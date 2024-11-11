<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validated();

            // Check if a logo file is uploaded
            if ($request->hasFile('logo')) {
                // Store the logo file in the public disk
                $logoPath = $request->file('logo')->store('logos', 'public');
                // Update the validated data with the logo path
                $validated['logo'] = 'storage/' . $logoPath;
            }

            // Create the company record
            Company::create($validated);

            // Flash a success message
            flash('Company created successfully!')->success();

            // Redirect back to the companies index page
            return redirect()->route('companies.index');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error creating company or uploading logo: ' . $e->getMessage());

            // Flash an error message to notify the user something went wrong
            flash('An error occurred while creating the company.')->error();

            // Optionally, redirect back to the form with the error message
            return redirect()->back();
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {

        return view('backend.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        try {
            // Validate the request data
            $validated = $request->validated();

            // Check if a logo file is uploaded
            if ($request->hasFile('logo')) {
                // If the company already has a logo, delete the old logo
                if ($company->logo) {
                    $this->deleteLogo($company->logo);
                }

                // Store the new logo and get its path
                $logoPath = $request->file('logo')->store('logos', 'public');

                // Update the validated data with the new logo path
                $validated['logo'] = 'storage/' . $logoPath;
            }

            // Use updateOrCreate to either update the existing record or create a new one
            Company::updateOrCreate(['id' => $company->id], $validated);

            // Flash a success message to notify that the company was updated
            flash('Company updated successfully!')->success();

            // Redirect back to the companies index page
            return redirect()->route('companies.index');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error updating company or logo: ' . $e->getMessage());

            // Flash an error message in case something went wrong
            flash('An error occurred while updating the company.')->error();

            // Optionally, return back to the previous page in case of error
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            if ($company->logo) {
                $this->deleteLogo($company->logo);
            }
            $company->delete();
            flash('Company deleted successfully.')->success();
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error deleting logo or company: ' . $e->getMessage());
            flash('An error occurred while deleting the company. '.$e->getMessage())->error();
        }
        return redirect()->route('companies.index');
    }


    public function getdata(Request $request)
    {
        // Query the companies
        $companies = Company::query();

        // You can add search and filter logic here if needed

        return DataTables::of($companies)
            ->addColumn('action', function ($company) {
                return view('backend.company._action', compact('company'));
            })
            ->addColumn('employee_count', function ($company) {
                // Count the number of employees related to the company
                return $company->employees->count(); // Assuming 'employees' is the relationship method
            })
            ->editColumn('created_at', function ($company) {
                return Carbon::parse($company->created_at)->toFormattedDateString(); // Human-readable format
            })
            ->editColumn('updated_at', function ($company) {
                return Carbon::parse($company->updated_at)->toFormattedDateString(); // Human-readable format
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')['value']) {
                    $search = $request->get('search')['value'];
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('website', 'like', "%$search%");
                }
            })
            ->make(true);
    }


    private function deleteLogo(string $logoPath)
    {
        // Remove the logo from the storage by using the public disk
        Storage::disk('public')->delete(str_replace('storage/', '', $logoPath));

        // Log the deletion of the logo for debugging and record-keeping
        Log::info('Logo deleted successfully: ' . $logoPath);
    }
}
