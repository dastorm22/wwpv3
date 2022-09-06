<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UPC
 *
 * @property int $upc UPC of all products on this group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ofert[] $oferts
 * @property-read int|null $oferts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|UPC newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UPC newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UPC query()
 * @method static \Illuminate\Database\Eloquent\Builder|UPC whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UPC whereUpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UPC whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UPC extends Model
{
    public $table = 'upcs';

    public $incrementing = false;

    protected $fillable = [
        'upc',
    ];

    /**
     * Returns the products in this group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'upc', 'upc');
    }
    public function oferts()
    {
        return $this->hasMany(Ofert::class, 'upc', 'upc');
    }
}
