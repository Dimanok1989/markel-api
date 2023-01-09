<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyFormDestroyRequest;
use App\Http\Requests\Company\CompanyFormUpdateRequest;
use App\Http\Requests\Company\CompanyFormStoreRequest;
use App\Http\Resources\Company\CompanyFormResource;
use App\Models\Company;
use App\Models\CompanyForm;
use App\Services\Interfaces\CompanyFormInterface;
use Illuminate\Http\Request;

class CompanyFormController extends Controller
{
    /**
     * Инициализация контроллера
     * 
     * @param  \App\Services\Interfaces\CompanyFormInterface  $service
     * @return void
     */
    public function __construct(
        protected CompanyFormInterface $service,
    ) {
    }

    /**
     * Создание новой формы заявок
     * 
     * @param  \App\Http\Requests\Company\CompanyFormStoreRequest  $request
     * @param  \App\Models\Company  $company
     * @return \App\Http\Resources\Company\CompanyFormResource
     */
    public function store(CompanyFormStoreRequest $request, Company $company)
    {
        return new CompanyFormResource(
            $this->service->create(
                $request->validated()
            )
        );
    }

    /**
     * Изменение данных формы заявок
     * 
     * @param  \App\Http\Requests\Company\CompanyFormUpdateRequest  $request
     * @param  \App\Models\Company  $company
     * @param  \App\Models\CompanyForm  $form
     * @return \App\Http\Resources\Company\CompanyFormResource
     */
    public function update(CompanyFormUpdateRequest $request, Company $company, CompanyForm $form)
    {
        $data = $request->validated();

        return new CompanyFormResource(
            $this->service->update($form, $data)
        );
    }

    /**
     * Изменение данных формы заявок
     * 
     * @param  \App\Http\Requests\Company\CompanyFormDestroyRequest  $request
     * @param  \App\Models\Company  $company
     * @param  \App\Models\CompanyForm  $form
     * @return \App\Http\Resources\Company\CompanyFormResource
     */
    public function destroy(CompanyFormDestroyRequest $request, Company $company, CompanyForm $form)
    {
        return new CompanyFormResource(
            $this->service->destroy($form)
        );
    }
}
