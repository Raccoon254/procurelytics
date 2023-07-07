<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementData extends Model
{
    use HasFactory;

    protected $fillable = [
        'firm_name',
        'certificate_number',
        'agpo_cert_no',
        'category_id',
        'directors',
        'postal_address',
        'email',
        'mobile_number',
        'amount',
        'spend_category_id',
        'procurement_number',
        'procurement_method',
    ];

    protected $casts = [
        'directors' => 'array',
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function spendCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SpendCategory::class);
    }
}
