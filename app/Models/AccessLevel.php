<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 03:35:36 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class AccessLevel
 * 
 * @property int $id
 * @property string $access_level
 * 
 * @property \Illuminate\Database\Eloquent\Collection $admins
 *
 * @package App\Models
 */
class AccessLevel extends Eloquent
{
	protected $table = 'access_level';
	public $timestamps = false;

	protected $fillable = [
		'access_level'
	];

	public function admins()
	{
		return $this->hasMany(\App\Models\Admin::class, 'access_level');
	}
}
