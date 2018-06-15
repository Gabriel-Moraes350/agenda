<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 15 Jun 2018 15:50:20 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class AdminToken
 * 
 * @property int $id
 * @property string $token
 * @property int $admin_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Admin $admin
 *
 * @package App\Models
 */
class AdminToken extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'admin_token';

	protected $casts = [
		'admin_id' => 'int'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'token',
		'admin_id'
	];

	public function admin()
	{
		return $this->belongsTo(\App\Models\Admin::class);
	}
}
