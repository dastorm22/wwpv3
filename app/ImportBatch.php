<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ImportBatch
 *
 * @property int $id
 * @property int $source_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ImportBatch extends Model
{
    /**
     * Returns all products that were imported on this batch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
