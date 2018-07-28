<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Symfony\Component\HttpFoundation\Response;

use Session;


class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
      $message=$code=null;

      $FlagEntry = Session::has('CheckVencidos') ? Session::get('CheckVencidos') : null;

      if ($FlagEntry == null) {
        $prestamos = \DB::table('tbl_prestaciones')
                  ->select('id','dias_permitidos','salida')
                  ->where('fk_status', 1)->get();

        foreach ($prestamos as $pre) :
          $dias_postCurrent = \FormatDate::DiffDiasBetweenTwoDates($pre->salida,'');
            if ($dias_postCurrent <= $pre->dias_permitidos)
            {
              $code = 304;
              $message = 'No se hicieron cambios en las fechas de los Prestamos...';
            }
            else
            {
              $save = \DB::table('tbl_prestaciones')
                      ->where('id', $pre->id)
                      ->update(['fk_status' => 2]);
              if ($save) {                
                $code = 201;
                $message = 'Al dia de hoy se encontraron vencidos y se hicieron cambios...';
              }else{
                $code = 302;
                $message = '!Error al guardar los datos¡';
              }
            }
        endforeach;
        Session::put('CheckVencidos', 777);
      }
        

    return view('home', array('message' => $message, 'code'=> $code));
    }


    public function searchPrestamo(Request $request){

      $validatedData = $request->validate([
        'usr_search' => 'string|max:255',
      ]);

      $txt_search = htmlentities(trim($request->input('usr_search')));


      $prestador = \DB::table('tbl_prestaciones AS PRE')
            ->where('PRE.dni', 'LIKE', '%'.$txt_search.'%')
            ->where('PRE.fk_status',3)
            ->get();
     
      return view('search/search', array('title'=>'Lista de resultados de la búsqueda...', 'prestador' => $prestador));
    }

    public function getPrestamoInfo($id){
      $full_datas = \DB::table('tbl_prestaciones AS PRE')
            ->join('users AS USR', 'USR.id', '=', 'PRE.fk_trabajador_entrega')
            ->leftJoin('users AS UER', 'UER.id', '=', 'PRE.fk_trabajador_recibe')
            ->join('cat_motivos AS MTV', 'MTV.id', '=', 'PRE.fk_motivo')
            ->join('cat_status AS STU', 'STU.id', '=', 'PRE.fk_status')
            ->select('PRE.id AS id_pre','PRE.*','UER.nombres AS TrabajadorRecibe','USR.nombres AS TrabajadorEntrega','MTV.*','STU.*')
            ->where('PRE.id',$id)
            ->get();
    //dd($full_datas);
    return view('search/request', array('title'=>'El prestador a encontrar...', 'prestamos' => $full_datas));
    }
}
