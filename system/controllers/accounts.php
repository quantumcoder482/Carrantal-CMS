<?php
/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
|
*/
_auth();

$ui->assign('_application_menu', 'accounts');
$ui->assign('_title', $_L['Accounts'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Accounts']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
Event::trigger('accounts');
switch ($action) {
    case 'balances':
        $parent_menu = route(2);
        if ($parent_menu == 'transactions') {
            $ui->assign('_application_menu', 'transactions');
        }

        $home_currency = Currency::where('iso_code', $config['home_currency'])->first();

        //   $net_worth = ORM::for_table('sys_accounts')->sum('balance');

        $net_worth = Balance::where('currency_id', $home_currency->id)->sum('balance');

        //   $net_worth = ORM::for_table('sys_accounts')->sum('balance');

        $net_worth = Balance::where('currency_id', $home_currency->id)->sum('balance');
        if ($net_worth == '') {
            $net_worth = 0;
        }

        $accounts = Account::all();
        $currencies = Currency::all();
        view('accounts_balances', ['accounts' => $accounts, 'currencies' => $currencies, 'net_worth' => $net_worth]);
        break;

    case 'add':
        $ui->assign('xfooter', Asset::js(array(
            'numeric'
        )));

        // find other currencies

        $currencies = Currency::all();
        $ui->assign('currencies', $currencies);
        view('accounts_add');
        break;

    case 'add-post':
        $account = _post('account');
        $description = _post('description');
        $msg = '';
        if (Validator::Length($account, 100, 2) == false) {
            $msg.= $_L['account_title_length_error'] . '<br />';
        }

        // check with same name account is exist

        $d = ORM::for_table('sys_accounts')->where('account', $account)->find_one();
        if ($d) {
            $msg.= $_L['account_already_exist'] . '<br />';
        }

        //        $balance = _post('balance');
        //        $balance = Finance::amount_fix($balance);
        // From version 4

        $ex_msg = '';
        $ib_url = _post('ib_url');
        if ($ib_url != '') {
            if (filter_var($ib_url, FILTER_VALIDATE_URL) === FALSE) {
                $ex_msg.= '. Error: Invalid URL. URL Not Updated.';
                $ib_url = '';
            }
        }

        if ($msg == '') {

            //            if($balance != '0.00'){
            //                //Add a Transaction
            //                $d = ORM::for_table('sys_transactions')->create();
            //                $d->account = $account;
            //                $d->type = 'Income';
            //                $d->payer = $_L['system'];
            //                $d->amount = $balance;
            //                $d->date = date('Y-m-d');
            //                $d->dr = '0.00';
            //                $d->cr = $balance;
            //                $d->bal = $balance;
            //                $d->description = $_L['initial_balance'];
            //
            //                $d->category = '';
            //                $d->payer = '';
            //                $d->payee = '';
            //                $d->payeeid = '0';
            //                $d->payerid = '0';
            //                $d->status = 'Cleared';
            //                $d->tax = '0.00';
            //                $d->iid = 0;
            //                $d->method = '';
            //                $d->ref = '';
            //                $d->tags = '';
            //
            //                //others
            //                $d->payer = '';
            //                $d->payee = '';
            //                $d->payeeid = '0';
            //                $d->status = 'Cleared';
            //                $d->tax = '0.00';
            //                $d->iid = 0;
            //                $d->aid = 0;
            //                $d->updated_at = date('Y-m-d H:i:s');
            //
            //                $d->save();
            //            }
            // Add Account

            $d = ORM::for_table('sys_accounts')->create();
            $d->account = $account;
            $d->description = $description;
            $d->balance = '0.00';

            // From Version 4

            $d->bank_name = '';
            $d->account_number = _post('account_number');
            $d->currency = '';
            $d->branch = '';
            $d->address = '';
            $d->contact_person = _post('contact_person');
            $d->contact_phone = _post('contact_phone');
            $d->website = '';
            $d->ib_url = $ib_url;
            $d->created = date('Y-m-d H:i:s');
            $d->notes = '';
            $d->sorder = 1;
            $d->e = '';
            $d->token = '';
            $d->status = '';
            $d->save();
            $account_id = $d->id;
            $currencies = Currency::all();
            foreach($currencies as $currency) {
                $balance = _post('balance_' . $currency->iso_code);
                $balance = Finance::amount_fix($balance);
                if (is_numeric($balance) == false) {
                    $balance = '0.00';
                }

                $b = new Balance;
                $b->account_id = $account_id;
                $b->currency_id = $currency->id;
                $b->balance = $balance;
                $b->save();
            }

            r2(U . 'accounts/list', 's', $_L['account_created_successfully'] . $ex_msg);
        }
        else {
            r2(U . 'accounts/add', 'e', $msg);
        }

        break;

    case 'list':
        $d = ORM::for_table('sys_accounts')->find_many();
        $ui->assign('d', $d);

        view('accounts-manage');
        break;

    case 'edit':
        $id = $routes['2'];
        $d = ORM::for_table('sys_accounts')->find_one($id);
        if ($d) {
            $ui->assign('d', $d);
            view('account-edit');
        }
        else {
            r2(U . 'accounts/list', 'e', $_L['Account_Not_Found']);
        }

        break;

    case 'edit-post':
        $account = _post('account');
        $description = _post('description');
        $id = _post('id');
        $today = date('Y-m-d H:i:s');
        $msg = '';
        if (Validator::Length($account, 100, 2) == false) {
            $msg.= $_L['account_title_length_error'] . '<br />';
        }

        $ex_msg = '';
        $ib_url = _post('ib_url');
        if ($ib_url != '') {
            if (filter_var($ib_url, FILTER_VALIDATE_URL) === FALSE) {
                $ex_msg.= '. Error: Invalid URL. URL Not Updated.';
                $ib_url = '';
            }
        }

        if ($msg == '') {
            $d = ORM::for_table('sys_accounts')->find_one($id);
            if ($d) {
                $oaccount = $d['account'];
                $d->account = $account;
                $d->description = $description;

                // From Version 4
                // From Version 4

                $d->bank_name = '';
                $d->account_number = _post('account_number');
                $d->currency = '';
                $d->branch = '';
                $d->address = '';
                $d->contact_person = _post('contact_person');
                $d->contact_phone = _post('contact_phone');
                $d->website = '';
                $d->ib_url = $ib_url;

                //  $d->created = $today;

                $d->notes = '';
                $d->sorder = 1;
                $d->e = '';
                $d->token = '';
                $d->status = '';
                $d->save();

                // now update all transactions with the new name

                $b = ORM::for_table('sys_transactions')->where('account', $oaccount)->find_result_set()->set('account', $account)->save();
                r2(U . 'accounts/list', 's', $_L['account_updated_successfully'] . $ex_msg);
            }
            else {
                r2(U . 'accounts/list', 'e', $_L['Account_Not_Found']);
            }
        }
        else {
            r2(U . 'accounts/add', 'e', $msg);
        }

        break;

    case 'delete':


        if (!has_access($user->roleid, 'bank_n_cash', 'delete')) {
            permissionDenied();
        }

        $id = $routes['2'];
        $id = str_replace('did', '', $id);
        if (APP_STAGE == 'Demo') {
            r2(U . 'accounts/list', 'e', 'Sorry! Deleting Account is disabled in the demo mode.');
        }

        $d = ORM::for_table('sys_accounts')->find_one($id);
        if ($d) {
            $d->delete();

            //Delete the balance table

            $balances = Balance::where('account_id',$id)->get();

            foreach ($balances as $b){

                $b->delete();

            }


            //


            r2(U . 'accounts/list', 's', $_L['account_delete_successful']);
        }

        break;

    case 'post':
        break;

    default:
        echo 'action not defined';
}