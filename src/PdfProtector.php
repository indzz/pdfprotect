<?php
namespace INDZZ\PdfProtector;

use INDZZ\PdfProtector\Driver\FpdiDriver;
use INDZZ\PdfProtector\Driver\QpdfDriver;

class PdfProtector {
    public static function create($driver = 'fpdi')
    {
        $map = [
            'fpdi' => FpdiDriver::class,
            'qpdf' => QpdfDriver::class,
        ];

        if (!isset($map[$driver]))
            throw new \Exception("Driver {$driver} is not defined");

        $class = $map[$driver];
        return new $class();
    }
}