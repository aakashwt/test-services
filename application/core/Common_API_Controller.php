<?php

require APPPATH.'/libraries/REST_Controller.php';

class Common_API_Controller extends REST_Controller {

	public function __construct() {
      parent::__construct();
    }

    /**
     * Function Name: _check_value_exist
     * Description:   To check values exist or not into database
     */
    public function _check_value_exist($str,$field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field,$msg);
        $rows = $this->db->limit(1)->get_where($table, array($field => $str))->num_rows();
        if($rows != 0){
            $this->form_validation->set_message('_check_value_exist', $msg);
            return FALSE;
        }else{
            return TRUE;
        }
    }

    /**
     * Function Name: _validate_login_session_key
     * Description:   To validate user login session key
     */
    public function _validate_login_session_key($LoginSessionKey)
    {
        $ci =&get_instance();
        $result = $ci->common_model->getSingleRecordById(USERS,array('login_session_key' => $LoginSessionKey));
        if(!empty($result)){
            return TRUE;
        }else{
            $ci->form_validation->set_message('_validate_login_session_key', 'Invalid Login Session Key');
            return FALSE;
        }
    }

    /**
     * Function Name: regex_check
     * Description:   For Password Regular Expression
     */
    public function pswd_regex_check($str)
    {
        $ci =&get_instance();
        if (1 !== preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/", $str))
        {
            $ci->form_validation->set_message('pswd_regex_check', 'Password must contain at least 6 characters, including UPPER/lower case & numbers, at-least one special character');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * Function Name: _pageno_min_value
     * Description:   For Check Minmum Value
     */
    public function _pageno_min_value($val)
    {
        $ci =&get_instance();
        $min = 1;
        if ($min > $val)
        {
            $ci->form_validation->set_message('_pageno_min_value', 'Page No minimum value should be '.$min);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * Function Name: _validate_date_format
     * Description:   To validate date format
     */
    public function _validate_date_format($date)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
        {
            $DateObject        = strtotime($date);
            $CurrentDateObject = strtotime(date('Y-m-d'));

            // Date should be greater then or equal to current date
            if($CurrentDateObject > $DateObject){
                $this->form_validation->set_message('_validate_date_format', 'Date should be greater then or equal to current date');
                return FALSE;
            }
            return TRUE;
        }else{
            $this->form_validation->set_message('_validate_date_format', 'Invalid date format, should be (YYYY-MM-DD)');
            return FALSE;
        }
    }

    

}