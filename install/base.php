<?php




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

session_start();

$app_name = 'CloudOnex Business Suite';
$app_url = 'www.cloudonex.com';
$release_date = 'November 17, 2017';
$author_name = 'Razib M.';
$support_url = 'https://www.cloudonex.com/support';


function inSession($key,$def=''){
    if(isset($_SESSION[$key])){
        return $_SESSION[$key];
    }
    else{
        return $def;
    }
}
