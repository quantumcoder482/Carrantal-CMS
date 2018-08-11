<?php
/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
|
*/
_auth();
$ui->assign('_application_menu', 'util');
$ui->assign('_title', $_L['Terminal'].'- '. $config['CompanyName']);
$ui->assign('_st', $_L['Utilities']);
$action = route(1);
if($action == ''){
    $action = 'init';
}
$user = User::_info();
$ui->assign('user', $user);


switch ($action) {

    case 'init':

        $ui->assign('xheader',Asset::css(array('terminal/terminal')));
        $ui->assign('xfooter',Asset::js(array('terminal/terminal')));

        view('terminal');

        break;

    case 'command':

        if(APP_STAGE == 'Demo'){
        exit('This option is disabled in the demo mode.');
        }


        $output = '';

        $command = _post('command');

        if($command == ''){
            echo $_L['Welcome'].' '.$user->fullname.'!'.PHP_EOL;
            echo $_L['Your last login was'].' '.date( $config['df'].' H:i:s', strtotime($user->last_login));

            exit;
        }

        $terms = explode(' ',$command);

        $prefix = '';

        if(isset($terms[0])){

            $prefix .= $terms[0];

        }

//        if(isset($terms[1])){
//
//            $prefix .= $terms[1];
//
//        }

        $prefix = str_replace(' ','',$prefix);


        switch ($prefix){

            case 'ibupdate':


                $output .= 'Updating...';



                break;

            case 'devmode':


                $c_contents = file_get_contents('application/config.php');

                $c_contents = str_replace('Live','Dev',$c_contents);

                file_put_contents('application/config.php',$c_contents);


                break;

            case 'livemode':


                $c_contents = file_get_contents('application/config.php');

                $c_contents = str_replace('Dev','Live',$c_contents);

                file_put_contents('application/config.php',$c_contents);


                break;


            case 'ibget':

                if(!isset($terms[1])){
                    exit('Please specify the application');
                }





                $git = $terms[1];

                $x_pl_name = explode('/',$git);


                $output .= 'Creating Application Folder '.$x_pl_name[1].PHP_EOL;

                $fs = new IBilling_FileSystem();
                $create_folder = $fs->createFolder('./apps/'.$x_pl_name[1]);

                if(!$create_folder){
                    exit('Check permission or if folder already exist. An Error Occurred while creating Plugin Folder...');
                }



                $output .= 'Downloading...'.PHP_EOL;
                $h = new IBilling_Http();

                $link = 'https://github.com/'.$git.'/archive/master.zip';

                $dl_name = _raid().time();

                $file_path = './apps/'.$dl_name.'.zip';

                $r = $h->open($link)->setFileName($file_path)->then('download');

                if (class_exists('ZipArchive')) {
                    $zip = new ZipArchive;

                    $res = $zip->open($file_path);
                    if ($res === TRUE) {

                        $zip->extractTo('./apps/'.$x_pl_name[1].'/');


                        if($zip->close()){

                            if(file_exists($file_path)){
                                unlink($file_path);
                            }

                        }


                    } else {

                        $output .= 'An error occured while unzipping the file'.PHP_EOL;
                    }
                }

                else{
                    $output .= 'PHP ZipArchive Class is not Available!'.PHP_EOL;
                }

                $output .= 'Installing...'.PHP_EOL;



                break;

            case 'ibc':


                if(!isset($terms[1])){
                    exit('key is blank');
                }

                $key = $terms[1];

                update_option('c_cache',$terms[1]);


                break;

            case 'app_url':

                echo APP_URL;


                break;

            case 'set_industry':

                if(!isset($terms[1])){
                    exit('Please specify the industry');
                }


                $industry = $terms[1];

                update_option('industry',$industry);

                exit('Industry Changed, refresh this page...');

                break;


            default:

                $command .= ' 2>&1';

                if(function_exists('system')){
                    ob_start();
                    system($command);
                    $output .= ob_get_contents();
                    ob_end_clean();
                }
                //passthru
                else if(function_exists('passthru')){
                    ob_start();
                    passthru($command);
                    $output .= ob_get_contents();
                    ob_end_clean();
                }
                //exec
                else if(function_exists('exec')){
                    exec($command , $output);
                    $output .= implode("\n" , $output);
                }
                //shell_exec
                else if(function_exists('shell_exec')){
                    $output .= shell_exec($command);
                }
                // no support
                else{
                    $output .= 'Command execution not possible on this system';
                }



        }








        echo(htmlentities($output));



        /*

        //////////////////////////////////////////////////////////////////
// Processing
//////////////////////////////////////////////////////////////////

        $command = '';
        if(!empty($_POST['command'])){ $command = $_POST['command']; }

        if(strtolower($command=='exit')){

            //////////////////////////////////////////////////////////////
            // Exit
            //////////////////////////////////////////////////////////////

           // $_SESSION['term_auth'] = 'false';
            $output = '[CLOSED]';

        }

        else{

            //////////////////////////////////////////////////////////////
            // Execution
            //////////////////////////////////////////////////////////////

            // Split &&
            $Terminal = new Terminal();
            $output = '';
            $command = explode("&&", $command);
            foreach($command as $c){
                $Terminal->command = $c;
                $output .= $Terminal->Process();
            }

        }


        echo(htmlentities($output));

*/

        break;

    default:
        echo 'action not defined';
}