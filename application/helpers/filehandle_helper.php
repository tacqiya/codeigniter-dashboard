<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function has_file($folder, $file){
    $path = FCPATH . $folder . '/' . $file;    
    return (is_file($path) && file_exists($path)) ? true : false;
}

function get_file($folder, $file, $type = 'URL'){
    $path = $folder . '/' . $file;
    switch($type){
        case 'URL' :
            return base_url('/'.$path);
            break;
        case 'DIR' :
            return FCPATH . $path;
            break;
    }
}

function get_file_icon($file){    
    if($file){
        switch(pathinfo($file, PATHINFO_EXTENSION)){
            case 'gif' : case 'png' : case 'jpg' : case 'jpeg' : return 'image'; break;
            case 'xls' : case 'xlsx' : return 'excel'; break;
            case 'ppt' : case 'pptx' : return 'powerpoint'; break;
            case 'doc' : case 'docx' : return 'word'; break;
            case 'pdf' : return 'pdf'; break;
            case 'zip' : case 'rar' : return 'archive'; break;
            default : return 'text'; break;
        }
    }    
}

function file_handler($handler,$is_single=false){
    if(is_array($handler) && array_filter($handler)){
        extract($handler);
        $fileArray = array_filter(array_map(function($_file) use ($dir){
            extract($_file);
            if(!$file) return false;
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            $size = @convert_filesize(filesize($path));
            $extention = @pathinfo($path, PATHINFO_EXTENSION);
            $icon = get_file_icon($file);
            return (object) compact('name','file','path','size','extention','icon');
        }, $files));
        return ($is_single) ? $fileArray[0] : $fileArray;
    }
    return false;
}

function convert_filesize($bytes, $decimals = 2){    
    $units = ['B','KB','MB','GB','TB','PB','EB','ZB','YB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return (object) [
        'bytes' => $bytes,
        'convereted' => sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) * 100/100,
        'unit' => @$units[$factor]
    ];
    //return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$units[$factor];
}