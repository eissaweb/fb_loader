<?php 
if (! isset($_GET['url']) || ! isset($_GET['filename'])) exit;

$url = $_GET['url'];
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_HEADER, true); 
curl_setopt($ch, CURLOPT_NOBODY, true); // make it a HEAD request
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
$head = curl_exec($ch);

$mimeType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
$path = parse_url($url, PHP_URL_PATH);
//$filename = substr($path, strrpos($path, '/') + 1);

curl_close($ch); 


$fileName = $_GET['filename'] . '_eissaweb.com_.mp4';

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Content-Type: application/force-download");
header("Content-Type: {$mimeType}");
header("Content-Disposition: attachment; filename=\"" . $fileName."\"");
header("Content-Length: {$size}");
header("Content-Description: File Transfer");
readfile($url);
exit;