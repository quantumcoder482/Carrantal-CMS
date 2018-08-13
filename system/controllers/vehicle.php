<?php
/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
|
*/
_auth();
$ui->assign('_application_menu', 'vehicles');
$ui->assign('_title', $_L['Vehicles']);
$ui->assign('_st', $_L['Vehicles']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
switch ($action) {

    case 'add-vehicle':
       
        $vehicle_types=ORM::for_table('sys_vehicle_type')->order_by_asc('id')->find_array();

        $ui->assign('vehicle_types',$vehicle_types);
        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'vehicle/vehicle-add')));
        $ui->assign('xjq', '$(\'.amount\').autoNumeric(\'init\');');

        //$max = ORM::for_table('sys_vehicles')->max('id');
        //$nxt = $max+1;
        //$ui->assign('nxt',$nxt);
        //$vehicle_type['make'].' '.$vehicle_type['make'].' '.$vehicle_type['engine_capacity'].' '.$vehicle_type['transmission'];

        view('vehicle-add');

        break;


    case 'list-vehicle':


        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();
        $ui->assign('vehicles',$vehicles);
        //$ui->assign('type','Service');
        $ui->assign('xheader', Asset::css(array('modal','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(),'jslib/add-ps')));


        $ui->assign('xjq', '
 $(\'.amount\').autoNumeric(\'init\');
 ');

        $max = ORM::for_table('sys_items')->max('id');
        $nxt = $max+1;
        $ui->assign('nxt',$nxt);
        $ui->assign('view_type',"filter");       
        view('vehicle-list');

        break;


    case 'm-k':
        
        $vehicle_types=ORM::for_table('sys_vehicles_type')->order_by_asc('id')->find_array();
        $ui->assign('vehicles_types',$vehicles_types);
        
        //$ui->assign('type','Service');
        
        $ui->assign('xheader', Asset::css(array('modal','dropzone/dropzone','redactor/redactor')));
        $ui->assign('xfooter', Asset::js(array('modal','dropzone/dropzone','redactor/redactor.min','numeric','jslib/add-ps')));

        $ui->assign('xjq', '$(\'.amount\').autoNumeric(\'init\');');

        $max = ORM::for_table('sys_items')->max('id');
        $nxt = $max+1;
        $ui->assign('nxt',$nxt);
        
        //$ui->assign('vie',"filter");       

        view('vehicle-mk');



        break;
    

    case 'post-vehicle':

        // Ajax post datas
        $vehicle_num = _post('vehicle_num');
        $vehicle_type = _post('vehicle_type');
        
        $purchase_price=_post('purchase_price','0.00');
        $purchase_price = Finance::amount_fix($purchase_price);
        
        $parf_cost=_post('parf_cost','0.00');
        $parf_cost = Finance::amount_fix($parf_cost);    
        
        $purchase_date=_post('pdate');
        $expiry_date=_post('edate');
        $expiry_status=_post('expiry_status');
        $description=_post('description');
        $vehicle_file=_post('vehicle_file');
        $cert_file=_post('cert_file');


        
        // Check validate post datas 
        $msg='';

        if($vehicle_num == ''){
           $msg .= 'You must input Vehicle number <br>';
        }
        if($vehicle_type == ''){
           $msg .= 'You must select Vehicle type <br>';
        }
        if($purchase_price == ''){
           $msg .= 'You must input Purchase_price <br>';
        }
        if($parf_cost == ''){
           $msg .= 'You must input Purf_cost <br>';
        }
        if($expiry_date == ''){
           $msg .= 'You must input Expiry_date <br>';
        }
        if($expiry_status == ''){
           $msg .= 'You must select Expiry_status <br>';
        }
       

        if($msg == ''){


            $d = ORM::for_table('sys_vehicles')->create();
            $d->vehicle_num = $vehicle_num;
            $d->vehicle_type = $vehicle_type;
            $d->purchase_price = $purchase_price;
            $d->parf_cost= $parf_cost;
            $d->purchase_date = $purchase_date;

            $d->expiry_date = $expiry_date;
            $d->expiry_status = $expiry_status;
            $d->description = $description;

            $d->v_i =$vehicle_file;
            $d->v_o_c = $cert_file;


            $d->save();

            _msglog('s',$_L['Item Added Successfully']);

            echo $d->id();
        }
        else{
            echo $msg;
        }

        break;



    case 'modal_add_mk':

        $id = route(2);

        $company = false;

        if($id != ''){

            $id = str_replace('ae','',$id);
            $id = str_replace('be','',$id);
            $id = str_replace('me','',$id);

            $company = M::factory('Models_Company')->find_one($id);

        }

        $val = array();

        if($company){
            $f_type = 'edit';
            $val['company_name'] = $company->company_name;
            $val['url'] = $company->url;
            $val['email'] = $company->email;
            $val['phone'] = $company->phone;
            $val['logo_url'] = $company->logo_url;
            $val['cid'] = $id;
            $val['fax'] = $company->fax;
            $val['business_number'] = $company->business_numner;

            $val['address1'] = $company->address1;
            $val['city'] = $company->city;
            $val['zip'] = $company->zip;
            $val['state'] = $company->state;
            $val['country'] = $company->country;

            $countries = Countries::all($company->country);


//            $val[''] = $company->;
        }
        else{
            $f_type = 'create';
            $val['make'] = '';
            $val['model'] = '';
            $val['engine_capacity'] = '';
            $val['transmission'] = '';
            $val['fuel_type'] = '';
            $val['v_t_id'] = '';
            $val['fax'] = '';
          
        }

        $ui->assign('f_type',$f_type);
        $ui->assign('val',$val);


        view('modal_add_mk');

        break;



    case 'add_mk_post':

        // Ajax post datas

        $make = _post('make');
        $model = _post('model');
        $engine_capacity=_post('engine_capacity');
        $transmission=_post('transmission');
        $fuel_type=_post('fuel_type');
        
        // Check validate post datas 
        $msg='';

        /*
        if($vehicle_num == ''){
           $msg .= 'You must input Vehicle number <br>';
        }
        if($vehicle_type == ''){
           $msg .= 'You must select Vehicle type <br>';
        }
        if($purchase_price == ''){
           $msg .= 'You must input Purchase_price <br>';
        }
        if($parf_cost == ''){
           $msg .= 'You must input Purf_cost <br>';
        }
        if($expiry_date == ''){
           $msg .= 'You must input Expiry_date <br>';
        }
        if($expiry_status == ''){
           $msg .= 'You must select Expiry_status <br>';
        }
        */

        if($msg == ''){


            $d = ORM::for_table('sys_vehicle_type')->create();

            $d->make=$make;
            $d->model=$model;
            $d->engine_capacity=$engine_capacity;
            $d->transmission=$transmission;
            $d->fuel_type=$fuel_type;

            $d->save();

            _msglog('s',$_L['Item Added Successfully']);

            echo $d->id();
        }
        else{
            echo $msg;
        }

        break;


    default:
        echo 'action not defined';
}