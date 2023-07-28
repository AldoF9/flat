<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Provider
 * 
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Income[] $incomes
 *
 * @package App\Models
 */
class Provider extends Model
{
	protected $table = 'provider';

	protected $casts = [
		'active' => 'bool'
	];

	protected $fillable = [
		'name',
		'phone',
		'active'
	];

	public function incomes()
	{
		return $this->hasMany(Income::class, 'fk_id_provider');
	}
}
