<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Editable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />

</head>

<body>

	<div id="page-wrap">


		<div id="identity">



            <div id="logo">
              <img id="image" src="images/logo.png" alt="logo" /> <br>
                fsfsfsf
            </div>

		</div>

		<div style="clear:both"></div>

		<div id="customer">

           Widget Corp.
c/o Steve Widget

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td>000123</td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td>December 15, 2009</td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">$875.00</div></td>
                </tr>

            </table>

		</div>

		<table id="items">

		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>

		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr">Web Updates</div></td>
		      <td class="description">Monthly web updates for http://widgetcorp.com (Nov. 1 - Nov. 30, 2009)</td>
		      <td>$650.00</td>
		      <td>1</td>
		      <td><span class="price">$650.00</span></td>
		  </tr>

		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr">SSL Renewals</div></td>

		      <td class="description">Yearly renewals of SSL certificates on main domain and several subdomains</td>
		      <td>$75.00</td>
		      <td>3</td>
		      <td><span class="price">$225.00</span></td>
		  </tr>



		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">$875.00</div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">$875.00</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value">$0.00</td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">$875.00</div></td>
		  </tr>

		</table>

		<div id="terms">
		  <h5>Terms</h5>
		 NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.
		</div>
	
	</div>
	
</body>

</html>