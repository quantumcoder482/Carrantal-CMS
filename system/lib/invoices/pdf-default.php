<style>

    * { margin: 0; padding: 0; }
    body {
        font: 14px/1.4 Helvetica, Arial, sans-serif;
    }
    #page-wrap { width: 800px; margin: 0 auto; }

    textarea { border: 0; font: 14px Helvetica, Arial, sans-serif; overflow: hidden; resize: none; }
    table { border-collapse: collapse; }
    table td, table th { border: 1px solid black; padding: 5px; }

    #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

    #address { width: 250px; height: 150px; float: left; }
    #customer { overflow: hidden; }

    #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }
    #customer-title { font-size: 20px; font-weight: bold; float: left; }

    #meta { margin-top: 1px; width: 100%; float: right; }
    #meta td { text-align: right;  }
    #meta td.meta-head { text-align: left; background: #eee; }
    #meta td textarea { width: 100%; height: 20px; text-align: right; }

    #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
    #items th { background: #eee; }
    #items textarea { width: 80px; height: 50px; }
    #items tr.item-row td {  vertical-align: top; }
    #items td.description { width: 300px; }
    #items td.item-name { width: 175px; }
    #items td.description textarea, #items td.item-name textarea { width: 100%; }
    #items td.total-line { border-right: 0; text-align: right; }
    #items td.total-value { border-left: 0; padding: 10px; }
    #items td.total-value textarea { height: 20px; background: none; }
    #items td.balance { background: #eee; }
    #items td.blank { border: 0; }

    #terms { text-align: center; margin: 20px 0 0 0; }
    #terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
    #terms textarea { width: 100%; text-align: center;}



    .delete-wpr { position: relative; }
    .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>
<div id="page-wrap">

    <table width="100%">
        <tr>
            <td style="border: 0;  text-align: left" width="62%">
                <span style="font-size: 18px; color: #2f4f4f"><strong>Invoice # <?php echo $d['id']; ?></strong></span>
            </td>
            <td style="border: 0;  text-align: right" width="62%"><div id="logo">
                    <img id="image" src="<?php echo APP_URL; ?>/storage/system/logo-md.png" alt="logo" /> <br>
                    <?php echo $config['caddress']; ?>
                </div></td>
        </tr>



    </table>


    <div style="clear:both"></div>

    <div id="customer">

        <table id="meta">
            <tr>
                <td rowspan="5" style="border: 1px solid white; border-right: 1px solid black; text-align: left" width="62%"> <?php echo $d['account']; ?> <br>
                    <?php echo $a['address']; ?> <br>
                    <?php echo $a['city']; ?> <?php echo $a['state']; ?> <?php echo $a['zip']; ?> <br>
                    <?php echo $a['country']; ?> <br>
                    <?php
                    if(($a['phone']) != ''){
                        echo 'Phone: '. $a['phone']. ' <br>';
                    }
                    if(($a['email']) != ''){
                        echo 'Email: '. $a['email']. ' <br>';
                    }
                    ?></td>
                <td class="meta-head">Invoice #</td>
                <td><?php echo $d['id']; ?></td>
            </tr>
            <tr>

                <td class="meta-head">Status</td>
                <td><?php echo $d['status']; ?></td>
            </tr>
            <tr>

                <td class="meta-head">Invoice Date</td>
                <td><?php echo date("M d Y", strtotime($d['date'])); ?></td>
            </tr>
            <tr>

                <td class="meta-head">Due Date</td>
                <td><?php echo date("M d Y", strtotime($d['duedate'])); ?></td>
            </tr>

            <tr>

                <td class="meta-head">Amount Due</td>
                <td><div class="due"><?php echo $d['total']; ?></div></td>
            </tr>

        </table>

    </div>

    <table id="items" <?php if(($d['status']) == 'Paid'){ echo 'background="'.APP_URL.'/system/lib/invoices/images/paid.png" style="background-repeat:no-repeat;"'; } ?> >

        <tr>
            <th width="65%">Item</th>
            <th align="right">Price</th>
            <th align="right">Quantity</th>
            <th align="right">Total</th>

        </tr>



        <?php

        foreach ($items as $item){
            echo '  <tr class="item-row">


            <td class="description">'.$item['description'].'</td>
            <td align="right">'.$config['currency_code'].''.$item['amount'].'</td>
            <td align="right">'.$item['qty'].'</td>
            <td align="right"><span class="price">'.$config['currency_code'].''.$item['total'].'</span></td>
        </tr>';
        }

        ?>

        <?php
        if (($d['tax']) != '0.00'){
            ?>
            <tr>
                <td class="blank"> </td>
                <td colspan="2" class="total-line">Subtotal</td>
                <td class="total-value"><div id="subtotal"><?php echo $config['currency_code']; ?><?php echo $d['subtotal']; ?></div></td>
            </tr>
            <tr>

                <td class="blank"> </td>
                <td colspan="2" class="total-line">TAX</td>
                <td class="total-value"><div id="total"><?php echo $config['currency_code']; ?><?php echo $d['tax']; ?></div></td>
            </tr>
        <?php
        }
        ?>

        <tr>
            <td class="blank"> </td>
            <td colspan="2" class="total-line balance">Grand Total</td>
            <td class="total-value balance"><div class="due"><?php echo $config['currency_code']; ?><?php echo $d['total']; ?></div></td>
        </tr>

    </table>

    <div id="terms">
        <h5>Terms</h5>
        NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.
    </div>

</div>