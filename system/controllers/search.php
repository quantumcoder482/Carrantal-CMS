<?php
/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
|
*/

_auth();
$ui->assign('_application_menu', 'contacts');
$ui->assign('_st', $_L['Search']);
$ui->assign('_title', $_L['Accounts'].'- '. $config['CompanyName']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
switch ($action) {

    case 'ps':
$type = _post('stype');
$name = _post('txtsearch');
        $d = ORM::for_table('sys_items')->where('type',$type)->where_like('name',"%$name%")->order_by_asc('name')->find_array();
if($d){
    echo '<table class="table table-hover">
        <tbody>
        
        <tr>
 
 <td>
 '.$_L['Image'].'
</td>

                <td class="project-title">
                    '.$_L['Name'].'
                </td>
                <td>

                  '.$_L['Cost Price'].'

                </td>
                <td>

                  '.$_L['Sales Price'].'

                </td>
                
                

                <td class="project-actions">

                    '.$_L['Manage'].'
                </td>
            </tr>
        
        
        
        ';


    foreach ($d as $ds){

        if($ds['image'] == ''){
            $img = '<img src="'.APP_URL.'/ui/lib/imgs/item_placeholder.png">';
        }
        else{
            $img = '<img src="'.APP_URL.'/storage/items/thumb'.$ds['image'].'">';
        }

      //  $price = number_format($ds['sales_price'],2,$config['dec_point'],$config['thousands_sep']);
        $price = ib_money_format($ds['sales_price'],$config);
        $cost_price = ib_money_format($ds['cost_price'],$config);

        $available = round($ds['inventory']);

        if($available != 0){
            $txt_available = '<hr> '.$_L['Available'].': '.$available;
        }
        else{
            $txt_available = '';
        }

        echo '


 <tr>
 
 <td>
 '.$img.'
</td>

                <td class="project-title">
                    <a href="#" class="cedit"  id="t'.$ds['id'].'">'.$ds['name'].'</a>
                    <br>
                    <small>'.$_L['Item Code'].' '.$ds['item_number'].'</small>
                    
                    '.$txt_available.'
                </td>
                
                <td>

                   '.$cost_price.'

                </td>
                <td>

                   '.$price.'

                </td>

                <td class="project-actions">

                    <a href="#" class="btn btn-primary btn-sm cedit" id="e'.$ds['id'].'"><i class="fa fa-pencil"></i> '.$_L['Edit'].' </a>
                    <a href="#" class="btn btn-danger btn-sm cdelete" id="pid'.$ds['id'].'"><i class="fa fa-trash"></i> '.$_L['Delete'].' </a>
                    <a href="'.U.'inventory/barcode/'.$ds['id'].'" target="_blank" class="btn btn-inverse btn-sm"><i class="fa fa-barcode"></i> '.$_L['Barcode'].' </a>
                </td>
            </tr>';
    }


    echo '
        <tr>
 
 <td colspan="5">
&nbsp;
</td>

                
            </tr>
        </tbody>
    </table>';
}
else{
    echo '<h4>Nothing Found</h4>';
}

        break;


    case 'users':
echo '<table class="table table-bordered table-hover trclickable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Access Level</th>
                    <th>Active</th>
                </tr>
                </thead>
                <tbody>
                <tr id="_tr120">
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td><div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" class="onoffswitch-checkbox" data-on-text="Yes">
                                <label class="onoffswitch-label" for="fixednavbar">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div></td>
                </tr>

                </tbody>
            </table>';
        break;

    default:
        echo 'action not defined';
}