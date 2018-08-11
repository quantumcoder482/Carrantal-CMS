<?php
require 'base.php';
require '../system/config.php';


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

 // $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$c_mysqli = false;
$c_pdo  = false;

if (mysqli_connect_errno()) {
    try{
        $dbh = new pdo( 'mysql:host='.DB_HOST.';dbname='.DB_NAME,
            DB_USER,
            DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $c_pdo  = true;
    }
    catch(PDOException $ex){

    }
}
else{
    $c_mysqli = true;
}



$sql = file_get_contents('primary.sql');
//$sql = str_replace('---LicenseKeyPlaceHolder---',$_SESSION['license_key'],$sql);
//$sql = str_replace('---PurchaseKeyPlaceHolder---',$_SESSION['purchase_key'],$sql);

if($c_mysqli){

    $mysqli->multi_query($sql);

}

elseif($c_pdo){

    $qr = $dbh->exec($sql);

}

else{

    echo 'Failed';
    exit;

}

echo '1';
