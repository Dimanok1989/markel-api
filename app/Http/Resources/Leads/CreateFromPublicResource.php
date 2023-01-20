<?php

namespace App\Http\Resources\Leads;

use App\Http\Resources\Company\CompanyFormResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateFromPublicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return new CompanyFormResource($this->resource);
    }
}
