<?php

namespace App\Http\Controllers\Leads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Leads\LeadCreateRequest;
use App\Http\Requests\Leads\LeadUpdateRequest;
use App\Http\Resources\Leads\CreateFromPublicResource;
use App\Http\Resources\Leads\LeadResource;
use App\Models\CompanyForm;
use App\Models\Lead;
use App\Services\Leads\LeadService;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    /**
     * Инициализация контроллера
     * 
     * @param  \App\Services\Leads\LeadService  $service
     * @return void
     */
    public function __construct(
        protected LeadService $service
    ) {
    }

    /**
     * Данные для фолрмы создания новой заявки
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyForm  $form
     * @return \App\Http\Resources\Leads\CreateFromPublicResource
     */
    // public function create(Request $request, CompanyForm $form)
    // {
    //     return new CreateFromPublicResource($form);
    // }

    /**
     * Создание новой заявки
     * 
     * @param  \App\Http\Requests\Leads\LeadCreateRequest  $request
     * @param  \App\Models\CompanyForm  $form
     * @return \App\Http\Resources\Leads\LeadResource
     */
    // public function store(LeadCreateRequest $request, CompanyForm $form)
    // {
    //     return new LeadResource(
    //         $this->service->create(
    //             $request->validated()
    //         )
    //     );
    // }

    /**
     * Обновление заявки
     * 
     * @param  \App\Http\Requests\Leads\LeadUpdateRequest  $request
     * @param  \App\Models\Lead  $lead
     * @return \App\Http\Resources\Leads\LeadResource
     */
    public function update(LeadUpdateRequest $request, Lead $lead)
    {
        $data = $request->validated();

        return new LeadResource(
            $this->service->update($lead, $data)
        );
    }
}
