<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
  protected $table = 'cat_motivos';

	 /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
	protected $fillable = [
    'desc_motv', 'dias', 
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */

  protected $hidden = ['created_at', 'updated_at'];

}
