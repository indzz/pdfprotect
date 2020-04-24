<?php
require_once "./vendor/autoload.php";

class MyPdf extends \setasign\Fpdi\Tcpdf\Fpdi {
    public function Header()
    {
        // empty
    }

    public function Footer() {
        // empty
    }

    public function importFile($file) {
        $pages = $this->SetSourceFile($file);
        for ($page = 1; $page <= $pages; $page++) {
            $pageId = $this->ImportPage($page);
            $s = $this->getTemplatesize($pageId);
            $this->AddPage($s['orientation'], $s);
            $this->useImportedPage($pageId);
        }
    }
}

$pdf = new MyPdf();
$pdf->importFile(__DIR__.'/input/1.pdf');
$pdf->SetProtection([], '123456');


$pdf->Output();