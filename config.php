<?php
//Your Limewire API Key
$API_KEY = "";
$AI_ENDPOINT = "https://api.limewire.com/api/image/generation";

//Some utility functions
function file_get_contents_curl($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	$cdata = curl_exec($ch);
	curl_close($ch);
	return $cdata;
}

function copyImageToServer($dest, $src)
{
	$srcImg = file_get_contents_curl($src);
	file_put_contents($dest, $srcImg);
}
?>