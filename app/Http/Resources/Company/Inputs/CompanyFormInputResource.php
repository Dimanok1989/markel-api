<?php

namespace App\Http\Resources\Company\Inputs;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyFormInputResource extends JsonResource
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
            "id" => $this->id,
            "key" => $this->input_key,
            "form_id" => $this->company_form_id,
            "name" => $this->name,
            "description" => $this->description,
            "type" => $this->type,
            "attributes" => $this->attributes,
            "options" => $this->options,
            "is_active" => $this->is_active,
            "is_public" => $this->is_public,
            "sorting" => $this->sorting,
        ];
    }
}
