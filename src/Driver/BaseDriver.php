<?php
namespace INDZZ\PdfProtector\Driver;

use Symfony\Component\HttpFoundation\Response;

abstract class BaseDriver {
    protected $source;

    const DEFAULT_DOC_NAME = 'file.pdf';

    public abstract function source($file);

    public abstract function protect($userPw, $ownerPw);

    public abstract function output($file = null);

    public abstract function response($file = null) : Response;

    protected function contentToResponse($content, $fileName) : Response {
        return new Response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => sprintf('inline; filename="%s"', $fileName),
        ]);
    }

    public abstract function save($file);

}
