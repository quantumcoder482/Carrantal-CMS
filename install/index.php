<?php
require 'base.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $app_name; ?> Installer</title>
    <link rel="shortcut icon" type="image/x-icon" href="../storage/icon/favicon.ico">
    <link href="../ui/theme/default/css/bootstrap.min.css" rel="stylesheet">
    <link href="../ui/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../ui/lib/icheck/skins/square/blue.css" rel="stylesheet">
    <link href="../ui/lib/css/animate.css" rel="stylesheet">
    <link href="../ui/lib/toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="../ui/theme/default/css/style.css?ver=2.0.1" rel="stylesheet">
    <link href="../ui/theme/default/css/component.css?ver=2.0.1" rel="stylesheet">
    <link href="../ui/theme/default/css/custom.css" rel="stylesheet">
    <link href="../ui/lib/icons/css/ibilling_icons.css" rel="stylesheet">
    <link href="../ui/theme/default/css/material.css" rel="stylesheet">
    <link type='text/css' href='style.css' rel='stylesheet'/>

</head>
<body style='background-color: #FBFBFB;'>
<div id='main-container'>
    <div class='header'>
        <div class="header-box wrapper">
            <div class="hd-logo"><a href="#"><img src="../storage/system/logo_inverse_6133988961.png" alt="Logo"/></a></div>
        </div>

    </div>
    <!--  contents area start  -->
    <div class="row">
        <div class="col-md-12">
            <hr>
            <h4> <?php echo $app_name; ?> Installer </h4>

            <div class="box box-two">


                <h5>

                    Please Read Before Continue</h5>

                <p><strong>About</strong><br>
                    Application Name: <?php echo $app_name; ?> <br>
                    By: Razib M. [ <a href="http://<?php echo $app_url; ?>" target="_blank"><?php echo $app_url; ?></a> ]<br>
                    <br>
                    <strong>Getting Support</strong><br>
                    If you need any help, don't hesitate to contact with us.<br>
                    <a href="<?php echo $support_url; ?>" target="_blank"><?php echo $support_url; ?></a>



            </div>

        </div>

        <div class="col-md-12"><br>

            <a href="step2.php" class="btn btn-primary">Accept &amp; Continue</a> <a href="#" class="btn">Cancel</a>
        </div>
    </div>



    <!--  contents area end  -->
</div>

<script src="../ui/theme/default/js/jquery-1.10.2.js"></script>
<script src="../ui/theme/default/js/bootstrap.min.js"></script>


</body>
</html>

