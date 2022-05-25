<?php
/************************************************************** 
* 	password Encryption
***************************************************************/

function passwordEncode($password){
	
	return substr(do_hash(do_hash(do_hash($password),'md5')),10,19);

}

/************************************************************** 
* 	Create GUID
/**************************************************************/

function guid(){
 
	return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

}

/************************************************************** 
* 	Random String
/**************************************************************/
	
function randomString($length = 10) {
	
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	    
}

/************************************************************** 
* 	Random Number
/**************************************************************/
	
function randomNumber($length = 10) {
	
	    $characters = '0123456789';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	    
}

/************************************************************** 
* 	String To Array
/**************************************************************/
	
function strToArr($string,$pattern) {
	
    return array_values(array_unique(array_filter(explode($pattern,$string))));
	    
}


/************************************************************** 
* 	encode string
/**************************************************************/

function safe_encode($string) {
    return strtr(base64_encode($string), '+/=', '._-');
}
 
/************************************************************** 
* 	decode string
/**************************************************************/
function safe_decode($string) {
    return base64_decode(strtr($string, '._-', '+/='));
}


/************************************************************** 
* 	Clean String
/**************************************************************/

function cleanString($string) {
	
	return trim(preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $string)); 
	
 }

/************************************************************** 
* 	Find String into String
/**************************************************************/

function findStringInString($string,$needed) {
	$pos = strpos($string,$needed);
	if ($pos === false) {
		return false;
	} else {
		return true;
	}
 }


 
         