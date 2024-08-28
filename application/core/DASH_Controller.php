<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DASH_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

    protected function __is_logged_user($type, $redirect=true){
        $fmdb_user = $this->__get_user($type, get_userid($type));
        if($redirect){
            switch($type){
                case 'ADMIN' :
                    if($fmdb_user->login_status != 1){
                        redirect(site_url('login/?redirect_url='. base64_encode(urlencode(current_url()))));
                        exit();
                    }
                    break; 
                case 'USER' :
                    if(!$fmdb_user->id){
                        redirect(site_url('login/?redirect_url='. base64_encode(urlencode(current_url()))));
                        exit();
                    }
                    break;
            }
        }else{
            switch($type){
                case 'ADMIN' :
                    return ($fmdb_user->access == 'allowed' && $fmdb_user->status == 'on') ? true : false;
                    break; 
                case 'USER' :
                    return ($fmdb_user->id) ? true : false;
                    break;
            }
        }
    }

    protected function __get_user($type, $id){
        switch($type){
            case 'ADMIN' :
                $fmdb = TBL_USERS;
                break;
            case 'USER' :
                $fmdb = TBL_USERS;
                break;
        }
        $record = $this->dbconnect->getWhere($fmdb, compact('id'), true);        
        return $record;
    }

}