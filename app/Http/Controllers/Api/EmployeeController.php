<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Resources\EmployeeCollection;
class EmployeeController extends Controller
{
  public function index(Request $request)
  {
    return new EmployeeCollection(Employee::with('company')->get());
  }
}
