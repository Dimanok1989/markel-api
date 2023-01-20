<?php

namespace App\Services\Leads;

use App\Models\Lead;
use App\Services\Interfaces\LeadInterface;

class LeadService implements LeadInterface
{
    /**
     * Создание новой заявки
     * 
     * @param  array  $data
     * @return \App\Models\Lead
     */
    public function create(array $data)
    {
        $lead = new Lead;

        $lead->fill($data)->save();
        $this->fillData($lead, $data);

        return $lead->refresh();
    }

    /**
     * Обновление данных
     * 
     * @param  \App\Models\Lead  $lead
     * @param  array  $data
     * @return \App\Models\Lead
     */
    public function update(Lead $lead, array $data)
    {
        $lead->fill($data)->save();
        $this->fillData($lead, $data);

        return $lead->refresh();
    }

    /**
     * Заполняет данные заявки
     * 
     * @param  \App\Models\Lead  $lead
     * @param  array  $data
     * @return \App\Models\Lead
     */
    public function fillData(Lead $lead, array $data)
    {
        $lead->form
            ->inputs
            ->each(function ($input) use ($lead, $data) {
                $input->dataFromLead($lead->id)->fill(['value' => $data[$input->input_key] ?? null])->save();
            });

        return $lead;
    }
}
