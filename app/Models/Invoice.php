<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'issuing_company_id',
        'receiving_company_id',
        'id_documents',
        'folio',
    ];

    /**
     * Obtiene la empresa emisora de la factura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function issuingCompany()
    {
        return $this->belongsTo(Company::class, 'issuing_company_id');
    }

    /**
     * Obtiene la empresa receptora de la factura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receivingCompany()
    {
        return $this->belongsTo(Company::class, 'receiving_company_id');
    }
}
