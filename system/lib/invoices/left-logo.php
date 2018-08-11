
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <style>

        @page{
            margin: 0;
            background: #f0f1f1;

        }

        .container {
            width: 80%;
            height: 100%;

            margin: 0;

        }

        #left{
            width: 200px;
            height: 100%;
            background: #d0d2d4;
            float: left;
        }

        .left-area{
            margin-left: 30px;

            padding-top: 50px;
        }

        .border-left-area-1{
            border-top: 3px solid #221f20;
        }
        .border-left-area-2{
            margin-top: 1px;
            border-top: 1px solid #221f20;
        }

        .border-right-area-1{
            border-top: 3px solid #221f20;
            width: 100px;
        }
        .border-right-area-2{
            margin-top: 1px;
            border-top: 1px solid #221f20;
            width: 100px;
        }

        .right-area{

            padding-top: 50px;
            padding-left: 40px;

        }

        .status{
            margin-top: 20px;

        }

        .font-bold{
            font-weight: bold;
            font-size: 13px;
        }

        .font-300{
            font-weight: 300;
            font-size: 13px;
        }

        .font-600{
            font-weight: bold;
            font-size: 11px;
        }

        .details{
            font-size: 12px;
            font-weight: 300;
        }

        .terms{
            font-size: 10px;
            font-weight: 300;
        }

        .logo{
            margin-top: 370px;
            margin-left: 30px;
        }





    </style>
</head>
<body>



<div class="container">
    <div id="left">

        <div class="left-area">
            <div class="border-left-area-1"></div>

            <div class="border-left-area-2"></div>

            <div>
                <h3>INVOICE</h3>
            </div>

            <div class="invoice-no">
                <p>
                    <span class="font-300">NO.</span> <br>
                    <span class="font-600">L4339539</span>
                </p>

                <p>
                    <span class="font-300">Date</span> <br>
                    <span class="font-600">20 November 2017</span>
                </p>

                <p>
                    <span class="font-300">To</span> <br>
                    <span class="font-bold">STACKPI PTY LIMITED</span> <br>
                    <span class="details">6/15-17 Jesica Road</span> <br>
                    <span class="details">Campbellfield Victoria 3061</span> <br> <br>
                    <span class="details">Phone: </span> <br>
                    <span class="details">Email: </span>

                </p>

                <p>

                    <span class="font-bold">PAYMENT</span> <br>
                    <span class="font-300">BANK NAME</span> <br>
                    <span class="font-600">Commonwealth Bank</span>
                </p>

                <p>


                    <span class="font-300">ACCOUNT NAME</span> <br>
                    <span class="font-600">Anh Tuan Tran</span>
                </p>

                <p>


                    <span class="font-300">ACCOUNT NUMBER</span> <br>
                    <span class="font-600">063168 - 1080 2794</span>
                </p>

                <p>
                    <span class="font-bold">TERMS</span> <br>
                    <span class="terms">
                        Please note our Terms are strictly Net 7 days and in the event that payment is not made within that time, interest will be charged on this account at 4.00% p.a. if the account remains unpaid.
                    </span>
                </p>


                <p class="logo"><img src="<?php echo APP_URL; ?>/storage/system/live-print.png" alt="logo" /></p>

            </div>





        </div>

    </div>

    <div id="right">

        <div class="right-area">

            <div class="border-right-area-1"></div>

            <div class="border-right-area-2"></div>

            <div class="status">DUE</div>
            <div>
                <h4>$ 5,610.00</h4>
            </div>

        </div>

    </div>
</div>


</body>
</html>