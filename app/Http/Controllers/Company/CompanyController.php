<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Resources\Company\CompanyResource;
use App\Services\Company\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Init controller
     * 
     * @param  \App\Services\Company\CompanyService  $service
     * @return void
     */
    public function __construct(
        protected CompanyService $service
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \lluminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return CompanyResource::collection(
            $this->service->list((int) optional($request->user())->id)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \App\Http\Resources\Company\CompanyResource
     */
    public function store(StoreCompanyRequest $request)
    {
        return new CompanyResource(
            $this->service->create(
                $request->validated()
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \App\Http\Resources\Company\CompanyResource
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \App\Http\Resources\Company\CompanyResource
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        return new CompanyResource(
            $this->service->update($company, $request->validated()),
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \App\Http\Resources\Company\CompanyResource
     */
    public function destroy(Company $company)
    {
        return new CompanyResource(
            $this->service->destroy($company),
        );
    }
}
