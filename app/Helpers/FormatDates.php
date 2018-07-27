<?php 
namespace App\Helpers;

class FormatDates {

  public static function DateCut($Fecha_Hora, $Posicion, $Caracter) {
    $Fecha = explode($Caracter, $Fecha_Hora);
    return $Fecha[$Posicion];
  }

  public static function AlterFecha($fecha_modificar, $dias_alter, $signo){
    $fecha = empty($fecha_modificar) ? date('Y-m-d') : $fecha_modificar;
    $sign = empty($signo) ? '+' : $signo;
    $nuevafecha = strtotime ( $sign.$dias_alter.' day' , strtotime ( $fecha ) ) ;
    $alter_date = date ( 'Y-m-d' , $nuevafecha );

    return $alter_date;
  }


  public static function DiffDiasBetweenTwoDates($fecha_one, $fecha_two){
    /*Validar los datos*/
    $date_one = empty($fecha_one) ? date('Y-m-d') : $fecha_one; 
    $date_two = empty($fecha_two) ? date('Y-m-d') : $fecha_two;

    /*Saber si es timestamp o fecha normal*/
    $date_one_p = strlen($date_one)>10 ? explode(' ', $date_one) : $date_one;
    $date_two_p = strlen($date_two)>10 ? explode(' ', $date_two) : $date_two;

    /*determinar si la fecha se partió fecha y tiempo*/
    $date_out_one = is_array($date_one_p) ? $date_one_p[0] : $date_one_p;
    $date_out_two = is_array($date_two_p) ? $date_two_p[0] : $date_two_p;
          
    $dias = ( strtotime($date_out_one) - strtotime($date_out_two) )/86400;
    $dias = abs($dias); 
    $dias_transcu = floor($dias);

    return  (int) $dias_transcu;
  }


  public static function FechaNowWithCountryLetras() {    
    $dia = date("d");
    $mes = date("m");
    $year = date("Y");
    $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
        "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
        "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

    return  "Tuxtla GutiÃ©rrez, Chiapas; " . $matmes[$mes] . " " . $dia . " de " . $year;
  }

  /*formato de fecha con letras y hora*/
  public static function DateDMA($Fecha, $hora, $letras) {
      /*Saber si es timestamp o fecha normal*/
      $date_explod = strlen($Fecha)>10 ? explode(' ', $Fecha) : $Fecha;

      /*determinar si la fecha se particionó en fecha y tiempo*/
      $any_date = is_array($date_explod) ? $date_explod[0] : $date_explod;

      /*extraemos solo los datos de la fecha*/
      $datos = explode("-", $any_date);
      $dia = $datos[2];
      $mes = $datos[1];
      $year = $datos[0];

      /*Saber si se quiere incluir hora en la fecha*/
      if (!empty($hora)) 
        /*saber si ay time en la fecha*/
        $time_end = is_array($date_explod) ? $date_explod[1] : date('H:s:i');
      else
        $time_end = '';

      /*Arreglo de meses en letras*/
      $matmes = [
          "01" => 'Enero', 
          "02" => 'Febrero',
          "03" => 'Marzo',
          "04" => 'Abril',
          "05" => 'Mayo',
          "06" => 'Junio',
          "07" => 'Julio',
          "08" => 'Agosto',
          "09" => 'Septiembre',
          "10" => 'Octubre',
          "11" => 'Noviembre',
          "12" => 'Diciembre'
      ];
      

      /*Determinar el sufijo por el año*/
      $sufijo = ($year > 1999) ? " del " : " de ";

      /*saber si la fecha se quiere en letras o no*/
      if(!empty($letras))
        $date_end = $dia . " de " . $matmes[$mes] . $sufijo . $year. " a las " .$time_end. " horas.";
      else
        $date_end = $dia . "/" . $mes . "/" . $year. " " .$time_end;

      /*Asignamos valores finales*/
      $salida = trim($date_end);

    return $salida;
  }


  public static function acentua($string){
    $Mystring = strtr($string, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
    return $Mystring;
  }

}