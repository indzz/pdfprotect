<?php
namespace INDZZ\PdfProtector\Driver;

use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\Filter\FilterException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use setasign\Fpdi\PdfReader\PdfReaderException;
use Symfony\Component\HttpFoundation\Response;

class FpdiDriver extends BaseDriver {
    protected $pdf;

    public function __construct()
    {
        $this->pdf = new FpdiPdf();
    }

    /**
     * @param $file
     * @return FpdiDriver
     * @throws CrossReferenceException
     * @throws FilterException
     * @throws PdfParserException
     * @throws PdfTypeException
     * @throws PdfReaderException
     */
    public function source($file) {
        $this->pdf->importFile($file);
        return $this;
    }

    public function protect($userPw, $ownerPw)
    {
        $this->pdf->SetProtection([], $userPw, $ownerPw);
        return $this;
    }

    public function output($file = null)
    {
        return $this->pdf->Output($file ?: static::DEFAULT_DOC_NAME, 'I');
    }

    public function response($file = null): Response
    {
        $fileName = $file ?: static::DEFAULT_DOC_NAME;
        return $this->contentToResponse($this->pdf->Output($fileName, 'S'), $fileName);
    }

    public function save($file)
    {
        return $this->pdf->Output($file, 'F');
    }
}
