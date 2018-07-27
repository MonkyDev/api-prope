<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Motivo;

use Symfony\Component\HttpFoundation\Response;

class MotivosController extends Controller
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
        $motv = Motivo::All();
        return view('reasons/table', array('motivo' => $motv));
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
          'desc_motv' => 'required|string|max:255',
          'dias' => 'required|integer|min:1',
        ]);

        $save = Motivo::create([
            'desc_motv' => trim(htmlentities( $request->input('desc_motv') )),
            'dias' => trim(htmlentities( $request->input('dias') )),
        ]);

        if ($save)
            return redirect()->route('reasons.index')->with(array('code'=>200));
        else
            return redirect()->route('reasons.index')->with(array('code'=>302));
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
            //cuando el valor es nulo
            return view('reasons/new-update', array('title' => 'Nuevo'));
        else:
            $doc = Motivo::find($id);
            return view('reasons/new-update', array('title' => 'Actualizar datos del', 'motivo' => $doc));
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
          'desc_motv' => 'required|string|max:255',
          'dias' => 'required|integer|min:1',
        ]);

        $mtv = Motivo::findOrFail($id);
        $mtv->desc_motv = trim(htmlentities( $request->input('desc_motv') ));
        $mtv->dias = trim(htmlentities( $request->input('dias') ));

        if ($mtv->save())
            return redirect()->route('reasons.index')->with(array('code'=>200));
        else
            return redirect()->route('reasons.index')->with(array('code'=>302));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $mtv = Motivo::findOrFail($id);
        if ($mtv->delete())
            return redirect()->route('reasons.index')->with(array('code'=>200));
        else
            return redirect()->route('reasons.index')->with(array('code'=>302));
    }
}
