<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'rfc',
    ];

    public function invoicesIssued()
    {
        return $this->hasMany(Invoice::class, 'issuing_company_id');
    }

    public function invoicesReceived()
    {
        return $this->hasMany(Invoice::class, 'receiving_company_id');
    }
}
