<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Groups extends Model
{
    protected $fillable = [
        'name',
        'level',
    ];
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    use HasFactory;

    protected $guarded = [];
}
