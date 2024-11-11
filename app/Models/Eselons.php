<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Eselons extends Model
{
    protected $fillable = [
        'name',
        'eselon',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    use HasFactory;

    protected $guarded = [];
}
