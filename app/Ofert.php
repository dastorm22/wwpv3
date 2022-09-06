<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Ofert
 *
 * @property int $id
 * @property int $upc
 * @property string|null $name
 * @property string|null $brand Brand of the product
 * @property string|null $category Category or type of the product
 * @property int|null $stock Current amount in stock
 * @property string|null $price
 * @property string|null $sku Internal product id of a company
 * @property int $is_enabled If false, this source will not be processed
 * @property string|null $vendor
 * @property string|null $offer
 * @property string|null $file
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Ofert[] $offers
 * @property-read int|null $offers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereUpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ofert whereVendor($value)
 * @mixin \Eloquent
 */
class Ofert extends Model
{
    protected $primaryKey = 'upc';

    protected $fillable = [
        'import_batch_id',
        'product_group_id',
        'upc',
        'name',
        'brand',
        'category',
        'stock',
        'file',
        'vendor',
        'offer',
        'price',
        'sku',
        'description',

    ];

    public function offers()
    {
        return $this->hasMany(Ofert::class, 'upc', 'upc');
    }
}
