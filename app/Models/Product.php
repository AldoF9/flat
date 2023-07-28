<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $sku
 * @property string $name
 * @property int $stock
 * @property string $img
 * @property float $calif
 * @property bool $active
 * @property int $fk_id_category
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Collection|Income[] $incomes
 * @property Collection|Sale[] $sales
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'product';

	protected $casts = [
		'stock' => 'int',
		'calif' => 'float',
		'active' => 'bool',
		'fk_id_category' => 'int'
	];

	protected $fillable = [
		'sku',
		'name',
		'stock',
		'img',
		'calif',
		'active',
		'fk_id_category'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'fk_id_category');
	}

	public function incomes()
	{
		return $this->hasMany(Income::class, 'fk_id_product');
	}

	public function sales()
	{
		return $this->hasMany(Sale::class, 'fk_id_product');
	}
}
