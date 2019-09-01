<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Contact
 * @package App
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Doc $docs
 * @property ContactField $fields
 */
class Contact extends Model
{
    protected $with = [
      'docs',
      'fields'
    ];

    const COLUMN_FOR_SEARCH = [
      'name',
      'surname'
    ];

    public function docs(): HasMany
    {
        return $this->hasMany(Doc::class, 'contact_id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(ContactField::class, 'contact_id');
    }
}
