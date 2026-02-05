<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Report extends Model
{
    use HasUuid;

    protected $fillable = [
        'user_id',
        'action',
        'model',
        'model_id',
        'old_data',
        'new_data'
    ];
}
