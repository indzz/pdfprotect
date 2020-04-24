<?php
header('Content-Type: application/pdf');

// qpdf --encrypt [user_password] [owner_password] [key-length] --use-aes=y -- [input] [output]
$password = '123456';
echo shell_exec(sprintf("qpdf --encrypt %s 123456 128 --use-aes=y -- input/1.pdf -", escapeshellarg($password)));