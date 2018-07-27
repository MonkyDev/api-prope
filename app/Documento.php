<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
  protected $table = 'cat_documentos';

	 /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
	protected $fillable = [
    'nomb_doc', 
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */

  protected $hidden = ['created_at', 'updated_at'];

}
