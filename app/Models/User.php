<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 14 Jun 2018 21:18:38 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $nickname
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $user_phones
 *
 * @package App\Models
 */
class User extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'user';

	protected $fillable = [
		'name',
		'email',
		'nickname',
		'image'
	];

	public function user_phones()
	{
		return $this->hasMany(\App\Models\UserPhone::class);
	}
}
