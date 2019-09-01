<?php


namespace App\Resources;


use App\Contact;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ContactResource
 * @package App\Resources
 * @property Contact $resource
 */
class ContactResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->resource->id,
            'name'       => $this->resource->name,
            'surname'    => $this->resource->surname,
            'fields'     => ContactFieldResource::collection($this->resource->fields),
            'docs'       => ContactDocResource::collection($this->resource->docs),
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }
}