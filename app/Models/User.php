<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Income[] $incomes
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'user';

	protected $casts = [
		'active' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'phone',
		'email',
		'password',
		'active'
	];

	public function incomes()
	{
		return $this->hasMany(Income::class, 'fk_id_user');
	}
}
