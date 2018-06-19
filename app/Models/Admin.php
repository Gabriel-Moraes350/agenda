<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 15 Jun 2018 15:50:29 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Admin
 * 
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $active
 * @property string $password
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $admin_tokens
 *
 * @package App\Models
 */
class Admin extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'admin';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'login',
		'active',
		'password',
		'access_level'
	];

	public function admin_tokens()
	{
		return $this->hasMany(\App\Models\AdminToken::class);
	}

	public function setPasswordAttribute($value){
		$this->attributes['password'] = password_hash($value,PASSWORD_DEFAULT);
	}

	public function setNameAttribute($value){
		$this->attributes['name'] = clean($value);
	}
}
