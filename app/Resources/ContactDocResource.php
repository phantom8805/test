<?php


namespace App\Resources;


use App\Doc;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ContactDocResource
 * @package App\Resources
 * @property Doc $resource
 */
class ContactDocResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->resource->id,
            'name'       => $this->resource->number,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }
}