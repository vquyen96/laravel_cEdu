<?php
	function cut_string($text, $length)
	{
	    if(strlen($text) > $length) {
	    	$text = $text.' ';
	        $text = substr($text, 0, strpos($text, ' ', $length)).'...';
	    }
	    return $text;
	}
	function cut_string_name($text, $length)
	{
	    if(strlen($text) > $length) {
	    	$text = $text.' ';
	        $text = substr($text, 0, $length).'...';
	    }
	    return $text;
	}


	/**
     * Save all images in request and resized copies of them.
     *
     * @return implode(',' , 'all images with new names');
     */
	function saveImage($input,$resized_size,$path){
	    $imgArr = [];
	    $max_size = $resized_size;
	    foreach ($input as $image) {

	        $filename = 'hs_'.date("Y-m-d").'_'.round(microtime(true)).'.'.$image->extension();
	        $image->storeAs($path,$filename);
	        $imgArr[] = $filename;

	        $image_info = getimagesize($image);
	        $width_orig  = $image_info[0];
	        $height_orig = $image_info[1];

	        $ratio = $width_orig/$height_orig;
	        if($ratio>=1){
	            $width=$max_size;
	            $height=$width/$ratio;
	        }else{
	            $height=$max_size;
	            $width=$height*$ratio;
	        }
	        $destination_image = imagecreatetruecolor($width, $height);

	        $type_org = $image->extension();
	        switch ($type_org) {
	            case 'jpeg':
	            $orig_image = imagecreatefromjpeg($image);
	            imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	            imagejpeg($destination_image, 'lib/storage/app/'.$path.'/resized-'.$filename);
	            break;

	            case 'jpg':
	            $orig_image = imagecreatefromjpeg($image);
	            imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	            imagejpeg($destination_image, 'lib/storage/app/'.$path.'/resized-'.$filename);
	            break;

	            case 'png':
	            $orig_image = imagecreatefrompng($image);
	            imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	            imagepng($destination_image, 'lib/storage/app/'.$path.'/resized-'.$filename);
	            break;

	            case 'gif':
	            $orig_image = imagecreatefromgif($image);
	            imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	            imagegif($destination_image, 'lib/storage/app/'.$path.'/resized-'.$filename);
	            break;
	        }
	    }
	    return implode(',',$imgArr);
	}

	function time_format($time){
		$date = new DateTime();
		$date = strtotime(date_format($date,"Y-m-d"));
		$time = strtotime(date_format($time,"Y-m-d"));
		$year = 31526000;
		$month = 2592000;
		$day = 86400;
		// strtotime(date_format($time,"Y-m-d")) == strtotime(date_format($date,"Y-m-d"))
		if ($time < $date-$year) {
			return round(($date-$time)/$year).' năm';
		}
		else if($time < $date-$month){
			return round(($date-$time)/$month).' tháng';
		}
		else{
			return round(($date-$time)/$day).' ngày';
		}

	}



	function getUrl() {
	    $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	    $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
	    $url .= $_SERVER["REQUEST_URI"];
	    return $url;
    }

    function aff_profit($amount){
    	if ($amount > 150000000) {
    		return $amount*0.3;
    	}
    	if ($amount > 61000000) {
    		return $amount*0.22;
    	}
    	if ($amount > 31000000) {
    		return $amount*0.18;
    	}
    	if ($amount > 11000000) {
    		return $amount*0.14;
    	}
    	if ($amount > 1000000) {
    		return $amount*0.11;
    	}
    	else{
    		return $amount*0.1;
    	}
    }
