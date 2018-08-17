<?php
/*
|--------------------------------------------------------------------------
|   Vehicle Controller
|
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

    case 'add_vehicle':

        $vehicle_types=ORM::for_table('sys_vehicle_type')->order_by_asc('id')->find_array();

        $v_types=array();

        foreach ($vehicle_types as $v) {
            array_push($v_types,$v['make']." ".$v['model']." ".$v['engine_capacity']." (".$v['transmission'].")");
        }
        $fs = ORM::for_table('crm_customfields')->where('ctype','cvm')->order_by_asc('id')->find_many();
        $ui->assign('fs',$fs);

        $ui->assign('vehicle_types',$vehicle_types);
        $ui->assign('v_types',$v_types);
        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'vehicle/vehicle_add')));
        $ui->assign('xjq', '$(\'.amount\').autoNumeric(\'init\');');

        //$max = ORM::for_table('sys_vehicles')->max('id');
        //$nxt = $max+1;
        //$ui->assign('nxt',$nxt);
        //$vehicle_type['make'].' '.$vehicle_type['make'].' '.$vehicle_type['engine_capacity'].' '.$vehicle_type['transmission'];

        view('vehicle_add');

        break;


    case 'list_vehicle':


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
            's2/js/i18n/'.lan(), 'vehicle/vehicle_list'
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


        view('vehicle_list');

        break;


    case 'm_k':


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
            's2/js/i18n/'.lan(), 'vehicle/vehicle_edit'
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

        view('vehicle_mk');



        break;

    case 'road_tax':

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
            's2/js/i18n/'.lan(), 'vehicle/vehicle_roadtax_list'
        ));

        $baseUrl=APP_URL;


        $total_items = ORM::for_table('sys_vehicle_roadtax');

        $total_items = $total_items->count();

        $f = ORM::for_table('sys_vehicle_roadtax');
        $d = $f->order_by_desc('id')->find_many();


        // Expiry Status

        $pay_status_string=array();

        foreach($d as $data){

            $expiry_id=$data['id'];
            $expiry_todate=$data['expiry_todate'];
            $due_date=$data['due_date'];
            $pay_status=$data['pay_status'];
            $today = date("Y-m-d");
            $date1 = date_create($today);
            $date2 = date_create($due_date);
            $rest= date_diff($date1,$date2);
            $rest= intval($rest->format("%a"));

            if($pay_status){

                $pay_status_string[$expiry_id]="Paid";


            }elseif($date1>=$date2){

                $pay_status_string[$expiry_id]="unPaid";

            }else {

                $pay_status_string[$expiry_id]=$rest." - Day Due";

            };


        }



        $paginator['contents'] = '';

        $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('pay_status_string',$pay_status_string);
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


        view('vehicle_roadtax_list');

        break;


    case 'add_roadtax':


        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();

        $baseUrl=APP_URL;
        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min','vehicle/vehicle_add_roadtax',
            's2/js/i18n/'.lan(),)));
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

        $ui->assign('vehicles',$vehicles);
        $ui->assign('baseUrl',$baseUrl);

        view('vehicle_add_roadtax');

        break;

    case 'insurance':

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
            's2/js/i18n/'.lan(), 'vehicle/vehicle_insurance_list'
        ));

        $baseUrl=APP_URL;


        $total_items = ORM::for_table('sys_vehicle_insurance');

        $total_items = $total_items->count();

        $f = ORM::for_table('sys_vehicle_insurance');
        $d = $f->order_by_desc('id')->find_many();


        // Expiry Status

        $pay_status_string=array();

        foreach($d as $data){

            $expiry_id=$data['id'];
            $expiry_todate=$data['expiry_todate'];
            $due_date=$data['due_date'];
            $pay_status=$data['pay_status'];
            $today = date("Y-m-d");
            $date1 = date_create($today);
            $date2 = date_create($due_date);
            $rest= date_diff($date1,$date2);
            $rest= intval($rest->format("%a"));

            if($pay_status){

                $pay_status_string[$expiry_id]="Paid";


            }elseif($date1>=$date2){

                $pay_status_string[$expiry_id]="unPaid";

            }else {

                $pay_status_string[$expiry_id]=$rest." - Day Due";

            };


        }



        $paginator['contents'] = '';

        $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('pay_status_string',$pay_status_string);
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


        view('vehicle_insurance_list');

        break;


    case 'add_insurance':

    
        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();

        $baseUrl=APP_URL;
        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min','vehicle/vehicle_add_insurance',
            's2/js/i18n/'.lan(),)));
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

        $ui->assign('vehicles',$vehicles);
        $ui->assign('baseUrl',$baseUrl);

        view('vehicle_add_insurance');

        break;

    case 'loans': 

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
            's2/js/i18n/'.lan(), 'vehicle/vehicle_loan_list'
        ));

        $baseUrl=APP_URL;


        $total_items = ORM::for_table('sys_vehicle_loan');

        $total_items = $total_items->count();

        $f = ORM::for_table('sys_vehicle_loan');
        $d = $f->order_by_desc('id')->find_many();


        // Expiry Status

        $pay_status_string=array();

        foreach($d as $data){

            // Expiry status calculation
            $expiry_id=$data['id'];
            $expiry_todate=$data['expiry_todate'];
            $expire_date=$data['expire_date'];
            $pay_status=$data['pay_status'];
            $today = date("Y-m-d");
            $date1 = date_create($today);
            $date2 = date_create($expire_date);
            $rest= date_diff($date1,$date2);
            $rest= intval($rest->format("%a"));

            if($pay_status){

                $pay_status_string[$expiry_id]="Paid";


            }elseif($date1>=$date2){

                $pay_status_string[$expiry_id]="unPaid";

            }else {

                $pay_status_string[$expiry_id]=$rest." - Day Due";

            };

            // Total Amount Calculation

            // $principal_amount=$data['principal_amount'];
            // $interest_rate=$data['interest_rate'];
            // $loan_duration=$data['loan_duration'];

        }



        $paginator['contents'] = '';

        $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('pay_status_string',$pay_status_string);
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


        view('vehicle_loan_list');

        break;

    case 'modal_add_roadtax':
        
        $id=$routes['2'];
        $f_type="add";
        $roadtax=false;

        if($id != ''){
            $roadtax=ORM::for_table('sys_vehicle_roadtax')->find_one($id);
            $f_type="edit";
        }

        // $fs = ORM::for_table('crm_customfields')->where('ctype','cvm')->order_by_asc('id')->find_many();
        // $ui->assign('fs',$fs);

        $val=array();

        if($roadtax){
            $val['id']=$id;
            $val['vehicle_num']=$roadtax->vehicle_num;
            $val['roadtax_amount']=$roadtax->roadtax_amount;
            $val['rebate_amount']=$roadtax->rebate_amount;
            $val['roadtax_total']=$roadtax->roadtax_total;
            $val['roadtax_date']=$roadtax->roadtax_date;
            $val['due_date']=$roadtax->due_date;
            $val['expiry_todate']=$roadtax->expiry_todate;
            $val['description']=$roadtax->description;
            $val['ref_img']=$roadtax->ref_img;

        }else{
            $val['id']=" ";
            $val['vehicle_num']=" ";
            $val['roadtax_amount']=" ";
            $val['rebate_amount']=" ";
            $val['roadtax_total']=" ";
            $val['roadtax_date']="  ";
            $val['due_date']=" ";
            $val['expiry_todate']=" ";
            $val['description']=" ";
            $val['ref_img']=" ";
        }

        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();

        $baseUrl=APP_URL;
        // $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        // $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
        //     's2/js/i18n/'.lan(),)));

        $ui->assign('val',$val);
        $ui->assign('f_type',$f_type);
        $ui->assign('vehicles',$vehicles);
        $ui->assign('baseUrl',$baseUrl);

        view('modal_add_roadtax');

        break;

   

    case 'modal_add_insurance':
        
        $id=$routes['2'];
        $f_type="add";
        $insurance=false;

        if($id != ''){
            $insurance=ORM::for_table('sys_vehicle_insurance')->find_one($id);
            $f_type="edit";
        }

        // $fs = ORM::for_table('crm_customfields')->where('ctype','cvm')->order_by_asc('id')->find_many();
        // $ui->assign('fs',$fs);

        $val=array();

        if($insurance){
            $val['id']=$id;
            $val['vehicle_num']=$insurance->vehicle_num;
            $val['insurance_amount']=$insurance->insurance_amount;
            $val['rebate_amount']=$insurance->rebate_amount;
            $val['insurance_total']=$insurance->insurance_total;
            $val['insurance_date']=$insurance->insurance_date;
            $val['due_date']=$insurance->due_date;
            $val['expiry_todate']=$insurance->expiry_todate;
            $val['description']=$insurance->description;
            $val['ref_img']=$insurance->ref_img;

        }else{
            $val['id']=" ";
            $val['vehicle_num']=" ";
            $val['insurance_amount']=" ";
            $val['rebate_amount']=" ";
            $val['insurance_total']=" ";
            $val['insurance_date']="  ";
            $val['due_date']=" ";
            $val['expiry_todate']=" ";
            $val['description']=" ";
            $val['ref_img']=" ";
        }

        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();

        $baseUrl=APP_URL;
        // $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        // $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
        //     's2/js/i18n/'.lan(),)));

        $ui->assign('val',$val);
        $ui->assign('f_type',$f_type);
        $ui->assign('vehicles',$vehicles);
        $ui->assign('baseUrl',$baseUrl);

        view('modal_add_insurance');

        break;
    

    case 'modal_add_loan':

    
        $id=$routes['2'];
        $f_type="add";
        $loan=false;

        if($id != ''){
            $loan=ORM::for_table('sys_vehicle_loan')->find_one($id);
            $f_type="edit";
        }

        // $fs = ORM::for_table('crm_customfields')->where('ctype','cvm')->order_by_asc('id')->find_many();
        // $ui->assign('fs',$fs);

        $val=array();

        if($loan){
            $val['id']=$id;
            $val['vehicle_num']=$loan->vehicle_num;
            $val['principal_amount']=$loan->principal_amount;
            $val['interest_rate']=$loan->interest_rate;
            $val['loan_duration']=$loan->loan_duration;
            $val['repay_cycle_type']=$loan->repay_cycle_type;
            $val['loan_date']=$loan->loan_date;
            $val['expire_date']=$loan->expire_date;
            $val['expiry_todate']=$loan->expiry_todate;
            $val['description']=$loan->description;
            $val['ref_img']=$loan->ref_img;

        }else{
            $val['id']=" ";
            $val['vehicle_num']=" ";
            $val['principal_amount']=" ";
            $val['interest_rate']=" ";
            $val['loan_duration']=" ";
            $val['repay_cycle_type']=" "; 
            $val['loan_date']="  ";
            $val['expire_date']=" ";
            $val['expiry_todate']=" ";
            $val['description']=" ";
            $val['ref_img']=" ";
        }

        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();

        $baseUrl=APP_URL;
        // $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        // $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
        //     's2/js/i18n/'.lan(),)));

        $ui->assign('val',$val);
        $ui->assign('f_type',$f_type);
        $ui->assign('vehicles',$vehicles);
        $ui->assign('baseUrl',$baseUrl);

        view('modal_add_loan');

        break;
    

    case 'post_roadtax':
      
        $id=_post('rid');

        $vehicle_num = _post('vehicle_num');
       
        $roadtax_amount=_post('roadtax_amount','0.00');
        $roadtax_amount = Finance::amount_fix($roadtax_amount);
        $rebate_amount=_post('rebate_amount','0.00');
        $rebate_amount = Finance::amount_fix($rebate_amount);
        $roadtax_total=_post('roadtax_total','0.00');
        $roadtax_total= Finance::amount_fix($roadtax_total);

        $roadtax_date=_post('roadtax_date');
        $due_date=_post('due_date');
        $expiry_todate=_post('expiry_todate');
        $description=_post('description');
        $ref_img=_post('ref_img');
        

        // Check validate post data

        $msg='';

        // if($vehicle_num == ''){
        //    $msg .= 'You must input Vehicle number <br>';
        // }
        // if($vehicle_type == ''){
        //    $msg .= 'You must select Vehicle type <br>';
        // }
        // if($purchase_price == ''){
        //    $msg .= 'You must input Purchase_price <br>';
        // }
        // if($parf_cost == ''){
        //    $msg .= 'You must input Purf_cost <br>';
        // }
        // if($expiry_date == ''){
        //    $msg .= 'You must input Expiry_date <br>';
        // }
        // if($expiry_status == ''){
        //    $msg .= 'You must select Expiry_status <br>';
        // }


        if($msg == ''){

            if($id == ''){
                _msglog('s',$_L['Item Added Successfully']);
                $d = ORM::for_table('sys_vehicle_roadtax')->create();
            } else{
                _msglog('s',$_L['Item Updated Successfully']);
                $d = ORM::for_table('sys_vehicle_roadtax')->find_one($id);
            }

            $d->vehicle_num = $vehicle_num;
            $d->roadtax_amount = $roadtax_amount;
            $d->rebate_amount = $rebate_amount;
            $d->roadtax_total= $roadtax_total;
            $d->roadtax_date = $roadtax_date;
            $d->due_date=$due_date;
            $d->expiry_todate = $expiry_todate;
            $d->description = $description;
            $d->ref_img =$ref_img;


            $d->save();



            echo $d->id();
        }
        else{
            echo $msg;
        }
        break;


    case 'post_insurance':

        $id=_post('rid');

        $vehicle_num = _post('vehicle_num');
       
        $insurance_amount=_post('insurance_amount','0.00');
        $insurance_amount = Finance::amount_fix($insurance_amount);
        $rebate_amount=_post('rebate_amount','0.00');
        $rebate_amount = Finance::amount_fix($rebate_amount);
        $insurance_total=_post('insurance_total','0.00');
        $insurance_total= Finance::amount_fix($insurance_total);

        $insurance_date=_post('insurance_date');
        $due_date=_post('due_date');
        $expiry_todate=_post('expiry_todate');
        $description=_post('description');
        $ref_img=_post('ref_img');
        

        // Check validate post data

        $msg='';

        // if($vehicle_num == ''){
        //    $msg .= 'You must input Vehicle number <br>';
        // }
        // if($vehicle_type == ''){
        //    $msg .= 'You must select Vehicle type <br>';
        // }
        // if($purchase_price == ''){
        //    $msg .= 'You must input Purchase_price <br>';
        // }
        // if($parf_cost == ''){
        //    $msg .= 'You must input Purf_cost <br>';
        // }
        // if($expiry_date == ''){
        //    $msg .= 'You must input Expiry_date <br>';
        // }
        // if($expiry_status == ''){
        //    $msg .= 'You must select Expiry_status <br>';
        // }


        if($msg == ''){

            if($id == ''){
                _msglog('s',$_L['Item Added Successfully']);
                $d = ORM::for_table('sys_vehicle_insurance')->create();
            } else{
                _msglog('s',$_L['Item Updated Successfully']);
                $d = ORM::for_table('sys_vehicle_insurance')->find_one($id);
            }

            $d->vehicle_num = $vehicle_num;
            $d->insurance_amount = $insurance_amount;
            $d->rebate_amount = $rebate_amount;
            $d->insurance_total= $insurance_total;
            $d->insurance_date = $insurance_date;
            $d->due_date=$due_date;
            $d->expiry_todate = $expiry_todate;
            $d->description = $description;
            $d->ref_img =$ref_img;


            $d->save();



            echo $d->id();
        }
        else{
            echo $msg;
        }
        break;

    case 'post_loan':
    
        $id=_post('rid');

        $vehicle_num = _post('vehicle_num');
       
        $principal_amount=_post('principal_amount','0.00');
        $principal_amount = Finance::amount_fix($principal_amount);
        $interest_rate=_post('interest_rate');
        $loan_duration=_post('loan_duration');
        $repay_cycle_type=_post('repay_cycle_type');
        
        $loan_date=_post('loan_date');
        $expire_date=_post('expire_date');
        $expiry_todate=_post('expiry_todate');
        $description=_post('description');
        $ref_img=_post('ref_img');
        

        // Check validate post data

        $msg='';

        // if($vehicle_num == ''){
        //    $msg .= 'You must input Vehicle number <br>';
        // }
        // if($vehicle_type == ''){
        //    $msg .= 'You must select Vehicle type <br>';
        // }
        // if($purchase_price == ''){
        //    $msg .= 'You must input Purchase_price <br>';
        // }
        // if($parf_cost == ''){
        //    $msg .= 'You must input Purf_cost <br>';
        // }
        // if($expiry_date == ''){
        //    $msg .= 'You must input Expiry_date <br>';
        // }
        // if($expiry_status == ''){
        //    $msg .= 'You must select Expiry_status <br>';
        // }


        if($msg == ''){

            if($id == ''){
                _msglog('s',$_L['Item Added Successfully']);
                $d = ORM::for_table('sys_vehicle_loan')->create();
            } else{
                _msglog('s',$_L['Item Updated Successfully']);
                $d = ORM::for_table('sys_vehicle_loan')->find_one($id);
            }

            $d->vehicle_num = $vehicle_num;
            $d->principal_amount = $principal_amount;
            $d->interest_rate = $interest_rate;
            $d->loan_duration = $loan_duration;
            $d->repay_cycle_type=$repay_cycle_type;
            $d->loan_date=$loan_date;
            $d->expire_date=$expire_date;
            $d->expiry_todate = $expiry_todate;
            $d->description = $description;
            $d->ref_img =$ref_img;


            $d->save();



            echo $d->id();
        }
        else{
            echo $msg;
        }
        break;

    case 'post_vehicle':

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


    case 'edit_vehicle':

        $id=$routes['2'];

        if($id != ''){
            $vehicle=ORM::for_table('sys_vehicles')->find_one($id);
        }

        $fs = ORM::for_table('crm_customfields')->where('ctype','cvm')->order_by_asc('id')->find_many();
        $ui->assign('fs',$fs);

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



    case 'view_cert':

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

    case 'view_vehicle':

        // Ajax post datas
        $id=$routes['2'];

        if($id){

            $d=ORM::for_table('sys_vehicles')->find_one($id);

        }

        if($d){

            $vehicle_img_path=APP_URL."/storage/items/".$d['v_i'];

        }
        $ui->assign('d',$d);
        $ui->assign('vehicle_img_path',$vehicle_img_path);
        view('modal_img_vehicle');

        break;


    case 'del_mk':


        Event::trigger('vehicle/del_mk/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicle_type')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'vehicle/m_k', 's', $_L['Vehicle_type_delete_successful']);
        }

        break;



    case 'del_vehicle':


        Event::trigger('vehicle/list_vehicle/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicles')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'vehicle/list_vehicle', 's', $_L['Vehicle Delete Successful']);
        }

        break;

    
    case 'del_roadtax':
        

        Event::trigger('vehicle/del_roadtax/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicle_roadtax')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'vehicle/road_tax', 's', $_L['Road Tax Transaction Delete Successful']);
        }

        break;


    case 'del_insurance':
        
        Event::trigger('vehicle/del_insurance/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicle_insurance')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'vehicle/insurance', 's', $_L['Insurance Transaction Delete Successful']);
        }

        break;
    
    case 'del_loan':
        
        Event::trigger('vehicle/del_loan/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicle_loan')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'vehicle/loans', 's', $_L['Loan Transaction Delete Successful']);
        }

        break;

    case 'upload':  

        if(APP_STAGE == 'Demo'){
            exit;
        }

        $uploader   =   new Uploader();
        $uploader->setDir('storage/items/');
        $uploader->sameName(false);
        $uploader->setExtensions(array('jpg','jpeg','png','gif'));  //allowed extensions list//
        //$uploader->allowAllFormats();  //allowed extensions list//
        if($uploader->uploadFile('file')){   //txtFile is the filebrowse element name //
            $uploaded  =   $uploader->getUploadName(); //get uploaded file name, renames on upload//

            $file = $uploaded;
            $msg = $_L['Uploaded Successfully'];
            $success = 'Yes';

            // create thumb

            $image = new Img();

            // indicate a source image (a GIF, PNG or JPEG file)
            $image->source_path = 'storage/items/'.$file;

            // indicate a target image
            // note that there's no extra property to set in order to specify the target
            // image's type -simply by writing '.jpg' as extension will instruct the script
            // to create a 'jpg' file
            $image->target_path = 'storage/items/thumb'.$file;

            // since in this example we're going to have a jpeg file, let's set the output
            // image's quality
            $image->jpeg_quality = 100;

            // some additional properties that can be set
            // read about them in the documentation
            $image->preserve_aspect_ratio = true;
            $image->enlarge_smaller_images = true;
            $image->preserve_time = true;

            // resize the image to exactly 200x100 pixels by using the "crop from center" method
            // (read more in the overview section or in the documentation)
            //  and if there is an error, check what the error is about
            if (!$image->resize(200, 100, ZEBRA_IMAGE_CROP_CENTER)) {
                // if no errors
            } else {
                // echo 'Success!';
            }

        }else{//upload failed
            $file = '';
            $msg = $uploader->getMessage();
            $success = 'No';
        }

        $a = array(
            'success' => $success,
            'msg' =>$msg,
            'file' =>$file
        );

        header('Content-Type: application/json');
        echo json_encode($a);

        break;
   
    default:
        echo 'action not defined';
}
