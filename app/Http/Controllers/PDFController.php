<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        // Genera el PDF usando Dompdf y devuelve una respuesta para descargar.
        $pdf = PDF::loadView('Reportes.HorarioPDF');
        $pdf->download('mi_archivo.pdf');
        $pdf->stream();
    }

}
