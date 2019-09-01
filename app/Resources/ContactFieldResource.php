<?php


namespace App\Resources;


use App\ContactField;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ContactFieldResource
 * @package App\Resources
 * @property ContactField $resource
 */
class ContactFieldResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->resource->id,
            'title'      => $this->resource->title,
            'type'       => $this->resource->type->name,
            'options'    => ContactFieldOptionResource::collection($this->resource->options),
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }
}