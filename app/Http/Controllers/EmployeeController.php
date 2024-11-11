<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use Carbon\Carbon;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::select(['id', 'name'])->get()->pluck('name', 'id')->toArray();

        return view('backend.employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            Employee::create($validated);
            flash('Employee created successfully!')->success();

            // Redirect back to the Employee index page
            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error creating Employe or uploading logo: ' . $e->getMessage());

            // Flash an error message to notify the user something went wrong
            flash('An error occurred while creating the Employe.')->error();

            // Optionally, redirect back to the form with the error message
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::select(['id', 'name'])->get()->pluck('name', 'id')->toArray();

        return view('backend.employee.edit',compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validated();
            $employee->update($validated);
            flash('Employee Updated successfully!')->success();

            // Redirect back to the Employee index page
            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error creating Employe or uploading logo: ' . $e->getMessage());

            // Flash an error message to notify the user something went wrong
            flash('An error occurred while creating the Employe.')->error();

            // Optionally, redirect back to the form with the error message
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        flash('employee deleted successfully.')->success();
        return redirect()->route('employees.index');
    }


    public function getdata(Request $request)
    {
        $employees = Employee::query();

        return DataTables::of($employees)
            ->addColumn('company_name', function ($employee) {
                // Access the company name and display it
                return $employee->company ? $employee->company->name : 'No Company';
            })
            ->addColumn('action', function ($employee) {
                return view('backend.employee._action', compact('employee'));
            })
            ->editColumn('created_at', function ($employee) {
                return Carbon::parse($employee->created_at)->toFormattedDateString(); // Human-readable format
            })
            ->editColumn('updated_at', function ($employee) {
                return Carbon::parse($employee->updated_at)->toFormattedDateString(); // Human-readable format
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    $search = $request->get('search')['value'];
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                }
            })
            ->make(true);
    }
}
