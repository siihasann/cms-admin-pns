<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'nip',
        'name',
        'birth_place',
        'birth_date',
        'gender',
        'address',
        'religion',
        'phone',
        'npwp',
        'jabatan_id',
        'eselon_id',
        'unit_id',
        'rank_id',
        'work_location_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Departements::class, 'jabatan_id');
    }

    public function eselon(): BelongsTo
    {
        return $this->belongsTo(Eselons::class, 'eselon_id');
    }

    public function ranks(): BelongsTo
    {
        return $this->belongsTo(Groups::class, 'rank_id');
    }

    public function units(): BelongsTo
    {
        return $this->belongsTo(Units::class, 'unit_id');
    }

    public function work_locations(): BelongsTo
    {
        return $this->belongsTo(WorkLocations::class, 'work_location_id');
    }
    use HasFactory;
}