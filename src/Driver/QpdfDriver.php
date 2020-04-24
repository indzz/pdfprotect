<?php
namespace INDZZ\PdfProtector\Driver;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class QpdfDriver extends BaseDriver {
    protected $userPw;
    protected $ownerPw;

    public function source($file) {
        $this->source = $file;
        return $this;
    }

    public function protect($userPw, $ownerPw)
    {
        $this->userPw = $userPw;
        $this->ownerPw = $ownerPw;
        return $this;
    }

    protected function exec($output = '-') {
        return shell_exec(
            sprintf(
                "qpdf --encrypt %s %s 128 --use-aes=y -- %s %s",
                escapeshellarg($this->userPw),
                escapeshellarg($this->ownerPw),
                escapeshellarg($this->source),
                $output
            )
        );
    }

    public function output($file = null)
    {
        header('Content-Type: application/pdf');
        echo $this->exec();
    }

    public function response($file = null): Response
    {
        $fileName = $file ?: static::DEFAULT_DOC_NAME;
        return $this->contentToResponse($this->exec(), $fileName);
    }

    public function save($file)
    {
        return $this->exec($file);
    }
}
