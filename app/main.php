<?php
//error_reporting(0);
header('Content-Type: application/json');

$msg = [];

try {
    $url = $_REQUEST['url'];

    if (empty($url)) {
        throw new Exception('Please provide the URL', 1);
    }

    $context = [
        'http' => [
            'method' => 'GET',
            'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.47 Safari/537.36',
        ],
    ];
    $context = stream_context_create($context);
    $data = file_get_contents($url, false, $context);

    $msg['success'] = true;

    //$msg['id'] = generateId($url);
    $msg['id'] = extract_id_from_url($url);
    $msg['title'] = getTitle($data);
    $msg['title'] = str_replace(['/', ' '], '_', $msg['title']);
    // get the thumbnail
    $msg['thumbnail'] = "https://graph.facebook.com/{$msg['id']}/picture";
    if ($sdLink = getSDLink($data)) {
        $msg['sd_size'] = getFileSize($sdLink);
        $msg['links']['download_low'] = urlencode($sdLink);
    }

    if ($hdLink = getHDLink($data)) {
        $msg['hd_size'] = getFileSize($hdLink);
        $msg['links']['download_high'] = urlencode($hdLink);
    }
    $msg['links']['play_video'] = $hdLink ?  $hdLink :  $sdLink;
} catch (Exception $e) {
    $msg['success'] = false;
    $msg['message'] = $e->getMessage();
}

echo json_encode($msg);

function generateId($url)
{
    $id = '';
    if (is_int($url)) {
        $id = $url;
    } elseif (preg_match('#(\d+)/?$#', $url, $matches)) {
        $id = $matches[1];
    }

    return $id;
}

function extract_id_from_url($url) {
    if (strpos($url, 'v=')) {
        $ex = explode('v=', $url);
        if (isset($ex[1]) && is_numeric($ex[1])) {
            return $ex[1];
        }
    }
    preg_match('/https?:\/\/(www.)?facebook\.com\/([a-zA-Z0-9_\- ]*)\/([a-zA-Z0-9_\- ]*)\/([a-zA-Z0-9_\.\-]*)\/([a-zA-Z0-9_\-]*)(\/\?type=1&theater\/)?/i', $url, $tmp);

    foreach ($tmp as $t) {
        if (is_numeric($t)) {
            return $t;
        }
    }
    return '';
    return isset($tmp[5]) ? $tmp[5] : false;
}
function cleanStr($str)
{
    return html_entity_decode(strip_tags($str), ENT_QUOTES, 'UTF-8');
}

function getSDLink($curl_content)
{
    $regexRateLimit = '/sd_src_no_ratelimit:"([^"]+)"/';
    $regexSrc = '/sd_src:"([^"]+)"/';

    if (preg_match($regexRateLimit, $curl_content, $match)) {
        return $match[1];
    } elseif (preg_match($regexSrc, $curl_content, $match)) {
        return $match[1];
    } else {
        return false;
    }
}

function getHDLink($curl_content)
{
    $regexRateLimit = '/hd_src_no_ratelimit:"([^"]+)"/';
    $regexSrc = '/hd_src:"([^"]+)"/';

    if (preg_match($regexRateLimit, $curl_content, $match)) {
        return $match[1];
    } elseif (preg_match($regexSrc, $curl_content, $match)) {
        return $match[1];
    } else {
        return false;
    }
}

function getTitle($curl_content)
{
    $title = null;
    if (preg_match('/h2 class="uiHeaderTitle"?[^>]+>(.+?)<\/h2>/', $curl_content, $matches)) {
        $title = $matches[1];
    } elseif (preg_match('/title id="pageTitle">(.+?)<\/title>/', $curl_content, $matches)) {
        $title = $matches[1];
    }

    return cleanStr($title);
}

function getDescription($curl_content)
{
    if (preg_match('/span class="hasCaption">(.+?)<\/span>/', $curl_content, $matches)) {
        return cleanStr($matches[1]);
    }

    return false;
}


function getFileSize($url, $mb = true) {
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
    if ($size >= 1024) {
        return round($size, 2) . ' GB';
    }
    $size = round($size, 2);
    return $size . ' MB';
}