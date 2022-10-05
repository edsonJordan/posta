<?php

namespace App\Http\Controllers;

use App\Models\{Citas, Diagnostico, Empresa};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    public function receta($cita)
    {
        $recetas = Citas::whereId($cita)->with(['paciente', 'medico', 'diagnostico', 'diagnostico.recetas'])->first();
        $empresa = Empresa::first();
        $ruta = public_path() . '/uploads/logos/' . $empresa->logo;

        $qrcode = base64_encode(QrCode::format('svg')->size(75)->errorCorrection('H')->generate( URL::current()));
        $pdf = \PDF::loadView('pdfs.receta', compact('recetas', 'ruta', 'empresa', 'qrcode'));

        // return $pdf->download( 'Receta - Paciente: ' . $recetas->paciente->name .' '. $recetas->paciente->last_name . '.pdf');
        return $pdf->stream('Pagina.pdf');
    }
    public function recetaDownload($cita)
    {
        $recetas = Citas::whereId($cita)->with(['paciente', 'medico', 'diagnostico', 'diagnostico.recetas'])->first();
        $empresa = Empresa::first();
        $ruta = public_path() . '/uploads/logos/' . $empresa->logo;

        $qrcode = base64_encode(QrCode::format('svg')->size(75)->errorCorrection('H')->generate( URL::current()));
        $pdf = \PDF::loadView('pdfs.receta', compact('recetas', 'ruta', 'empresa', 'qrcode'));
        
        return $pdf->download( 'Receta - Paciente: ' . $recetas->paciente->name .' '. $recetas->paciente->last_name . '.pdf');
        
    }

    public function diagnostico($cita)
    {
        $recetas = Citas::whereId($cita)->with(['paciente', 'medico', 'servicio', 'diagnostico', 'diagnostico.recetas'])->first();
        $empresa = Empresa::first();
        $ruta = public_path() . '/uploads/logos/' . $empresa->logo;
        //return view('pdfs.diagnostico', compact('recetas', 'ruta', 'empresa'));

        $qrcode = base64_encode(QrCode::format('svg')->size(140)->errorCorrection('H')->generate( URL::current()));

        $pdf = \PDF::loadView('pdfs.diagnostico', compact('recetas', 'ruta', 'empresa', 'qrcode'));

        // return $pdf->download('Diagnostico - Paciente: ' . $recetas->paciente->name . ' ' . $recetas->paciente->last_name . '.pdf');
        return $pdf->stream('Pagina.pdf');
    }
    public function diagnosticoDownload($cita)
    {
        $recetas = Citas::whereId($cita)->with(['paciente', 'medico', 'servicio', 'diagnostico', 'diagnostico.recetas'])->first();
        $empresa = Empresa::first();
        $ruta = public_path() . '/uploads/logos/' . $empresa->logo;
        //return view('pdfs.diagnostico', compact('recetas', 'ruta', 'empresa'));

        $qrcode = base64_encode(QrCode::format('svg')->size(140)->errorCorrection('H')->generate( URL::current()));

        $pdf = \PDF::loadView('pdfs.diagnostico', compact('recetas', 'ruta', 'empresa', 'qrcode'));
        return $pdf->download('Diagnostico - Paciente: ' . $recetas->paciente->name . ' ' . $recetas->paciente->last_name . '.pdf');
       
    }
    public function prueba($cita)
    {
        /* $recetas = Citas::whereId($cita)->with(['paciente', 'medico', 'servicio', 'diagnostico', 'diagnostico.recetas'])->first();
        return response()->json($recetas); */
        return QrCode::generate('Make me into a QrCode!');
    }
}
