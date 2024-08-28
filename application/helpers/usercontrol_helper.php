<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_userid($type){
    $ci =& get_instance();
    return $ci->session->userdata('logged_'.strtolower($type))->id;
}

# ADMIN functions ==============================================================

function get_admin(){
    $CI = & get_instance();
    $admin_user = $CI->admin_user;
    return $admin_user;
}

function is_admin($roles){
    return ($roles) ? ( (is_array($roles)) ? ((in_array(get_admin()->role, $roles)) ? true : false) : ((in_array(get_admin()->role, explode('|',$roles))) ? true : false) ) : false;
}

# USER functions ===============================================================

function get_user(){
    $CI = & get_instance();
    $site_user = $CI->site_user;
    if($site_user){
        $site_user->user_username = $site_user->app_id . ' : ' . $site_user->f_name . ' ' . $site_user->l_name;
    }
    return $site_user;
}