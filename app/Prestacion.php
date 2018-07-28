<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{
  protected $table = 'tbl_prestaciones';

	 /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
	protected $fillable = [
    'dni', 
    'tipo_dni',
    'fk_motivo', 
    'fk_trabajador_entrega',
    'fk_trabajador_recibe',
    'fk_status',
    'dias_permitidos',
    'salida',
    'regresa' 
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */

  protected $hidden = [
    'created_at',
    'updated_at'
  ];

}
