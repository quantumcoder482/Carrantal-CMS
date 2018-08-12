<?php
/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
|
*/
_auth();
$ui->assign('_application_menu', 'vehicle');
$ui->assign('_title', $_L['Vehicles'].'- '. $config['CompanyName']);
$ui->assign('_st', $_L['Vehicles']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
switch ($action) {

    case 'add-vehicle':

        $units = ORM::for_table('sys_units')->order_by_asc('sorder')->find_array();
        $ui->assign('units',$units);

        $ui->assign('type','Product');
        $ui->assign('xheader', Asset::css(array('modal','dropzone/dropzone','redactor/redactor')));
        $ui->assign('xfooter', Asset::js(array('modal','dropzone/dropzone','redactor/redactor.min','numeric','jslib/add-ps')));

        $ui->assign('xjq', '
 $(\'.amount\').autoNumeric(\'init\');
 ');

        $max = ORM::for_table('sys_items')->max('id');
        $nxt = $max+1;
        $ui->assign('nxt',$nxt);

        view('vehicle-add');



        break;


    case 'list-vehicle':


        $ui->assign('type','Service');
        $ui->assign('xheader', Asset::css(array('modal','dropzone/dropzone','redactor/redactor')));
        $ui->assign('xfooter', Asset::js(array('modal','dropzone/dropzone','redactor/redactor.min','numeric','jslib/add-ps')));

        $ui->assign('xjq', '
 $(\'.amount\').autoNumeric(\'init\');
 ');

        $max = ORM::for_table('sys_items')->max('id');
        $nxt = $max+1;
        $ui->assign('nxt',$nxt);
        view('vehicle-list');



        break;


    case 'm-k':

        $msg = '';


        $name = _post('name');
        $sales_price = _post('sales_price','0.00');
        $sales_price = Finance::amount_fix($sales_price);
        $item_number = _post('item_number');
        $description = _post('description');
        $type = _post('type');

        // other variables

        // check item number already exist

        if($item_number != ''){
            $check = ORM::for_table('sys_items')->where('item_number',$item_number)->find_one();
            if($check){
                $msg .= 'Item number already exist <br>';
            }
        }





        $inventory = _post('inventory');

        if(!is_numeric($inventory)){
            $inventory = '0';
        }

        $unit = _post('unit');

        $weight = _post('weight');

        if(!is_numeric($weight)){
            $weight = '0.0000';
        }







        if($name == ''){
            $msg .= 'Item Name is required <br>';
        }




        $sales_price = Finance::amount_fix($sales_price);

        if(!is_numeric($sales_price)){
            $sales_price = '0.00';
        }

        $cost_price = _post('cost_price','0.00');

        $cost_price = Finance::amount_fix($cost_price);

        if(!is_numeric($cost_price)){
            $cost_price = '0.00';
        }


        if($msg == ''){


            $d = ORM::for_table('sys_items')->create();
            $d->name = $name;
            $d->sales_price = $sales_price;
            $d->item_number = $item_number;
            $d->description = $description;
            $d->type = $type;
//others
            $d->unit = $unit;
            $d->weight = $weight;
            $d->inventory = $inventory;
            $d->e = '';

            // other variables

            $d->image = _post('file_link');
            $d->cost_price = $cost_price;




            $d->save();

            _msglog('s',$_L['Item Added Successfully']);

            echo $d->id();
        }
        else{
            echo $msg;
        }

        view('vehicle-mk');
        break;

    default:
        echo 'action not defined';
}