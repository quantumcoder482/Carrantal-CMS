<?php
/*
|--------------------------------------------------------------------------
|   Vehicle Controller
|
|--------------------------------------------------------------------------
|
*/
_auth();
$ui->assign('_title', $_L['Contract n Deposit'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Contract n Deposit']);
$ui->assign('_application_menu', 'contract_deposit');
$ui->assign('content_inner', inner_contents($config['c_cache']));
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {

    case 'add_contract': 

        $id=$routes['2'];
        
        if($id){
            $d=ORM::for_table('sys_vehicle_contract')->where('id',$id)->find_one();
            $title=$d['title'];
            $content=$d['content'];
        }else{
            $title="";
            $content="";
        }
        
        $ui->assign('title',$title);
        $ui->assign('content', $content);
        $ui->assign('id', $id);
        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','s2/css/select2.min','cd/cd_contract_add')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'tinymce/tinymce.min','js/editor','cd/cd_contract_add')));
        $ui->assign('xjq', '$(\'.amount\').autoNumeric(\'init\');');

        view('cd_contract_add');

        break;


    case 'contract_list':


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
        $mode_css = Asset::css(array('modal','dropzone/dropzone','dp/dist/datepicker.min','footable/css/footable.core.min','s2/css/select2.min','cd/cd'));
        $mode_js = Asset::js(array('modal','dropzone/dropzone','dp/dist/datepicker.min','footable/js/footable.all.min','contacts/mode_search','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'cd/cd_contract_list'
        ));

        $baseUrl=APP_URL;

        $f = ORM::for_table('sys_vehicle_contract');
        $d = $f->order_by_desc('id')->find_many();
        $s_count=array();
        $g_count=array();
        foreach($d as $ds){
            $g_count[$ds['id']]=ORM::for_table('sys_vehicle_generatedcontract')->where('contract_id', $ds['id'])->count();
            $s_count[$ds['id']]=ORM::for_table('sys_vehicle_generatedcontract')->where('contract_id', $ds['id'])->where('status','1')->count();
        }

        $ui->assign('g_count', $g_count);
        $ui->assign('s_count', $s_count);

        $paginator['contents'] = '';

       
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
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


        view('cd_contract_list');

        break;


    case 'generate_contract':
        
        $contract_id=$routes['2'];
        @$customer_id=$routes['3']; //_post('customer_id')
        @$vehicle_id=$routes['4']; //_post('vehicle_id')

        
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
        $mode_css = Asset::css(array('modal','dropzone/dropzone','dp/dist/datepicker.min','footable/css/footable.core.min','s2/css/select2.min','cd/cd'));
        $mode_js = Asset::js(array('modal','dropzone/dropzone','dp/dist/datepicker.min','footable/js/footable.all.min','contacts/mode_search','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'cd/cd_generate_contract'
        ));

        $baseUrl=APP_URL;

        $contract=ORM::for_table('sys_vehicle_contract')->find_one($contract_id);

        $f = ORM::for_table('sys_vehicle_generatedcontract');
        $d = $f->where('contract_id',$contract_id)->order_by_desc('id')->find_many();
               
        $val=array();
        
        if($d){
            foreach($d as $ds){
                $c=ORM::for_table('crm_accounts')->find_one($ds['customer_id']);               
                $val[$ds['id']]['customer']=$c['account'];
                
                $v=ORM::for_table('sys_vehicles')->find_one($ds['vehicle_id']);
                $val[$ds['id']]['vehicle']=$v['vehicle_num'];

                $deposit=ORM::for_table('sys_vehicle_deposit')->find_one($ds['deposit_id']);
                $val[$ds['id']]['deposit_amount']=$deposit['deposit_amount'];
                $val[$ds['id']]['first_deposit']=$deposit['first_deposit'];

                $invoice=ORM::for_table('sys_invoices')->find_one($ds['invoice_id']);
                $val[$ds['id']]['invoicenum']=$invoice['invoicenum'];
                $val[$ds['id']]['invoice_cn']=$invoice['cn'];
            }
        }
        $ui->assign('val', $val);

        $customers=ORM::for_table('crm_accounts')->order_by_asc('id')->find_many();
        //$vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_many();
        $deposits=ORM::for_table('sys_vehicle_deposit');
        $invoices=ORM::for_table('sys_invoices');
        $transaction_deposits=ORM::for_table('sys_transactions');
       
        $selected_customer=null;
        $selected_vehicle=null;
        $vehicles=array();
        $v_i=array();

        if($customer_id){
            $selected_customer=ORM::for_table('crm_accounts')->find_one($customer_id);
            
            // $d1=ORM::for_table('sys_vehicle_deposit')->where('customerid', $customer_id)->select('vehicle_num')->find_array();
            $d1=ORM::for_table('sys_transactions')->where('payerid', $customer_id)->select('vehicle_num')->find_array();
            if($d1){
                foreach ($d1 as $ds) {
                    if($ds['vehicle_num'] != ''){ 
                        array_push($v_i, $ds['vehicle_num']); // $vehicles.push($ds['vehicle_num']);
                    }
                }
                $v_i=array_unique($v_i);
                foreach ($v_i as $value) {
                    $vehicle=ORM::for_table('sys_vehicles')->where('vehicle_num', $value)->find_one();
                    array_push($vehicles,$vehicle);
                }
            }
                       
            $deposits=$deposits->where('customerid', $customer_id);
            // $transaction_deposits=$transaction_deposits->where
            $invoices=$invoices->where('userid', $customer_id);
        }
        if($vehicle_id){
            $selected_vehicle=ORM::for_table('sys_vehicles')->where('id', $vehicle_id)->find_one();
            $deposits=$deposits->where('vehicle_num', $selected_vehicle['vehicle_num']);
        }
        $deposits=$deposits->order_by_asc('id')->find_many();
        $invoices=$invoices->order_by_asc('id')->find_many();
   


        $ui->assign('contract', $contract);
        $ui->assign('selected_customer', $selected_customer);
        $ui->assign('selected_vehicle', $selected_vehicle);
        $ui->assign('customers', $customers);
        $ui->assign('vehicles', $vehicles);
        $ui->assign('deposits', $deposits);
        $ui->assign('invoices', $invoices);


        $paginator['contents'] = '';

       
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
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


        view('cd_generate_contract');
        

        break;


    case 'getdata':
        $customer_id=_post('customer_id');
        $vehicle_id=_post('vehicle_id');


        break;

    case 'modal_edit_contract':

        $id=$routes['2'];

        $d=ORM::for_table('sys_vehicle_generatedcontract')->find_one($id);
        $contract_id=$d['contract_id'];
        $customer_id=$d['customer_id'];
        $vehicle_id=$d['vehicle_id'];
        $deposit_id=$d['deposit_id'];
        $invoice_id=$d['invoice_id'];
        $ui->assign('id', $id);
        $ui->assign('contract_id', $contract_id);
        $ui->assign('customer_id', $customer_id);
        $ui->assign('vehicle_id', $vehicle_id);
        $ui->assign('deposit_id', $deposit_id);
        $ui->assign('invoice_id', $invoice_id);


        $contracts=ORM::for_table('sys_vehicle_contract')->order_by_asc('id')->find_many();
        $customers=ORM::for_table('crm_accounts')->order_by_asc('id')->find_many();
        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_many();
        $deposits=ORM::for_table('sys_vehicle_deposit')->order_by_asc('id')->find_many();
        $invoices=ORM::for_table('sys_invoices')->order_by_asc('id')->find_many();

        $ui->assign('contracts', $contracts);
        $ui->assign('customers', $customers);
        $ui->assign('vehicles', $vehicles);
        $ui->assign('deposits', $deposits);
        $ui->assign('invoices', $invoices);
        
        view('modal_edit_contract');


        break;
    
    case 'post_contract':
    
        $id=_post('id');
        $title=_post('title');
        $content=_post('content');

        $msg='';

        if($title==''){
            $msg.="Title is required"."<br/>";
        }
        if($content==''){
            $msg.="Content is required"."<br/>";
        }


        if($msg==''){
            if($id){
                $contract=ORM::for_table('sys_vehicle_contract')->find_one($id);
                _msglog('s',$_L['Item Updated Successfully']);

                $today=date('Y-m-d');
                $contract->modified_date=$today;
            }else{
                $contract=ORM::for_table('sys_vehicle_contract')->create();
                _msglog('s',$_L['Item Added Successfully']);    
                
                $today=date('Y-m-d');
                $contract->create_date=$today;
            }

            $contract->title=$title;
            $contract->content=$content;
            $contract->save();

            echo $contract->id();
            

        }else{
            echo $msg;
        }



        break;        

    case 'post_generate_contract':
    
        $id=_post('id');

        $contract=_post('contract_id');
        $contact=_post('contact');
        $vehicle=_post('vehicle');
        $deposit=_post('deposit');
        $invoice=_post('invoice');
        

        $msg='';

        if($contact==''){
            $msg.="Contact is required"."<br/>";
        }
        if($vehicle==''){
            $msg.="Vehicle is required"."<br/>";
        }
        if($deposit==''){
            $msg.="Deposit is required"."<br/>";
        }
        if($invoice==''){
            $msg.="Invoice is required"."<br/>";
        }

        if($msg==''){
            if($id){
                $d=ORM::for_table('sys_vehicle_generatedcontract')->find_one($id);
                _msglog('s',$_L['Item Updated Successfully']);
            }else{
                $d=ORM::for_table('sys_vehicle_generatedcontract')->create();
                _msglog('s',$_L['Item Added Successfully']);
                $today=date('Y-m-d');
                $d->created_date=$today;
            }
            $d->contract_id=$contract;
            $d->customer_id=$contact;
            $d->deposit_id=$deposit;
            $d->vehicle_id=$vehicle;
            $d->invoice_id=$invoice;
            $d->save();

            echo $d->id();
            
            
        }else{
            echo $msg;
        }

        break;  

    case 'deposit_list':

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
            's2/js/i18n/'.lan(), 'cd/cd_deposit_list'
        ));

        $baseUrl=APP_URL;


        $total_items = ORM::for_table('sys_vehicle_deposit');

        $total_items = $total_items->count();

        $f = ORM::for_table('sys_vehicle_deposit');
        $d = $f->order_by_desc('id')->find_many();


        // Expiry Status

        
        $pay_status_string=array();
        $next_duedate=array();
        $expire_date=array();
        $customer=array();
        foreach($d as $data){

            // Expiry status calculation
            $expiry_id=$data['id'];
            $expiry_todate=$data['expiry_todate'];
            $pay_status=$data['pay_status'];
            $duration=$data['duration'];
            $first_paystatus=$data['first_paystatus'];
            $repay_cycle_type=$data['repay_cycle_type'];

            switch ($repay_cycle_type) {
                case 'weekly':
                    $expire_date_interval=new DateInterval('P'.($duration*7).'D');
                    $interval = new DateInterval('P'.(($pay_status+1)*7).'D');
                    break;
                case 'monthly':
                    $expire_date_interval=new DateInterval('P'.$duration.'M');
                    $interval = new DateInterval('P'.($pay_status+1).'M');
                    break;
                case 'yearly':
                    $expire_date_interval=new DateInterval('P'.$duration.'Y');
                    $interval = new DateInterval('P'.($pay_status+1).'Y');
                    break;
                default:
                    break;
            }

            $expire_date[$expiry_id]=date_create($data['deposit_date'])->add($expire_date_interval);
            $expire_date[$expiry_id]=$expire_date[$expiry_id]->format('Y-m-d');
            $next_duedate[$expiry_id]=date_create($data['deposit_date'])->add($interval);
            $next_duedate[$expiry_id]=$next_duedate[$expiry_id]->format('Y-m-d');
            
            $today = date("Y-m-d");
            $date1 = date_create($today);
            $date2 = date_create($next_duedate[$expiry_id]);
            $date3 = date_create($expire_date[$expiry_id]);
            $rest= date_diff($date1,$date3);
            $rest= intval($rest->format("%a"));

            if(!$first_paystatus|| !$pay_status || $date1>$date2){

                $pay_status_string[$expiry_id]="unPaid";

            }
            if($first_paystatus && $pay_status && $date1<=$date2 && $rest>$expiry_todate){

                $pay_status_string[$expiry_id]="Paid";

            }
            if($rest<=$expiry_todate && $duration>$pay_status) {

                $pay_status_string[$expiry_id]=$rest." - Day Due";

            };

                        
            // next due date overflow expire date
            if($first_paystatus && $next_duedate[$expiry_id]>$expire_date[$expiry_id]) {
                $next_duedate[$expiry_id]=$expire_date[$expiry_id];
                $pay_status_string[$expiry_id]="Paid";
            }

            $customers=ORM::for_table('crm_accounts')->where('id',$data['customerid'])->find_one();
            $customer[$expiry_id]=$customers['account'];

        }



        $transactions=ORM::for_table('sys_transactions')->where('type','Income')->where('category','Vehicle Deposit');
        $transactions=$transactions->where_not_null('vehicle_num')->order_by_desc('id')->find_array();
        $transaction_customer=array();
        foreach($transactions as $t){
            $tc=ORM::for_table('crm_accounts')->where('id',$t['payerid'])->find_one();
            $transaction_customer[$t['id']]=$tc['account'];
        }

        if(!$transactions){
            $transactions="";
        }

        $ui->assign('transactions', $transactions);
        $ui->assign('transaction_customer',$transaction_customer);

        $paginator['contents'] = '';
        $ui->assign('customer',$customer);
        $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('view_type', $view_type);
        $ui->assign('d', $d);
        $ui->assign('pay_status_string',$pay_status_string);
        $ui->assign('next_duedate', $next_duedate);
        $ui->assign('expire_date', $expire_date);
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



        view('cd_deposit_list');

        break;


    case 'add_deposit':

    
        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();
        $customers=ORM::for_table('crm_accounts')->order_by_asc('id')->find_array();
        $baseUrl=APP_URL;

        $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min','cd/cd_deposit_add',
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
        $ui->assign('customers',$customers);
        $ui->assign('baseUrl',$baseUrl);

        view('cd_deposit_add');

        break;


    case 'edit_deposit':
        
        $id=$routes['2'];
        $f_type="add";
        $deposit=false;

        if($id != ''){
            $deposit=ORM::for_table('sys_vehicle_deposit')->find_one($id);
            $f_type="edit";
        }


        $val=array();

        if($deposit){
            $val['id']=$id;
            $val['customerid']=$deposit->customerid;
            $val['vehicle_num']=$deposit->vehicle_num;
            $val['deposit_amount']=$deposit->deposit_amount;
            $val['first_deposit']=$deposit->first_deposit;
            $val['balance']=$deposit->balance;
            $val['duration']=$deposit->duration;
            $val['repay_cycle_type']=$deposit->repay_cycle_type;
            $val['deposit_date']=$deposit->deposit_date;
            $val['expire_date']=$deposit->expire_date;
            $val['expiry_todate']=$deposit->expiry_todate;
            $val['description']=$deposit->description;
            $val['ref_img']=$deposit->ref_img;

            $c=ORM::for_table('crm_accounts')->where('id',$deposit->customerid)->find_one();
            $val['customer']=$c['account'];

        }else{
            $val['id']=" ";
            $val['customerid']=" ";
            $val['vehicle_num']=" ";
            $val['deposit_amount']=" ";
            $val['first_deposit']=" ";
            $val['duration']=" ";
            $val['balance']=" ";
            $val['repay_cycle_type']=" "; 
            $val['deposit_date']="  ";
            $val['expire_date']=" ";
            $val['expiry_todate']=" ";
            $val['description']=" ";
            $val['ref_img']=" ";
        }

        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();
        $customers=ORM::for_table('crm_accounts')->order_by_asc('id')->find_array();

        $baseUrl=APP_URL;
        // $ui->assign('xheader', Asset::css(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor','s2/css/select2.min')));
        // $ui->assign('xfooter', Asset::js(array('modal','dp/dist/datepicker.min','dropzone/dropzone','redactor/redactor.min','numeric','s2/js/select2.min',
        //     's2/js/i18n/'.lan(),)));

        $ui->assign('val',$val);
        $ui->assign('f_type',$f_type);
        $ui->assign('vehicles',$vehicles);
        $ui->assign('customers',$customers);
        $ui->assign('baseUrl',$baseUrl);


        view('modal_edit_deposit');

        break;
    

    case 'post_deposit':
        
        $id=_post('rid');

        $vehicle_num = _post('vehicle_num');
        $customerid=_post('customer');
        $deposit_amount=_post('deposit_amount','0.00');
        $deposit_amount = Finance::amount_fix($deposit_amount);
        $first_deposit=_post('first_deposit');
        $first_deposit=Finance::amount_fix($first_deposit);
        $balance=$deposit_amount-$first_deposit;

        $duration=_post('duration');
        $repay_cycle_type=_post('repay_cycle_type');
        $deposit_date=_post('deposit_date');
        $expiry_todate=_post('expiry_todate');
        $description=_post('description');
        $ref_img=_post('ref_img');
        
        // Check validate post data

        $msg='';

        if($customerid == ''){
            $msg .= 'Customer is required <br>';
        }
        if($vehicle_num == ''){
            $msg .= 'Vehicle Number is required <br>';
        }
        if($deposit_amount == ''){
            $msg .= 'Principal Amount is required <br>';
        }
        if($duration == ''){
            $msg .= 'Duration is required <br>';
        }
        if($repay_cycle_type == ''){
            $msg .= 'Repayment Cycle is required <br>';
        }
        if($deposit_date == ''){
            $msg .= 'Loan Date is required <br>';
        }
        if($expiry_todate == ''){
            $msg .= 'Expiry To Date is required <br>';
        }
       

        if($msg == ''){
            switch ($repay_cycle_type) {
                case 'weekly':
                    $interval=new DateInterval('P'.($duration*7).'D');
                    break;
                case 'monthly':
                    $interval=new DateInterval('P'.$duration.'M');
                    break;
                case 'yearly':
                    $interval=new DateInterval('P'.$duration.'Y');
                    break;
                default:
                    break;
            }
           
            $expire_date=date_create($deposit_date)->add($interval);
            $expire_date=$expire_date->format('Y-m-d');

            if($id == ''){
                _msglog('s',$_L['Item Added Successfully']);
                $d = ORM::for_table('sys_vehicle_deposit')->create();
            } else{
                _msglog('s',$_L['Item Updated Successfully']);
                $d = ORM::for_table('sys_vehicle_deposit')->find_one($id);
            }
            $d->customerid=$customerid;
            $d->vehicle_num = $vehicle_num;
            $d->deposit_amount = $deposit_amount;
            $d->first_deposit = $first_deposit;
            $d->balance = $balance;
            $d->duration=$duration;
            $d->repay_cycle_type=$repay_cycle_type;
            $d->deposit_date=$deposit_date;
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


    

    case 'view_deposit': 

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
        $mode_css = Asset::css(array('modal','dropzone/dropzone','dp/dist/datepicker.min','footable/css/footable.core.min','redactor/redactor','s2/css/select2.min','cd/cd'));
        $mode_js = Asset::js(array('modal','dropzone/dropzone','dp/dist/datepicker.min','footable/js/footable.all.min','contacts/mode_search','redactor/redactor.min','numeric','s2/js/select2.min',
            's2/js/i18n/'.lan(), 'cd/cd_deposit_view'));

        $baseUrl=APP_URL;


        $deposit = ORM::for_table('sys_vehicle_deposit')->where('id',$id)->find_one();
        $val=array();
        $val['id']=$id;
        $val['vehicle_num']=$deposit['vehicle_num'];
        $val['date']=$deposit['deposit_date'];
        $val['duration']=$deposit['duration'];
        $repay_cycle_type=$deposit['repay_cycle_type'];
        
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
        
        $val['repayment']=$deposit['repay_cycle_type'];
        $val['amount']=$deposit['deposit_amount'];
        $val['first_deposit']=$deposit['first_deposit'];
        $val['total_due']=$val['amount']-$val['first_deposit'];
        
        if($deposit['first_paystatus']){
            $first_paystatus="Paid";
        }else{
            $first_paystatus="unPaid";
        }


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
            
            $next_duedate[$i]=date_create($deposit['deposit_date'])->add($interval);
            $next_duedate[$i]=$next_duedate[$i]->format('Y-m-d');
        }

        if($val['total_due'] && $val['duration']){
            $val['balance_amount']=$val['total_due']/$val['duration'];       
        }

        $balance_due=array();
        $balance_due[0]=$val['total_due'];

        for($i=1;$i<=$val['duration'];$i++){
            $balance_due[$i]=$balance_due[$i-1]-$val['balance_amount'];
        }

        $deposit_log=ORM::for_table('sys_vehicle_depositlog')->where('deposit_id',$val['id'])->where_not_null('transaction_id')->find_array();
        if($deposit_log){
            $deposit_log_count=count($deposit_log);
        }else{
            $deposit_log_count=0;
        }


               
        $val['expiry_todate']=$deposit['expiry_todate'];
        $pay_status_string=array();   
        
        // Expiry Status

        for($i=1;$i<=$val['duration'];$i++){

            if($deposit_log_count != 0){
                
                $pay_status_string[$i]="Paid";
                $deposit_log_count--;    

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


        // Trasaction  data
        $first_deposit_transaction="";
        if($deposit['first_paystatus']){
            $first_deposit_transaction=ORM::for_table('sys_transactions')->where('id',$deposit['first_paystatus'])->find_one();
            $f_t_c=ORM::for_table('crm_accounts')->where('id',$first_deposit_transaction['payerid'])->find_one();
            $f_t_c=$f_t_c['account'];
        }else{
            $f_t_c="";
        }
        // $transactions=ORM::for_table('sys_transactions')->where('type','Income')->where('category','Vehicle Deposit');
        // $transactions=$transactions->where_not_null('vehicle_num')->where('vehicle_num',)->order_by_desc('id')->find_array();

        $transactions=ORM::for_table('sys_transactions')->select('sys_transactions.*')
        ->inner_join('sys_vehicle_depositlog',array('sys_vehicle_depositlog.transaction_id','=','sys_transactions.id'))
        ->where('sys_vehicle_depositlog.deposit_id',$id)->order_by_desc('id')->find_many();
        //$transactions+=$first_deposit_transaction;
        
        $transaction_customer=array();
        foreach($transactions as $t){
            $tc=ORM::for_table('crm_accounts')->where('id',$t['payerid'])->find_one();
            $transaction_customer[$t['id']]=$tc['account'];
        }
        
        if(!$transactions){
            $transactions="";
        }

        $ui->assign('transactions', $transactions);
        $ui->assign('transaction_customer', $transaction_customer);

        $ui->assign('f_d_t', $first_deposit_transaction);
        $ui->assign('f_t_c', $f_t_c);
        $paginator['contents'] = '';

        // $ui->assign('total_items', $total_items);
        $ui->assign('xheader', $mode_css);
        $ui->assign('xfooter', $mode_js);
        $ui->assign('val', $val);
        $ui->assign('view_type',$view_type);
        $ui->assign('next_duedate',$next_duedate);
        $ui->assign('balance_due',$balance_due);
        $ui->assign('pay_status_string',$pay_status_string);
        $ui->assign('first_paystatus', $first_paystatus);
        $ui->assign('transactions',$transactions);   
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

        view('cd_deposit_view');

        break;

    
    case 'view_img':
      // Ajax post datas
        $id = $routes['2'];
        $tr_type = $routes['3'];
        $table_name = "";
        if($tr_type){
            switch ($tr_type) {
                case 'deposit':
                    $table_name = 'sys_vehicle_deposit';
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

    case 'modal_deposit':
        
        $id=$routes['2'];
        @$firstdeposit_flag=$routes['3'];
        
                
        $deposit=false;
        if($id != ''){
            $deposit=ORM::for_table('sys_vehicle_deposit')->find_one($id);
        }


        $baseUrl=APP_URL;
        $val=array();
        if($deposit){
            $val['id']=$id;
            $val['vehicle_num']=$deposit->vehicle_num;
            $deposit_amount=$deposit->deposit_amount;
            $first_deposit=$deposit->first_deposit;
            $duration=$deposit->duration;
            if($duration){
                $val['amount']=($deposit_amount-$first_deposit)/$duration;
            }
            $val['amount']=$firstdeposit_flag?$first_deposit:$val['amount'];
            $val['category']="Vehicle Deposit";
            $val['customerid']=$deposit->customerid;
            $c=ORM::for_table('crm_accounts')->where('id',$deposit->customerid)->find_one();
            $val['customer']=$c['account'];
        }else{
            $val['id']="";
            $val['vehicle_num']="";
            $val['amount']="";
            $val['category']="";
            $val['customerid']="";
            $val['customer']="";
        }
        $ui->assign('val',$val);
        $vehicles=ORM::for_table('sys_vehicles')->order_by_asc('id')->find_array();
        $ui->assign('vehicles',$vehicles);
        $ui->assign('baseUrl',$baseUrl);
        //first deposit

        $ui->assign('firstdeposit_flag',$firstdeposit_flag);


        //Transactions Controller
        
        $currencies = Currency::all();
        $ui->assign('currencies', $currencies);
        $d = ORM::for_table('sys_accounts')->find_many();
        $p = ORM::for_table('crm_accounts')->find_many();
        $ui->assign('p', $p);
        $ui->assign('d', $d);
        $tags = Tags::get_all('Income');
        $ui->assign('tags', $tags);
        $cats = ORM::for_table('sys_cats')->where('type', 'Income')->order_by_asc('sorder')->find_many();
        $ui->assign('cats', $cats);
        $pms = ORM::for_table('sys_pmethods')->find_many();
        $ui->assign('pms', $pms);
        $mdate = date('Y-m-d');
        $ui->assign('mdate', $mdate);
       
      
        $x = ORM::for_table('sys_transactions')->where('type', 'Income');
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

       
        view('modal_vehicle_deposit', [
            'currency_rate' => $currency_rate,
            'expense_types' => ExpenseType::orderBy('sorder')->get()
        ]);


        break;
   
    
    
    case 'del_deposit':
        
        Event::trigger('vehicle/del_deposit/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicle_deposit')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'cd/deposit_list', 's', $_L['Deposit Transaction Delete Successful']);
        }

        break;
    
    case 'del_contract':
        
        Event::trigger('vehicle/del_contract/');
        $id = $routes['2'];

        $d = ORM::for_table('sys_vehicle_contract')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'cd/contract_list', 's', $_L['Contract Delete Successful']);
        }

        break;


    case 'del_generated_contract':
        
        Event::trigger('cd/del_generated_contract');
        $id = $routes['2'];
        $contract_id=$routes['3'];
        $d = ORM::for_table('sys_vehicle_generatedcontract')->find_one($id);

        if ($d) {
            $d->delete();
            r2(U . 'cd/generate_contract/'.$contract_id, 's', $_L['Contract Delete Successful']);
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
