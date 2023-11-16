<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService

{
    private $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
        $pdfOmtion = new Options();
        $pdfOmtion->set('defaultFont', 'Garamond');

        $this->dompdf->setOptions($pdfOmtion);

    }

    public function showPdf($html)
    {
            $this->dompdf->loadHtml($html);
            $this->dompdf->render();
            $this->dompdf->stream( "details.pdf", [
                'Attachement' => false
            ]);

    }

    public function generatePdf($html)
    {
         
        $this->dompdf->loadHtml($html);
        $this->dompdf->render();  
        $this->dompdf->output(); 
    }
}