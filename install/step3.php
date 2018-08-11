<?php
require ('base.php');



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
    <div class="col-md-12">



        <?php
        if (isset($_GET['_error']) && ($_GET['_error']) == '1') {
            echo '<hr><h4 style="color: red;"> Unable to Connect Database, Please make sure database info is correct and try again ! </h4><hr>';
        }
        elseif (isset($_GET['_error']) && ($_GET['_error']) == '2') {
            echo '<hr><h4 style="color: red;"> Config File Already Exist, Application is already installed. If Not delete config.php in application folder. And try installing again. </h4><hr>';
        }

        elseif (isset($_GET['_error']) && ($_GET['_error']) == '3') {
            echo '<hr><h4 style="color: red;"> Please provide database info correctly and try again. </h4><hr>';
        }

        elseif (isset($_GET['_error']) && ($_GET['_error']) == '4') {
            echo '<hr><h4 style="color: red;"> An error occurred during database import. Delete system/config.php file & try with manual installation- <a href="#" target="_blank">https://www.stackpi.com/manual-installation/when-failed</a> </h4><hr>';
        }

        elseif (isset($_GET['_error']) && ($_GET['_error']) == '5') {
            echo '<hr><h4 style="color: red;"> Invalid Purchase Key, you will find your purchase key from here- <a href="https://www.stackpi.com/downloads" target="_blank">https://www.stackpi.com/downloads</a> </h4><hr>';
        }

        else{
           // echo '<h4 style="color: red;"> An Error Occuered </h4>';
        }
        ?>
        <?php
        $http = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $cururl = $http . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $appurl = str_replace('/install/step3.php', '', $cururl);
        $appurl = str_replace('?_error=1', '', $appurl);
        $appurl = str_replace('?_error=2', '', $appurl);
        $appurl = str_replace('?_error=3', '', $appurl);
        $appurl = str_replace('?_error=4', '', $appurl);
        $appurl = str_replace('?_error=5', '', $appurl);
        $appurl = str_replace('/system', '', $appurl);


        ?>

        <form action="" method="post" id="ib_form">
            <fieldset>
                <legend>Database Connection &amp Site config</legend>

                <div class="form-group">
                    <label for="appurl">Application URL</label>
                    <input type="text" class="form-control" id="appurl" name="appurl" value="<?php echo $appurl; ?>">
                    <span class='help-block'>Application url without trailing slash at the end of url (e.g. http://example.com/app). Please keep default, if you are unsure.</span>
                </div>

                <div class="form-group">
                    <label for="purchase_key">Purchase Key</label>
                    <input type="text" class="form-control" id="purchase_key" name="purchase_key" value="<?php echo inSession('purchase_key'); ?>">
                    <span class='help-block'>To install this software, you need a valid purchase key. You can retrieve it from here- <a href="https://www.cloudonex.com/downloads" target="_blank">https://www.cloudonex.com/downloads</a> </span>
                </div>

                <hr>
                <p>Before getting started, we need some information on the database. You will need to know the following items, input those and Click Submit to Continue.</p>

                <hr>
                <div class="form-group">
                    <label for="dbhost">Database Host</label>
                    <input type="text" class="form-control" id="dbhost" name="dbhost" value="localhost" value="<?php echo inSession('db_host'); ?>">
                    <span class="help-block">You should be able to get this info from your web host, if <strong>localhost</strong> doesn’t work.</span>
                </div>
                <div class="form-group">
                    <label for="dbuser">Database Username</label>
                    <input type="text" class="form-control" id="dbuser" name="dbuser" value="<?php echo inSession('db_user'); ?>">
                    <span class="help-block">Your database username.</span>
                </div>
                <div class="form-group">
                    <label for="dbpass">Database Password</label>
                    <input type="text" class="form-control" id="dbpass" name="dbpass" value="<?php echo inSession('db_password'); ?>">
                    <span class="help-block">Your database password.</span>
                </div>

                <div class="form-group">
                    <label for="dbname">Database Name</label>
                    <input type="text" class="form-control" id="dbname" name="dbname" value="<?php echo inSession('db_name'); ?>">
                    <span class="help-block">The name of the database.</span>
                </div>

                <button type="submit" id="ib_submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
</div>

<script src="../ui/lib/cloudonex.js"></script>


<script type="text/javascript">

    var block_msg = '<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="32" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div>';

    var ib_submit = $("#ib_submit");
    var ib_box = $("#main-container");

    ib_submit.on('click', function(e) {

        e.preventDefault();
        ib_box.block({message: block_msg});

        $.post("ajax_c.php", $('#ib_form').serialize())
            .done(function( data ) {

                if ($.isNumeric(data)) {

//                    ib_box.unblock();

                    ib_box.block({message: '<h3 style="color: #fff">Config file created. Importing database....</h3>'});

                 //   window.location = 'profile.php';

                    $.get( "db_import.php", function( data ) {

                        if ($.isNumeric(data)) {

                            ib_box.block({message: '<h3 style="color: #fff">Database Imported. Redirecting.....</h3>'});

                            window.location = 'profile.php';

                        }
                        else{
                            window.location = '../index.php';
                        }

                    });


                }

                else {
                    ib_box.unblock();
                    bootbox.alert(data);
                }





            });

    });

</script>

</body>
</html>

