<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  protected $table = 'cat_status';

	 /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
	protected $fillable = [
    'desc_stats',
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */

  protected $hidden = ['created_at', 'updated_at'];
}
