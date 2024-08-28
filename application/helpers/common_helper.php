<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function valid_url_check($url){
    $ci =& get_instance();
    $valid_url_list = array_keys($ci->router->routes);    
    if($url){
        $get_method_part_of_the_url = explode('/', $url);
        $matches = array();
        foreach($valid_url_list as $method){
            if(preg_match("/\b$get_method_part_of_the_url[3]\b/i", $method)) {
                $matches[] = $method;
            }   
        }
    }else{
        $url = site_url();
    }
    return (count($matches)> 0) ? $url : ($ci->agent->referrer() ? $ci->agent->referrer() : site_url());
}

function redirect_page_error($content, $redirect_url){
    if(!$content){
        redirect(base_url($redirect_url));
    }
}

function make_array_list($objArray, $column1, $column2=null){
    if(is_object($objArray) || is_array($objArray)){
        $array = array();
        foreach($objArray as $row){
            $row = (object) $row;
            $array[$row->$column1] = ($column2) ? $row->$column2 : $row;
        }
        return $array;
    }
}

function make_group_list($objArray, $targetKey, $isRow = false){
    if(is_object($objArray) || is_array($objArray)){
        $array = array();
        foreach($objArray as $row){
            $row = (object) $row;
            if($isRow){
                $array[$row->$targetKey] = $row;
            }else{
                $array[$row->$targetKey][] = $row;
            }
        }
        return $array;
    }
}

function make_list_values($values, $source){
    if(empty($values)){ return false; }
    $valuesArray = (!is_array($values)) ? explode(',', $values) : $values;    
    if(is_array($source)){
        $returnArray = array_filter(array_map(function($value) use ($source){ return $source[$value]; }, $valuesArray));
        return $returnArray;
    }
    return false;
}

function objectToArray($d){
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }
    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    }
    else {
        // Return array
        return $d;
    }
}

function arrayToObject($d){
    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return (object) array_map(__FUNCTION__, $d);
    }
    else {
        // Return object
        return $d;
    }
}

function valid_date($date){
    if($date){
        $date = get_date_only($date);        
        if(in_array($date, array('0000-00-00', '00-00-0000'))){            
            return false;
        }else{
            if(preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/", $date)){
                list($day, $month, $year) = explode('-', $date);
            }elseif(preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)){
                list($year, $month, $day) = explode('-', $date);
            }else{
                return false;
            }
            return (checkdate($month, $day, $year)) ? true : false;
        }
    }else{
        return false;
    }
}

function get_date_only($date){
    return substr($date, 0, 10);
}

function get_days($endDate, $startDate=null){
    if(valid_date($endDate) && (is_null($startDate) || valid_date($startDate))){
        $eDate = new DateTime($endDate);
        $sDate = (is_null($startDate)) ? new DateTime() : new DateTime($startDate);
        $diff = $sDate->diff($eDate);
        return $diff;
    }
    return false;
}

function get_date_range($from, $to){
    if(valid_date($from) && valid_date($to)){
        $dateRange = [];
        $day = 1;
        while(strtotime($from) <= strtotime($to)){
            $dateRange[$day] = $from;            
            $from = date('Y-m-d', strtotime('+1 day', strtotime($from)));            
            // $date = new DateTime($from);
            // $date->modify('+1 day');
            // $from = $date->format('Y-m-d');
            $day++;
        }
        return $dateRange;
    }
    return false;    
}

function time_format_convert($time, $format){
    $time = preg_replace('/\s+/', '', $time);    
    $timeFormat = new DateTime($time);
    return $timeFormat->format($format);
}

function youtube_id_from_url($url) {
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
        return $id[1];
    } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
        return $id[1];
    } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
        return $id[1];
    } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
        return $id[1];
    } else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
        return $id[1];
    } else { 
        return false;
    }
}

function get_youtube_url_image($video_url, $image_type){
    $video_id = youtube_id_from_url($video_url);
    if($video_id){
        //$url = 'https://img.youtube.com/vi/'.$video_id.'/';
        $url = 'https://i.ytimg.com/vi/'.$video_id.'/';
        switch($image_type){
            case 'standard' : $url .= 'default.jpg'; break;
            case 'medium' : $url .= 'mqdefault.jpg'; break;
            case 'high' : $url .= 'hqdefault.jpg'; break;        
            case 'max' : $url .= 'maxresdefault.jpg'; break;
            case 0 : $url .= '0.jpg'; break;
            case 1 : $url .= '1.jpg'; break;
            case 2 : $url .= '2.jpg'; break;
            case 3 : $url .= '3.jpg'; break;
        }
        return $url;
    }else{ return false; }    
}

function currency_convert($value, $comma=false, $decimal=false){
    $striped = ($value) ? str_replace(',', '', $value) : 0;
    return ($comma) ? number_format($striped, (($decimal) ? 2 : 0), '.', ',') : $striped;
}