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

class Categories extends Common_API_Controller {
    function __construct() 
    {
        parent::__construct();
        $post = file_get_contents("php://input");
        $this->data = json_decode($post);
    }
    
    function getcategories_GET(){
        $getCat = $this->Common_model->getAll("categories");
		$response = array("status_code"=>200, "message"=>"Successfull", "data"=> $getCat);
    	echo json_encode($response);
    }	
}

?>