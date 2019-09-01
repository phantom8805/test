<?php


namespace App\Resources;


use App\ContactField;
use App\FieldOption;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ContactFieldOptionResource
 * @package App\Resources
 * @property FieldOption $resource
 */
class ContactFieldOptionResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->resource->id,
            'key'        => $this->resource->key,
            'value'      => $this->resource->value,
            'selected'   => $this->resource->selected,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }
}