<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    public function scopeForCurrentClient($query)
    {
        if (auth()->check() && auth()->user()->role === 'client') {
            $query->whereHas('client', fn($q) => $q->where('id', auth()->user()->client_id));
        }
        return $query;
    }
    
    public function scopeForCurrentUser($query)
    {
        if (auth()->check()) {
            if (auth()->user()->role === 'client') {
                $query->whereHas('client', fn($q) => $q->where('id', auth()->user()->client_id));
            } elseif (auth()->user()->role === 'collaborateur') {
                $query->whereHas('collaborators', fn($q) => $q->where('user_id', auth()->id()));
            }
        }
        return $query;
    }

    use HasFactory;


    protected $fillable = [
        'client_id',
        'contract_id',
        'name',
        'description',
        'status',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function collaborators(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function getIncludedHoursConsumedAttribute(): float
    {
        return (float) $this->tickets()
            ->where('is_billable', false)
            ->withSum('timeEntries', 'duration_hours')
            ->get()
            ->sum('time_entries_sum_duration_hours');
    }

    public function getBillableHoursAttribute(): float
    {
        return (float) $this->tickets()
            ->where('is_billable', true)
            ->withSum('timeEntries', 'duration_hours')
            ->get()
            ->sum('time_entries_sum_duration_hours');
    }

    public function getRemainingHoursAttribute(): float
    {
        $includedHours = (float) ($this->contract?->included_hours ?? 0);

        return max(0, $includedHours - $this->included_hours_consumed);
    }

    public function getBillableAmountAttribute(): float
    {
        $rate = (float) ($this->contract?->hourly_rate ?? 0);

        return round($this->billable_hours * $rate, 2);
    }
}
