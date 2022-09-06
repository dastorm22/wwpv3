<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Adjustment
 *
 * @property int $upc
 * @property string|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereUpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Adjustment extends Model
{
    protected $primaryKey = 'upc';

    protected $fillable = [
        'upc',
        'price',
    ];
}
