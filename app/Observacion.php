<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
  protected $table = 'tbl_observaciones';

	 /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
	protected $fillable = [
    'desc_obsv', 'fk_prestamo',
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */

  protected $hidden = ['created_at', 'updated_at'];
}
