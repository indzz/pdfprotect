<?php
namespace INDZZ\PdfProtector\Driver;

use setasign\Fpdi\Tcpdf\Fpdi;

use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\Filter\FilterException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\StreamReader;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use setasign\Fpdi\PdfReader\PdfReaderException;

class FpdiPdf extends Fpdi {
    public function Header()
    {
        // empty
    }

    public function Footer() {
        // empty
    }

    /**
     * @param string|resource|StreamReader $file
     *
     * @throws CrossReferenceException
     * @throws FilterException
     * @throws PdfParserException
     * @throws PdfTypeException
     * @throws PdfReaderException
     */
    public function importFile($file) {
        $totalPages = $this->SetSourceFile($file);
        for ($page = 1; $page <= $totalPages; $page++) {
            $pageId = $this->ImportPage($page);
            $s = $this->getTemplatesize($pageId);
            $this->AddPage($s['orientation'], $s);
            $this->useImportedPage($pageId);
        }
    }
}
