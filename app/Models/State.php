<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * 
 * @property int $id
 * @property string $name
 * @property bool $active
 * 
 * @property Collection|Sale[] $sales
 *
 * @package App\Models
 */
class State extends Model
{
	protected $table = 'state';
	public $timestamps = false;

	protected $casts = [
		'active' => 'bool'
	];

	protected $fillable = [
		'name',
		'active'
	];

	public function sales()
	{
		return $this->hasMany(Sale::class, 'fk_id_state');
	}
}
