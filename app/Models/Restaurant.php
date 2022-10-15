<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function tables(): HasMany
    {
        return $this->hasMany(Table::class);
    }

    public function currentReservations(Carbon $reservationStartsAt, Carbon $reservationEndsAt): Collection
    {
        return $this->reservations()
            ->orwhereBetween('starts_at', [$reservationStartsAt, $reservationEndsAt])
            ->orWhereBetween('ends_at', [$reservationStartsAt, $reservationEndsAt])
            ->get();
    }
}
