<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpendCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function procurementData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProcurementData::class);
    }
}
