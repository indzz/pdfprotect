# PDF Protection
One of the requirements of the project is to add a password protection to the uploaded file. The workflow is:
1. CMS user uploads a PDF file in the CMS
2. When a visitor clicks the download button, he/she will be asked to set a password to the file
3. The system runs the script to add password encryption to the PDF
4. The system returns the encrypted file to the browser

## Solution 1
The first solution requires PHP only. 

It uses FPDI to import all pages of the source PDF and add each page to a new file. Then, it outputs the file binary as a response.

Advantage:
* PHP Only, no extra library needed

Disadvantage:
* PDF version 1.5 or above is not supported, due to the limitation of the free PDF parser
  
## Solution 2
The second solution uses QPDF, which is a command line program. The solution simply calls `shell_exec` to execute QPDF and add the password.

Advantage:
* Simple
* Supports PDF version 1.5

Disadvantage:
* Requires extra library installed on the system