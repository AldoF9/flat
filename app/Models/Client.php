<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
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
 * @property Collection|Sale[] $sales
 *
 * @package App\Models
 */
class Client extends Model
{
	protected $table = 'client';

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

	public function sales()
	{
		return $this->hasMany(Sale::class, 'fk_id_client');
	}
}
