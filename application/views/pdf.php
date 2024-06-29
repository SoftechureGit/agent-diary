<?php
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
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
$pdf->SetFont('arial', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


$tbl = <<<EOD
<h1>INVOICE</h1>
<table cellspacing="0" cellpadding="11" border="1">
    <tr>
        <td rowspan="3">COL 1 - ROW 1<br />COLSPAN 3</td>
        <td>COL 2 - ROW 1</td>
        <td>COL 3 - ROW 1</td>
    </tr>
    <tr>
        <td rowspan="2">COL 2 - ROW 2 - COLSPAN 2<br />text line<br />text line<br />text line<br />text line</td>
        <td>COL 3 - ROW 2</td>
    </tr>
    <tr>
       <td>COL 3 - ROW 3</td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//Change this according to where you want your document to be uploaded to
//$LocationOnServer = base_url('public/'); 

/*$FileNamePath = FCPATH.'/uploads/tmppdf/invoice'.time().'.pdf';

//Save the document to the server
$QuotationAttachment = $pdf->Output($FileNamePath, 'F');

//$pdf->Output('example_001.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+

$email_from = MAINEMAIL;
$email_to = MAINEMAIL;
$subject = "Test Mail";
$email_subject = $subject;
$email_msg = "Test Message";//$this->load->view('email/invoice_create',$data,true);

$this->email->from($email_from, SITE_TITLE);
$this->email->to($email_to);
$this->email->subject($email_subject);
$this->email->message($email_msg);
$this->email->set_mailtype("html");
$this->email->attach($FileNamePath);
$this->email->send();*/

//unlink($FileNamePath);
