<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FieldOption
 * @package App
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property bool $selected
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class FieldOption extends Model
{
    protected $casts = [
        'selected' => 'boolean'
    ];
}
