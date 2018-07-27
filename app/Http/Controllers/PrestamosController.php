<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Prestacion;
use App\Motivo;
use App\Documento;
use Session;

use Symfony\Component\HttpFoundation\Response;

class PrestamosController extends Controller
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


    public function index(){
        $documentos = Documento::get();
        $motivos = Motivo::get();
    	return view('/prestar', compact('documentos', 'motivos'));
    }


    /*public function getStore(Request $request){

			//Validamos los datos que llegan por post
      $validatedData = $request->validate([
        'dni' => 'required|numeric|min:4',
        'clave_documento' => 'required|numeric',
        'clave_motivo' => 'required|numeric',
        'tipo_documento' => 'required|string|max:15',
        'anotaciones' => 'string|max:255',
      ]);

      //Limpiar la clave del documento y motivo
      $id_doc = str_replace(7, '', $request->input('clave_documento'));
      $id_mtv = str_replace(8, '', $request->input('clave_motivo'));

      //Buscar los datos del documento y motivo
     	$datas_doc = Documento::find($id_doc);
     	$datas_mtv = Motivo::find($id_mtv);

     	//Creamos el arreglo para los documentos que irá almacenando los items
     	if (!is_null($datas_doc) && !is_bool($datas_mtv) )
     		$this->addItem(html_entity_decode($datas_doc->nomb_doc), $request->input('tipo_documento'), $request->input('anotaciones'), $datas_doc->id);
     	else
     		return redirect()->route('prestar')->with('code', 303);

     	//Creamos el arreglo de los datos de la tabla de prestaciones
     	$prestamo = Session::has('prestamo') ? Session::get('prestamo') : null;
     	if ( is_null($prestamo) ) {
     		if( strlen($request->input('dni')) > 5 ){
     			$type_clave = 'Estudiante';
                $dias_permitidos = $datas_mtv->dias;
            } else {
     			$type_clave = 'Trabajador';
                $dias_permitidos = 7;
            }

     		$array_prestamo = [
     			'dni' => $request->input('dni'),
     			'tipo_dni' => $type_clave,
                'fk_motivo' => $datas_mtv->id,
     			'dias_permitidos' => $dias_permitidos,
     		];
     		Session::put('prestamo', $array_prestamo);
     	}

     	return redirect()->route('prestar');
    }
*/
    public function getCreate(Request $request){
        $validatedData = $request->validate([
            'dni' => 'required|numeric|min:4',
            'documents' => 'required|array',
            'clave_motivo' => 'required|numeric',
            'tipo_documento' => 'required|string|max:15',
            'anotaciones' => 'string|max:255',
        ]);
        if ($validatedData) {
            $datas_mtv = Motivo::find( $request->input('clave_motivo') );
            if( strlen($request->input('dni')) > 5 ){
                $type_clave = 'Estudiante';
                $dias_permitidos = $datas_mtv->dias;
            } else {
                $type_clave = 'Trabajador';
                $dias_permitidos = 7;
            }

            $savePrestamo = Prestacion::create([
                'dni' => trim(htmlentities( $request->input('dni') )),
                'tipo_dni' => trim(htmlentities($type_clave )),
                'fk_motivo' => trim(htmlentities( $request->input('clave_motivo') )),
                'fk_trabajador_entrega' => Auth::user()->id,
                'dias_permitidos' => $dias_permitidos,
                'salida' => \Carbon\Carbon::now(),
            ]);
            if ($savePrestamo){
                foreach ( $request->input('documents') AS $doc) {
                    $saveDocumento = DB::table('rel_prestacion_documento')->insert([
                        'fk_prestamo' => $savePrestamo->id,
                        'fk_documento' => $doc,
                        'tipo_documento' => trim(htmlentities($request->input('tipo_documento'))),
                        'anotaciones' => trim(htmlentities($request->input('anotaciones'))),
                        "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                        "updated_at" => \Carbon\Carbon::now(),  #\Datetime()
                    ]);
                }
            }
            if ($saveDocumento)
                return redirect()->route('prestar')->with(array('code'=>200));
            else
                return redirect()->route('prestar')->with(array('code'=>302));
        }
        else
            return redirect()->route('prestar')->with('code', 303);

    }

   /* public function getCreateOld(Request $request){

        $prestamo = Session::has('prestamo') ? Session::get('prestamo') : null;
        $documentos = Session::has('rel_prestamo_doc') ? Session::get('rel_prestamo_doc') : null;
        //dd( $prestamo['dias_permitidos'] );
        if ( !is_null($documentos) && !is_null($prestamo) ) {
            $savePrestamo = Prestacion::create([
                'dni' => trim(htmlentities( $prestamo['dni'] )),
                'tipo_dni' => trim(htmlentities( $prestamo['tipo_dni'] )),
                'fk_motivo' => trim(htmlentities( $prestamo['fk_motivo'] )),
                'fk_trabajador_entrega' => Auth::user()->id,
                'dias_permitidos' => $prestamo['dias_permitidos'],
                'salida' => \Carbon\Carbon::now(),
            ]);
        if ($savePrestamo){
            //dd($savePrestamo);
            foreach ($documentos AS $doc) {
                $saveDocumento = DB::table('rel_prestacion_documento')->insert([
                    'fk_prestamo' => $savePrestamo->id,
                    'fk_documento' => $doc['id_doc'],
                    'tipo_documento' => $doc['type'],
                    'anotaciones' => $doc['obsv'],
                    "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),  #\Datetime()
                ]);
            }

            if ($saveDocumento){
                $request->session()->forget('prestamo');
                $request->session()->forget('rel_prestamo_doc');
                return redirect()->route('prestar')->with(array('code'=>200));
            }
            else
                return redirect()->route('prestar')->with(array('code'=>302));

        }
        else
            return redirect()->route('prestar')->with(array('code'=>302));

        }
        else
            return redirect()->route('prestar')->with('code', 303);

    }

*/

    /*private function addItem($nomb_doc, $tipo_documento, $anotaciones, $id){
    	//Array de almacenamiento de los documentos
    	$items = array();
    	//Sesión qe traerá y llevará los documentos
    	$session = Session::has('rel_prestamo_doc') ? Session::get('rel_prestamo_doc') : null;
    	//Array de un nuevo documento a agregar
    	$storedItem = ['id_doc'=> $id, 'document'=>$nomb_doc, 'type'=>$tipo_documento, 'obsv'=> $anotaciones];
    	//Creamos la primer entrada
    	if ( is_null($session) ) {
    		array_push($items, $storedItem);
    		Session::put('rel_prestamo_doc', $items);

    	}else{
    		$items = $session;
				array_push($items , $storedItem);
				//Pos eliminamos la repeticion
				$reset_items = array_map("unserialize", array_unique(array_map("serialize", $items)));
    		Session::put('rel_prestamo_doc', $reset_items);
    	}


    }*/


   /*---------------- Métodos para seccion ---------------*/
   /* private function getaddToCart($arryDatas, $id){
    	//Validamos si ya se creo una variable de sesion "cart"
    	$oldCart = Session::has('cart') ? Session::get('cart') : null;
    	$cart = new Cart($oldCart);
    	$cart->add($product, $product->id);

    	$request->session()->put('cart', $cart);
    	dd($request->session()->get('cart'));

    	return redirect()->route('x.x');
    }*/


}
