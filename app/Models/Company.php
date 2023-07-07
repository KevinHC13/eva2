<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'rfc',
    ];

    /**
     * Obtiene las facturas emitidas por la empresa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicesIssued()
    {
        return $this->hasMany(Invoice::class, 'issuing_company_id');
    }

    /**
     * Obtiene las facturas recibidas por la empresa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicesReceived()
    {
        return $this->hasMany(Invoice::class, 'receiving_company_id');
    }
}
