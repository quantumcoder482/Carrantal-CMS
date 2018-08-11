<?php
require 'base.php';
@ini_set('memory_limit', '512M');
@ini_set('max_execution_time', 0);
@set_time_limit(0);
$appurl = $_POST['appurl'];
$db_host = $_POST['dbhost'];
$db_user = $_POST['dbuser'];
$db_password = $_POST['dbpass'];
$db_name = $_POST['dbname'];

$_SESSION['db_host'] = $db_host;
$_SESSION['db_user'] = $db_user;
$_SESSION['db_password'] = $db_password;
$_SESSION['db_name'] = $db_name;

$purchase_key = trim($_POST['purchase_key']);

if($appurl == '' OR $db_host == '' OR $db_user == '' OR $db_name == '' OR $purchase_key == ''){
   echo 'Please Input all the informations and try again.';
   exit;
}


// set post fields
//$get_license = [
//    'purchase_key' => $purchase_key,
//    'app_url' => $appurl
//];
//
//$ch = curl_init('https://www.cloudonex.com/get-license');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $get_license);
//
//// execute!
//$response = curl_exec($ch);
//
//// close the connection, release resources used
//curl_close($ch);
//
//$res = json_decode($response);
//
//if($res->license_key == ''){
//
//    echo 'Invalid Purchase Key. Or unable to contact with server.';
//    exit;
//
//}
//
//else{
//    $_SESSION['license_key'] = $res->license_key;
//    $_SESSION['purchase_key'] = $purchase_key;
//}

//

//$link = mysqli_connect($db_host, $db_user , $db_password, $db_name);
//
//if (!$link) {
//    echo "Error: Unable to connect to MySQL." . PHP_EOL;
//    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
//    exit;
//}

try{
    $dbh = new pdo( "mysql:host=$db_host;dbname=$db_name",
        "$db_user",
        "$db_password",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    // database connection successful

    //create config file


    $input = '<?php
define(\'DB_HOST\', \'' . $db_host . '\'); # Database Host
define(\'DB_PORT\', \'\'); # Database Port. Keep it blank if you are un sure.
define(\'DB_USER\', \'' . $db_user . '\'); # Database Username
define(\'DB_PASSWORD\', \'' . $db_password . '\'); # Database Password
define(\'DB_NAME\', \'' . $db_name . '\'); # Database Name
define(\'APP_URL\', \'' . $appurl . '\'); # Application URL.
#Please include http and do not use trailing slash after the url. For example use in this format- http://www.example.com Or http://www.example.com/finance
define(\'APP_STAGE\', \'Live\'); # Change Live to Dev to enable Debug
';

    $f_msg = 'Can\'t create config file. The folder is not writable. You will have to manually create config file. Create a <strong>config.php</strong> inside- <strong>system</strong> folder with following contents- <hr>
<textarea rows="10" class="form-control">'.$input.'</textarea>
<span class="help-block">StackPI required some folders writable. It seems folders is not writable. The App may not work properly. For common troubleshooting tips, please visit- <strong><a href="https://www.cloudonex.com/doc/general/troubleshooting" target="_blank">https://www.cloudonex.com/doc/general/troubleshooting</a></strong></span>
';

    $wConfig = "../system/config.php";

    if(file_exists($wConfig)){
        echo 'Config file exist. Please delete- <strong>system/config.php</strong> and try again.';
        exit;
    }



    $fh = fopen($wConfig, 'w') or die($f_msg);
    fwrite($fh, $input);
    fclose($fh);

    echo '1';


}
catch(PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}



