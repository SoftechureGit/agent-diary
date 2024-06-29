<?php

function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
$size = array();
$pdf = new TCPDF("P", PDF_UNIT, $size, true, 'UTF-8', false);


$pdf->SetTitle('Receipt');

/*$path = echo base_url('public/');
$fontname = TCPDF_FONTS::addTTFfont($path, 'TrueTypeUnicode', '', 96);
$pdf->SetFont($fontname, '', 14, '', false);*/

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set default header data
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(8, 8, 8);//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(false);
$pdf->SetFooterMargin(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, false);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$monthly_cost = ($invoice_detail->monthly_cost>0)?"Rs.".str_replace(".00", "", $invoice_detail->monthly_cost):"";

$amount_per_user = ($invoice_detail->amount_per_user)?"Rs.".str_replace(".00", "", $invoice_detail->amount_per_user):"";

$total_amount = ($invoice_detail->total_amount)?"Rs.".str_replace(".00", "", $invoice_detail->total_amount):"";

$amount_per_user_net = $invoice_detail->amount_per_user * $invoice_detail->no_of_user;
$amount_per_user_net = "Rs.".$amount_per_user_net;
$monthly_cost_record = ($invoice_detail->monthly_cost>0)?'<tr>
        <td align="center"><span style="font-size:14px;font-weight:normal;color:;">2</span></td>
        <td><span style="font-size:14px;font-weight:normal;color:#222222c7;"><span>Monthly Charges</span><br><span>Period From '.$invoice_detail->current_plan_date.' to '.$invoice_detail->next_due_date.'</span></span></td>
        <td align="center"><span style="font-size:14px;font-weight:normal;color:;">'.$monthly_cost.'</span></td>
    </tr>':"";

$amount_words = ucwords(getIndianCurrency($invoice_detail->total_amount));
$invoice_address = nl2br($setting->invoice_address);

$base_url = base_url("terms-and-conditions");
$address = $invoice_detail->address;

$where = "state_id='".$invoice_detail->state."'";
$state_detail = $this->Action_model->select_single('tbl_states',$where);

$where = "city_id='".$invoice_detail->city."'";
$city_detail = $this->Action_model->select_single('tbl_city',$where);

$address .= ($state_detail && $state_detail->state_name)?", ".$state_detail->state_name:"";
$address .= ($city_detail && $city_detail->city_name)?", ".$city_detail->city_name:"";
$logo = base_url('public/front/images/logo.png');
$tbl = <<<EOD
<br>
<table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
    <tr>
        <td style="width:60%;"><div><img src="$logo" style="height:110px;" ></div><span style="font-size:20px;">$setting->invoice_company_name</span><br><span style="font-size:14px;color:#222222c7;">$invoice_address</span>
        <br><br><span style="font-size:14px;" align="center">Bill To</span><br><span style="font-size:14px;font-weight:normal;color:#222222c7;">$invoice_detail->name<br>$address<br>$invoice_detail->email<br>$invoice_detail->mobile</span>
        </td>
        <td style="background-color:;width:40%;"><h1 align="center">INVOICE</h1><span style="font-size:14px;font-weight:normal;"><span style="color:#222222c7;">Invoice Id:</span> <span style='color:red;'>$invoice_detail->invoice_id</span><br><span style="color:#222222c7;">Invoice Date:</span> <span style='color:red;'>$invoice_detail->invoice_date</span><br><span style="color:#222222c7;">Customer Id:</span> <span style='color:red;'>$invoice_detail->user_id</span><br><span style="color:#222222c7;">Status:</span> <span style='color:red;'>Paid</span>
        </span>
        </td>
    </tr>
</table>
<br><br>
<table cellspacing="0" cellpadding="11" border="1">
    <tr>
        <td style="width:15%" align="center">Sr. No</td>
        <td style="width:65%">Description</td>
        <td style="width:20%" align="center">Amount</td>
    </tr>
    <tr>
        <td align="center"><span style="font-size:14px;font-weight:normal;color:;">1</span></td>
        <td><span style="font-size:14px;font-weight:normal;color:#222222c7;"><span>Subscription Charges</span><br><span>Period From $invoice_detail->current_plan_date to $invoice_detail->next_due_date</span><br><span>No. Of User $invoice_detail->no_of_user @ $amount_per_user Per user</span></span></td>
        <td align="center"><span style="font-size:14px;font-weight:normal;color:;">$amount_per_user_net</span></td>
    </tr>
    $monthly_cost_record

</table>
<br><br><br>
<table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
    <tr>
        <td style="width:70%;"><span style="font-size:14px;"></span>
        </td>
        <td style="background-color:;width:15%;"><span style="font-size:14px;font-weight:normal;color:#222222c7;">Total: </span>
        </td>
        <td style="background-color:;width:15%;text-align:right;"><span style="font-size:14px;font-weight:normal;color:#000;">$total_amount</span>
        </td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
    <tr>
        <td style="width:70%;"><span style="font-size:14px;"></span>
        </td>
        <td style="background-color:;width:15%;"><span style="font-size:14px;font-weight:normal;color:#222222c7;">Payments: </span>
        </td>
        <td style="background-color:;width:15%;text-align:right;"><span style="font-size:14px;font-weight:normal;color:#000;">$total_amount</span>
        </td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
    <tr>
        <td style="width:70%;"><span style="font-size:14px;"></span>
        </td>
        <td style="background-color:;width:15%;"><span style="font-size:14px;font-weight:normal;color:#222222c7;">Amount Due: </span>
        </td>
        <td style="background-color:;width:15%;text-align:right;"><span style="font-size:14px;font-weight:normal;color:#000;">Rs.0</span>
        </td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
    <tr>
        <td colspan="2"><br><br>
        <br>
        <span style="font-size:14px;font-weight:normal;color:#222222c7;">Payments</span><br>
        <span style="font-size:14px;font-weight:normal;color:#222222c7;"><b>$total_amount</b> was paid on <b>$invoice_detail->receipt_date</b> By $invoice_detail->paid_type_name Thru Ref No. $invoice_detail->txn_id</span>
        
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center"><br><br>
        <span style="font-size:12px;font-weight:normal;color:#222222c7;">This is Computer Generated Statment Signature Not Required</span>
        
        </td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.

//Change this according to where you want your document to be uploaded to
//$LocationOnServer = base_url('public/'); 

if ($this->input->get('view')==1) {
    $pdf->Output('Receipt'.time().'.pdf', 'I');
}
else if (isset($pdf_send_mail)) {
   
$FileNamePath = FCPATH.'/uploads/tmppdf/Receipt-'.time().'.pdf';

//Save the document to the server
$QuotationAttachment = $pdf->Output($FileNamePath, 'F');

//$pdf->Output('example_001.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+

$this->email->from($email_from, SITE_TITLE);
$this->email->to($email_to);
$this->email->subject($email_subject);
$this->email->message($email_msg);
$this->email->set_mailtype("html");
$this->email->attach($FileNamePath);
$this->email->send();

//unlink($FileNamePath);

}
else {
$pdf->Output('Receipt-'.time().'.pdf', 'D');
}
