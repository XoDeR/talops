<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Logo;
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
        $companyData = $request->validated();
        $company = Company::create($companyData);
        if ($request->logo_uuid) {
            $logo = Logo::where('uuid', $request->logo_uuid)->first();
            if ($logo) {
                // because company has hasOne relationship, there is no direct attach or accosiate method for hasOne
                $company->logo()->save($logo);
            }
        }
        return redirect()->route('companies.show', $company->uuid);
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
        $company->load('logo');
        return Inertia::render(
            'Company/Edit',
            [
                'company' => new CompanyResource($company),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        // update only if fields are present in the request
        $company->update($request->only([
            'name',
            'address',
            'email',
            'website',
        ]));

        if ($request->logo_uuid) {
            $newLogoUuid = $request->logo_uuid;
            if ($company->logo) {
                $prevLogoUuid = $company->logo->uuid;
                if ($prevLogoUuid && $prevLogoUuid !== $newLogoUuid) {
                    $company->logo->delete();
                }
            }
            $logo = Logo::where('uuid', $newLogoUuid)->first();
            if ($logo) {
                $company->logo()->save($logo);
            }
        }
        return redirect()->route('companies.show', $company->uuid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
    }
}
