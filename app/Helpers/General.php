<?php
namespace App\Helpers;

class General
{
    public static function setImage($img,$path){
        if ($img != null) {
            $prefix_path    = $path . '/' . date('YmdHis');
            $path           = $this->getHashName($img, $prefix_path);
            $image          = $this->image($img);
            $save           = $this->saveImage($path, $image);
            return $path;
        }
        return null;
    }

    public static function columnDatatable($datas){
        foreach($datas as $data)
    	{
    		$columns[] = ['data'=>$data, 'name'=>$data ];
    	}
    	return json_encode($columns);
    }

    public static function getSegmentFromEnd($url,$position_from_end = 1) {
        $segments = $url;
        return $segments[sizeof($segments) - $position_from_end];
    }

    
}
