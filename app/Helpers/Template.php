<?php
namespace App\Helpers;

class Template
{
    public static function selectbox($datas=[],$selected=null,$name=null,$attributes=[]){
        $attrs = '';
        foreach($attributes as $key=>$attr){
            $attrs .= $key.' = "'.$attr.'"';
        }
        $element = '<select name="'.$name.'" '.$attrs.'>';
        foreach($datas as $key=>$data){
            $element .= '<option value="'.$key.'" '.($selected == $key ? 'selected' : '').'>';
            $element .= $data;
            $element .= '</option>';
        }
        $element .='</select>';
        return $element;
    }
}
