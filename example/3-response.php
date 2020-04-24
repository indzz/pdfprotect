<?php
use INDZZ\PdfProtector\PdfProtector;

require_once "../vendor/autoload.php";

PdfProtector::create('fpdi')  // or `qpdf`
    ->source(__DIR__.'/input/1.pdf')
    ->protect('userPw', 'ownerPw')
    ->response(__DIR__.'/test.pdf')
    ->send();