<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{


    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

     // Cast specific attributes to native types
     protected $casts = [
        'name' => 'string', // Ensure 'name' is always treated as a string
        'logo' => 'string', // Ensure 'logo' is always treated as a string
        'email' => 'string', // Ensure 'email' is always treated as a string
        'website' => 'string', // Ensure 'website' is always treated as a string
    ];

  
    protected $dates = [
        'created_at', // These are automatically handled, but adding here if needed
        'updated_at', // Same as above
       
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }


    protected static function booted()
    {
        // Prevent deletion if the company has associated employees
        static::deleting(function ($company) {
            if ($company->employees()->count() > 0) {
                // Prevent deletion and throw an exception or set a custom message
                throw new \Exception('Cannot delete company with associated employees.');
            }
        });
    }
}
