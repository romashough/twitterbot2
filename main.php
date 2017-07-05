<?php
require_once 'lib/twitteroauth.php';


$o_data = get_user_info();

$to = new TwitterOAuth(
	$o_data->consumer_key,
	$o_data->consumer_secret,
	$o_data->access_token,
	$o_data->access_token_secret);

$tweet = get_tweet();
if( rand(0,3)!=1){
$tweet .= get_tweet();}
if( rand(0,3)!=1){
$tweet .= get_tweet();
}

$to->OAuthRequest("https://api.twitter.com/1.1/statuses/update.json","POST",array("status" => $tweet));

function get_tweet() {
	$o_data = file_content('data/growl.txt');
	$tlist = preg_split("/\r\n/",$o_data);
	if ("" == end($tlist)) {
		array_pop($tlist);
	}
	$toutput= $tlist[rand(0, count($tlist) - 1)];
	return $toutput;
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
