<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'included_hours',
        'starts_at',
        'ends_at',
        'hourly_rate',
    ];

    protected $casts = [
        'starts_at' => 'date',
        'ends_at' => 'date',
        'included_hours' => 'decimal:2',
        'hourly_rate' => 'decimal:2',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
