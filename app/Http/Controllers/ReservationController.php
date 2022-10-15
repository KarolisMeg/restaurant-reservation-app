<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation.reservation',
            [
                'restaurants' => Restaurant::all(),
            ]);
    }

    public function success(string $uuid)
    {
        return view('reservation.success',
            [
                'reservation' => Reservation::where('uuid', $uuid)->firstOrFail(),
            ]);
    }
}
