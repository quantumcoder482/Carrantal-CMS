<?php
// Config






/*
|--------------------------------------------------------------------------
| Various Custom Function used in this application
|--------------------------------------------------------------------------
|
*/


/*


INSERT INTO sys_appconfig (setting, value) VALUES ('assets','1');



CREATE TABLE IF NOT EXISTS ib_assets (
id int(11) NOT NULL AUTO_INCREMENT,
`asset_name` varchar(200),
`price` decimal(14,2) NOT NULL DEFAULT '0.00',
`date_purchased` date,
`warranty_period` date,
`image` text,
`description` text,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY ( id )
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1




 */
// require 'ui/theme/' . $config['theme'] . '/functions.php';

use Sabre\Event\EventEmitter;
$app = new EventEmitter();

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model;

use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;



$update_server = 'https://www.cloudonex.com';
//$update_server = 'http://www.cloudonex.dev';


/**
 * Redirect Function
 *
 * @param  string  $to
 * @return void
 */

function r2($to, $ntype = 'e', $msg = '')
{
    if ($msg == '') {
        header("location: $to");
        exit;
    }
    $_SESSION['ntype'] = $ntype;
    $_SESSION['notify'] = $msg;
    header("location: $to");
    exit;
}



if (APP_STAGE == 'Dev') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
} else {
    error_reporting(0);
}

/**
 * Clean whitespace from string
 *
 * @param  string  $value
 * @return string
 */

function safedata($value)
{
    $value = trim($value);
    return $value;
}

/**
 * shortcut function
 *
 * @param  string  $param
 * @return string
 */

function _post($param, $defvalue = '')
{
    if (!isset($_POST[$param])) {
        return $defvalue;
    } else {
        return safedata($_POST[$param]);
    }
}

/**
 * shortcut function
 *
 * @param  string  $param
 * @return string
 */

function _get($param, $defvalue = '')
{
    if (!isset($_GET[$param])) {
        return $defvalue;
    } else {
        return safedata($_GET[$param]);
    }
}

/**
 * shortcut function
 *
 * @param  string  $l
 * @return string
 */

function _raid($l = '6')
{
    $r = substr(str_shuffle(str_repeat('0123456789', $l)), 0, $l);
    return $r;

}



$req = _get('ng');
$routes = explode('/', $req);
$handler = $routes['0'];
if ($handler == '') {
    $handler = 'default';
}

$db = new DB;

$db->addConnection([
    'driver'    => 'mysql',
    'host'      => DB_HOST,
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASSWORD,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$db->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$db->bootEloquent();





ORM::configure('mysql:host='.DB_HOST.';dbname='.DB_NAME);
ORM::configure('username', DB_USER);
ORM::configure('password', DB_PASSWORD);
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
ORM::configure('return_result_sets', true); // returns result sets
//ORM::configure('logging', true);





$result = ORM::for_table('sys_appconfig')->find_array();


foreach ($result as $value) {
    $config[$value['setting']] = $value['value'];
}


date_default_timezone_set($config['timezone']);

function _notify($msg, $type = 'e')
{
    $_SESSION['ntype'] = $type;
    $_SESSION['notify'] = $msg;
}

// $_c = $config;



if(isset($_SESSION['language']) && ($_SESSION['language'] != '')){
    $ib_language_file_path = 'system/i18n/' . $_SESSION['language'] . '.php';
}
else{
    $ib_language_file_path = 'system/i18n/' . $config['language'] . '.php';
}

require 'system/i18n/en.php';

if (file_exists($ib_language_file_path)) {
    require $ib_language_file_path;
}


function _msglog($type, $msg)
{
    $_SESSION['ntype'] = $type;
    $_SESSION['notify'] = $msg;
}

if (($config['url_rewrite']) == '1') {
    define('U', APP_URL . '/');
} else {
    define('U', APP_URL . '/?ng=');
}

// $_theme = APP_URL . '/ui/theme/ibilling';
$_theme = APP_URL . '/ui/theme/default';

// $ui = ui();



$ps = ORM::for_table('sys_pl')->where('status', '1')->order_by_asc('sorder')->find_array();




function _auth()
{
    if (isset($_SESSION['uid'])) {
        return true;
    } else {

        $after = _get('ng');

        $after = str_replace('/', '*', $after);

        $after = rtrim($after, '*');

        r2(U . 'login/after/' . $after);

    }

}


// additional function

function _admin()
{
    if (isset($_SESSION['uid'])) {
        $d = ORM::for_table('user')->find_one($_SESSION['uid']);
        if ($d['user_type'] == 'Admin') {
            //  return true;
        } else {
            r2(U . 'login/');
        }
    } else {

        r2(U . 'login/');

    }

}


$app_theme = $config['theme'];



$l_enc_key = '4R48dj389dj3Gjdo92048s';
$version_code = '1000';

$license_should_be = md5(APP_URL.$l_enc_key.$version_code);

// exit($license_should_be);

$c_license_key = $config['license_key'];

$db_license_key = str_replace('-','',$c_license_key);

$db_license_key = strtolower($db_license_key);



//if($license_should_be != $db_license_key){
//
//
//
//    $req_string = base64_encode(APP_URL.'*'.$c_license_key);
//
//    $submitted_license_key = _post('license_key');
//
//    if($submitted_license_key != ''){
//        update_option('license_key',$submitted_license_key);
//        r2(U.'dashboard');
//    }
//
//    echo '<!doctype html>
//<html lang="en">
//
//<head>
//  <meta charset="utf-8">
//  <meta http-equiv="x-ua-compatible" content="ie=edge">
//  <meta name="viewport" content="width=device-width, initial-scale=1">
//
//  <title></title>
//
//  <link rel="stylesheet" href="'.APP_URL.'/ui/assets/fonts/open-sans/open-sans.css?ver=4.0.1">
//
//  <style>
//  *, *:before, *:after {
//  box-sizing: border-box;
//}
//
//html {
//  overflow-y: scroll;
//}
//
//body {
//  background: #c1bdba;
//  font-family: \'open sans\', sans-serif;
//}
//
//a {
//  text-decoration: none;
//  color: #2196f3;
//  -webkit-transition: .5s ease;
//  transition: .5s ease;
//}
//a:hover {
//  color: #156EF3;
//}
//
//.form {
//  background: rgba(19, 35, 47, 0.9);
//  padding: 40px;
//  max-width: 600px;
//  margin: 40px auto;
//  border-radius: 4px;
//  box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
//}
//
//
//
//h1 {
//  text-align: center;
//  color: #ffffff;
//  font-weight: 300;
//  margin: 0 0 40px;
//}
//
//label {
//  position: absolute;
//  -webkit-transform: translateY(6px);
//          transform: translateY(6px);
//  left: 13px;
//  color: rgba(255, 255, 255, 0.5);
//  -webkit-transition: all 0.25s ease;
//  transition: all 0.25s ease;
//  -webkit-backface-visibility: hidden;
//  pointer-events: none;
//  font-size: 22px;
//}
//label .req {
//  margin: 2px;
//  color: #2196f3;
//}
//
//label.active {
//  -webkit-transform: translateY(50px);
//          transform: translateY(50px);
//  left: 2px;
//  font-size: 14px;
//}
//label.active .req {
//  opacity: 0;
//}
//
//label.highlight {
//  color: #ffffff;
//}
//
//input, textarea {
//  font-size: 22px;
//  display: block;
//  width: 100%;
//  height: 100%;
//  padding: 5px 10px;
//  background: none;
//  background-image: none;
//  border: 1px solid #a0b3b0;
//  color: #ffffff;
//  border-radius: 0;
//  -webkit-transition: border-color .25s ease, box-shadow .25s ease;
//  transition: border-color .25s ease, box-shadow .25s ease;
//}
//input:focus, textarea:focus {
//  outline: 0;
//  border-color: #2196f3;
//}
//
//textarea {
//  border: 2px solid #a0b3b0;
//  resize: vertical;
//}
//
//.field-wrap {
//  position: relative;
//  margin-bottom: 40px;
//}
//
//.top-row:after {
//  content: "";
//  display: table;
//  clear: both;
//}
//.top-row > div {
//  float: left;
//  width: 48%;
//  margin-right: 4%;
//}
//.top-row > div:last-child {
//  margin: 0;
//}
//
//.button {
//  border: 0;
//  outline: none;
//  border-radius: 0;
//  padding: 15px 0;
//  font-size: 2rem;
//  font-weight: 600;
//  text-transform: uppercase;
//  letter-spacing: .1em;
//  background: #2196f3;
//  color: #ffffff;
//  -webkit-transition: all 0.5s ease;
//  transition: all 0.5s ease;
//  -webkit-appearance: none;
//}
//.button:hover, .button:focus {
//  background: #2196f3;
//}
//
//.button-block {
//  display: block;
//  width: 100%;
//}
//
//.forgot {
//  margin-top: -20px;
//  text-align: right;
//}
//
//</style>
//
//</head>
//
//<body>
//
//<div class="form">
//
//
//
//      <div class="tab-content">
//
//
//        <div id="login">
//          <h1>Invalid License Key!</h1>
//
//          <p style="color: #ffffff; font-size: 14px;">Your current license key- '.$c_license_key.' is invalid for this domain. </p>
//
//          <form action="" method="post">
//
//            <div class="field-wrap">
//            <label>
//              Enter License Key<span class="req">*</span>
//            </label>
//            <input type="text" required autocomplete="off" autofocus name="license_key"/>
//          </div>
//
//
//
//
//
//          <button class="button button-block"/>Activate</button>
//
//          <p style="color: #ffffff;"><a href="https://www.cloudonex.com/update_license/'.$req_string.'" target="_blank">New domain ? Update License Key.</a> </p>
//
//          </form>
//
//        </div>
//
//      </div><!-- tab-content -->
//
//</div> <!-- /form -->
//
//<script src="'.APP_URL.'/ui/assets/js/jquery.min.js"></script>
//
//<script>
//$(function() {
//  $(\'.form\').find(\'input, textarea\').on(\'keyup blur focus\', function (e) {
//
//  var $this = $(this),
//      label = $this.prev(\'label\');
//
//	  if (e.type === \'keyup\') {
//			if ($this.val() === \'\') {
//          label.removeClass(\'active highlight\');
//        } else {
//          label.addClass(\'active highlight\');
//        }
//    } else if (e.type === \'blur\') {
//    	if( $this.val() === \'\' ) {
//    		label.removeClass(\'active highlight\');
//			} else {
//		    label.removeClass(\'highlight\');
//			}
//    } else if (e.type === \'focus\') {
//
//      if( $this.val() === \'\' ) {
//    		label.removeClass(\'highlight\');
//			}
//      else if( $this.val() !== \'\' ) {
//		    label.addClass(\'highlight\');
//			}
//    }
//
//});
//})
//</script>
//
//</body>
//
//</html>';
//
//    exit;
//
//}



 $resourceURL = 'https://www.cloudonex.com';
// $resourceURL = 'http://www.stackpi.dev';

require 'ui/theme/' . 'default' . '/functions.php';

function ui()
{
    global $config, $_L, $file_build, $resourceURL;
    $_theme = APP_URL . '/ui/theme/' . $config['theme'];
    $theme = APP_URL . '/ui/theme/';
    $assets = APP_URL . '/ui/assets/';
    $storage = APP_URL . '/storage/';
  //  $app_theme = $config['theme'];
    $app_theme = 'default';
    $ui = new Smarty();
    $ui->setTemplateDir('ui/theme/' . $app_theme . '/');
    $ui->setCompileDir('storage/compiled/');
    $ui->setCacheDir('storage/cache/');
    $ui->assign('config', $config);
    $ui->assign('_L', $_L);
    $ui->assign('app_theme', $app_theme);
    $ui->assign('_app_stage', APP_STAGE);
    $ui->assign('assets', $assets);
    $ui->assign('storage', $storage);
    $ui->assign('layouts_admin', 'layouts/admin.tpl');
    $ui->assign('layouts_client', 'layouts/client.tpl');
    $ui->assign('layouts_paper', 'layouts/paper.tpl');
    $ui->assign('app_url', APP_URL . '/');
    if (($config['url_rewrite']) == '1') {
        $ui->assign('_url', APP_URL . '/');
        $ui->assign('base_url', APP_URL . '/');
    }
    else {
        $ui->assign('_url', APP_URL . '/?ng=');
        $ui->assign('base_url', APP_URL . '/?ng=');
    }

    $ui->assign('_theme', $_theme);
    $ui->assign('theme', $theme);
    $ui->assign('resourceURL', $resourceURL);
    $ui->assign('file_build', $file_build);
    $ui->assign('_application_menu', 'dashboard');
    $ui->assign('_title', $config['CompanyName']);
    $ui->assign('_st', 'application');
    $ui->assign('_topic', 'dashboard');
    $ui->assign('content_inner', '');
    $ui->assign('jsvar', '');
    $ui->assign('tpl_footer', true);
    $ui->assign('tplheader', 'sections/' . $config['industry'] . '/header');
    $ui->assign('tplfooter', 'sections/' . $config['industry'] . '/footer');
    $ui->assign('admin_menu', 'sections/admin_menu');
    $ui->assign('client_menu', 'sections/client_menu');
    $ui->assign('client_tplheader', 'sections/header_client_' . $config['industry']);
    $ui->assign('client_tplfooter', 'sections/footer_client_' . $config['industry']);
    if (isset($_SESSION['notify'])) {
        $notify = $_SESSION['notify'];
        $ntype = $_SESSION['ntype'];
        if ($ntype == 's') {
            $ui->assign('notify', '<div class="alert alert-success ks-solid ks-active-border">
								<button class="close" data-dismiss="alert">
									&times;
								</button>
								<i class="fa-fw fa fa-check"></i>
								' . $notify . '
							</div>');
        }
        else {
            $ui->assign('notify', '<div class="alert alert-danger ks-solid ks-active-border">
								<button class="close" data-dismiss="alert">
									&times;
								</button>
								<i class="fa-fw fa fa-times"></i>
								' . $notify . '
							</div>');
        }

        unset($_SESSION['notify']);
        unset($_SESSION['ntype']);
    }

    return $ui;
}

function get_client_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function ib_post($param, $defvalue = '')
{
    if (!isset($_POST[$param])) {
        return $defvalue;
    }
    else {
        return $_POST[$param];
    }
}

function _log($description, $type = '', $userid = '0')
{
    $d = ORM::for_table('sys_logs')->create();
    $d->date = date('Y-m-d H:i:s');
    $d->type = $type;
    $d->description = $description;
    $d->userid = $userid;
    $d->ip = get_client_ip();
    $d->save();
}

$admin_extra_nav = array(
    0 => '',
    1 => '',
    2 => '',
    3 => '',
    4 => '',
    5 => '',
    6 => '',
    7 => '',
    8 => '',
    9 => '',
    10 => ''
);
$client_extra_nav = array(
    0 => '',
    1 => '',
    2 => '',
    3 => '',
    4 => '',
    5 => '',
    6 => '',
    7 => '',
    8 => '',
    9 => '',
    10 => ''
);

function add_menu_client($name, $link = '#', $c = '', $icon = 'icon-leaf', $position = 3, $submenu = array() , $menu_id = '', $target = '')
{
    global $client_extra_nav, $routes;
    $active = '';
    if ((isset($routes['0'])) AND ($routes['0']) == $c) {
        $active = 'active';
    }
    elseif ((isset($routes['2'])) AND ($routes['2']) == $c) {
        $active = 'active';
    }
    else {
    }

    if ($menu_id != '') {
        $menu_id = ' id="' . $menu_id . '"';
    }

    if ($target != '') {
        $target = ' target="' . $target . '"';
    }

    if (!empty($submenu)) {
        $s = '';
        foreach($submenu as $menu) {
            if (isset($menu['target'])) {
                $target = 'target="' . $menu['target'] . '"';
            }
            else {
                $target = '';
            }

            $s.= ' <li><a href="' . $menu['link'] . '" ' . $target . '>' . $menu['name'] . '</a></li>';
        }

        $client_extra_nav[$position].= '<li class="' . $active . '">
                    <a href="' . $link . '"' . $menu_id . $target . '><i class="' . $icon . '"></i> <span class="nav-label">' . $name . ' </span><span class="fa arrow"></span></a>

<ul class="nav nav-second-level">
' . $s . '
</ul>
</li>';
    }
    else {
        $client_extra_nav[$position].= '<li class="' . $active . '"><a href="' . $link . '"' . $menu_id . $target . '><i class="' . $icon . '"></i> <span class="nav-label">' . $name . '</span></a></li>';
    }
}

$sub_menu_admin = array();
$sub_menu_admin['settings'] = array();
$sub_menu_admin['appearance'] = array();
$sub_menu_admin['crm'] = array();
$sub_menu_admin['sales'] = array();
$sub_menu_admin['reports'] = array();

function add_sub_menu_admin($parent, $name, $link)
{
    global $sub_menu_admin;
    $sub_menu_admin[$parent][] = '<li><a href="' . $link . '">' . $name . '</a></li>
';
}

function add_option($option, $value)
{
    $d = ORM::for_table('sys_appconfig')->where('setting', $option)->find_one();
    if ($d) {
        return false;
    }
    else {

        // add option

        $c = ORM::for_table('sys_appconfig')->create();
        $c->setting = $option;
        $c->value = $value;
        $c->save();
        return true;
    }
}

function get_option($option)
{
    $d = ORM::for_table('sys_appconfig')->where('setting', $option)->find_one();
    if ($d) {
        return $d['value'];
    }
    else {
        return false;
    }
}

function update_option($option, $value)
{
    $d = ORM::for_table('sys_appconfig')->where('setting', $option)->find_one();
    if ($d) {
        $d->value = $value;
        $d->save();
        return true;
    }
    else {
        return false;
    }
}

function delete_option($option)
{
    $d = ORM::for_table('sys_appconfig')->where('setting', $option)->find_one();
    if ($d) {
        $d->delete();
        return true;
    }
    else {
        return false;
    }
}

function ib_die($msg = '')
{
    echo $msg;
    exit;
}

function ib_close()
{
    exit;
}

function get_custom_field_value($fid, $rid)
{
    $d = ORM::for_table('crm_customfieldsvalues')->where('fieldid', $fid)->where('relid', $rid)->find_one();
    return $d['fvalue'];
}

function ib_pg_count()
{
    $d = ORM::for_table('sys_pg')->where('status', 'Active')->count();
    return $d;
}

function ib_add_field_value($fieldid, $relid, $fvalue)
{
    $d = ORM::for_table('crm_customfieldsvalues')->create();
    $d->fieldid = $fieldid;
    $d->relid = $relid;
    $d->fvalue = $fvalue;
    $d->save();
    return true;
}

// Date Related

function ib_today()
{
    return date('Y-m-d');
}

function ib_after_1_month($from = '', $format = 'mysql')
{
    if ($from == '') {
        $from = strtotime(date('Y-m-d'));
    }

    if ($format == 'mysql') {
        $format = 'Y-m-d';
    }

    return date($format, strtotime('+1 month', $from));
}

function ib_lan_get_line($line, $fallback = '')
{
    global $_L;
    if (isset($_L[$line])) {
        return str_replace($line, $_L[$line], $line);
    }
    elseif ($fallback != '') {
        return $fallback;
    }
    else {
        return $line;
    }
}

function d2($msg = 'I am here!')
{
    if (is_array($msg)) {
        foreach($msg as $m) {
            echo $m . ' |
';
        }
    }
    else {
        echo $msg;
    }

    exit;
}

function d2c($data)
{
    if (is_array($data)) $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
    else $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
    echo $output;
}

function lan()
{
    global $config;
    return $config['language'];
}

function add_js($f = array() , $v = '')
{
    global $ui;
    global $pl_path;
    if ($v == '') {
        $ver = '';
    }
    else {
        $ver = '?ver=' . $v;
    }

    $gen = '';
    if (is_array($f)) {
        foreach($f as $p) {
            $gen.= '<script type="text/javascript" src="' . $pl_path . 'js/' . $p . '.js' . $ver . '"></script>
        ';
        }

        $ui->assign('xfooter', $gen);
        return true;
    }

    return false;
}

function add_js_external($url = array())
{
    $gen = '';
    if (is_array($url)) {
        foreach($url as $u) {
            $gen.= '<script type="text/javascript" src="' . APP_URL . '/' . $u . '.js"></script>
        ';
        }

        return $gen;
    }

    return false;
}

function add_js_internal($paths = array())
{
    $gen = '';
    if (is_array($paths)) {
        foreach($paths as $u) {
            $gen.= '<script type="text/javascript" src="' . APP_URL . '/' . $u . '.js"></script>
        ';
        }

        return $gen;
    }

    return false;
}

function set_tpl($path)
{
    global $ui;
    $ui->assign('tplheader', $path . 'header');
    $ui->assign('tplfooter', $path . 'footer');
}

function set_admin_header($path)
{
    global $ui;
    $ui->assign('tplheader', $path);
}

function set_admin_footer($path)
{
    global $ui;
    $ui->assign('tplfooter', $path);
}

// @deprecated

function set_admin_nav($path)
{
    global $ui;
    $ui->assign('admin_menu', $path);
}

function set_admin_menu($path)
{
    global $ui;
    $ui->assign('admin_menu', $path);
}

function set_client_menu($path)
{
    global $ui;
    $ui->assign('client_menu', $path);
}

function language_append($path)
{
    global $_L;
    $file = 'apps/' . $path;
    include ($file);

}

function lan_register($path)
{
    $x = include $path;

    var_dump($x);
    exit;
}

function add_plugin_ui_header_admin($header = '')
{
    global $plugin_ui_header_admin;
    array_push($plugin_ui_header_admin, $header);
}

function add_css_admin($path)
{
    global $plugin_ui_header_admin_css;
    array_push($plugin_ui_header_admin_css, $path);
}

function add_plugin_ui_header_client($header = '')
{
    global $plugin_ui_header_client;
    array_push($plugin_ui_header_client, $header);
}

function add_css_client($path)
{
    global $plugin_ui_header_client_css;
    array_push($plugin_ui_header_client_css, $path);
}

function i_close($msg = '')
{
    echo $msg;
    exit;
}

function inner_contents($lk)
{

    //    $url_string = '?ng=';
    //    $inner_contents = '';
    //
    //    $lc = md5(APP_URL.$url_string);
    //
    //    if($lc != $lk){
    //
    //        $smarty_cache = 'PGRpdiBjbGFzcz0iYWxlcnQgYWxlcnQtZGFuZ2VyIj5QbGVhc2UgQWN0aXZhdGUgWW91ciBpQmlsbGluZy4gPGEgY2xhc3M9ImJ0biBidG4tc3VjY2VzcyIgaHJlZj0iP25nPXNldHRpbmdzL2FjdGl2YXRlX2xpY2Vuc2UvIj5DbGljayBIZXJlIHRvIEFjdGl2YXRlPC9hPjwvZGl2Pg==';
    //
    //        $inner_contents = base64_decode($smarty_cache);
    //
    //    }
    //
    //    return $inner_contents;

    return;
}

function ib_http_request($url, $method = 'GET', $params = array() , $headers = array() , $resp_header = false, $follow_redirect = false)
{
    $response = '';
    if (!is_callable('curl_init')) {
        throw new Exception('CURL Not available in this Server.');
    }

    switch ($method) {
        case 'GET':
            $q = '';
            foreach($params as $key => $value) {
                $value = urlencode($value);
                $q.= $key . '=' . $value . '&';
            }

            $req = $url;
            if ($q != '') {
                $q = rtrim($q, '&');
                $req = $url . '?' . $q;
            }

            try {
                $ch = curl_init();
                if (FALSE === $ch) throw new Exception('failed to initialize');
                if (!empty($headers)) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                }

                curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $req);
                if ($follow_redirect) {
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                }

                if ($resp_header) {
                    curl_setopt($ch, CURLOPT_HEADER, 1);
                }

                $response = curl_exec($ch);
                if (FALSE === $response) throw new Exception(curl_error($ch) , curl_errno($ch));
                curl_close($ch);
            }

            catch(Exception $e) {
                throw new Exception($e->getCode() . ' ' . $e->getMessage());
            }

            break;

        case 'POST':
            try {
                $ch = curl_init();
                if (FALSE === $ch) throw new Exception('failed to initialize');
                if (!empty($headers)) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                }

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                if ($resp_header) {
                    curl_setopt($ch, CURLOPT_HEADER, 1);
                }

                $response = curl_exec($ch);
                if (FALSE === $response) throw new Exception(curl_error($ch) , curl_errno($ch));
                curl_close($ch);
            }

            catch(Exception $e) {
                throw new Exception($e->getCode() . ' ' . $e->getMessage());
            }

            break;
    }

    return $response;
}

function db_find_many($table, $columns = array())
{
    $d = ORM::for_table($table);
    foreach($columns as $column) {
        $d->select($column);
    }

    $ret = $d->find_many();
    return $ret;
}

function db_find_array($table, $columns = array() , $order_by = '')
{
    $d = ORM::for_table($table);
    foreach($columns as $column) {
        $d->select($column);
    }

    if ($order_by != '') {
        $o = explode(':', $order_by);
        if ($o[0] == 'asc') {
            $d->order_by_asc($o[1]);
        }
        elseif ($o[0] == 'desc') {
            $d->order_by_desc($o[1]);
        }
        else {
            $d->order_by_desc($order_by);
        }
    }

    $ret = $d->find_array();
    return $ret;
}

function db_find_one($table, $id)
{
    $d = ORM::for_table($table)->find_one($id);
    if ($d) {
        return $d;
    }
    else {
        return false;
    }
}

function db_delete_row($table, $id)
{
    $d = ORM::for_table($table)->find_one($id);
    if ($d) {
        $d->delete();
        return true;
    }
    else {
        return false;
    }
}

function db_column_exist($table, $column)
{
    return ORM::for_table($table)->raw_query("SHOW COLUMNS FROM $table LIKE '$column'")->find_one();
}

function db_table_exist($table)
{
    return ORM::for_table('crm_accounts')->raw_query("SHOW TABLES LIKE '$table'")->find_one();
}

function route($id, $default = '')
{
    global $routes;
    if (isset($routes[$id]) && $routes[$id] != '') {
        return $routes[$id];
    }
    else {
        return $default;
    }
}

function is_dev()
{
    
    if (APP_STAGE != "Dev") {
        die("Unable to handle your request in Live Mode.");
    }
}

function ib_money_format($amount, $config, $symbol = '')
{
    if ($symbol == '') {
        $currency_code = $config['currency_code'];
    }
    else {
        $currency_code = $symbol;
    }

    $thousand_separator_placement = $config['thousand_separator_placement'];
    $currency_decimal_digits = $config['currency_decimal_digits'];
    $currency_symbol_position = $config['currency_symbol_position'];
    $dec_point = $config['dec_point'];
    $thousands_sep = $config['thousands_sep'];
    if ($currency_decimal_digits == 'true') {
        $dec_digit = 2;
    }
    else {
        $dec_digit = 0;
    }

    if ($currency_symbol_position == 's') {
        $retval = number_format($amount, $dec_digit, $dec_point, $thousands_sep) . $currency_code;
    }
    else {
        $retval = $currency_code . ' ' . number_format($amount, $dec_digit, $dec_point, $thousands_sep);
    }

    return $retval;
}

function ib_multiply($x, $y)
{
    return $x * $y;
}

function ib_division($x, $y)
{
    return $x / $y;
}

function ib_addition($values = array())
{
    $total = 0;
    foreach($values as $val) {
        $total+= $val;
    }

    return $total;
}

function secondary_currency()
{
    global $config;
    $c_check = ORM::for_table('sys_currencies')->find_array();
    if (count($c_check) == 2) {
        $sc = ORM::for_table('sys_currencies')->where_not_equal('iso_code', $config['currency_code'])->find_one();
        return $sc;
    }
    else {
        return false;
    }
}

/*
* @deprecated
* use ib_posted_data
* */

function ib_get_posted_data()
{
    $data = array();
    foreach($_POST as $key => $value) {
        $data[$key] = trim($value);
    }

    return $data;
}

function ib_posted_data()
{
    $data = array();
    foreach($_POST as $key => $value) {
        $data[$key] = trim($value);
    }

    return $data;
}

function ib_js_date_format($format, $js = 'moment')
{
    if ($js == 'moment') {
        $format = str_replace('d', 'DD', $format);
        $format = str_replace('M', 'MMM', $format);
        $format = str_replace('m', 'MM', $format);
        $format = str_replace('Y', 'YYYY', $format);
        $format = str_replace('jS', 'Do', $format);
        return $format;
    }
    elseif ($js = 'picker') {
        $format = str_replace('d', 'dd', $format);
        $format = str_replace('m', 'mm', $format);
        $format = str_replace('Y', 'yyyy', $format);
        $format = str_replace('M', 'mmm', $format);
        $format = str_replace('jS', 'd', $format);
        return $format;
    }
    else {
        $format = str_replace('d', 'DD', $format);
        $format = str_replace('m', 'MM', $format);
        $format = str_replace('Y', 'YYYY', $format);
        $format = str_replace('M', 'MMM', $format);
        $format = str_replace('jS', 'Do', $format);
        return $format;
    }
}

function has_access($rid, $shortname, $action = 'view')
{
    if ($rid == 0) {
        return true;
    }

    $d = ORM::for_table('sys_staffpermissions')->where('rid', $rid)->where('shortname', $shortname)->find_one();
    if ($d) {
        switch ($action) {
            case 'view':
                if ($d->can_view == 1) {
                    return true;
                }
                else {
                    return false;
                }

                break;

            case 'edit':
                if ($d->can_edit == 1) {
                    return true;
                }
                else {
                    return false;
                }

                break;

            case 'create':
                if ($d->can_create == 1) {
                    return true;
                }
                else {
                    return false;
                }

                break;

            case 'delete':
                if ($d->can_delete == 1) {
                    return true;
                }
                else {
                    return false;
                }

                break;

            case 'all_data':
                if ($d->all_data == 1) {
                    return true;
                }
                else {
                    return false;
                }

                break;

            default:
                return false;
        }
    }
    else {
        return false;
    }
}

function addPermission($pname, $shortname)
{
    $d = ORM::for_table('sys_permissions')->where('shortname', $shortname)->find_one();
    if ($d) {
        return false;
    }
    else {
        $p = ORM::for_table('sys_permissions')->create();
        $p->pname = $pname;
        $p->shortname = $shortname;
        $p->save();
        return $p->id();
    }
}

function deletePermission($shortname)
{
    $d = ORM::for_table('sys_permissions')->where('shortname', $shortname)->find_one();
    if ($d) {
        $d->delete();
        return true;
    }
    else {
        return false;
    }
}

function permissionDenied()
{
    r2(U . 'dashboard', 'e', 'Permission Denied');
}

function api_response($data = array())
{
    header('Content-type: application/json');
    echo json_encode($data);
    exit;
}

function client_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function ib_zerofill($num, $zerofill = 5)
{
    return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
}

function getAdminName($aid)
{
    $d = ORM::for_table('sys_users')->find_one($aid);
    if ($d) {
        return $d->fullname;
    }
    else {
        return '';
    }
}

function getCompanyName($company_id)
{
    $d = ORM::for_table('sys_companies')->find_one($company_id);
    if ($d) {
        return $d->company_name;
    }
    else {
        return '';
    }
}

function getAdminImage($admin_id, $size = 100)
{
    $d = ORM::for_table('sys_users')->select('img')->find_one($admin_id);
    if ($d) {
        if ($d->img == 'gravatar') {
            $img = 'http://www.gravatar.com/avatar/{($a->email)|md5}?s=' . $size;
        }
        elseif ($d->img != '') {
            $img = $d->img;
        }
        else {
            $img = APP_URL . '/ui/lib/imgs/default-user-avatar.png';
        }
    }
    else {
        $img = APP_URL . '/ui/lib/imgs/default-user-avatar.png';
    }

    return $img;
}

function abort($code = '404', $text = 'Page Not Found')
{
    global $ui;
    $ui->assign('code', $code);
    $ui->assign('text', $text);
    $ui->display('error_page.tpl');
    exit;
}

function hasColumn($column, $table)
{
    $x = ORM::for_table($table)->raw_query('SHOW COLUMNS FROM `' . $table . '` LIKE \'' . $column . '\'')->find_one();
    if ($x) {
        return true;
    }
    else {
        return false;
    }
}

function view($template, $vars = array())
{
    global $ui;
    global $app_theme;
    foreach($vars as $key => $value) {
        $ui->assign($key, $value);
    }

    if (file_exists('ui/theme/' . $app_theme . '/' . $template . '.tpl')) {
        $ui->display($template . '.tpl');
    }
    else {
        $ui->display('../default/' . $template . '.tpl');
    }
}

function assets()
{
    return APP_URL . '/ui/assets/';
}

function namePresenter($name)
{
    $name = trim($name);
    if ($name == '') {
        $name = 'N A';
    }

    $colors = array(
        'red',
        'pink',
        'purple',
        'deep_purple',
        'indigo',
        'blue',
        'light_blue',
        'cyan',
        'teal',
        'green',
        'light_green',
        'deep_orange',
        'brown',
        'grey',
        'blue_grey'
    );
    $css_bg = $colors[array_rand($colors) ];
    $full_name_e = explode(' ', $name);
    $first_name = $full_name_e[0];
    $first_name_letter = $first_name[0];
    if (isset($full_name_e[1])) {
        $last_name = $full_name_e[1];
        $last_name_letter = $last_name[0];
    }
    else {
        $last_name_letter = '';
    }

    $img = '<span class="ib_avatar ib_bg_' . $css_bg . '">' . $first_name_letter . $last_name_letter . '</span>';
    return $img;
}

function lastTwelveMonths()
{
    $months = array();
    for ($i = 1; $i <= 11; $i++) {
        $months[] = date("M Y", strtotime(date('Y-m-01') . " -$i months"));
    }

    $months = array_reverse($months);
    $months[12] = date("M Y", strtotime(date('Y-m-01')));
    $m = array();
    foreach($months as $month) {
        $m[] = $month;
    }

    return $m;
}

function strTrunc($string, $length=12){
    return strlen($string) > $length ? substr($string,0,$length)."..." : $string;
}

function inSession($key,$def=''){
    if(isset($_SESSION[$key])){
        return $_SESSION[$key];
    }
    else{
        return $def;
    }
}

function homeCurrency()
{
    global $config;
    return Currency::where('iso_code',$config['home_currency'])->first();
}

function predictNextRow($table)
{
//    $d = ORM::for_table($table)->select('id')->order_by_desc('id')->limit(1)->find_one();
//
//    if($d){
//        $id = $d->id;
//        $nextRow = $id+1;
//    }
//    else{
//        $nextRow = 1;
//    }
//
//    return $nextRow;


    $d = DB::select("SHOW TABLE STATUS FROM `".DB_NAME."` WHERE `name` LIKE '$table'");

    if($d){
        $nextRow = $d[0]->Auto_increment;
    }
    else{
        $nextRow = 1;
    }

    return $nextRow;

}


function updateCheck($purchase_key='')
{


    global $user,$config,$update_server;

    $arr = array(
        'action' => 'version-check',
        'app_url' => APP_URL,
        'fullname' => $user->fullname,
        'email' => $user->username,
        'build' => $config['build'],
        'purchase_key' => $purchase_key
    );

    $remote_build = '';
    $changelog = '';
    $update_available = 'No';
    $msg = '';
    $server_check = false;


    $raw = '';


    try{

        $raw = ib_http_request($update_server.'/update-app','POST',$arr);



    } catch (Exception $e){

        $msg = $e->getMessage();

    }




    $resp = json_decode($raw);

    if (json_last_error() === JSON_ERROR_NONE) {

        if(isset($resp->build)){

            $remote_build = $resp->build;
            $changelog = $resp->changelog;

            $server_check = true;

            if(($config['build']) < $remote_build){

                $update_available = 'Yes';

            }

        }

    }
    else{
        $msg = 'Unable to Connect Update Server';
    }


    $a = array(

        'remote_build' => $remote_build,
        'changelog' => $changelog,
        'update_available' => $update_available,
        'msg' => $msg,
        'server_check' => $server_check

    );


    return $a;

}


function prevDirAccess($dir)
{

}


function addSmsTemplate($template_name,$message)
{


    $check = SMSTemplate::where('tpl',$template_name)->first();

    if($check){

        // already exisit

        return false;

    }
    else{
        $sms_template = new SMSTemplate;
        $sms_template->tpl = $template_name;
        $sms_template->sms = $message;
        $sms_template->save();

        return $sms_template;
    }



}


function addEmailTemplate($template_name,$subject,$message,$core='Yes')
{
    $check = EmailTemplate::where('tplname',$template_name)->first();

    if($check){

        // already exisit

        return false;

    }
    else{

        $email_template = new EmailTemplate;
        $email_template->tplname = $template_name;
        $email_template->subject = $subject;
        $email_template->message = $message;
        $email_template->send = 'Yes';
        $email_template->core = $core;
        $email_template->save();

        return $email_template;


    }
}


function addOption($setting,$value)
{

    $check = AppConfig::where('setting',$setting)->first();

    if($check){
        return false;
    }
    else{
        $c = new AppConfig;
        $c->setting = $setting;
        $c->value = $value;
        $c->save();

        return $c;
    }

}


function updateOption($setting,$value)
{
    $check = AppConfig::where('setting',$setting)->first();

    if($check){
        $check->setting = $setting;
        $check->value = $value;
        $check->save();
    }
    else{
        return false;
    }
}


function dieIfNotPOST() {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        header('HTTP/1.1 405 Method Not Allowed', true, 405);
        header("Allow: POST");
        exit();
    }
}

function isValidApiKey($key)
{

    $apiKey = ApiKey::where('apikey',$key)->first();

    if($apiKey){
        return true;
    }
    else{
        return false;
    }


}

function categoryCalculateTotalByName($name,$type){

    $t = Transaction::where('type',$type)->where('category',$name)->sum('amount');


    if($t == '' || $t == '0'){
        return '0.00';
    }
    else{
        return $t;
    }




}


/**
 * Get hearder Authorization
 * */
function getAuthorizationHeader(){
    $headers = null;


    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);

    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);

    } else if (function_exists('apache_request_headers')) {

        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)

        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }

    else{

//        var_dump($_SERVER);
//        exit;
    }
    return $headers;
}
/**
 * get access token from header
 * */
function getBearerToken() {
    $headers = getAuthorizationHeader();


    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}


function jsonResponse($data=[],$code=200){
    http_response_code($code);
    header('Content-type: application/json');
    echo json_encode($data);
    exit;
}

function apiAuth(){
    $token = getBearerToken();
    $key = ApiKey::where('apikey',$token)->first();
    if($key){
        return true;
    }
    else{

        jsonResponse([
           'error' => true,
            'message' => 'No valid API key provided.'
        ],401);

    }
}


function showThenExit($message){
    echo $message;
    exit;
}

if (!function_exists('dd')) {
    function dd()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }
}
if (!function_exists('d')) {
    function d()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
    }
}

function getSharedPreferences($relation_type,$relation_id,$key)
{
    return SharedPreference::where('relation_type',$relation_type)
        ->where('relation_id',$relation_id)
        ->where('key',$key)
        ->first();
}

function setSharedPreferences($relation_type,$relation_id,$key,$value)
{

    $pref = SharedPreference::where('relation_type',$relation_type)
        ->where('relation_id',$relation_id)
        ->where('key',$key)
        ->first();

    if($pref)
    {
        $pref->value = $value;
        $pref->save();
    }
    else{
        $pref = new SharedPreference;
        $pref->relation_type = $relation_type;
        $pref->relation_id = $relation_id;
        $pref->key = $key;
        $pref->value = $value;
        $pref->save();
    }

    return $pref;

}


function spGetLastFourDigit($string)
{
    return substr($string, -4);
}


