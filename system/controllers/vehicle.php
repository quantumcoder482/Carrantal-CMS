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


            }elseif($date1>=$date2 || $rest>$expiry_todate){

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


            }elseif($date1>=$date2  || $rest>$expiry_todate){

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
        $next_duedate=array();
        $expire_date=array();
        foreach($d as $data){

            // Expiry status calculation
            $expiry_id=$data['id'];
            $expiry_todate=$data['expiry_todate'];
            $pay_status=$data['pay_status'];
            $loan_duration=$data['loan_duration'];
            $repay_cycle_type=$data['repay_cycle_type'];

            switch ($repay_cycle_type) {
                case 'weekly':
                    $expire_date_interval=new DateInterval('P'.($loan_duration*7).'D');
                    $interval = new DateInterval('P'.(($pay_status+1)*7).'D');
                    break;
                case 'monthly':
                    $expire_date_interval=new DateInterval('P'.$loan_duration.'M');
                    $interval = new DateInterval('P'.($pay_status+1).'M');
                    break;
                case 'yearly':
                    $expire_date_interval=new DateInterval('P'.$loan_duration.'Y');
                    $interval = new DateInterval('P'.($pay_status+1).'Y');
                    break;
                default:
                    break;
            }

            $expire_date[$expiry_id]=date_create($data['loan_date'])->add($expire_date_interval);
            $expire_date[$expiry_id]=$expire_date[$expiry_id]->format('Y-m-d');
            $next_duedate[$expiry_id]=date_create($data['loan_date'])->add($interval);
            $next_duedate[$expiry_id]=$next_duedate[$expiry_id]->format('Y-m-d');
            
            $today = date("Y-m-d");
            $date1 = date_create($today);
            $date2 = date_create($next_duedate[$expiry_id]);
            $date3 = date_create($expire_date[$expiry_id]);
            $rest= date_diff($date1,$date3);
            $rest= intval($rest->format("%a"));

            if($pay_status && $date1<$date2 && $rest>$expiry_todate){

                $pay_status_string[$expiry_id]="Paid";

            }
            if(!$pay_status || $date1>$date2){

                $pay_status_string[$expiry_id]="unPaid";

            }
            if($rest<$expiry_todate && $loan_duration>$pay_status) {

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
        $ui->assign('next_duedate',$next_duedate);
        $ui->assign('expire_date',$expire_date);
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


        $loan = ORM::for_table('sys_vehicle_loan')->where('id',$id)->find_one();
        $val=array();
        $val['id']=$id;
        $val['vehicle_num']=$loan['vehicle_num'];
        $val['date']=$loan['loan_date'];
        $val['duration']=$loan['loan_duration'];
        $repay_cycle_type=$loan['repay_cycle_type'];
        
        // Expire Date
        switch ($repay_cycle_type) {
            case 'weekly':
                $expire_date_interval=new DateInterval('P'.($val['duration']*7).'D');
                break;
            case 'monthly':
                $expire_date_interval=new DateInterval('P'.$val['duration'].'M');
                break;
            case 'yearly':
                $expire_date_interval=new DateInterval('P'.$val['duration'].'Y');
                break;
            default:
                break;
        }

        $val['expire_date']=date_create($val['date'])->add($expire_date_interval);
        $val['expire_date']=$val['expire_date']->format('Y-m-d');
        
        $val['repayment']=$loan['repay_cycle_type'];
        $val['amount']=$loan['principal_amount'];
        $val['rate']=$loan['interest_rate'];
        $val['interest']=($val['amount']*$val['rate']*$val['duration'])/100;
        $val['total_due']=$val['amount']+$val['interest'];
        
        $next_duedate=array();

        for($i=1;$i<=$val['duration'];$i++){
            switch ($repay_cycle_type) {
                case 'weekly':
                    $interval = new DateInterval('P'.($i*7).'D');
                    break;
                case 'monthly':
                    $interval = new DateInterval('P'.$i.'M');
                    break;
                case 'yearly':
                    $interval = new DateInterval('P'.$i.'Y');
                    break;
                default:
                    break;
            }
            
            $next_duedate[$i]=date_create($loan['loan_date'])->add($interval);
            $next_duedate[$i]=$next_duedate[$i]->format('Y-m-d');
        }

        $val['loan_amount']=$val['amount']/$val['duration'];
        $val['interest_amount']=$val['interest']/$val['duration'];
        $val['due_amount']=$val['loan_amount']+$val['interest_amount'];

        $loan_balance=array();
        $loan_balance[0]=$val['amount'];

        for($i=1;$i<=$val['duration'];$i++){
            $loan_balance[$i]=$loan_balance[$i-1]-$val['loan_amount'];
        }

        $loan_log=ORM::for_table('sys_vehicle_loanlog')->where('loan_id',$val['id'])->find_array();
        if($loan_log){
            $loan_log_count=count($loan_log);
        }else{
            $loan_log_count=0;
        }


               
        $val['expiry_todate']=$loan['expiry_todate'];
        $pay_status_string=array();   
        
        // Expiry Status

        for($i=1;$i<=$val['duration'];$i++){

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

        $paginator['contents'] = '';

        // $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('val', $val);
        $ui->assign('view_type',$view_type);
        $ui->assign('next_duedate',$next_duedate);
        $ui->assign('loan_balance',$loan_balance);
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
        $mode_css = Asset::css(array('dashboard/dashboard','fc/fc','fc/fc_ibilling','footable/css/footable.core.min','redactor/redactor','s2/css/select2.min','vehicle/vehicle_summary'));
        $mode_js = Asset::js(array('dashboard/graph','waypoints/jquery.waypoints.min','waypoints/jquery.counterup.min','fc/fc','footable/js/footable.all.min','contacts/mode_search','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan()
        ));


        // $xheader .= Asset::css(array('dashboard/dashboard','fc/fc','fc/fc_ibilling','modal'));
        // $xfooter .= Asset::js(array('dashboard/graph','numeric','waypoints/jquery.waypoints.min','waypoints/jquery.counterup.min','fc/fc','modal'),$file_build).$xtra;

        $baseUrl=APP_URL;
        $total_expense=0;
        $total_sales=23233;
        $net_profits=123212;
        $expiry_days=120;   
        
        $pay_status_string['roadtax']="Paid";
        $pay_status_string['insurance']="unPaid";
        $pay_status_string['loan']="Due";
        
        
        
        $vehicle_info=ORM::for_table('sys_vehicles')->find_one($id);
        $vehicle_num=$vehicle_info->vehicle_num;
        
        $expense=ORM::for_table('sys_transactions')->where('type','Expense')->where('vehicle_num',$vehicle_num)->order_by_desc('date')->find_many();
        
        foreach($expense as $exp){
            $total_expense+=floatval($exp->amount);
        }
        
        
        $insurance=ORM::for_table('sys_vehicle_insurance')->where('vehicle_num',$vehicle_num)->find_many();
        $roadtax=ORM::for_table('sys_vehicle_roadtax')->where('vehicle_num', $vehicle_num)->find_many();
        
        


        $ui->assign('baseUrl',$baseUrl);
        $ui->assign('total_expense', $total_expense);
        $ui->assign('total_sales', $total_sales);
        $ui->assign('net_profits',$net_profits);
        $ui->assign('expiry_days',$expiry_days);
        $ui->assign('pay_status_string',$pay_status_string);
        $ui->assign('vehicle',$vehicle_info);
        $ui->assign('roadtax',$roadtax);
        $ui->assign('insurance',$insurance);
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
            $val['policy_num']=$insurance->policy_num;
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
        $loan=false;
        if($id != ''){
            $loan=ORM::for_table('sys_vehicle_loan')->find_one($id);
        }


        $baseUrl=APP_URL;
        $val=array();
        if($loan){
            $val['id']=$id;
            $val['vehicle_num']=$loan->vehicle_num;
            $principal_amount=$loan->principal_amount;
            $interest_rate=$loan->interest_rate;
            $loan_duration=$loan->loan_duration;

            $val['amount']=$principal_amount/$loan_duration+$principal_amount*$interest_rate/100;
            $val['category']="Vehicle Loan";

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
        $interest_rate=_post('interest_rate');
        $loan_duration=_post('loan_duration');
        $repay_cycle_type=_post('repay_cycle_type');
        $loan_date=_post('loan_date');
        $expiry_todate=_post('expiry_todate');
        $description=_post('description');
        $ref_img=_post('ref_img');
        
        // Check validate post data

        $msg='';

        if($vehicle_num == ''){
           $msg .= 'Vehicle Number is required <br>';
        }
        if($principal_amount == ''){
           $msg .= 'Principal Amount is required <br>';
        }
        if($interest_rate == ''){
           $msg .= 'Interest Rate is required <br>';
        }
        if($loan_duration == ''){
           $msg .= 'Loan Duration is required <br>';
        }
        if($repay_cycle_type == ''){
           $msg .= 'Repayment Cycle is required <br>';
        }
        if($loan_date == ''){
           $msg .= 'Loan Date is required <br>';
        }
        if($expiry_todate == ''){
           $msg .= 'Expiry To Date is required <br>';
        }


        if($msg == ''){
            
            $interval = new DateInterval('P'.$loan_duration.'M');
            $expire_date=date_create($loan_date)->add($interval);
            $expire_date=$expire_date->format('Y-m-d');

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
           $msg .= 'Vehicle Number is required <br>';
        }
        if($vehicle_type == ''){
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
            $msg.='Transmission is requried </br>';
        }




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
