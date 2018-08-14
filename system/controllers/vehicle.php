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

        $v_types=array();

        foreach ($vehicle_types as $v) {
            array_push($v_types,$v['make']." ".$v['model']." ".$v['engine_capacity']." (".$v['transmission'].")");
        }


        $ui->assign('vehicle_types',$vehicle_types);
        $ui->assign('v_types',$v_types);
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


        if(has_access($user->roleid,'sales','all_data')){

            $all_data = true;

        }
        else{
            $all_data = false;
        }

        $paginator = array();
        $mode_css = '';
        $mode_js = '';
        $view_type = 'default';
        $view_type = 'filter';
        $mode_css = Asset::css(array('modal','dropzone/dropzone','dp/dist/datepicker.min','footable/css/footable.core.min','redactor/redactor','s2/css/select2.min','vehicle/vehicle'));
        $mode_js = Asset::js(array('modal','dropzone/dropzone','dp/dist/datepicker.min','footable/js/footable.all.min','contacts/mode_search','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'vehicle/vehicle-list'
        ));
        
        $baseUrl=APP_URL;


        $total_vehicles = ORM::for_table('sys_vehicles');

        if(!$all_data)
        {
            $total_vehicles->where('aid',$user->id);
        }

        $total_vehicles = $total_vehicles->count();
        
        $f = ORM::for_table('sys_vehicles');
        $d = $f->order_by_desc('id')->find_many();


        
        // Expiry Status 
        
        $ex_status=array();

        foreach($d as $data){

            $expiry_id=$data['id'];

            $expiry_status=$data['expiry_status'];
            
            $expiry_date=$data['expiry_date'];
            
            $today = date("Y-m-d");

            $date1 = date_create($today);

            $date2 = date_create($expiry_date);
           
            $rest= date_diff($date1,$date2); 

            $rest= intval($rest->format("%a"));   
            
            if($date2<$date1){
            
                $ex_status[$expiry_id]="Expired";
             

            }elseif($rest>=$expiry_status){
             
                $ex_status[$expiry_id]="Active";
            
            }else {
           
                $ex_status[$expiry_id]=$rest."-Day to Expiry"; 
            };
            
        }


        $paginator['contents'] = '';

        $ui->assign('total_vehicles', $total_vehicles);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('ex_status',$ex_status);
        $ui->assign('baseUrl',$baseUrl);
        $ui->assign('paginator', $paginator);
        $ui->assign('xjq', '
            $(\'.amount\').autoNumeric(\'init\', {
            dGroup: ' . $config['thousand_separator_placement'] . ',
            aPad: ' . $config['currency_decimal_digits'] . ',
            pSign: \'' . $config['currency_symbol_position'] . '\',
            aDec: \'' . $config['dec_point'] . '\',
            aSep: \'' . $config['thousands_sep'] . '\',
            vMax: \'9999999999999999.00\',
                        vMin: \'-9999999999999999.00\'

            });
            $(\'[data-toggle="tooltip"]\').tooltip();

        ');


        view('vehicle-list');

        break;


    case 'm-k':
        
       
        if(has_access($user->roleid,'sales','all_data')){

            $all_data = true;

        }
        else{

            $all_data = false;

        }

        $paginator = array();
        $mode_css = '';
        $mode_js = '';
        $view_type = 'default';
        $view_type = 'filter';
        $mode_css = Asset::css(array('modal','footable/css/footable.core.min','redactor/redactor','s2/css/select2.min','vehicle/vehicle'));
        $mode_js = Asset::js(array('modal','numeric','footable/js/footable.all.min','contacts/mode_search','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'vehicle/vehicle-edit'
        ));


        $total_invoice = ORM::for_table('sys_vehicle_type');

        if(!$all_data)
        {
            $total_invoice->where('aid',$user->id);
        }

        $total_invoice = $total_invoice->count();



        $ui->assign('total_invoice', $total_invoice);
        $f = ORM::for_table('sys_vehicle_type');
        
        if(!$all_data)
        {
            $f->where('aid',$user->id);
        }

        $d = $f->order_by_desc('id')->find_many();
        $paginator['contents'] = '';
        $ui->assign('_st', $_L['Invoices'] . '<div class="btn-group pull-right" style="padding-right: 10px;">
  <a class="btn btn-success btn-xs" href="' . U . 'invoices/add/' . '" style="box-shadow: none;"><i class="fa fa-plus"></i></a>
  <a class="btn btn-primary btn-xs" href="' . U . 'invoices/add/' . '" style="box-shadow: none;"><i class="fa fa-repeat"></i></a>
  <a class="btn btn-success btn-xs" href="' . U . 'invoices/export_csv/' . '" style="box-shadow: none;"><i class="fa fa-download"></i></a>
</div>');
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('paginator', $paginator);
        $ui->assign('xjq', '
         $(\'.amount\').autoNumeric(\'init\'),
         $(\'[data-toggle="tooltip"]\').tooltip();

        ');

        view('vehicle-mk');



        break;
    

    case 'post-vehicle':

        // Ajax post Data
        $id=_post('vid');
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


        
        // Check validate post data

        $msg='';

        $check= ORM::for_table('sys_vehicles')->find_one($vehicle_num);
        if($check){
            $msg .= 'Vehicle Number duplicated';
        }

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

            if($id == ''){
                _msglog('s',$_L['Item Added Successfully']);
                $d = ORM::for_table('sys_vehicles')->create();
            } else{
                _msglog('s',$_L['Item Updated Successfully']);
                $d = ORM::for_table('sys_vehicles')->find_one($id);
            }
            
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

            

            echo $d->id();
        }
        else{
            echo $msg;
        }

        break;


    case 'edit-vehicle':

        $id=$routes['2'];

        if($id != ''){
            $vehicle=ORM::for_table('sys_vehicles')->find_one($id);
        }

        $val=array();

        if($vehicle){
            $val['id']=$id;
            $val['vehicle_num']=$vehicle->vehicle_num;
            $val['vehicle_type']=$vehicle->vehicle_type;
            $val['parf_cost']=$vehicle->parf_cost;
            $val['purchase_price']=$vehicle->purchase_price;
            $val['purchase_date']=$vehicle->purchase_date;
            $val['expiry_date']=$vehicle->expiry_date;
            $val['expiry_status']=$vehicle->expiry_status;
            $val['v_i']=$vehicle->v_i;
            $val['v_o_c']=$vehicle->v_o_c;
            $val['description']=$vehicle->description;

        }

        $vehicle_types=ORM::for_table('sys_vehicle_type')->order_by_asc('id')->find_array();
        
        $v_types=array();

        foreach ($vehicle_types as $v) {
            array_push($v_types, $v['make']." ".$v['model']." ".$v['engine_capacity']." (".$v['transmission'].")");
        }

        $baseUrl=APP_URL;
        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(),)));
        $ui->assign('val',$val);
        $ui->assign('v_types',$v_types);
        $ui->assign('baseUrl',$baseUrl);

        view('modal_edit_vehicle');

        break;

       
    case 'modal_add_mk':

        $id = $routes['2'];

        $vehicle_type = false;

        if($id != ' '){

            $vehicle_type = ORM::for_table('sys_vehicle_type')->find_one($id);

        }   

        $val = array();

        if($vehicle_type){
            $f_type = 'edit';
            $val['make'] = $vehicle_type->make;
            $val['model'] = $vehicle_type->model;
            $val['engine_capacity'] = $vehicle_type->engine_capacity;
            $val['transmission'] = $vehicle_type->transmission;
            $val['fuel_type'] = $vehicle_type->fuel_type;
            $val['v_t_id'] = $id;
        }
        else{
            $f_type = 'create';
            $val['make'] = '';
            $val['model'] = '';
            $val['engine_capacity'] = '';
            $val['transmission'] = '';
            $val['fuel_type'] = '';
            $val['v_t_id']='';
        }

        $ui->assign('f_type',$f_type);
        $ui->assign('val',$val);


        view('modal_add_mk');

        break;



    case 'update_mk_post':

        // Ajax post datas
        $id=_post('v_t_id');
        $make = _post('make');
        $model = _post('model');
        $engine_capacity=_post('engine_capacity');
        $transmission=_post('transmission');
        $fuel_type=_post('fuel_type');
        
        // Check validate post datas 

        $msg='';
      

        if($msg == ''){
            if($id){
                $d = ORM::for_table('sys_vehicle_type')->find_one($id);
                _msglog('s',$_L['Item Added Successfully']);
            }else {
                $d = ORM::for_table('sys_vehicle_type')->create();
                _msglog('s',$_L['Item Added Successfully']);
            }
            
            
            $d->make=$make;
            $d->model=$model;
            $d->engine_capacity=$engine_capacity;
            $d->transmission=$transmission;
            $d->fuel_type=$fuel_type;

            $d->save();

           

            echo $d->id();
        }
        else{
            echo $msg;
        }

        break;



    case 'view-cert':

        // Ajax post datas
        $id=$routes['2'];

        if($id){

            $d=ORM::for_table('sys_vehicles')->find_one($id);

        }

        if($d){
           
            $cert_img_path=APP_URL."/storage/items/".$d['v_o_c'];

        }

        $ui->assign('cert_img_path',$cert_img_path);
        view('modal_cert_vehicle');

        break;


    case 'del_mk':

      
        Event::trigger('vehicle/del_mk/');
        $id = $routes['2'];
        
        $d = ORM::for_table('sys_vehicle_type')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'vehicle/m-k', 's', $_L['Vehicle_type_delete_successful']);
        }

        break;



    case 'del_vehicle':

      
        Event::trigger('vehicle/list-vehicle/');
        $id = $routes['2'];
        
        $d = ORM::for_table('sys_vehicles')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'vehicle/list-vehicle', 's', $_L['Vehicle Delete Successful']);
        }

        break;


    default:
        echo 'action not defined';
}