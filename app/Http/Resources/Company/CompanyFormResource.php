<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\Company\Inputs\CompanyFormInputCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyFormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            ...parent::toArray($request),
            'inputs' => new CompanyFormInputCollection($this->resource->inputs ?? null),
        ];
    }
}
