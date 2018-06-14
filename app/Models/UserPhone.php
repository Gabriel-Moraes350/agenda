<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 14 Jun 2018 21:19:42 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class UserPhone
 * 
 * @property int $id
 * @property string $phone
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class UserPhone extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'user_phone';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'phone',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
