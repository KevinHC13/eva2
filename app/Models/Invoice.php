<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'issuing_company_id',
        'receiving_company_id',
        'id_documents',
        'folio',
    ];

    public function issuingCompany()
    {
        return $this->belongsTo(Company::class,'issuing_company_id');
    }

    public function receivingCompany()
    {
        return $this->belongsTo(Company::class,'receiving_company_id');
    }
}
