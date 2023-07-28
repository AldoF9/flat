<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Income
 * 
 * @property int $id
 * @property string $folio
 * @property Carbon $date
 * @property int $total
 * @property float $monetario
 * @property int $cantidad
 * @property float $total_unitario
 * @property int $fk_id_product
 * @property int $fk_id_provider
 * @property int $fk_id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Product $product
 * @property Provider $provider
 * @property User $user
 *
 * @package App\Models
 */
class Income extends Model
{
	protected $table = 'income';

	protected $casts = [
		'date' => 'datetime',
		'total' => 'int',
		'monetario' => 'float',
		'cantidad' => 'int',
		'total_unitario' => 'float',
		'fk_id_product' => 'int',
		'fk_id_provider' => 'int',
		'fk_id_user' => 'int'
	];

	protected $fillable = [
		'folio',
		'date',
		'total',
		'monetario',
		'cantidad',
		'total_unitario',
		'fk_id_product',
		'fk_id_provider',
		'fk_id_user'
	];

	public function product()
	{
		return $this->belongsTo(Product::class, 'fk_id_product');
	}

	public function provider()
	{
		return $this->belongsTo(Provider::class, 'fk_id_provider');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'fk_id_user');
	}
}
