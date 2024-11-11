<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone',
    ];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'phone' => 'string', 
        'email' => 'string', 
        'company_id' => 'integer', 
    ];


    protected $dates = [
        'created_at', // Automatically handled, but can be added explicitly if needed
        'updated_at', // Automatically handled, but can be added explicitly if needed
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
