<?php

namespace App\Http\Controllers\Leads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Leads\LeadCreateRequest;
use App\Http\Resources\Leads\CreateFromPublicResource;
use App\Models\CompanyForm;
use App\Services\Leads\LeadService;
use Illuminate\Http\Request;

class LeadsFormController extends Controller
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
    public function create(Request $request, CompanyForm $form)
    {
        return new CreateFromPublicResource($form);
    }

    /**
     * Создание новой заявки
     * 
     * @param  \App\Http\Requests\Leads\LeadCreateRequest  $request
     * @param  \App\Models\CompanyForm  $form
     */
    public function store(LeadCreateRequest $request, CompanyForm $form)
    {
        return $this->service->create(
            $request->validated()
        );
    }
}
