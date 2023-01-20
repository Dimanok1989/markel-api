<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Inputs\CompanyFormInputCreateRequest;
use App\Http\Requests\Company\Inputs\CompanyFormInputUpdateRequest;
use App\Http\Resources\Company\Inputs\CompanyFormInputEditResource;
use App\Http\Resources\Company\Inputs\CompanyFormInputResource;
use App\Models\CompanyForm;
use App\Models\CompanyFormInput;
use App\Services\Interfaces\FormInputInterface;
use Illuminate\Http\Request;

class CompanyFormInputController extends Controller
{
    /**
     * Инициализация контроллера
     * 
     * @param  \App\Services\Interfaces\FormInputInterface  $service
     * @return void
     */
    public function __construct(
        protected FormInputInterface $service,
    ) {
    }

    /**
     * Данные для создания поля ввода
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\Company\Inputs\CompanyFormInputEditResource
     */
    public function create(Request $request)
    {
        return new CompanyFormInputEditResource(null);
    }

    /**
     * Создание нового поля ввода
     * 
     * @param  \App\Http\Requests\Company\Inputs\CompanyFormInputCreateRequest  $request
     * @param  \App\Models\CompanyForm  $form
     * @return \App\Http\Resources\Company\Inputs\CompanyFormInputResource
     */
    public function store(CompanyFormInputCreateRequest $request, CompanyForm $form)
    {
        return new CompanyFormInputResource(
            $this->service->create(
                $request->validated(),
            )
        );
    }

    /**
     * Вывод данных формы
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyForm  $form
     * @param  \App\Models\CompanyFormInput  $input
     * @return \App\Http\Resources\Company\Inputs\CompanyFormInputResource
     */
    public function show(Request $request, CompanyForm $form, CompanyFormInput $input)
    {
        $this->authorize('view', $input);

        return new CompanyFormInputResource($input);
    }

    /**
     * Вывод данных поля ввода для формы редактирования
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyForm  $form
     * @param  \App\Models\CompanyFormInput  $input
     * @return \App\Http\Resources\Company\Inputs\CompanyFormInputEditResource
     */
    public function edit(Request $request, CompanyForm $form, CompanyFormInput $input)
    {
        $this->authorize('view', $input);

        return new CompanyFormInputEditResource($input);
    }

    /**
     * Обновление данных поля ввода
     * 
     * @param  \App\Http\Requests\Company\Inputs\CompanyFormInputUpdateRequest  $request
     * @param  \App\Models\CompanyForm  $form
     * @return \App\Http\Resources\Company\Inputs\CompanyFormInputResource
     */
    public function update(CompanyFormInputUpdateRequest $request, CompanyForm $form, CompanyFormInput $input)
    {
        $data = $request->validated();

        return new CompanyFormInputResource(
            $this->service->update($input, $data)
        );
    }

    /**
     * Удаление поля ввода
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyForm  $form
     * @param  \App\Models\CompanyFormInput  $input
     */
    public function destroy(Request $request, CompanyForm $form, CompanyFormInput $input)
    {
        $this->authorize('delete', $input);

        return new CompanyFormInputResource(
            $this->service->delete($input)
        );
    }
}
