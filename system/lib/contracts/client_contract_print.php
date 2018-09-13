<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title><?php echo $_L['Contract'].'_'.$in; ?></title>

    <style>
    
        * { margin: 0; padding: 0; }
        body {
            font: 14px Helvetica, Arial, sans-serif;
           
        }
        
        #page-wrap { width: 666px; margin: 0 auto; }
       
        #print {
            position:fixed;
            bottom:0px;
            left:10px;
        }
        
        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
               
            }
            body {
                position: relative; 
                font: 14px Helvetica, Arial, sans-serif;
            }
            
            #page-wrap{
                /*height: 10 in;  or give size as per proper calculation of the height of all your pages after which you want footer */
                /* position: relative;  */

            } 
            
            footer {
              position:relative;   
              bottom:0;      
            }

            @page:last {
                #footer{
                    display: block;
                    width:100%;        
                    position:fixed;
                    bottom:0; 
                }
            }
          
        } 

        table { border-collapse: collapse; }
        table td, table th { border: 1px solid black; padding: 5px; }

       
        .delete-wpr { position: relative; }
        .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }

    /* Extra CSS for Print Button*/
        .button {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            overflow: hidden;
            margin-top: 20px;
            padding: 12px 12px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-transition: all 60ms ease-in-out;
            transition: all 60ms ease-in-out;
            text-align: center;
            white-space: nowrap;
            text-decoration: none !important;

            color: #fff;
            border: 0 none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.3;
            -webkit-appearance: none;
            -moz-appearance: none;

            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-flex: 0;
            -webkit-flex: 0 0 160px;
            -ms-flex: 0 0 160px;
            flex: 0 0 160px;
        }
        .button:hover {
            -webkit-transition: all 60ms ease;
            transition: all 60ms ease;
            opacity: .85;
        }
        .button:active {
            -webkit-transition: all 60ms ease;
            transition: all 60ms ease;
            opacity: .75;
        }
        .button:focus {
            outline: 1px dotted #959595;
            outline-offset: -4px;
        }

        .button.-regular {
            color: #202129;
            background-color: #edeeee;
        }
        .button.-regular:hover {
            color: #202129;
            background-color: #e1e2e2;
            opacity: 1;
        }
        .button.-regular:active {
            background-color: #d5d6d6;
            opacity: 1;
        }

        .button.-dark {
            color: #FFFFFF;
            background: #333030;
        }
        .button.-dark:focus {
            outline: 1px dotted white;
            outline-offset: -4px;
        }

       

    </style>
</head>

<body>
    <header>
        <div style="text-align:center"><img src="<?php echo($logo_url);?>" width="270px" /></div> 
        <div style="text-align:center; font: 14px Helvetica, Arial, sans-serif"><strong><?php echo($company_name); ?></strong></div>
        <div style="text-align:center; font: 14px Helvetica, Arial, sans-serif"><?php echo($caddress);?></div>
        <hr style="margin-top:12px">
    </header>


    <div id="page-wrap">
        <div style="margin-bottom:200px;">
            <p><h1 style="text-align:center; margin-top:35px; margin-bottom:35px;"><?php echo($contract['title']); ?></h1></p>
            <p><?php echo($content); ?></p>
        </div>
    </div>
    <footer style="width:666px; text-align:center; margin:0 auto">
        <div id="footer" style="">
            <table style="width:100%;">
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
    </footer>
        <div id="print" style="text-align:center">    
            <button class='button -dark center no-print' onClick="window.print();">Click Here to Print</button>
        </div>

</body>

</html>