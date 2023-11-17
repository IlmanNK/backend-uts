<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'Name',
        'Gender',
        'Phone',
        'Address',
        'Email',
        'Status',
        'Hired_on',
        'Timestamp'
    ];

    public function scopeActive($query) {
        return $query->where('active', true);
    }
}
