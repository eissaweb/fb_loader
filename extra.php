<?php 
$url = 'http://localhost/fb_video_core/download.php?url=https%3A%2F%2Fvideo-gru1-1.xx.fbcdn.net%2Fv%2Ft42.9040-2%2F82604248_1269287039936307_640447892338769920_n.mp4%3F_nc_cat%3D104%26efg%3DeyJ2ZW5jb2RlX3RhZyI6InN2ZV9zZCJ9%26_nc_ohc%3D02HN3nxxO-cAX8QPTBt%26_nc_ht%3Dvideo-gru1-1.xx%26oh%3Dc9c1b9e762726c126743d9b39a03f2c2%26oe%3D5E29D5A6&filename=%E2%80%AB%D8%AC%D9%88_%D8%B4%D9%88_Joe_Show_-_%D9%85%D9%82%D8%AA%D9%84_%D9%82%D8%A7%D8%B3%D9%85_%D8%B3%D9%84%D9%8A%D9%85%D8%A7%D9%86%D9%8A_|_Facebook%E2%80%AC';

echo retrieve_remote_file_size($url);


function retrieve_remote_file_size($url){
     $ch = curl_init($url);

     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     curl_setopt($ch, CURLOPT_HEADER, TRUE);
     curl_setopt($ch, CURLOPT_NOBODY, TRUE);

     $data = curl_exec($ch);
     $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

     curl_close($ch);
     return $size;
}