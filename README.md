UthandoDomPdf
============

[![Build Status](https://travis-ci.org/uthando-cms/uthando-dompdf.svg?branch=master)](https://travis-ci.org/uthando-cms/uthando-dompdf)
[![Test Coverage](https://codeclimate.com/github/uthando-cms/uthando-dompdf/badges/coverage.svg)](https://codeclimate.com/github/uthando-cms/uthando-dompdf/coverage)
[![Code Climate](https://codeclimate.com/github/uthando-cms/uthando-dompdf/badges/gpa.svg)](https://codeclimate.com/github/uthando-cms/uthando-dompdf)
[![Dependency Status](https://www.versioneye.com/user/projects/55ed90c2211c6b0019001aa2/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55ed90c2211c6b0019001aa2)
[![Packagist](https://img.shields.io/packagist/v/uthando-cms/uthando-dompdf.svg)](https://packagist.org/packages/uthando-cms/uthando-dompdf)

This project is based on https://github.com/raykolbe/DOMPDFModule.
I have adapted it for Uthando CMS but it can be used independently. The UthandoDomPdf module integrates the DOMPDF library with Zend Framework 2 with minimal
effort on the consumer's end.

## Requirements
  - [Zend Framework 2](http://www.github.com/zendframework/zf2)

## Installation
Installation of UthandoDomPdf uses PHP Composer. For more information about
PHP Composer, please visit the official [PHP Composer site](http://getcomposer.org/).

#### Installation steps

  1. `cd my/project/directory`
  2. create a `composer.json` file with following contents:

     ```json
     {
         "require": {
             "uthando-cms/uthando-dompdf": "2.*"
         }
     }
     ```
  3. install PHP Composer via `curl -s http://getcomposer.org/installer | php` (on windows, download
     http://getcomposer.org/installer and execute it with PHP)
  4. run `php composer.phar install`
  5. open `my/project/directory/config/application.config.php` and add the following key to your `modules`: 

     ```php
     'UthandoDomPdf',
     ```
#### Configuration options
You can override options via the `uthando_dompdf` key in your local or global config files. See UthandoDomPdf/config/module.config.php.dist for config options.

## Usage

```php
<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use UthandoDomPdf\View\Model\PdfModel;

class ReportController extends AbstractActionController
{
    public function monthlyReportPdfAction()
    {
        $pdf = $this->getServiceLocator()->get('PdfModel');
        
        $pdf->getPdfOptions()->setFilename('monthly-report'); // Triggers PDF download, automatically appends ".pdf"
        $pdf->getPdfOptions()->setPaperSize('a4'); // Defaults to "8x11"
        $pdf->getPdfOptions()->setPaperOrientation('landscape'); // Defaults to "portrait"
        
        // set footer/header on every page, this is an array of arrays. Each array represents one line of text
        // to set header lines use the setHeaderLines() method
        $pdf->getPdfOptions()->setFooterLines([
            [
                'text'      => 'top line', // text to print
                'position'  => 'center', // alignment of text can be center, left or right
                'font' => [
                    'family'    => 'Helvetica', // font family
                    'weight'    => 'normal', // font weight can be normal, bold, italic or bold_italic
                    'size'      => 8, // size of font in pt
                ],
            ],
        ]);
        
        // example showing how to set header lines
        $pdf->getPdfOptions()->setHeaderLines([
            [
                'text'      => 'top line', // text to print
                'position'  => 'center', // alignment of text can be center, left or right
                'font' => [
                    'family'    => 'Helvetica', // font family
                    'weight'    => 'normal', // font weight can be normal, bold, italic or bold_italic
                    'size'      => 8, // size of font in pt
                ],
            ],
        ]);
        
        // To set view variables
        $pdf->setVariables(array(
          'message' => 'Hello'
        ));
        
        return $pdf;
    }
}
```

## Admin Settings and Configuration
There is an admin setting page. It's not enabled by default. If you are using [UthandoAdmin](https://github.com/uthando-cms/uthando-admin) you can enable the routes, navigation and acl rules 
by adding
    
```php
'load_uthando_configs' => true,
```
    
to you global config in `config/autoload/global.php` and add
    
```json
{
    "require": {
        "uthando-cms/uthando-admin": "1.*"
    }
}
```

to your composer.json file then do and `php composer.phar update` to update your dependencies.
 
If you are not using the [UthandoAdmin](https://github.com/uthando-cms/uthando-admin) module you can still use the settings page but must configure the routes, navigation and acl rules manually,
 please not that if you do not have any authentication checks then the settings page will be available to the public. You can use the files in config
 folder as a basis to set up the admin page.
 
The Admin settings page also requires that you have [Twitter Bootstrap 3](http://getbootstrap.com) and [JQuery](https://jquery.com) enabled in your layout template.
 
You can also manually setup the options by copying `config/module.config.php.dist` to your `config\autoload` folder and renaming it to `uthando-dompdf.local.php`.

## Contributing
If you like to help improve this module please clone the repository and send me a pull request, please also include unit tests for the changes/additions
 you make.

## To-do
  - Add command line support.
