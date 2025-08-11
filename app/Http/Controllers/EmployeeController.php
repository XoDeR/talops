<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanySummaryResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Company;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        $perPage = 10;
        $employees = Employee::with(['company'])->paginate($perPage);

        return Inertia::render(
            'Employee/Index',
            [
                'employees' => EmployeeResource::collection($employees),
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
        // a list of companies to select
        // to which company to attach a created employee
        $companies = Company::get();

        return Inertia::render(
            'Employee/Create',
            [
                'allCompanies' => CompanySummaryResource::collection($companies),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employeeData = $request->validated();
        $employee = Employee::create($employeeData);
        if ($request->company_uuid) {
            $company = Company::where('uuid', $request->company_uuid)->first();
            if ($company) {
                $employee->company()->associate($company);
                $employee->save();
            }
        }

        return redirect()->route('employees.show', $employee->uuid);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load([
            'company',
        ]);

        return Inertia::render(
            'Employee/Show',
            [
                'employee' => new EmployeeResource($employee),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee->load([
            'company',
        ]);
        $companies = Company::get();

        return Inertia::render(
            'Employee/Edit',
            [
                'employee' => new EmployeeResource($employee),
                'allCompanies' => CompanySummaryResource::collection($companies),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // update only if fields are present in the request
        $employee->update($request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
        ]));

        if ($request->company_uuid) {
            $company = Company::where('uuid', $request->company_uuid)->first();
            if ($company) {
                $employee->company()->associate($company);
                $employee->save();
            }
        }
        return redirect()->route('employees.show', $employee->uuid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
    }
}
