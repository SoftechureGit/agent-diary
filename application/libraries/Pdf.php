<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/TCPDF-master/tcpdf.php';
	//		require_once APPPATH."/tcpdf/tcpdf.php";


class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}
