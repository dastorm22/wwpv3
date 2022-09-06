<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AnalysisCache
 *
 * @property int $id
 * @property int $type Type of data stored.
 * @property string $contents JSON representation of the rows
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisCache newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisCache newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisCache query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisCache whereContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisCache whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisCache whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisCache whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisCache whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AnalysisCache extends Model
{
    const TYPE_COMPARISON = 1;
    const TYPE_CROSS_REFERENCE = 2;

    protected $fillable = [
        'type',
        'contents',
    ];
}
