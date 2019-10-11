<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfReport extends Controller
{
    public function pdf($value='')
    {
    	$pdf = \App::make('dompdf.wrapper');
     	$pdf->loadHTML("<p>Hello</p>");
     	return $pdf->stream();
    }

    public function getDownload($file_name){
    $file = public_path()."/documents/".$file_name;
    echo $file;
    exit();
    $headers = array('Content-Type: application/*',);
    return \Response::download($file,$file_name,$headers);
}

}
