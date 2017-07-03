<?php
require_once 'lib/twitteroauth.php';

$o_data = get_user_info();

$to = new TwitterOAuth(
	$o_data->consumer_key,
	$o_data->consumer_secret,
	$o_data->access_token,
	$o_data->access_token_secret);

$tweet = get_tweet();

$to->OAuthRequest("https://api.twitter.com/1.1/statuses/update.json","POST",array("status" => $tweet));


function get_tweet() {

$filelist = file('data/growl.txt');
if( shuffle($filelist) ){
  $message = $filelist[0];
  $message = mb_substr($message, 0, -2, "SJIS");
}
if( shuffle($filelist) & rand(0,3)!=1){
  $message .= $filelist[0];
  $message = mb_substr($message, 0, -2, "SJIS");
}
if( shuffle($filelist) & rand(0,1)!=1){
  $message .= $filelist[0];
  $message = mb_substr($message, 0, -2, "SJIS");
}
if( shuffle($filelist) & rand(0,3)==1){
  $message .= $filelist[0];
  $message = mb_substr($message, 0, -2, "SJIS");
}
$str = mb_convert_encoding($message,"utf-8","sjis"); 
	return $str;
}

function get_user_info() {
	$o_data = json_decode(file_content('data/outh_data.json'));
	return $o_data;
}



function file_content($filename) {
	$handle = fopen($filename, 'r');
	$data = fread($handle, filesize($filename));
	fclose($handle);
	return $data;
}


