<?php

namespace App\Http\Resources\Leads;

use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = $this->resource
            ->form
            ->inputs
            ->mapWithKeys(function ($row) {
                return [$row->input_key => $row->getValueFromLead($this->id)];
            })
            ->toArray();

        return [
            // ...parent::toArray($request),
            'id' => $this->id,
            'status_id' => $this->status_id,
            ...$data,
        ];
    }
}
