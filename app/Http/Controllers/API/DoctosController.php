<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Documento;

use Symfony\Component\HttpFoundation\Response;

class DoctosController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Metodo de entrada
        $docs = Documento::All();
        return view('documents/documents', array('doctos' => $docs));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validamos los datos nuevos a guardar
        $validatedData = $request->validate([
          'nomb_doc' => 'required|string|max:255',
        ]);

        $save = Documento::create([
            'nomb_doc' => trim(htmlentities( $request->input('nomb_doc') )),
        ]);

        if ($save)
            return redirect()->route('documents.index')->with(array('code'=>200));
        else
            return redirect()->route('documents.index')->with(array('code'=>302));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Vista de Manipulacion de los datos
        //Validamos el valor del id para saber cuando esta vacio
        if ( !is_numeric($id) ): 
            //cuando el valor el nulo
            return view('documents/document', array('title' => 'Nuevo'));
        else:
            $doc = Documento::find($id);
            return view('documents/document', array('title' => 'Actualizar datos del', 'docto' => $doc));
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validamos los datos a modificar
        $validatedData = $request->validate([
          'nomb_doc' => 'required|string|max:255',
        ]);

        $doc = Documento::findOrFail($id);
        $doc->nomb_doc = trim(htmlentities( $request->input('nomb_doc') ));

        if ($doc->save())
            return redirect()->route('documents.index')->with(array('code'=>200));
        else
            return redirect()->route('documents.index')->with(array('code'=>302));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc = Documento::findOrFail($id);
        if ($doc->delete())
            return redirect()->route('documents.index')->with(array('code'=>200));
        else
            return redirect()->route('documents.index')->with(array('code'=>302));
    }
}
