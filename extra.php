<?php 
$url = 'https://www.facebook.com/joeshowalaraby/videos/616659042400555/?from=bookmark';
print_r(extract_id_from_url($url));

function extract_id_from_url($url) {
    preg_match('/https?:\/\/(www.)?facebook\.com\/([a-zA-Z0-9_\- ]*)\/([a-zA-Z0-9_\- ]*)\/([a-zA-Z0-9_\.\-]*)\/([a-zA-Z0-9_\-]*)(\/\?type=1&theater\/)?/i', $url, $tmp);
    
    foreach ($tmp as $t) {
    	if (is_numeric($t)) {
    		return $t;
    	}
    }
    return '';
    return isset($tmp[5]) ? $tmp[5] : false;
}