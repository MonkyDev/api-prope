<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Prestacion;
use App\Motivo;
use App\Documento;
use App\Observacion;


class SeguimientosController extends Controller
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


    public function index()
    {
    	$full_datas = DB::table('tbl_prestaciones AS PRE')
            ->join('users AS USR', 'USR.id', '=', 'PRE.fk_trabajador_entrega')
            ->join('cat_motivos AS MTV', 'MTV.id', '=', 'PRE.fk_motivo')
            ->join('cat_status AS STU', 'STU.id', '=', 'PRE.fk_status')
            ->select('PRE.id AS id_pre','PRE.*','USR.*','MTV.*','STU.*')
            ->where('PRE.fk_status', '<>', 3)
            ->get();
    	return view('/seguimient', array('title' => 'Seguimiento a los prestamos', 'prestamos' => $full_datas));
    }

    public function getObvs(Request $request, $id)
    { 
      $msg='default';
      $status='default';
      $code='default';


      if ( $request->ajax() ):

        $validator = \Validator::make($request->all(), [
            'desc_obsv' => 'required|string|max:255|regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ0-9_.,() ]+$/'
        ]);

        if ( !$validator->fails() ) {
            
            $save = DB::table('tbl_observaciones')->insert([
                'desc_obsv' => trim(htmlentities( $request->input('desc_obsv') )),
                'fk_prestamo' => trim(htmlentities( $id )),
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  #\Datetime()
            ]);
            if( $save ){
              $msg = '¡El registro se ha guardado satisfactoriamente!';
              $status = '_success';
              $code = 200;

            } else {
              $msg = '¡El registro no se ha podido guardar! => '. $save ;
              $status = '_fail';
              $code = 300;
            }

        } else {
          $msg = $validator->getMessageBag()->toArray();
          $status = '_fail';
          $code = 300;
        }

      else:
        abort(500); /*Abortamos la operacion mandando un error*/
      endif;

    return response()->json([ 'message' => $msg, 'status' => $status, 'code' => $code]);
    }

    public function allObvs(Request $request, $id){
      $msg='default';
      $status='default';
      $code='default';

      if ( $request->ajax() ):
        $observaciones = DB::table('tbl_observaciones')->where('fk_prestamo', $id)->get();
        $x=0;
        $body='';
        foreach ($observaciones as $ob) {
          $body .='
            <tr>
              <td>'.(++$x).'</td>
              <td>'.$ob->desc_obsv.'</td>
            </tr>
          ';
        }

        $msg = $body;
        $status = '_success';
        $code = 200;
      else :        
        abort(500); /*Abortamos la operacion mandando un error*/

      endif;
    return response()->json([ 'message' => $msg, 'status' => $status, 'code' => $code]);    
    }


    public function allDop(Request $request, $id){
      $msg='default';
      $status='default';
      $code='default';
      $x=0;
      $body='';

      if ( $request->ajax() ):
        $docs_prest = DB::table('rel_prestacion_documento AS RPD')
                      ->select('*')
                      ->join('cat_documentos AS TDC', 'TDC.id', '=', 'RPD.fk_documento')
                      ->where('RPD.fk_prestamo', $id)                      
                      ->get();
                      
        foreach ($docs_prest AS $dp) {
          $body .='
            <tr>
              <td>'.(++$x).'</td>
              <td>'.$dp->nomb_doc.'</td>
              <td>'.$dp->tipo_documento.'</td>
              <td>'.$dp->anotaciones.'</td>
            </tr>
          ';
        }

        $msg = $body;
        $status = '_success';
        $code = 200;
      else :        
        abort(500); /*Abortamos la operacion mandando un error*/

      endif;
    return response()->json([ 'message' => $msg, 'status' => $status, 'code' => $code]);    
    }


  public function finishPre($id){
    $pre = Prestacion::findOrFail($id);
    
    if ($pre->fk_status == 1) {
        $pre->fk_trabajador_recibe = Auth::user()->id;
        $pre->regresa = \Carbon\Carbon::now();
        $pre->fk_status = 3;

        if ($pre->save())
            return redirect()->route('seguimiento')->with(array('code'=>200));
        else
          return redirect()->route('seguimiento')->with(array('code'=>302));
    
    } else
        return redirect()->route('seguimiento')->with(array('code'=>304));
   
  }


}

 
// $fecha_salida = date_format($prestamo->salida, 'd/m/Y H:i:s');

/*$fecha = date('Y-m-j');
$nuevafecha = strtotime ( '+2 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
 
echo $fecha;

function dias_transcurridos($fecha_i, $fecha_f)
{
  $dias = (strtotime($fecha_i) - strtotime($fecha_f))/86400;
  $dias   = abs($dias); 
  $dias = floor($dias);   
  return $dias;
}
// Ejemplo de uso:
echo dias_transcurridos('2012-07-01','2012-07-18');
// Salida : 17*/
 
/*$fecha2 = $fch_salida;
$nuevafecha = strtotime ( '+'.$prestamo->dias.' day' , strtotime ( $fecha2 ) ) ;
$fch_limite = date ( 'Y-m-j' , $nuevafecha );*/
