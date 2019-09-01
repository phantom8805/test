<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ContactField
 * @package App
 * @property int $id
 * @property string $title
 * @property FieldType $type
 * @property FieldOption $options
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ContactField extends Model
{
    protected $with = [
        'type',
        'options'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(FieldType::class, 'field_type');
    }

    public function options(): HasMany
    {
        return $this->hasMany(FieldOption::class, 'field_id');
    }
}
