<?php
error_reporting(E_WARNING); # log errors

### CORS interaction
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');

if(array_key_exists('HTTP_ACCESS_CONTROL_REQUEST_HEADERS', $_SERVER)) {
    header('Access-Control-Allow-Headers: '
        . $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);
} else {
    header('Access-Control-Allow-Headers: *');
}

if("OPTIONS" == $_SERVER['REQUEST_METHOD']) {
    exit(0);
}
###

### compute POST request
if("POST" == $_SERVER['REQUEST_METHOD']){
    # PHP parse json manualy
    $file = 'apache.log';
    if(!is_file($file)){
        file_put_contents($file, '');     // Save our content to the file.
    }
    $postData = file_get_contents('php://input');
    file_put_contents($file, $postData, FILE_APPEND | LOCK_EX);
}
?>