<?php
/*
|--------------------------------------------------------------------------
|   Vehicle Controller
|
|--------------------------------------------------------------------------
|
*/
_auth();
$ui->assign('_title', $_L['Vehicles'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Vehicles']);
$ui->assign('_application_menu', 'vehicles');
$ui->assign('content_inner', inner_contents($config['c_cache']));
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {

    case 'add_vehicle': 

        $vehicle_types=ORM::for_table('sys_vehicle_type')->order_by_asc('make')->find_array();

        $v_types=array();

        foreach ($vehicle_types as $v) {
            // array_push($v_types,$v['make']." ".$v['model']." ".$v['engine_capacity']." (".$v['transmission'].")");
            $v_types[$v['id']]=$v['make']." ".$v['model']." ".$v['engine_capacity']." (".$v['transmission'].")";
        }
        // var_dump($v_types);
        // exit;
        $fs = ORM::for_table('sys_vehicle_customfields')->order_by_asc('id')->find_many();
        $ui->assign('fs',$fs);

        $ui->assign('vehicle_types',$vehicle_types);
        $ui->assign('v_types',$v_types);
        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'vehicle/vehicle_add')));
        $ui->assign('xjq', '$(\'.amount\').autoNumeric(\'init\');');

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


            }elseif($rest>$expiry_status){

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


        $f = ORM::for_table('sys_vehicle_type');

        if(!$all_data)
        {
            $f->where('aid',$user->id);
        }

        $d = $f->order_by_desc('id')->find_many();
        $paginator['contents'] = '';
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
        $rest_status=array();

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


            }elseif($date1>=$date2 || $rest>$expiry_todate){

                $pay_status_string[$expiry_id]="unPaid";

            }else {

                $pay_status_string[$expiry_id]=$rest." - Day Due";

            };

            $rest_status[$expiry_id]=0;
            if($rest<$expiry_todate){
                $rest_status[$expiry_id]=1;
            }
            
            if($data['expired']==1){
                $pay_status_string[$expiry_id]="Expired";
                $rest_status[$expiry_id]=0;
            }


        }

        $transactions=ORM::for_table('sys_transactions')->where('type','Expense')->where('category','Road Tax')->order_by_desc('id')->find_many();
        if(!$transactions){
            $transactions="";
        }
        
        $ui->assign('transactions',$transactions);

        $paginator['contents'] = '';

        $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('pay_status_string',$pay_status_string);
        $ui->assign('rest_status',$rest_status);
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
        $rest_status=array();

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


            }elseif($date1>=$date2  || $rest>$expiry_todate){

                $pay_status_string[$expiry_id]="unPaid";

            }else {

                $pay_status_string[$expiry_id]=$rest." - Day Due";

            };

            $rest_status[$expiry_id]=0;
            if($rest<$expiry_todate){
                $rest_status[$expiry_id]=1;
            }
            
            if($data['expired']==1){
                $pay_status_string[$expiry_id]="Expired";
                $rest_status[$expiry_id]=0;
            }
        }

        $transactions=ORM::for_table('sys_transactions')->where('type','Expense')->where('category','Insurance')->order_by_desc('id')->find_many();
        if(!$transactions){
            $transactions="";
        }
        
        $ui->assign('transactions',$transactions);

        $paginator['contents'] = '';

        $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('pay_status_string',$pay_status_string);
        $ui->assign('rest_status',$rest_status);
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

        $pay_status_string = array();
        $next_duedate = array();
        $duration_count = array();
        // $expire_date=array();
        foreach($d as $data){

            // Expiry status calculation
            $expiry_id=$data['id'];
            $loan_date=$data['loan_date'];
            $expire_date=$data['expire_date'];
            $expiry_todate=$data['expiry_todate'];
            $pay_status=$data['pay_status'];
            $loan_duration=$data['loan_duration'];
            $total_days=$data['total_days'];
            $loan_type=$data['loan_type'];
                      
            $repay_cycle_type=$data['repay_cycle_type'];
            $duration_int=0;
            switch ($repay_cycle_type) {
                case 'weekly':
                    if($loan_type == 'HP'){
                        $duration=$total_days/7;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int*7).'D');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
    
                        $duration=$duration_int+1+$rest/7;
                    } else {
                        
                        $duration=$total_days/7;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int*7).'D');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        
                        $duration=$duration_int+1+$rest/7;
                    }
                    
                    break;

                case 'monthly':
                    if($loan_type == 'HP'){
                        $d1 = new DateTime($loan_date);
                        $d2 = new DateTime($expire_date);
                        $d1->add(new \DateInterval('P1M'));
                        while ($d1 <= $d2){
                            $duration_int++;
                            $d1->add(new \DateInterval('P1M'));
                        }
    
                        $interval = new DateInterval('P'.($duration_int).'M');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        if($rest==31){
                            $rest=30;
                        }
                        $duration=$duration_int+1+$rest/30;
                        $months=$duration;
                    }else {
                        $duration=$total_days/30;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int*30).'D');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        
                        $duration=$duration_int+1+$rest/30;
                        $months=$duration;
                    }
                    
                    break;

                case 'yearly':
                    if($loan_type == 'HP'){
                        $duration=$total_days/365;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int).'Y');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        
                        $duration=$duration_int+1+$rest/365;
                        $months=$duration*365/30;
                    }else {
                        $duration=$total_days/365;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int*365).'D');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        
                        $duration=$duration_int+1+$rest/365;
                        $months=$duration*365/30;
                    }

                    break;
                default:
                    break;
            }
            $duration_count[$expiry_id]=$duration;


            switch ($repay_cycle_type) {
                case 'weekly':
                    if($loan_type == 'HP'){
                        $interval = new DateInterval('P'.($pay_status*7).'D');
                    }else {
                        $interval = new DateInterval('P'.($pay_status*7).'D');
                    }
                    break;
                case 'monthly':
                    if($loan_type == 'HP'){
                        $interval = new DateInterval('P'.($pay_status).'M');
                    }else {
                        $interval = new DateInterval('P'.($pay_status*30).'D');
                    }
                    break;
                case 'yearly':
                    if($loan_type == 'HP'){
                        $interval = new DateInterval('P'.($pay_status).'Y');
                    }else {
                        $interval = new DateInterval('P'.($pay_status*365).'D');
                    }
                    break;
            }

            $next_duedate[$expiry_id]=date_create($data['loan_date'])->add($interval);
            $next_duedate[$expiry_id]=$next_duedate[$expiry_id]->format('Y-m-d');
            
            $today = date("Y-m-d");
            $date1 = date_create($today);
            $date2 = date_create($next_duedate[$expiry_id]);
            $date3 = date_create($expire_date);
            $rest= date_diff($date1,$date3);
            $rest= intval($rest->format("%a"));

            if(!$pay_status || $date1>$date2){

                $pay_status_string[$expiry_id]="unPaid";

            }
            if($pay_status && $date1<$date2 && $rest>$expiry_todate){

                $pay_status_string[$expiry_id]="Paid";

            }
            if($rest<$expiry_todate && $loan_duration+1>$pay_status) {

                $pay_status_string[$expiry_id]=$rest." - Day Due";

            };

            // Total Amount Calculation

            // $principal_amount=$data['principal_amount'];
            // $interest_rate=$data['interest_rate'];
            // $loan_duration=$data['loan_duration'];
            // next due date overflow expire date
            if($next_duedate[$expiry_id]>$expire_date) {
                $next_duedate[$expiry_id]=$expire_date;
                $pay_status_string[$expiry_id]="Paid";
            }

        }

        $loan_types = array(array('type'=>'Expense','category'=>'Vehicle Loan'),
                            array('type'=>'Expense', 'category'=>'Vehicle HP Loan'),
                            array('type'=>'Expense', 'category'=>'Vehicle Flooring Loan'),
                            array('type'=>'Expense', 'category'=>'Vehicle Flooring Interest')
                        ); 
        $transactions = ORM::for_table('sys_transactions')->where_any_is($loan_types)->order_by_desc('id')->find_many();
        if(!$transactions){
            $transactions="";
        }

        $ui->assign('transactions',$transactions);

        $paginator['contents'] = '';

        $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('next_duedate',$next_duedate);
        $ui->assign('duration_count',$duration_count);
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

    case 'loan_view': 


        $id=$routes['2'];

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
            's2/js/i18n/'.lan(), 'vehicle/vehicle_loan_view'
        ));

        $baseUrl=APP_URL;
        $duration_count=0;

        $loan = ORM::for_table('sys_vehicle_loan')->where('id',$id)->find_one();
        $val=array();
        $val['id']=$id;
        $val['vehicle_num']=$loan['vehicle_num'];
        $val['date']=$loan['loan_date'];
        $val['loan_type']=$loan['loan_type'];
        $val['duration']=$loan['loan_duration'];
        $val['expire_date']=$loan['expire_date'];              
        $val['repayment']=$loan['repay_cycle_type'];
        $val['amount']=$loan['principal_amount'];
        $val['rate']=$loan['interest_rate'];
     

        $loan_date=$loan['loan_date'];
        $expire_date=$loan['expire_date'];
        $total_days=$loan['total_days'];
        
        $months=0;  // for calculate interest
        $duration_int=0;
        // real duration calculate
        $repay_cycle_type=$loan['repay_cycle_type'];
        
        switch ($repay_cycle_type) {
            // case 'weekly':
            //     $duration=$total_days/7;
            //     $duration_int=floor($duration);
            //     $interval = new DateInterval('P'.($duration_int*7).'D');
            //     $duration_int_date=date_create($loan_date)->add($interval);
            //     $duration_int_date=$duration_int_date->format('Y-m-d');
            //     $date1 = date_create($duration_int_date);
            //     $date2 = date_create($expire_date);
            //     $rest= date_diff($date1,$date2);
            //     $rest= intval($rest->format("%a"));

            //     $duration=$duration_int+1+$rest/7;
            //     $months=$duration*7/30;
                
            //     break;

            // case 'monthly':
            //     // $duration=$total_days/30;
            //     // $duration_int=floor($duration);

            //     $d1 = new DateTime($loan_date);
            //     $d2 = new DateTime($expire_date);
            //     $d1->add(new \DateInterval('P1M'));
            //     while ($d1 <= $d2){
            //         $duration_int++;
            //         $d1->add(new \DateInterval('P1M'));
            //     }

            //     $interval = new DateInterval('P'.($duration_int).'M');
            //     $duration_int_date=date_create($loan_date)->add($interval);
            //     $duration_int_date=$duration_int_date->format('Y-m-d');
            //     $date1 = date_create($duration_int_date);
            //     $date2 = date_create($expire_date);
            //     $rest= date_diff($date1,$date2);
            //     $rest= intval($rest->format("%a"));
            //     if($rest==31){
            //         $rest=30;
            //     }
            //     $duration=$duration_int+1+$rest/30;
            //     $months=$duration;
               
            //     break;

            // case 'yearly':
            //     $duration=$total_days/365;
            //     $duration_int=floor($duration);
            //     $interval = new DateInterval('P'.($duration_int).'Y');
            //     $duration_int_date=date_create($loan_date)->add($interval);
            //     $duration_int_date=$duration_int_date->format('Y-m-d');
            //     $date1 = date_create($duration_int_date);
            //     $date2 = date_create($expire_date);
            //     $rest= date_diff($date1,$date2);
            //     $rest= intval($rest->format("%a"));
                
            //     $duration=$duration_int+1+$rest/365;
            //     $months=$duration*365/30;

            //     break;
             case 'weekly':
                if($val['loan_type'] == 'HP'){
                    $duration=$total_days/7;
                    $duration_int=floor($duration);
                    $interval = new DateInterval('P'.($duration_int*7).'D');
                    $duration_int_date=date_create($loan_date)->add($interval);
                    $duration_int_date=$duration_int_date->format('Y-m-d');
                    $date1 = date_create($duration_int_date);
                    $date2 = date_create($expire_date);
                    $rest= date_diff($date1,$date2);
                    $rest= intval($rest->format("%a"));

                    $duration=$duration_int+1+$rest/7;
                } else {
                    
                    $duration=$total_days/7;
                    $duration_int=floor($duration);
                    $interval = new DateInterval('P'.($duration_int*7).'D');
                    $duration_int_date=date_create($loan_date)->add($interval);
                    $duration_int_date=$duration_int_date->format('Y-m-d');
                    $date1 = date_create($duration_int_date);
                    $date2 = date_create($expire_date);
                    $rest= date_diff($date1,$date2);
                    $rest= intval($rest->format("%a"));
                    
                    $duration=$duration_int+1+$rest/7;
                }
                
                break;

            case 'monthly':
                if($val['loan_type'] == 'HP'){
                    $d1 = new DateTime($loan_date);
                    $d2 = new DateTime($expire_date);
                    $d1->add(new \DateInterval('P1M'));
                    while ($d1 <= $d2){
                        $duration_int++;
                        $d1->add(new \DateInterval('P1M'));
                    }

                    $interval = new DateInterval('P'.($duration_int).'M');
                    $duration_int_date=date_create($loan_date)->add($interval);
                    $duration_int_date=$duration_int_date->format('Y-m-d');
                    $date1 = date_create($duration_int_date);
                    $date2 = date_create($expire_date);
                    $rest= date_diff($date1,$date2);
                    $rest= intval($rest->format("%a"));
                    if($rest==31){
                        $rest=30;
                    }
                    $duration=$duration_int+1+$rest/30;
                    $months=$duration;
                }else {
                    $duration=$total_days/30;
                    $duration_int=floor($duration);
                    $interval = new DateInterval('P'.($duration_int*30).'D');
                    $duration_int_date=date_create($loan_date)->add($interval);
                    $duration_int_date=$duration_int_date->format('Y-m-d');
                    $date1 = date_create($duration_int_date);
                    $date2 = date_create($expire_date);
                    $rest= date_diff($date1,$date2);
                    $rest= intval($rest->format("%a"));
                    
                    $duration=$duration_int+1+$rest/30;
                    $months=$duration;
                }
                
                break;

            case 'yearly':
                if($val['loan_type'] == 'HP'){
                    $duration=$total_days/365;
                    $duration_int=floor($duration);
                    $interval = new DateInterval('P'.($duration_int).'Y');
                    $duration_int_date=date_create($loan_date)->add($interval);
                    $duration_int_date=$duration_int_date->format('Y-m-d');
                    $date1 = date_create($duration_int_date);
                    $date2 = date_create($expire_date);
                    $rest= date_diff($date1,$date2);
                    $rest= intval($rest->format("%a"));
                    
                    $duration=$duration_int+1+$rest/365;
                    $months=$duration*365/30;
                }else {
                    $duration=$total_days/365;
                    $duration_int=floor($duration);
                    $interval = new DateInterval('P'.($duration_int*365).'D');
                    $duration_int_date=date_create($loan_date)->add($interval);
                    $duration_int_date=$duration_int_date->format('Y-m-d');
                    $date1 = date_create($duration_int_date);
                    $date2 = date_create($expire_date);
                    $rest= date_diff($date1,$date2);
                    $rest= intval($rest->format("%a"));
                    
                    $duration=$duration_int+1+$rest/365;
                    $months=$duration*365/30;
                }

                break;
            default:
                break;
        }
            

        $duration_count=ceil($duration-1);
      

        // Calculate interest

        $val['interest']=($val['amount']*$val['rate']*$months)/100;

        if($val['loan_type'] == "HP"){
            $val['interest'] =$val['interest']/12;
        }

        
        $val['total_due']=$val['amount']+$val['interest'];
        
        $next_duedate=array();

        for($i=0;$i<=$duration_count-1;$i++){
            switch ($repay_cycle_type) {
                case 'weekly':
                    if($val['loan_type'] == 'HP'){
                        $interval = new DateInterval('P'.($i*7).'D');
                    }else {
                        $interval = new DateInterval('P'.($i*7).'D');
                    }
                    break;
                case 'monthly':
                    if($val['loan_type'] == 'HP'){
                        $interval = new DateInterval('P'.($i).'M');
                    }else {
                        $interval = new DateInterval('P'.($i*30).'D');
                    }
                    break;
                case 'yearly':
                    if($val['loan_type'] == 'HP'){
                        $interval = new DateInterval('P'.($i).'Y');
                    }else {
                        $interval = new DateInterval('P'.($i*365).'D');
                    }
                    break;
                default:
                    break;
            }
            
            $next_duedate[$i]=date_create($loan['loan_date'])->add($interval);
            $next_duedate[$i]=$next_duedate[$i]->format('Y-m-d');
        }
        $next_duedate[$duration_count]=$val['expire_date'];

        $val['loan_amount']=ceil($val['amount']/$duration);
        $val['interest_amount']=ceil($val['interest']/$duration);
        $val['due_amount']=$val['loan_amount']+$val['interest_amount'];

        $loan_balance=array();
        $loan_balance[0]=$val['total_due']-$val['due_amount'];

        for($i=1;$i<=$duration_count-1;$i++){
            $loan_balance[$i]=$loan_balance[$i-1]-$val['due_amount'];
        }

        $loan_log=ORM::for_table('sys_vehicle_loanlog')->where('loan_id',$val['id'])->where_not_equal('principal_pay','1')->find_array();
        if($loan_log){
            $loan_log_count=count($loan_log);
        }else{
            $loan_log_count=0;
        }


        $val['expiry_todate']=$loan['expiry_todate'];
        $pay_status_string=array();   
        
        // Expiry Status

        for($i=0;$i<=$duration_count;$i++){

            if($loan_log_count != 0){
                
                $pay_status_string[$i]="Paid";
                $loan_log_count--;    

            }else{

                $today = date("Y-m-d");
                $date1 = date_create($today);
                $date2 = date_create($next_duedate[$i]);
                $rest= date_diff($date1,$date2);
                $rest= intval($rest->format("%a"));

                if($date1>=$date2 || $rest>$val['expiry_todate']){
                 
                    $pay_status_string[$i]="unPaid";
                
                }else{
                      
                    $pay_status_string[$i]=$rest." - Day Due";

                }

            }

        }


        // Flooring Loan calculate
        $principal_paid_amount=ORM::for_table('sys_transactions')->select('sys_transactions.*')
        ->inner_join('sys_vehicle_loanlog',array('sys_vehicle_loanlog.transaction_id','=','sys_transactions.id'))
        ->where('sys_vehicle_loanlog.loan_id',$id)->where('sys_vehicle_loanlog.principal_pay','1')->sum('sys_transactions.amount');
        $principal_paid_amount=$principal_paid_amount?$principal_paid_amount:0;
        $flooring_paid_balance=$val['amount']-$principal_paid_amount;
        if($flooring_paid_balance == 0){
            $flooring_paystatus="Paid";
        } elseif($principal_paid_amount == 0){
            $flooring_paystatus="unPaid";
        } else {
            $flooring_paystatus="Parcial";
        }

        $ui->assign('principal_paid_amount', $principal_paid_amount);
        $ui->assign('flooring_paid_balance', $flooring_paid_balance);
        $ui->assign('flooring_paystatus', $flooring_paystatus);


        $transactions=ORM::for_table('sys_transactions')->select('sys_transactions.*')
        ->inner_join('sys_vehicle_loanlog',array('sys_vehicle_loanlog.transaction_id','=','sys_transactions.id'))
        ->where('sys_vehicle_loanlog.loan_id',$id)->order_by_desc('id')->find_many();

        $transaction_total=ORM::for_table('sys_transactions')->select('sys_transactions.*')
        ->inner_join('sys_vehicle_loanlog',array('sys_vehicle_loanlog.transaction_id','=','sys_transactions.id'))
        ->where('sys_vehicle_loanlog.loan_id',$id)->sum('sys_transactions.amount');

        if(!$transactions){
            $transactions="";
        }

        $ui->assign('transactions',$transactions);
        $ui->assign('transactions_total', $transaction_total);

        $paginator['contents'] = '';

        // $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('val', $val);
        $ui->assign('view_type',$view_type);
        $ui->assign('next_duedate',$next_duedate);
        $ui->assign('loan_balance',$loan_balance);
        $ui->assign('duration', $duration);
        $ui->assign('duration_count', $duration_count);
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

        view('vehicle_loan_view');

        break;

    case 'summary':

        $id=$routes['2'];
        
        $paginator = array();
        $mode_css = '';
        $mode_js = '';
        $view_type = 'default';
        $view_type = 'filter';
        $mode_css = Asset::css(array('modal','dropzone/dropzone','dp/dist/datepicker.min','dashboard/dashboard','dt/dt','fc/fc','fc/fc_ibilling','footable/css/footable.core.min','redactor/redactor','s2/css/select2.min','vehicle/vehicle_summary'));
        $mode_js = Asset::js(array('modal','dropzone/dropzone','dp/dist/datepicker.min','dashboard/graph','waypoints/jquery.waypoints.min','dt/dt','waypoints/jquery.counterup.min','fc/fc','footable/js/footable.all.min','contacts/mode_search','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(),'vehicle/vehicle_summary'
        ));


        // $xheader .= Asset::css(array('dashboard/dashboard','fc/fc','fc/fc_ibilling','modal'));
        // $xfooter .= Asset::js(array('dashboard/graph','numeric','waypoints/jquery.waypoints.min','waypoints/jquery.counterup.min','fc/fc','modal'),$file_build).$xtra;

        $baseUrl=APP_URL;
             
        // Vehicle Datas

        $vehicle_info=ORM::for_table('sys_vehicles')->find_one($id);
        $vehicle_num=$vehicle_info->vehicle_num;
        $type_id=$vehicle_info->type_id;
        $parf_cost=$vehicle_info->parf_cost;
        $purchase_price=$vehicle_info->purchase_price;
        $vehicle_totalcost=$purchase_price-$parf_cost;
        $purchase_date=$vehicle_info->purchase_date;
        $expiry_date=$vehicle_info->expiry_date;

        $today=date('Y-m-d');
        if($today>=$expiry_date){
            $remain_day=0;
        } else {
            $remain_day=date_diff(date_create($expiry_date),date_create($today));
            $remain_day=intval($remain_day->format("%a"));
        }
       
        $expiry_remain_days=date_diff(date_create($expiry_date),date_create($purchase_date));
        $expiry_remain_days=intval($expiry_remain_days->format("%a"));

        // vehicle type

        $vehicle_type=ORM::for_table('sys_vehicle_type')->find_one($type_id);

        //custom fields

        $fs = ORM::for_table('sys_vehicle_customfields')->order_by_asc('id')->find_many();
        $ui->assign('fs',$fs);
        $cf_value=array();
        foreach ($fs as $f) {
            $cf=ORM::for_table('sys_vehicle_customfieldsvalues')->where('relid',$id)->where('fieldid',$f->id)->find_one();
            $cf_value[$f->id]='';
            if($cf){
                $cf_value[$f->id]=$cf->fvalue;
            }    
        }
        $ui->assign('cf_value',$cf_value);

        $ui->assign('vehicle_type', $vehicle_type);
        $ui->assign('remain_day', $remain_day);
        $ui->assign('expiry_remain_days',$expiry_remain_days);
        $ui->assign('vehicle_totalcost', $vehicle_totalcost);
        

        // vehicle income
        
        $incomes=ORM::for_table('sys_transactions')->where('type', 'Income')->where('vehicle_num', $vehicle_num)->order_by_desc('id')->find_many();
        $income_total=ORM::for_table('sys_transactions')->where('type', 'Income')->where('vehicle_num', $vehicle_num)->sum('amount');
        $income_total=$income_total?$income_total:0;
        $customer=array();
        foreach($incomes as $income){
            $d=ORM::for_table('crm_accounts')->where('id',$income->payerid)->find_one();
            if($d){
                $customer[$income->id]=$d->account;
            }else{
                $customer[$income->id]="anonymous";
            }
        }
        $ui->assign('incomes', $incomes);
        $ui->assign('customer',$customer);
        $ui->assign('income_total', $income_total);



        //Total vehicle Depreciation

        $expenses=ORM::for_table('sys_transactions')->where('type','Expense')->where('vehicle_num',$vehicle_num);
        $expense_vehicle=$expenses->where('category', 'Depreciation')->sum('amount');
        $expense_vehicle=$expense_vehicle?$expense_vehicle:0;

        $expenses=ORM::for_table('sys_transactions')->where('type','Expense')->where('vehicle_num',$vehicle_num);
        $expense_insurance=$expenses->where('category', 'Insurance')->order_by_desc('id')->sum('amount');
        $expense_insurance=$expense_insurance?$expense_insurance:0;

        $expenses=ORM::for_table('sys_transactions')->where('type','Expense')->where('vehicle_num',$vehicle_num);
        $expense_roadtax=$expenses->where('category', 'Road Tax')->order_by_desc('id')->sum('amount');
        $expense_roadtax=$expense_roadtax?$expense_roadtax:0;
        
        // $expenses=ORM::for_table('sys_transactions')->where('type','Expense')->where('vehicle_num',$vehicle_num);
        // $expense_loan=$expenses->where('category',array('Vehicle Loan','Vehicle HP Loan','Vehicle Flooring Loan','Vehicle Flooring Interest'))->sum('amount');
        // $expense_loan=$expense_loan?$expense_loan:0;

        $expenses=ORM::for_table('sys_transactions')->where('type','Expense')->where('vehicle_num',$vehicle_num);
        $expense_others=$expenses
            ->where_not_equal('category','Road Tax')
            ->where_not_equal('category','Insurance')
            ->where_not_equal('category','Vehicle Loan')
            ->where_not_equal('category','Vehicle HP Loan')
            ->where_not_equal('category','Vehicle Flooring Loan')
            ->where_not_equal('category','Vehicle Flooring Interest')
            ->where_not_equal('category','Depreciation')->sum('amount');
        $expense_others=$expense_others?$expense_others:0;
        

       
        // Vehicle Depreciation  prefix V_D

        $v_d_balance=$vehicle_totalcost-$expense_vehicle;
        if($v_d_balance == 0){
            $v_d_status="Paid";
        } elseif($expense_vehicle == 0){
            $v_d_status="unPaid";
        } else {
            $v_d_status="Parcial";
        }

        $ui->assign('v_d_balance', $v_d_balance);
        $ui->assign('v_d_status', $v_d_status);



        // Insurnace
        
        $insurances=ORM::for_table('sys_vehicle_insurance')->where('vehicle_num',$vehicle_num)->order_by_desc('id')->find_many();
        $insurance_paystatus=array();
        $insurance_count=count($insurances);
        $insurance_unpaid_amount=0;
        if($insurances){
           foreach($insurances as $data){
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
                    $insurance_paystatus[$expiry_id]="Paid";
                }elseif($date1>=$date2  || $rest>$expiry_todate){
                    $insurance_paystatus[$expiry_id]="unPaid";
                }else {
                    $insurance_paystatus[$expiry_id]="Due";
                };
                if($data['expired']==1){
                    $insurance_paystatus[$expiry_id]="Expired";
                }

                // unpaid amount
                if( $insurance_paystatus[$expiry_id] == "unPaid" ||  $insurance_paystatus[$expiry_id] == "Due"){
                    $insurance_unpaid_amount += $data['insurance_total'];
                  
                }
            }
        }
        
        $ui->assign('insurances', $insurances);
        $ui->assign('insurance_count', $insurance_count);
        $ui->assign('insurance_paystatus',$insurance_paystatus);
        $ui->assign('insurance_unpaid_amount',$insurance_unpaid_amount);


        // Road Tax

        $roadtaxs=ORM::for_table('sys_vehicle_roadtax')->where('vehicle_num', $vehicle_num)->order_by_desc('id')->find_many();
       
        $roadtax_paystatus=array();
        $roadtax_count=count($roadtaxs);
        $roadtax_unpaid_amount=0;
        if($roadtaxs){
           foreach($roadtaxs as $data){
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
                    $roadtax_paystatus[$expiry_id]="Paid";
                }elseif($date1>=$date2  || $rest>$expiry_todate){
                    $roadtax_paystatus[$expiry_id]="unPaid";
                }else {
                    $roadtax_paystatus[$expiry_id]="Due";
                };
                if($data['expired']==1){
                    $roadtax_paystatus[$expiry_id]="Expired";
                }

                // unpaid amount
                if( $roadtax_paystatus[$expiry_id] == "unPaid" ||  $roadtax_paystatus[$expiry_id] == "Due"){
                    $roadtax_unpaid_amount += $data['roadtax_total'];
                  
                }
            }
        }
        

        $ui->assign('roadtaxs', $roadtaxs);
        $ui->assign('roadtax_count', $roadtax_count);
        $ui->assign('roadtax_paystatus',$roadtax_paystatus);
        $ui->assign('roadtax_unpaid_amount',$roadtax_unpaid_amount);


        // Loan

        $loan=ORM::for_table('sys_vehicle_loan')->where('vehicle_num', $vehicle_num)->order_by_desc('id')->find_one();
        
        if($loan){
            
            $duration_count=0;      

            $loan_val=array();
            $loan_val['id']=$loan['id'];
            $loan_val['vehicle_num']=$loan['vehicle_num'];
            $loan_val['date']=$loan['loan_date'];
            $loan_val['loan_type']=$loan['loan_type'];
            $loan_val['duration']=$loan['loan_duration'];
            $loan_val['expire_date']=$loan['expire_date'];              
            $loan_val['repayment']=$loan['repay_cycle_type'];
            $loan_val['amount']=$loan['principal_amount'];
            $loan_val['rate']=$loan['interest_rate'];
        

            $loan_date=$loan['loan_date'];
            $expire_date=$loan['expire_date'];
            $total_days=$loan['total_days'];
            
            $months=0;  // for calculate interest
            $duration_int = 0;

            // real duration calculate
            $repay_cycle_type=$loan['repay_cycle_type'];
            
            switch ($repay_cycle_type) {
                case 'weekly':
                    if($loan_val['loan_type'] == 'HP'){
                        $duration=$total_days/7;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int*7).'D');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));

                        $duration=$duration_int+1+$rest/7;
                    } else {
                        
                        $duration=$total_days/7;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int*7).'D');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        
                        $duration=$duration_int+1+$rest/7;
                    }
                    
                    break;

                case 'monthly':
                    if($loan_val['loan_type'] == 'HP'){
                        $d1 = new DateTime($loan_date);
                        $d2 = new DateTime($expire_date);
                        $d1->add(new \DateInterval('P1M'));
                        while ($d1 <= $d2){
                            $duration_int++;
                            $d1->add(new \DateInterval('P1M'));
                        }

                        $interval = new DateInterval('P'.($duration_int).'M');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        if($rest==31){
                            $rest=30;
                        }
                        $duration=$duration_int+1+$rest/30;
                        $months=$duration;
                    }else {
                        $duration=$total_days/30;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int*30).'D');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        
                        $duration=$duration_int+1+$rest/30;
                        $months=$duration;
                    }
                    
                    break;

                case 'yearly':
                    if($loan_val['loan_type'] == 'HP'){
                        $duration=$total_days/365;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int).'Y');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        
                        $duration=$duration_int+1+$rest/365;
                        $months=$duration*365/30;
                    }else {
                        $duration=$total_days/365;
                        $duration_int=floor($duration);
                        $interval = new DateInterval('P'.($duration_int*365).'D');
                        $duration_int_date=date_create($loan_date)->add($interval);
                        $duration_int_date=$duration_int_date->format('Y-m-d');
                        $date1 = date_create($duration_int_date);
                        $date2 = date_create($expire_date);
                        $rest= date_diff($date1,$date2);
                        $rest= intval($rest->format("%a"));
                        
                        $duration=$duration_int+1+$rest/365;
                        $months=$duration*365/30;
                    }

                    break;
                default:
                    break;
            }
                

            $duration_count=ceil($duration-1);
        
            // Calculate interest

            $loan_val['interest'] = ($loan_val['amount']*$loan_val['rate']*$months)/100;
            
            if($loan_val['loan_type'] == "HP"){
                $loan_val['interest'] = $loan_val['interest']/12;
            }
            
            
            
            $loan_val['total_due']=$loan_val['amount']+$loan_val['interest'];
            $next_duedate=array();
            
            for($i=0;$i<=$duration_count-1;$i++){
                switch ($repay_cycle_type) {
                    case 'weekly':
                        if($loan_val['loan_type'] == 'HP'){
                            $interval = new DateInterval('P'.($i*7).'D');
                        }else {
                            $interval = new DateInterval('P'.($i*7).'D');
                        }
                        break;
                    case 'monthly':
                        if($loan_val['loan_type'] == 'HP'){
                            $interval = new DateInterval('P'.($i).'M');
                        }else {
                            $interval = new DateInterval('P'.($i*30).'D');
                        }
                        break;
                    case 'yearly':
                        if($loan_val['loan_type'] == 'HP'){
                            $interval = new DateInterval('P'.($i).'Y');
                        }else {
                            $interval = new DateInterval('P'.($i*365).'D');
                        }
                        break;
                    default:
                        break;
                }
                
                $next_duedate[$i] = date_create($loan['loan_date'])->add($interval);
                $next_duedate[$i] = $next_duedate[$i]->format('Y-m-d');
            }
            $next_duedate[$duration_count] = $loan_val['expire_date'];
            
            $loan_val['loan_amount'] = ceil($loan_val['amount']/$duration);
            $loan_val['interest_amount'] = ceil($loan_val['interest']/$duration);
            $loan_val['due_amount'] = $loan_val['loan_amount']+$loan_val['interest_amount'];
            
            
            // display format 
            $loan_val['interest_txt'] = $config['currency_code'].' '.number_format(round($loan_val['interest_amount'],2), 2);
            $loan_val['due_amount_txt'] = $config['currency_code'].' '.number_format(round($loan_val['due_amount'],2), 2);
            $last_due = $loan_val['total_due']-$loan_val['due_amount']*($duration_count);
            $last_interest = $loan_val['interest']-$loan_val['interest_amount']*$duration_count;
            $loan_val['last_due_txt'] = $config['currency_code'].' '.number_format(round($last_due,2), 2);
            $loan_val['last_interest_txt'] = $config['currency_code'].' '.number_format(round($last_interest,2), 2);
            
            
            
            // balance
            $loan_balance = array();
            $loan_balance[0] = $loan_val['total_due']-$loan_val['due_amount'];
            
            for($i=1;$i<=$duration_count-1;$i++){
                $loan_balance[$i]=$loan_balance[$i-1]-$loan_val['due_amount'];
            }
            
            $loan_log=ORM::for_table('sys_vehicle_loanlog')->where('loan_id',$loan_val['id'])->where_not_equal('principal_pay','1')->find_array();
            if($loan_log){
                $loan_log_count=count($loan_log);
            }else{
                $loan_log_count=0;
            }
            

            $loan_val['expiry_todate']=$loan['expiry_todate'];
            $pay_status_string=array();   
            
            // Expiry Status

            for($i=0;$i<=$duration_count;$i++){

                if($loan_log_count != 0){
                    
                    $pay_status_string[$i]="Paid";
                    $loan_log_count--;    

                }else{

                    $today = date("Y-m-d");
                    $date1 = date_create($today);
                    $date2 = date_create($next_duedate[$i]);
                    $rest= date_diff($date1,$date2);
                    $rest= intval($rest->format("%a"));

                    if($date1>=$date2 || $rest>$loan_val['expiry_todate']){
                    
                        $pay_status_string[$i]="unPaid";
                    
                    }else{
                        
                        $pay_status_string[$i]="Due";

                    }

                }

            }


            // Flooring Loan calculate
            $principal_paid_amount=ORM::for_table('sys_transactions')->select('sys_transactions.*')
            ->inner_join('sys_vehicle_loanlog',array('sys_vehicle_loanlog.transaction_id','=','sys_transactions.id'))
            ->where('sys_vehicle_loanlog.loan_id',$loan_val['id'])->where('sys_vehicle_loanlog.principal_pay','1')->sum('sys_transactions.amount');
            $principal_paid_amount=$principal_paid_amount?$principal_paid_amount:0;
            $flooring_paid_balance=$loan_val['amount']-$principal_paid_amount;
            if($flooring_paid_balance == 0){
                $flooring_paystatus="Paid";
            } elseif($principal_paid_amount == 0){
                $flooring_paystatus="unPaid";
            } else {
                $flooring_paystatus="Parcial";
            }

            $expense_loan=ORM::for_table('sys_vehicle_loanlog')->where('loan_id', $loan_val['id'])->sum('transaction_amount');
            
        } else{
            $principal_paid_amount="";
            $flooring_paid_balance="";
            $flooring_paystatus="";
            $loan_val="";
            $next_duedate="";
            $loan_balance="";
            $duration="";
            $duration_count="";
            $pay_status_string="";
            $expense_loan=0;
        }


        $ui->assign('principal_paid_amount', $principal_paid_amount);
        $ui->assign('flooring_paid_balance', $flooring_paid_balance);
        $ui->assign('flooring_paystatus', $flooring_paystatus);
        
        // $ui->assign('transactions',$transactions);
        // $ui->assign('transactions_total', $transaction_total);
        
        $paginator['contents'] = '';

        $ui->assign('loan_val', $loan_val);
        $ui->assign('next_duedate',$next_duedate);
        $ui->assign('loan_balance',$loan_balance);
        $ui->assign('duration', $duration);
        $ui->assign('duration_count', $duration_count);
        $ui->assign('pay_status_string',$pay_status_string);
        $ui->assign('paginator', $paginator);


        $vehicle_total_expense=$expense_vehicle+$expense_roadtax+$expense_insurance+$expense_loan;

        $ui->assign('expense_vehicle', $expense_vehicle);
        $ui->assign('expense_roadtax',$expense_roadtax);
        $ui->assign('expense_insurance',$expense_insurance);
        $ui->assign('expense_loan', $expense_loan);
        $ui->assign('expense_others', $expense_others);
        $ui->assign('vehicle_total_expense', $vehicle_total_expense);


        // Total expense 

        $recent_expenses=ORM::for_table('sys_transactions')
            ->where('type','Expense')
            ->where('vehicle_num',$vehicle_num)
            ->order_by_desc('id')->find_many();
        
        $total_expense_amount=ORM::for_table('sys_transactions')
            ->where('type','Expense')
            ->where('vehicle_num',$vehicle_num) 
            ->sum('amount');

        $recent_expenses=$recent_expenses?$recent_expenses:"";
        $total_expense_amount=$total_expense_amount?$total_expense_amount:0;
        
        $ui->assign('recent_expenses',$recent_expenses);
        $ui->assign('total_expense_amount',$total_expense_amount);
        


        $ui->assign('baseUrl',$baseUrl);
        $ui->assign('vehicle',$vehicle_info);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
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

        view('vehicle_summary');


        break;


    case 'modal_add_roadtax':
        
        $id=$routes['2'];
        @$clone=$routes['3'];

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
            if($clone != ''){
                $interval = new DateInterval('P1D');
                $val['roadtax_date']=$roadtax->due_date;
                $val['roadtax_date']=date_create($val['roadtax_date'])->add($interval);
                $val['roadtax_date']=$val['roadtax_date']->format('Y-m-d');

            }

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
        $ui->assign('clone',$clone);
        $ui->assign('vehicles',$vehicles);
        $ui->assign('baseUrl',$baseUrl);

        view('modal_add_roadtax');

        break;

   

    case 'modal_add_insurance':
        
        $id=$routes['2'];
        @$clone=$routes['3'];
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
            $val['policy_num']=$insurance->policy_num;
            $val['description']=$insurance->description;
            $val['ref_img']=$insurance->ref_img;
            if($clone != ''){
                $interval = new DateInterval('P1D');
                $val['insurance_date']=$insurance->due_date;
                $val['insurance_date']=date_create($val['insurance_date'])->add($interval);
                $val['insurance_date']=$val['insurance_date']->format('Y-m-d');

            }

        }else{
            $val['id']=" ";
            $val['vehicle_num']=" ";
            $val['insurance_amount']=" ";
            $val['rebate_amount']=" ";
            $val['insurance_total']=" ";
            $val['insurance_date']="  ";
            $val['due_date']=" ";
            $val['expiry_todate']=" ";
            $val['policy_num']=" ";
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
        $ui->assign('clone',$clone);
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
            $val['loan_type']=$loan->loan_type;
            $val['total_days']=$loan->total_days;
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
            $val['loan_type']=" ";
            $val['total_days']=" ";
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
    

    case 'modal_vehicle_expense':
        
        $vehicle_num=$routes['2'];
        $amount=$routes['3'];

        $baseUrl=APP_URL;
        $val=array();
        if($vehicle_num){
            $val['id']="";
            $val['vehicle_num']=$vehicle_num;
            $val['amount']=$amount;
            $val['category']="Depreciation";
        }else{
            $val['id']="";
            $val['vehicle_num']="";
            $val['amount']="";
            $val['category']="";
        }
        $ui->assign('val',$val);
        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();
        $ui->assign('vehicles',$vehicles);  
        $ui->assign('baseUrl',$baseUrl);
        //Transactions Controller
        
        $currencies = Currency::all();
        $ui->assign('currencies', $currencies);
        $d = ORM::for_table('sys_accounts')->find_many();
        $p = ORM::for_table('crm_accounts')->find_many();
        $ui->assign('p', $p);
        $ui->assign('d', $d);
        $tags = Tags::get_all('Expense');
        $ui->assign('tags', $tags);
        $cats = ORM::for_table('sys_cats')->where('type', 'Expense')->order_by_asc('sorder')->find_many();
        $ui->assign('cats', $cats);
        $pms = ORM::for_table('sys_pmethods')->find_many();
        $ui->assign('pms', $pms);
        $mdate = date('Y-m-d');
        $ui->assign('mdate', $mdate);
       
        $x = ORM::for_table('sys_transactions')->where('type', 'Expense');
        if (!has_access($user->roleid, 'transactions', 'all_data')) {
            $x->where('aid', $user->id);
        }

        $x->order_by_desc('id')->limit(20);
        $tr = $x->find_array();
        $ui->assign('tr', $tr);
       
        $currency_rate = 1;
        if ($config['edition'] == 'iqm') {
            $c_find = Currency::where('iso_code', 'IQD')->first();
            $currency_rate = $c_find->rate;
        }

       
        view('modal_vehicle_expense', [
            'currency_rate' => $currency_rate,
            'expense_types' => ExpenseType::orderBy('sorder')->get()
        ]);


        break;
   
    case 'modal_roadtax_expense':
        
        $id=$routes['2'];
        $roadtax=false;
        if($id != ''){
            $roadtax=ORM::for_table('sys_vehicle_roadtax')->find_one($id);
        }


        $baseUrl=APP_URL;
        $val=array();
        if($roadtax){
            $val['id']=$id;
            $val['vehicle_num']=$roadtax->vehicle_num;
            $val['amount']=$roadtax->roadtax_total;
            $val['category']="Road Tax";
        }else{
            $val['id']="";
            $val['vehicle_num']="";
            $val['amount']="";
            $val['category']="";
        }
        $ui->assign('val',$val);
        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();
        $ui->assign('vehicles',$vehicles);  
        $ui->assign('baseUrl',$baseUrl);
        //Transactions Controller
        
        $currencies = Currency::all();
        $ui->assign('currencies', $currencies);
        $d = ORM::for_table('sys_accounts')->find_many();
        $p = ORM::for_table('crm_accounts')->find_many();
        $ui->assign('p', $p);
        $ui->assign('d', $d);
        $tags = Tags::get_all('Expense');
        $ui->assign('tags', $tags);
        $cats = ORM::for_table('sys_cats')->where('type', 'Expense')->order_by_asc('sorder')->find_many();
        $ui->assign('cats', $cats);
        $pms = ORM::for_table('sys_pmethods')->find_many();
        $ui->assign('pms', $pms);
        $mdate = date('Y-m-d');
        $ui->assign('mdate', $mdate);
       
        // $ui->assign('xheader', Asset::css(array(
        //     'dropzone/dropzone',
        //     'modal',
        //     's2/css/select2.min',
        //     'dp/dist/datepicker.min'
        // )));
        // $ui->assign('xfooter', Asset::js(array(
        //     'modal',
        //     'dropzone/dropzone',
        //     's2/js/select2.min',
        //     's2/js/i18n/' . lan() ,
        //     'dp/dist/datepicker.min',
        //     'dp/i18n/' . $config['language'],
        //     'numeric',
        //     'expense'
        // )));
       
        $x = ORM::for_table('sys_transactions')->where('type', 'Expense');
        if (!has_access($user->roleid, 'transactions', 'all_data')) {
            $x->where('aid', $user->id);
        }

        $x->order_by_desc('id')->limit(20);
        $tr = $x->find_array();
        $ui->assign('tr', $tr);

        //

        $currency_rate = 1;
        if ($config['edition'] == 'iqm') {
            $c_find = Currency::where('iso_code', 'IQD')->first();
            $currency_rate = $c_find->rate;
        }

        // view('transactions_expense', [
        //     'currency_rate' => $currency_rate,
        //     'expense_types' => ExpenseType::orderBy('sorder')->get()
        // ]);
       
        view('modal_vehicle_expense', [
            'currency_rate' => $currency_rate,
            'expense_types' => ExpenseType::orderBy('sorder')->get()
        ]);


        break;
    
    
    case 'modal_insurance_expense':
        
        $id=$routes['2'];
        $insurance=false;
        if($id != ''){
            $insurance=ORM::for_table('sys_vehicle_insurance')->find_one($id);
        }


        $baseUrl=APP_URL;
        $val=array();
        if($insurance){
            $val['id']=$id;
            $val['vehicle_num']=$insurance->vehicle_num;
            $val['amount']=$insurance->insurance_total;
            $val['category']="Insurance";
        }else{
            $val['id']="";
            $val['vehicle_num']="";
            $val['amount']="";
            $val['category']="";
        }
        $ui->assign('val',$val);
        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();
        $ui->assign('vehicles',$vehicles);  
        $ui->assign('baseUrl',$baseUrl);
        //Transactions Controller
        
        $currencies = Currency::all();
        $ui->assign('currencies', $currencies);
        $d = ORM::for_table('sys_accounts')->find_many();
        $p = ORM::for_table('crm_accounts')->find_many();
        $ui->assign('p', $p);
        $ui->assign('d', $d);
        $tags = Tags::get_all('Expense');
        $ui->assign('tags', $tags);
        $cats = ORM::for_table('sys_cats')->where('type', 'Expense')->order_by_asc('sorder')->find_many();
        $ui->assign('cats', $cats);
        $pms = ORM::for_table('sys_pmethods')->find_many();
        $ui->assign('pms', $pms);
        $mdate = date('Y-m-d');
        $ui->assign('mdate', $mdate);
       
        // $ui->assign('xheader', Asset::css(array(
        //     'dropzone/dropzone',
        //     'modal',
        //     's2/css/select2.min',
        //     'dp/dist/datepicker.min'
        // )));
        // $ui->assign('xfooter', Asset::js(array(
        //     'modal',
        //     'dropzone/dropzone',
        //     's2/js/select2.min',
        //     's2/js/i18n/' . lan() ,
        //     'dp/dist/datepicker.min',
        //     'dp/i18n/' . $config['language'],
        //     'numeric',
        //     'expense'
        // )));
       
        $x = ORM::for_table('sys_transactions')->where('type', 'Expense');
        if (!has_access($user->roleid, 'transactions', 'all_data')) {
            $x->where('aid', $user->id);
        }

        $x->order_by_desc('id')->limit(20);
        $tr = $x->find_array();
        $ui->assign('tr', $tr);

        //

        $currency_rate = 1;
        if ($config['edition'] == 'iqm') {
            $c_find = Currency::where('iso_code', 'IQD')->first();
            $currency_rate = $c_find->rate;
        }

        // view('transactions_expense', [
        //     'currency_rate' => $currency_rate,
        //     'expense_types' => ExpenseType::orderBy('sorder')->get()
        // ]);
       
        view('modal_vehicle_expense', [
            'currency_rate' => $currency_rate,
            'expense_types' => ExpenseType::orderBy('sorder')->get()
        ]);


        break;

    case 'modal_loan_expense':  
        
        $id=$routes['2'];
        $amount=@$routes['3'];
        $principal_pay=@$routes['4'];

        $loan=false;
        if($id != ''){
            $loan=ORM::for_table('sys_vehicle_loan')->find_one($id);
        }


        $baseUrl=APP_URL;
        $val=array();
        if($loan){
            $val['id']=$id;
            $val['vehicle_num']=$loan->vehicle_num;
            $val['amount']=$amount;

            $principal_amount=$loan->principal_amount;
            $interest_rate=$loan->interest_rate;
            $loan_duration=$loan->loan_duration;
            $total_days=$loan->total_days;
            $loan_type=$loan->loan_type;
            
            if($loan_type=="HP"){
                $val['category']="Vehicle HP Loan";
            }else{
                if($principal_pay){
                    $val['category']="Vehicle Flooring Loan";
                }else{
                    $val['category']="Vehicle Flooring Interest";
                }
            }
            
            
        }else{
            $val['id']="";
            $val['vehicle_num']="";
            $val['amount']="";
            $val['category']="";
        }

        $principal_pay=$principal_pay?$principal_pay:0;
        $ui->assign('val',$val);
        $ui->assign('principal_pay', $principal_pay);
        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();
        $ui->assign('vehicles',$vehicles);  
        $ui->assign('baseUrl',$baseUrl);
        //Transactions Controller
        
        $currencies = Currency::all();
        $ui->assign('currencies', $currencies);
        $d = ORM::for_table('sys_accounts')->find_many();
        $p = ORM::for_table('crm_accounts')->find_many();
        $ui->assign('p', $p);
        $ui->assign('d', $d);
        $tags = Tags::get_all('Expense');
        $ui->assign('tags', $tags);
        $cats = ORM::for_table('sys_cats')->where('type', 'Expense')->order_by_asc('sorder')->find_many();
        $ui->assign('cats', $cats);
        $pms = ORM::for_table('sys_pmethods')->find_many();
        $ui->assign('pms', $pms);
        $mdate = date('Y-m-d');
        $ui->assign('mdate', $mdate);
       
        // $ui->assign('xheader', Asset::css(array(
        //     'dropzone/dropzone',
        //     'modal',
        //     's2/css/select2.min',
        //     'dp/dist/datepicker.min'
        // )));
        // $ui->assign('xfooter', Asset::js(array(
        //     'modal',
        //     'dropzone/dropzone',
        //     's2/js/select2.min',
        //     's2/js/i18n/' . lan() ,
        //     'dp/dist/datepicker.min',
        //     'dp/i18n/' . $config['language'],
        //     'numeric',
        //     'expense'
        // )));
       
        $x = ORM::for_table('sys_transactions')->where('type', 'Expense');
        if (!has_access($user->roleid, 'transactions', 'all_data')) {
            $x->where('aid', $user->id);
        }

        $x->order_by_desc('id')->limit(20);
        $tr = $x->find_array();
        $ui->assign('tr', $tr);

        //

        $currency_rate = 1;
        if ($config['edition'] == 'iqm') {
            $c_find = Currency::where('iso_code', 'IQD')->first();
            $currency_rate = $c_find->rate;
        }

        // view('transactions_expense', [
        //     'currency_rate' => $currency_rate,
        //     'expense_types' => ExpenseType::orderBy('sorder')->get()
        // ]);
       
        view('modal_vehicle_expense', [
            'currency_rate' => $currency_rate,
            'expense_types' => ExpenseType::orderBy('sorder')->get()
        ]);


        break;



    case 'post_roadtax':
      
        $id=_post('rid');
        $clone=_post('clone');
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

        if($vehicle_num == ''){
           $msg .= 'Vehicle Numver is required <br>';
        }
        if($roadtax_amount == ''){
           $msg .= 'Road Tax Amount is requried <br>';
        }
        if($roadtax_date == ''){
           $msg .= 'Road Tax Date is required <br>';
        }
        if($due_date == ''){
           $msg .= 'Due Date is requried <br>';
        }
        if($expiry_todate == ''){
           $msg .= 'Expiry To Date is requried <br>';
        }
        
        if($msg == ''){

            if($id == ''){
                _msglog('s',$_L['Item Added Successfully']);
                $d = ORM::for_table('sys_vehicle_roadtax')->create();
            }elseif($clone !=''){
                _msglog('s',$_L['Item Updated Successfully']);
                $old_d=ORM::for_table('sys_vehicle_roadtax')->find_one($id);
                $old_d->expired=1;
                $old_d->save();
                $d = ORM::for_table('sys_vehicle_roadtax')->create();
            }else{
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
        $clone=_post('clone');
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
        $policy_num=_post('policy_num');
        $description=_post('description');
        $ref_img=_post('ref_img');
        

        // Check validate post data

        $msg='';

        if($vehicle_num == ''){
           $msg .= 'Vehicle Number is required <br>';
        }
        if($insurance_amount == ''){
           $msg .= 'Insurance Amount is required <br>';
        }
        if($insurance_date == ''){
           $msg .= 'Insurance Date is required <br>';
        }
        if($due_date == ''){
           $msg .= 'Due Date is required <br>';
        }
        if($expiry_todate == ''){
           $msg .= 'Expiry To Date is required <br>';
        }
        


        if($msg == ''){

            if($id == ''){
                _msglog('s',$_L['Item Added Successfully']);
                $d = ORM::for_table('sys_vehicle_insurance')->create();
            }elseif($clone !=''){
                _msglog('s',$_L['Item Updated Successfully']);
                $old_d=ORM::for_table('sys_vehicle_insurance')->find_one($id);
                $old_d->expired=1;
                $old_d->save();
                $d = ORM::for_table('sys_vehicle_insurance')->create();
            }else{
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
            $d->policy_num=$policy_num;
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
        $loan_type=_post('loan_type');
        $interest_rate=_post('interest_rate');
        $loan_date=_post('loan_date');
        $expire_date=_post('expire_date');
        $total_days=_post('total_days');
        $repay_cycle_type=_post('repay_cycle_type');
        $expiry_todate=_post('expiry_todate');
        $description=_post('description');
        $ref_img=_post('ref_img');
        
        // Check validate post data

        $msg='';
        // $check= ORM::for_table('sys_vehicle_loan')->where('vehicle_num',$vehicle_num)->find_one();;
        // if($check){
        //     $msg .= 'Vehicle Number duplicated <br>';
        // }

        if($id){
            $check1=ORM::for_table('sys_vehicle_loan')->find_one($id);
            if($vehicle_num != $check1['vehicle_num']){
                 $check= ORM::for_table('sys_vehicle_loan')->where('vehicle_num',$vehicle_num)->find_one();
            }
            if($check){
                $msg .= 'Vehicle Number duplicated <br>';
            }
        } else {
            $check= ORM::for_table('sys_vehicle_loan')->where('vehicle_num',$vehicle_num)->find_one();
            if($check){
                $msg .= 'Vehicle Number duplicated <br>';
            }
        } 


        if($vehicle_num == ''){
           $msg .= 'Vehicle Number is required <br>';
        }
        if($principal_amount == ''){
           $msg .= 'Principal Amount is required <br>';
        }
        if($loan_type == ''){
            $msg.= 'Loan Type is required <br>';
        }
        if($interest_rate == ''){
           $msg .= 'Interest Rate is required <br>';
        }
        if($repay_cycle_type == ''){
           $msg .= 'Repayment Cycle is required <br>';
        }
        if($loan_date == ''){
           $msg .= 'Start Date is required <br>';
        }
        if($expire_date == ''){
           $msg .= 'End Date is required <br>';
        }
        if($expiry_todate == ''){
           $msg .= 'Expiry To Date is required <br>';
        }

        $date1 = date_create($loan_date);
        $date2 = date_create($expire_date);
        $rest= date_diff($date1,$date2);
        $total_days= intval($rest->format("%a"));


        if($msg == ''){
            
            // $interval = new DateInterval('P'.$loan_duration.'M');
            // $expire_date=date_create($loan_date)->add($interval);
            // $expire_date=$expire_date->format('Y-m-d');

            if($id == ''){
                _msglog('s',$_L['Item Added Successfully']);
                $d = ORM::for_table('sys_vehicle_loan')->create();
            } else{
                _msglog('s',$_L['Item Updated Successfully']);
                $d = ORM::for_table('sys_vehicle_loan')->find_one($id);
            }

            switch ($repay_cycle_type) {
                case 'weekly':
                    $loan_duration=$total_days/7;  
                    // $duration_int=floor($duration);

                    // $interval = new DateInterval('P'.($duration_int*7).'D');
                    // $duration_int_date=date_create($loan_date)->add($interval);
                    // $duration_int_date=$duration_int_date->format('Y-m-d');

                    // $date1 = date_create($duration_int_date);
                    // $date2 = date_create($expire_date);
                    // $rest= date_diff($date1,$date2);
                    // $rest= intval($rest->format("%a"));
                    
                    // $loan_duration=$duration_int+$rest/7;
                    break;
                case 'monthly':
                    $loan_duration=$total_days/30;  
                    break;
                case 'yearly':
                    $loan_duration=$total_days/365;  
                    break;
                default:
                    $loan_duration=0;
                    break;
               
            }

            $d->vehicle_num = $vehicle_num;
            $d->principal_amount = $principal_amount;
            $d->loan_type=$loan_type;
            $d->interest_rate = $interest_rate;
            $d->loan_duration = $loan_duration;
            $d->repay_cycle_type=$repay_cycle_type;
            $d->loan_date=$loan_date;
            $d->expire_date=$expire_date;
            $d->total_days=$total_days;
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
        $vehicle_type_id = _post('vehicle_type_id');
        if($vehicle_type_id){
            $v=ORM::for_table('sys_vehicle_type')->find_one($vehicle_type_id);
            $vehicle_type=$v['make']." ".$v['model']." ".$v['engine_capacity']." (".$v['transmission'].")";
        } else {
            $vehicle_type="";
        }

        $engine_num = _post('engine_num');
        $chassis_num = _post('chassis_num');
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

        if($id){
            $check1=ORM::for_table('sys_vehicles')->find_one($id);
            if($vehicle_num != $check1['vehicle_num']){
                 $check= ORM::for_table('sys_vehicles')->where('vehicle_num',$vehicle_num)->find_one();
            }
            if($check){
                $msg .= 'Vehicle Number duplicated <br>';
            }
        } else {
            $check= ORM::for_table('sys_vehicles')->where('vehicle_num',$vehicle_num)->find_one();
            if($check){
                $msg .= 'Vehicle Number duplicated <br>';
            }
        } 


        if($vehicle_num == ''){
           $msg .= 'Vehicle Number is required <br>';
        }
        if($engine_num ==''){
            $msg.= 'Engine Number is requried <br>';
        }
        if($chassis_num == ''){
            $msg.= 'Chassis Number is required <br>';
        }
        if($vehicle_type_id == ''){
           $msg .= 'Vehicle Type is required <br>';
        }
        if($purchase_price == ''){
           $msg .= 'Purchase Price is required <br>';
        }
        if($parf_cost == ''){
           $msg .= 'Parf Cost is required <br>';
        }
        if($expiry_date == ''){
           $msg .= 'Expiry Date is required <br>';
        }
        if($expiry_status == ''){
           $msg .= 'Expiry status is requried <br>';
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
            $d->type_id = $vehicle_type_id;
            $d->vehicle_type = $vehicle_type;
            $d->engine_num = $engine_num;
            $d->chassis_num = $chassis_num;
            $d->purchase_price = $purchase_price;
            $d->parf_cost= $parf_cost;
            $d->purchase_date = $purchase_date;

            $d->expiry_date = $expiry_date;
            $d->expiry_status = $expiry_status;
            $d->description = $description;

            $d->v_i =$vehicle_file;
            $d->v_o_c = $cert_file;


            $d->save();
            $cid = $d->id();

            //now add custom fields values
            $fs = ORM::for_table('sys_vehicle_customfields')->order_by_asc('id')->find_many();

            foreach($fs as $f){
                $fvalue = _post('cf'.$f['id']);
                if($id){
                    $fc=ORM::for_table('sys_vehicle_customfieldsvalues')->where('relid',$id)->where('fieldid',$f['id'])->find_one();
                    if($fc){
                        $fc->fvalue = $fvalue;
                        $fc->save();
                    }else{
                        $fc = ORM::for_table('sys_vehicle_customfieldsvalues')->create();
                        $fc->fieldid = $f['id'];
                        $fc->relid = $cid;
                        $fc->fvalue = $fvalue;
                        $fc->save();    
                    }
                    
                }else{
                    $fc = ORM::for_table('sys_vehicle_customfieldsvalues')->create();
                    $fc->fieldid = $f['id'];
                    $fc->relid = $cid;
                    $fc->fvalue = $fvalue;
                    $fc->save();
                }
               
            }

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

        $fs = ORM::for_table('sys_vehicle_customfields')->order_by_asc('id')->find_many();
        $ui->assign('fs',$fs);
        $cf_value=array();
        foreach ($fs as $f) {
            $cf=ORM::for_table('sys_vehicle_customfieldsvalues')->where('relid',$id)->where('fieldid',$f->id)->find_one();
            $cf_value[$f->id]='';
            if($cf){
                $cf_value[$f->id]=$cf->fvalue;
            }    
        }
        $ui->assign('cf_value',$cf_value);

        $val = array();

        if($vehicle){
            $val['id'] = $id;
            $val['vehicle_num'] = $vehicle->vehicle_num;
            $val['type_id'] = $vehicle->type_id;
            $val['vehicle_type'] = $vehicle->vehicle_type;
            $val['engine_num'] = $vehicle->engine_num;
            $val['chassis_num'] = $vehicle->chassis_num;
            $val['parf_cost'] = $vehicle->parf_cost;
            $val['purchase_price'] = $vehicle->purchase_price;
            $val['purchase_date'] = $vehicle->purchase_date;
            $val['expiry_date'] = $vehicle->expiry_date;
            $val['expiry_status'] = $vehicle->expiry_status;
            $val['v_i'] = $vehicle->v_i;
            $val['v_o_c'] = $vehicle->v_o_c;
            $val['description'] = $vehicle->description;

        }

        $vehicle_types=ORM::for_table('sys_vehicle_type')->order_by_asc('make')->find_array();

        $v_types=array();

        foreach ($vehicle_types as $v) {
            $v_types[$v['id']]=$v['make']." ".$v['model']." ".$v['engine_capacity']." (".$v['transmission'].")";
        }

        $baseUrl=APP_URL;
        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(),)));
        $ui->assign('val',$val);
        $ui->assign('vehicle_types', $vehicle_types);
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
            $val['color'] = $vehicle_type->color; 
            $val['v_t_id'] = $id;
        }
        else{
            $f_type = 'create';
            $val['make'] = '';
            $val['model'] = '';
            $val['engine_capacity'] = '';
            $val['transmission'] = '';
            $val['fuel_type'] = '';
            $val['color'] = '';
            $val['v_t_id']='';
        }

        $ui->assign('f_type',$f_type);
        $ui->assign('val',$val);


        view('modal_add_mk');

        break;



    case 'update_mk_post':

        // Ajax post datas
        $id = _post('v_t_id');
        $make = _post('make');
        $model = _post('model');
        $engine_capacity =_post('engine_capacity');
        $transmission =_post('transmission');
        $fuel_type =_post('fuel_type');
        $color = _post('color');

        // Check validate post datas

        $msg='';

        if($make == ''){
            $msg.='Make is required <br/>';
        }

        if($model == ''){
            $msg.='Model is required </br>';
        }

        if($engine_capacity == ''){
            $msg.='Engine Capacity is required </br>';
        }

        if($transmission == ''){
            $msg.='Transmission is required </br>';
        }

        if($color == ''){
            $msg.='Color is required <br>';
        }


        if($msg == ''){
            if($id){
                $d = ORM::for_table('sys_vehicle_type')->find_one($id);
                $vehicle_type = $make." ".$model." ".$engine_capacity." (".$transmission.")";
                $vehicles=ORM::for_table('sys_vehicles')->where('type_id', $id)->find_many();
                foreach($vehicles as $v){
                    $v->vehicle_type = $vehicle_type;
                    $v->save();
                }
                _msglog('s',$_L['Item Updated Successfully']);
            }else {
                $d = ORM::for_table('sys_vehicle_type')->create();
                _msglog('s',$_L['Item Added Successfully']);
            }


            $d->make = $make;
            $d->model = $model;
            $d->engine_capacity = $engine_capacity;
            $d->transmission = $transmission;
            $d->fuel_type = $fuel_type;
            $d->color = $color;

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

    case 'view_img':
      // Ajax post datas
        $id = $routes['2'];
        $tr_type = $routes['3'];
        $table_name = "";
        if($tr_type){
            switch ($tr_type) {
                case 'roadtax':
                    $table_name = 'sys_vehicle_roadtax';
                    break;
                case 'insurance':
                    $table_name = 'sys_vehicle_insurance';
                    break;
                case 'loan':
                    $table_name = 'sys_vehicle_loan';
                    break;
                default:
                    
                    break;
            }
        }
        if($id){
            $d=ORM::for_table($table_name)->find_one($id);
        }
        
        if($d){
            $img_path=APP_URL."/storage/items/".$d['ref_img'];
        }

        $ui->assign('img_path',$img_path);
        view('modal_img_view');

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
            if($d['pay_status']){
                $d_tran=ORM::for_table('sys_transactions')->find_one($d['pay_status']);
                if($d_tran){
                    $d_tran->delete();
                }
            }
            if($d['ref_img']){
                $ref_img_url="storage/items/".$d['ref_img'];
                $ref_thumbimg_url="storage/items/thumb".$d['ref_img'];
                unlink($ref_img_url);
                unlink($ref_thumbimg_url);            
            }
            $d->delete();
            r2(U . 'vehicle/road_tax', 's', $_L['Road Tax Transaction Delete Successful']);
        }
        break;


    case 'del_insurance':
        
        Event::trigger('vehicle/del_insurance/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicle_insurance')->find_one($id);

        if ($d) {
            if($d['pay_status']){
                $d_tran=ORM::for_table('sys_transactions')->find_one($d['pay_status']);
                if($d_tran){
                    $d_tran->delete();
                }
            }
            if($d['ref_img']){
                $ref_img_url="storage/items/".$d['ref_img'];
                $ref_thumbimg_url="storage/items/thumb".$d['ref_img'];
                unlink($ref_img_url);
                unlink($ref_thumbimg_url);            
            }
            $d->delete();
            r2(U . 'vehicle/insurance', 's', $_L['Insurance Transaction Delete Successful']);
        }

        break;
    
    case 'del_loan':
        
        Event::trigger('vehicle/del_loan/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicle_loan')->find_one($id);

        if ($d) {
            if($d['ref_img']){
                $ref_img_url="storage/items/".$d['ref_img'];
                $ref_thumbimg_url="storage/items/thumb".$d['ref_img'];
                unlink($ref_img_url);
                unlink($ref_thumbimg_url);            
            }
            $d->delete();

            $d1=ORM::for_table('sys_vehicle_loanlog')->where('loan_id', $id)->find_many();
            if($d1){
                foreach($d1 as $d_t){
                    $d_tran=ORM::for_table('sys_transactions')->find_one($d_t['transaction_id']);
                    if($d_tran){
                        $d_tran->delete();
                    }
                }
                $d1->delete();
            }

            r2(U . 'vehicle/loans', 's', $_L['Loan Transaction Delete Successful']);
        }


        break;

    case 'clone_roadtax':
        $id=$routes['2'];

        if($id){
            $d=ORM::for_table('sys_vehicle_roadtax')->find_one($id);
            $vehicle_num=$d->vehicle_num;
            $roadtax_amount=$d->roadtax_amount;
            $rebate_amount=$d->rebate_amount;
            $roadtax_total=$d->roadtax_total;
            $roadtax_date=$d->roadtax_date;
            $due_date=$d->due_date;
            $expiry_todate=$d->expiry_todate;
            // $pay_status=$d->pay_status;
            $description=$d->description;
            $ref_img=$d->ref_img;
            $d->expired=1;
            $d->save();
        }

        $renew=ORM::for_table('sys_vehicle_roadtax')->create();
        $renew->vehicle_num=$vehicle_num;
        $renew->roadtax_amount=$roadtax_amount;
        $renew->rebate_amount=$rebate_amount;
        $renew->roadtax_total=$roadtax_total;
        $renew->roadtax_date=$roadtax_date;
        $renew->due_date=$due_date;
        $renew->expiry_todate=$expiry_todate;
        // $renew->pay_status=$pay_status;
        $renew->description=$description;
        $renew->ref_img=$ref_img;
        $renew->save();
        
        r2(U . 'vehicle/road_tax', 's', $_L['Clone Roadtax Successful']);

        break;

    case 'clone_insurance':
        
        $id=$routes['2'];

        if($id){
            $d=ORM::for_table('sys_vehicle_insurance')->find_one($id);
            $vehicle_num=$d->vehicle_num;
            $insurance_amount=$d->insurance_amount;
            $rebate_amount=$d->rebate_amount;
            $insurance_total=$d->insurance_total;
            $insurance_date=$d->insurance_date;
            $due_date=$d->due_date;
            $expiry_todate=$d->expiry_todate;
            // $pay_status=$d->pay_status;
            $description=$d->description;
            $ref_img=$d->ref_img;
            $d->expired=1;
            $d->save();
        }

        $renew=ORM::for_table('sys_vehicle_insurance')->create();
        $renew->vehicle_num=$vehicle_num;
        $renew->insurance_amount=$insurance_amount;
        $renew->rebate_amount=$rebate_amount;
        $renew->insurance_total=$insurance_total;
        $renew->insurance_date=$insurance_date;
        $renew->due_date=$due_date;
        $renew->expiry_todate=$expiry_todate;
        // $renew->pay_status=$pay_status;
        $renew->description=$description;
        $renew->ref_img=$ref_img;
        $renew->save();

        r2(U . 'vehicle/insurance', 's', $_L['Clone Insurance Successful']);

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
