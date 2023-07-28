<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sale
 * 
 * @property int $id
 * @property string $folio
 * @property Carbon $date
 * @property float $imuesto
 * @property int $total
 * @property int $fk_id_state
 * @property int $fk_id_product
 * @property int $fk_id_client
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Client $client
 * @property Product $product
 * @property State $state
 *
 * @package App\Models
 */
class Sale extends Model
{
	protected $table = 'sale';

	protected $casts = [
		'date' => 'datetime',
		'imuesto' => 'float',
		'total' => 'int',
		'fk_id_state' => 'int',
		'fk_id_product' => 'int',
		'fk_id_client' => 'int'
	];

	protected $fillable = [
		'folio',
		'date',
		'imuesto',
		'total',
		'fk_id_state',
		'fk_id_product',
		'fk_id_client'
	];

	public function client()
	{
		return $this->belongsTo(Client::class, 'fk_id_client');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'fk_id_product');
	}

	public function state()
	{
		return $this->belongsTo(State::class, 'fk_id_state');
	}
}
