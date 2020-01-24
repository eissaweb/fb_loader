<?php 
if (! isset($_GET['url']) || ! isset($_GET['filename'])) exit;

$url = $_GET['url'];
$fileName = $_GET['filename'] . 'video_.mp4';
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=\"" . $fileName."\"");
header("Content-Description: File Transfer");
readfile($url);
exit;