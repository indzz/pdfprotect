# PDF Protection
This is a PHP wrapper library to add password encryption to an existing PDF file.

## Driver 1 - FPDI
The first solution requires PHP only. 

It uses FPDI to import all pages of the source PDF and add each page to a new file. Then, it outputs the file binary as a response.

Advantage:
* PHP Only, no extra library needed

Disadvantage:
* PDF version 1.5 or above is not supported, due to the limitation of the free PDF parser

Please be reminded to add the following packages to composer.json before you use this driver:
```json
{
  "require": {
    "setasign/fpdi": "^2.0",
    "tecnickcom/tcpdf": "6.3.*"  
  }
}
```

## Driver 2 - QPDF
The second solution uses QPDF, which is a command line program. The solution simply calls `shell_exec` to execute QPDF and add the password.

Advantage:
* Simple
* Supports PDF version 1.5

Disadvantage:
* Requires extra library installed on the system

For macOS, you may install QPDF with Homebrew:
```bash
brew install qpdf
```

For Ubuntu, you may install with apt:
```bash
apt-get install -y qpdf
```
If you are using other Linux distribution, please refer to the corresponding package repository. 

## Example
The simplest usage is:
```php
<?php
use INDZZ\PdfProtector\PdfProtector;

PdfProtector::create('fpdi')
    ->source(__DIR__.'/input/1.pdf')
    ->protect('userPw', 'ownerPw')
    ->output();
```

See `example` folder for more details
* Directly output to web browser - [1-output.pdf](./example/1-output.php)
* Save to a path on the server-side - [2-save.pdf](./example/2-save.php)
* Return a Symfony HTTP Foundation Response object - [3-response.pdf](./example/3-response.php)

# License
This library is open-sourced under [the MIT license](LICENSE.md).

Please also refer to the license of the 
* FPDI: https://github.com/Setasign/FPDI/blob/master/LICENSE.txt
* TCPDF: https://github.com/tecnickcom/TCPDF/blob/master/LICENSE.TXT
* QPDF: https://github.com/qpdf/qpdf#copyright-license