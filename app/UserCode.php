<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\UserCode
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCode whereUserId($value)
 * @mixin \Eloquent
 */
class UserCode extends Model
{
    use HasFactory;
  
    public $table = "user_codes";
  
    protected $fillable = [
        'user_id',
        'code',
    ];
}
