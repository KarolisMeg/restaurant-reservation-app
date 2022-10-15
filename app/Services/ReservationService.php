<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Str;

class ReservationService
{
    private int $totalSeats;

    public function __construct()
    {
        $this->totalSeats = 0;
    }

    public function makeReservation(Collection $data): array
    {
        $reservationStartsAt = new Carbon($data->get('date').$data->get('time'));
        $reservationEndsAt = new Carbon($data->get('date').$data->get('time'));
        $reservationEndsAt = $reservationEndsAt->addHours($data->get('duration'));

        $restaurant = Restaurant::findOrFail($data->get('restaurant'));

        if (! $this->isRestaurantWorking($restaurant, $reservationStartsAt, $reservationEndsAt)) {
            return ['reservation' => null, 'message' => __('messages.restaurant-closed')];
        }

        $clientsCount = count($data->get('clients'));
        $reservationsInfo = $this->getReservationsInfo($restaurant, $reservationStartsAt, $reservationEndsAt);

        if (! $this->isReservationAvailable($restaurant, $clientsCount, $reservationsInfo->get('reservedSeats'))) {
            return ['reservation' => null, 'message' => __('messages.no-empty-tables')];
        }

        $tables = $this->getAvailableTable($restaurant, $clientsCount, $reservationsInfo->get('reservedTablesIds'));

        if ($tables->isEmpty()) {
            return ['reservation' => null, 'message' => __('messages.no-empty-tables')];
        }

        $reservation = new Reservation();
        $reservation->restaurant_id = $restaurant->id;
        $reservation->uuid = Str::uuid();
        $reservation->name = $data->get('name');
        $reservation->surname = $data->get('surname');
        $reservation->phone = $data->get('phone');
        $reservation->tables_count = $tables->count();
        $reservation->clients_count = $clientsCount;
        $reservation->starts_at = $reservationStartsAt;
        $reservation->ends_at = $reservationEndsAt;
        $reservation->save();

        $reservation->tables()->sync($tables);
        $reservation->clients()->createMany($data->get('clients'));

        return ['reservation' => $reservation, 'message' => __('messages.successful-reservation')];
    }

    private function isRestaurantWorking(Restaurant $restaurant, Carbon $startsAt, Carbon $endsAt): bool
    {
        return ! ($restaurant->opens_at > $startsAt || $restaurant->closes_at < $endsAt);
    }

    private function isReservationAvailable(Restaurant $restaurant, int $clientsCount, int $reservedSeats): bool
    {
        return $restaurant->tables()->sum('seats') - $reservedSeats >= $clientsCount;
    }

    private function getAvailableTable(Restaurant $restaurant, int $clientsCount, Collection $reservedTablesIds): Collection
    {
        $table = $restaurant->tables()
            ->where('seats', '>=', $clientsCount)
            ->whereNotIn('id', $reservedTablesIds->toArray())
            ->orderBy('seats')
            ->first();

        if ($table) {
            return collect($table->id);
        }

        $tables = $restaurant->tables()
            ->whereNotIn('id', $reservedTablesIds->toArray())
            ->orderBy('seats')
            ->get()->filter(function ($query) use ($clientsCount) {
                if ($this->totalSeats <= $clientsCount) {
                    $this->totalSeats += $query['seats'];

                    return true;
                }
            })->all();

        return collect($tables)->pluck('id');
    }

    private function getReservationsInfo(Restaurant $restaurant, Carbon $reservationStartsAt, Carbon $reservationEndsAt): Collection
    {
        $reservedSeats = 0;
        $reservedTablesIds = collect();
        foreach ($restaurant->currentReservations($reservationStartsAt, $reservationEndsAt) as $reservation) {
            $reservedSeats += $reservation->tables()->sum('seats');
            $reservedTablesIds->add($reservation->tables()->pluck('table_id'));
        }

        return collect(['reservedSeats' => $reservedSeats, 'reservedTablesIds' => $reservedTablesIds->collapse()]);
    }
}
