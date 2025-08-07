<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        //$companies = Company::with(['employees', 'logo'])->get();
        $perPage = 10;
        $companies = Company::with(['employees', 'logo'])->paginate($perPage);

        return Inertia::render(
            'Company/Index',
            [
                'companies' => CompanyResource::collection($companies),
            ]
        );
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render(
            'Company/Create',
            [
                //'companies' => CompanyResource::collection($companies),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create($request);

        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource
     *
     * @return \Inertia\Response
     */
    public function show(Company $company): Response
    {
        $company->load([
            'logo',
            'employees',
        ]);

        return Inertia::render(
            'Company/Show',
            [
                'company' => new CompanyResource($company),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource
     *
     * @return \Inertia\Response
     */
    public function edit(Company $company): Response
    {
        return Inertia::render(
            'Company/Edit',
            [
                //'companies' => CompanyResource::collection($companies),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
    }
}
