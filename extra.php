<?php 
$url = 'https://r1---sn-4g5edns6.googlevideo.com/videoplayback?expire=1579966244&ei=wwosXp7IGKrR5gTFrJSICw&ip=154.73.161.130&id=o-AMUTZDEMBnMHhSEd0LnH1QTIqHHJ-iDn65mfQbJXrNl6&itag=136&aitags=133%2C134%2C135%2C136%2C160%2C242%2C243%2C244%2C247%2C278&source=youtube&requiressl=yes&mm=31%2C26&mn=sn-4g5edns6%2Csn-aigl6nek&ms=au%2Conr&mv=m&mvi=0&pl=24&initcwndbps=103750&vprv=1&mime=video%2Fmp4&gir=yes&clen=1277592672&dur=7629.080&lmt=1576789236837519&mt=1579944594&fvip=1&keepalive=yes&fexp=23842630&c=WEB&txp=6316222&sparams=expire%2Cei%2Cip%2Cid%2Caitags%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cgir%2Cclen%2Cdur%2Clmt&sig=ALgxI2wwRQIgbTB_a1bZHuKlXZtw30WYDnFjKAsHgrOBCnnL32ZAREECIQD0zu0UAcQowHjmGI9ZDfkdNiMUgsAW0ntRm3ZtXnVDhw%3D%3D&lsparams=mm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AHylml4wRAIgKto-dw76hG-CvsWPIEwok_olw5VZc9yKlYDvp5YABGACIACqPterCs858LtpTRQAyJuP9qHFlw3SMdo_V6_fwuW4';

//$url = urldecode($url);

echo retrieve_remote_file_size($url);


function retrieve_remote_file_size($url, $mb = true){
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
    if (! $mb) {
    	return $size;
    }

    $size = $size  / (1024 * 1024);
    $size = round($size, 2);
    return $size . ' MB';

}