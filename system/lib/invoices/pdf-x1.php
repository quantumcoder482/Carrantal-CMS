<?php


# Logo


$pdf->Image('storage/system/logo.png', 10, 15, 35);


# Company Details
$pdf->SetFont('freesans', '', 13);
$address = str_replace('<br>', ',', $config['caddress']);
$companyaddress = explode(',', $address);
$pdf->Cell(0, 6, $companyaddress[0], 0, 1, 'R');
$pdf->SetFont('freesans', '', 9);
foreach ($companyaddress as $key) {
    if ($companyaddress[0] != $key) {
        $pdf->Cell(0, 4, trim($key), 0, 1, 'R');
    }

}
$pdf->Ln(5);

# Header Bar
$invoiceprefix = $d['invoicenum'];
$invoicenum = $d['id'];

$pdf->SetFont('freesans', 'B', 15);
$pdf->SetFillColor(239);
$pdf->Cell(0, 8, $invoiceprefix . $invoicenum, 0, 1, 'L', '1');
$pdf->SetFont('freesans', '', 10);
$pdf->Cell(0, 6, 'Date Created' . ': ' . date("M d Y", strtotime($d['date'])) . '', 0, 1, 'L', '1');
$pdf->Cell(0, 6, 'Due On' . ': ' . date("M d Y", strtotime($d['duedate'])) . '', 0, 1, 'L', '1');
$pdf->Ln(10);
$startpage = $pdf->GetPage();
$addressypos = $pdf->GetY();
# Clients Details
$pdf->SetFont('freesans', 'B', 10);
$pdf->Cell(0, 4, 'To', 0, 1);
$pdf->SetFont('freesans', '', 9);
$pdf->Cell(0, 4, $d['account'], 0, 1, 'L');
$pdf->Cell(0, 4, 'ATTN' . ": " . $d['account'], 0, 1, 'L');
$pdf->Cell(0, 4, $a["address"], 0, 1, 'L');
$pdf->Cell(0, 4, $a["city"] . ", " . $a["state"] . ", " . $a["zip"], 0, 1, 'L');
$pdf->Cell(0, 4, $a["country"], 0, 1, 'L');
foreach($cf as $cfs){
    $pdf->Cell(0, 4, $cfs['fieldname'].': '. get_custom_field_value($cfs['id'],$a['id']), 0, 1, 'L');
}
$pdf->Ln(10);

# Invoice Items
$tblhtml = '<table width="100%" bgcolor="#ccc" cellspacing="1" cellpadding="1" border="0">
    <tr height="30" bgcolor="#efefef" style="font-weight:bold;text-align:center;">
        <td width="70%">Item</td>
        <td width="10%">Price</td>
        <td width="10%">Qty</td>
        <td width="10%">Total</td>
    </tr>';
foreach ($items as $item) {
    $tblhtml .= '
    <tr bgcolor="#fff">
        <td align="left">' . nl2br($item['description']) . '<br /></td>
        <td align="center">' . $item['amount'] . '</td>
        <td align="center">' . $item['qty'] . '</td>
        <td align="center">' . $item['total'] . '</td>
    </tr>';
}
$tblhtml .= '
    <tr height="30" bgcolor="#efefef" style="font-weight:bold;">
        <td align="right" colspan="3">Subtotal</td>
        <td align="center">' . $d['subtotal'] . '</td>
    </tr>';

if (($d['discount']) != '0.00') $tblhtml .= '
    <tr height="30" bgcolor="#efefef" style="font-weight:bold;">
        <td align="right" colspan="3">Discount</td>
        <td align="center">' . $d['discount'] . '</td>
    </tr>';

if (($d['tax']) != '0.00') $tblhtml .= '
    <tr height="30" bgcolor="#efefef" style="font-weight:bold;">
        <td align="right" colspan="3">' . $d['taxrate'] . '% ' . $d['taxname'] . '</td>
        <td align="center">' . $d['tax'] . '</td>
    </tr>';

$tblhtml .= '<tr height="30" bgcolor="#efefef" style="font-weight:bold;">
        <td align="right" colspan="3">Total</td>
        <td align="center">' . $d['total'] . '</td>
    </tr>
</table>';

// <h4>Related Transactions</h4>

//    if ($trs_c != ''){
//        $inner_trs = '';
//        foreach ($trs as $tr){
//            $inner_trs .= '  <tr class="item-row">
//
//
//            <td align="left">'.date( $config['df'], strtotime($tr['date'])).'</td>
//            <td align="left">'.$tr['account'].'</td>
//            <td align="left">'.$tr['description'].'</td>
//            <td align="right"><span class="price">'.number_format($tr['amount'],2,$config['dec_point'],$config['thousands_sep']).'</span></td>
//        </tr>';
//        }
//
//
//        $tblhtml .= '
//<table width="100%" bgcolor="#ccc" cellspacing="1" cellpadding="1" border="0">
//    <tr height="30" bgcolor="#efefef" style="font-weight:bold;text-align:center;">
//        <td width="70%">Item</td>
//        <td width="10%">Price</td>
//        <td width="10%">Qty</td>
//        <td width="10%">Total</td>
//    </tr>'.$inner_trs;
//    }



$pdf->writeHTML($tblhtml, true, false, false, false, '');

$pdf->Ln(5);

# Notes
if (($d['notes']) != '') {
    $pdf->Ln(5);
    $pdf->SetFont('freesans', '', 8);
    $pdf->MultiCell(170, 5, 'Notes' . ": " . $d['notes']);
}

# Generation Date
$pdf->SetFont('freesans', '', 8);
$pdf->Ln(5);
$pdf->Cell(180, 4, 'PDF Generated on ' . date( $config['df'], time()), '', '', 'C');
$endpage = $pdf->GetPage();
$pdf->setPage($startpage);
# Payment Status

$status = $d['status'];
$pdf->SetXY(85, $addressypos);
if ($status == "Cancelled") {
    $statustext = 'Cancelled';
    $pdf->SetTextColor(245, 245, 245);
} elseif ($status == "Unpaid") {
    $statustext = 'Unpaid';
    $pdf->SetTextColor(204, 0, 0);
}

elseif ($status == "Partially Paid") {
    $statustext = 'Partially Paid';
    $pdf->SetTextColor(204, 0, 0);
}

elseif ($status == "Paid") {
    $statustext = 'Paid';
    $pdf->SetTextColor(153, 204, 0);
} elseif ($status == "Refunded") {
    $statustext = 'Refunded';
    $pdf->SetTextColor(34, 68, 136);
} elseif ($status == "Collections") {
    $statustext = 'Collections';
    $pdf->SetTextColor(255, 204, 0);
}
$pdf->SetFont('freesans', 'B', 40);
$pdf->Cell(110, 20, strtoupper($statustext), 0, 0, 'C');