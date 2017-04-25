<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This Class used as REST API for user
 * @package   CodeIgniter
 * @category  Controller
 * @author    Sorav Garg
 */

class User extends Common_API_Controller {
    function __construct() 
    {
        parent::__construct();
        $post = file_get_contents("php://input");
        $this->data = json_decode($post);
    }

    function register_POST(){
    	$requestparam = $this->data; 
    	$getUser = $this->Common_model->getcount("users", array("email"=>$requestparam->email));
    	if($getUser == 0){
    		$registerid = $this->Common_model->insertData("users", array("name"=> $requestparam->name, "email"=> $requestparam->email, "password"=> md5($requestparam->password), "user_type"=>$requestparam->user_type));
    		$response = array("status_code"=> 200, "message"=>"User registered successfully", "user_id"=> $registerid);
    	}else{
    		$response = array("status_code"=>400, "message"=>"Email already registered with us");
    	}
    	echo json_encode($response);
    }

    function login_POST(){
    	$requestparam = $this->data; 
    	$getUser = (array)$this->Common_model->getsingle("users", array("email"=>$requestparam->email, "password"=>md5($requestparam->password)));
        unset($getUser['password']);
    	if(!empty($getUser)){
    		$response = array("status_code"=>200, "message"=>"Login successfully", "data"=> $getUser);
    	}else{
    		$response = array("status_code"=>400, "message"=>"Email or password is wrong");
    	}
    	echo json_encode($response);
    }

    function changepassword_POST(){
        $requestparam = $this->data; 
        $updatepass = $this->Common_model->updateFields("users", array("password"=>md5($requestparam->password)), array("id" => $requestparam->user_id));
        echo $this->db->last_query();
        if($updatepass){
            $response = array("status_code"=>200, "message"=>"Password changed successfully");
        }else{
            $response = array("status_code"=>400, "message"=>"Can't use old password");
        }
        echo json_encode($response);
    }

    function forgotpassword_POST(){
        $requestparam = $this->data; 
        $getUser = $this->Common_model->getsingle("users", array("email"=>$requestparam->email));
        if(!empty($getUser)){
            $rand = rand(1000,9999);
            $updatepass = $this->Common_model->updateFields("users", array("rand"=>$rand), array("email" => $requestparam->email));
            mail($requestparam->email, "Password reset Code", $rand);
            $response = array("status_code"=>200, "message"=>"Email is sent to your registered email.");
        }else{
            $response = array("status_code"=>400, "message"=>"Email is not registered with us");
        }
        echo json_encode($response);
    }

    function resetpassword_POST(){
        $requestparam = $this->data; 
        $getUser = $this->Common_model->getsingle("users", array("rand"=>$requestparam->rand));
        if(!empty($getUser)){
            $updatepass = $this->Common_model->updateFields("users", array("password"=>md5($requestparam->password)), array("rand" => $requestparam->rand));
            if($updatepass){
                $response = array("status_code"=>200, "message"=>"Password changed successfully.");
            }else{
                $response = array("status_code"=>400, "message"=>"Cannot use old password");
            }
        }else{
            $response = array("status_code"=>400, "message"=>"Please enter correct code");
        }
        echo json_encode($response);
    }
}

?>