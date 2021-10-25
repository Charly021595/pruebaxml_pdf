<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use PDF;

use App\Models\User;

class PDFController extends Controller
{
    public function createPDF(){
        //Recuperar todos los productos de la db
        $users = User::all();
        view()->share('usuarios', $users);
        $nombre_archivo = time().'prueba.pdf';

        $usuarios = [
            'usuarios' => $users
        ];
    
        $pdf = PDF::loadView('pdf.index', $usuarios)
            ->save(storage_path('app/public/'.$nombre_archivo));

        return $pdf->download($nombre_archivo);
    }
}
