<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FieldType
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property boolean $option_able
 */
class FieldType extends Model
{
    protected $casts = [
      'option_able' => 'boolean'
    ];
}
