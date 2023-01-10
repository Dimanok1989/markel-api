<?php

namespace App\Http\Resources\Company\Inputs;

use App\Models\CompanyFormInput;
use App\Services\Enums\CompanyFormInputs;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyFormInputEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = $this->resource instanceof CompanyFormInput
            ? new CompanyFormInputResource($this->resource)
            : null;

        return [
            'data' => $data,
            'types' => CompanyFormInputs::options(),
        ];
    }
}
