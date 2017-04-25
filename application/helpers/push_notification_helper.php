<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Push Notifications Helper
* Author: Sorav Garg
* Author Email: soravgarg123@gmail.com
* Description: This helper is used to send push notifications.
* version: 1.0
*/

if(!function_exists('send_android_notification')) {
	function send_android_notification($data, $target,$badges = 0,$user_id = ''){
		//FCM api URL
		$url = 'https://fcm.googleapis.com/fcm/send';
		//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
		$server_key = 'AIzaSyDEiGNYzs9FYa9M7L7u6dOTM9vtdukLTJg';
					
		$fields = array();
		$fields['data'] = $data;
		$fields['data']['badges'] = $badges;

		//header with content_type api key
		$headers = array(
			'Content-Type:application/json',
		  	'Authorization:key='.$server_key
		);
					
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);

		/* To update user badges */
		if(!empty($user_id)){
			$this->db->update(USERS, array('badges','badges+1'), array('id' => $user_id));
		}
	}
}

if(!function_exists('send_ios_notification')) {
	function send_ios_notification($deviceToken, $message,$params = array(),$badges = 0,$user_id = '') {

		// Put your private key's passphrase here:
		$passphrase = '123456';
		$user_certificate_path = APPPATH . "/libraries/Certificates.pem";
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', $user_certificate_path);
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		// Open a connection to the APNS server
		$fp = stream_socket_client(APNS_GATEWAY_URL, $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp) {
			log_message('apn_debug',"APN: Maybe some errors: $err: $errstr");
			//exit("Failed to connect: $err $errstr" . PHP_EOL);
		} else {
			log_message('apn_debug',"Connected to APNS");
			//echo 'Connected to APNS' . PHP_EOL;
		}

		// Create the payload body
		$body['aps'] = array(
			'alert' => $message,
			'params'=> $params,
			'badges'=> $badges,
			'sound' => 'default'
			);

		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));

		if (!$result) {
			log_message('apn_send_debug',"APN: Message not delivered");
			//echo 'Message not delivered' . PHP_EOL;
		} else {
			/* To update user badges */
			if(!empty($user_id)){
				$this->db->update(USERS, array('badges','badges+1'), array('id' => $user_id));
			}
			log_message('apn_send_debug',"APN: Message successfully delivered");
			//echo 'Message successfully delivered' . PHP_EOL;
		}

		// Close the connection to the server
		fclose($fp);
	}
}


/* End of file push_notification_helper.php */
/* Location: ./system/application/helpers/push_notification_helper.php */

?>