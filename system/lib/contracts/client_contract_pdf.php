<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title><?php echo $_L['Contract'].'_'.$in; ?></title>
    <style>
        
        * { margin: 0; padding: 0; }
        body {
            font: 14px/1.4 Helvetica, Arial, sans-serif;
        }
        #page-wrap { width: 800px; margin-top:200px !important;}
        #company-name {text-align:center; margin-top: 15px; font-weight:bold; font:14px Helvetica, Arial, sans-serif; overflow: hidden; resize: none; }
        
        
        textarea { border: 0; font: 14px Helvetica, Arial, sans-serif; overflow: hidden; resize: none; }
        table { border-collapse: collapse; }
        table td, table th { border: 1px solid black; padding: 5px; }
        
        #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }
        
        #address { width: 250px; height: 150px; float: left; }
        #customer { overflow: hidden; }
        
        #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }
        #customer-title { font-size: 20px; font-weight: 600; float: left; }
        
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
        
        #terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
        #terms { text-align: center; margin: 20px 0 0 0; }
        #terms textarea { width: 100%; text-align: center;}
        
        .delete-wpr { position: relative; }
        .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
    </style>
</head>
<body style="font-family:dejavusanscondensed">
    <div id="page-wrap">
        <div>
            <p><h1 style="text-align:center"><?php echo($contract['title']); ?></h1></p>
            <p><?php echo($content); ?></p>
        </div>
    </div>

    <div style="position: fixed; bottom: 2px; right: 24px; z-index: 1004;">
        <table id="sign-table" style="width:100%;">
            <tr>
                <td style="width:60%; text-align:center; font-size:23px; border-style:hidden">
                    <strong><?php echo($d['submit_name']); ?></strong>
                </td>
                <td style="text-align:center; border-style:hidden">
                    <span data-date-format="yyyy-mm-dd" data-auto-close="true"><?php echo($d['submit_date']); ?></span>
                </td>
            </tr>
            <tr>
                <td style="border-style:hidden; height:5px; padding-left:30px; padding-right:30px; margin:0; spacing:0"><hr></td>
                <td style="border-style:hidden; height:5px; padding-left:30px; padding-right:30px; margin:0; spacing:0"><hr></td>
            </tr>
            <tr>
                <td style="text-align:center; border-style:hidden;valign:top; padding:0px; spacing:0px; margin-top:0px"><?php echo($_L['Name']); ?></td>
                <td style="text-align:center; border-style:hidden;valign:top; padding:0px; spacing:0px; margin-top:0px"><?php echo($_L['Date']); ?></td>
            </tr>
        </table>
    </div>

</body>
