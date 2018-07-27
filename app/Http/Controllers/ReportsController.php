<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\Motivo;

class ReportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uno(){
        $docs = Documento::All();
        return view('documents/reports/codigos_barras', array('doctos' => $docs));
    }

    public function dos(){
        $mots = Motivo::All();
        return view('reasons/reports/codigos_barras', array('motivos' => $mots));
    }
}
