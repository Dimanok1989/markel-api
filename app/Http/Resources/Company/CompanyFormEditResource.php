<?php

namespace App\Http\Resources\Company;

use App\Models\CompanyForm;
use App\Services\Enums\CompanyFormInputs;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyFormEditResource extends JsonResource
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
            'data' => $this->resource instanceof CompanyForm ? new CompanyFormResource($this->resource) : null,
            'inputs' => CompanyFormInputs::options(),
        ];
    }
}
