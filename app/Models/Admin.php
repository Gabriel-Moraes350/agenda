<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 14 Jun 2018 21:18:38 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Admin
 * 
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
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
		'password'
	];
}
