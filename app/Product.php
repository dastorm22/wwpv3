<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Product
 *
 * @property int $id
 * @property int $import_batch_id Import batch for this product
 * @property int $upc
 * @property string|null $name Name or description of the product
 * @property string|null $brand Brand of the product
 * @property string|null $category Category or type of the product
 * @property int|null $stock Current amount in stock
 * @property string|null $price
 * @property string|null $sku Internal product id of a company
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\ImportBatch $batch
 * @property-read \App\UPC|null $group
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImportBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'import_batch_id',
        'product_group_id',
        'upc',
        'name',
        'brand',
        'category',
        'stock',
        'price',
        'sku',
    ];

    /**
     * Returns the import batch of this order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batch()
    {
        return $this->belongsTo(ImportBatch::class, 'import_batch_id');
    }

    /**
     * Returns the group of this order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(UPC::class, 'product_group_id');
    }

    /**
     * Mutates the brand to title case.
     *
     * @param $value
     */
    public function setBrandAttribute($value)
    {
        $this->attributes['brand'] = $value ? Str::title($value) : null;
    }

    /**
     * Mutates the category to title case.
     *
     * @param $value
     */
    public function setCategoryAttribute($value)
    {
        $this->attributes['category'] = $value ? Str::title($value) : null;
    }

    /**
     * Object representation when being transformed to json.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'upc' => $this->attributes['upc'],
            'name' => $this->attributes['name'],
            'sku' => $this->attributes['sku'],
            'category' => $this->attributes['category'],
            'brand' => $this->attributes['brand'],
            'stock' => $this->attributes['stock'],
        ];
    }
}
