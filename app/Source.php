<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Source
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string|null $file Filename for local sources
 * @property string|null $url
 * @property int|null $is_main True for the main source all others are compared against
 * @property int|null $is_enabled If false, this source will not be processed
 * @property int|null $include_in_explore If false, this source will included in the exploration
 * @property int $skip_rows Number of rows to be skipped
 * @property int|null $column_upc
 * @property int|null $column_name
 * @property int|null $column_brand
 * @property int|null $column_category
 * @property int|null $column_stock
 * @property int|null $column_price
 * @property int|null $column_sku
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ImportBatch[] $batches
 * @property-read int|null $batches_count
 * @property-read mixed $type_name
 * @method static \Illuminate\Database\Eloquent\Builder|Source newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Source newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Source query()
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereColumnBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereColumnCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereColumnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereColumnPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereColumnSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereColumnStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereColumnUpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereIncludeInExplore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereIsMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereSkipRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereUrl($value)
 * @mixin \Eloquent
 */
class Source extends Model
{
    const TYPE_LOCAL = 1;
    const TYPE_REMOTE = 2;

    const TYPES = [
        self::TYPE_LOCAL => 'Local',
        self::TYPE_REMOTE => 'Remote',
    ];

    protected $fillable = [
        'name',
        'type',
        'url',
        'filename',
        'is_main',
        'is_enabled',
        'include_in_explore',
        'skip_rows',
        'column_upc',
        'column_name',
        'column_brand',
        'column_category',
        'column_stock',
        'column_price',
        'column_sku',
        'column_description',
    ];

    /**
     * Returns all import batches of this source.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function batches()
    {
        return $this->hasMany(ImportBatch::class);
    }

    /**
     * Returns a new import batch for this source.
     *
     * @return ImportBatch
     */
    public function getNewBatch()
    {
        return $this->batches()->create([]);
    }

    /**
     * Returns the latest import batch for this source.
     *
     * @return ImportBatch
     */
    public function getCurrentBatch()
    {
        return $this->batches()->latest()->first();
    }

    /**
     * Returns the products that were imported on the last batch.
     *
     * @return Product[]|null
     */
    public function getCurrentProducts()
    {
        return $this->getCurrentBatch()->products ?? null;
    }

    public function getTypeNameAttribute()
    {
        return self::TYPES[$this->attributes['type']];
    }

    public function jsonSerialize()
    {
        return [
          'id' => $this->attributes['id'],
          'name' => Str::limit($this->attributes['name'], 6, ''),
        ];
    }
}
