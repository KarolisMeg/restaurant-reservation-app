<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class RestaurantController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('restaurant.restaurants',
            [
                'restaurants' => Restaurant::with(['tables', 'reservations'])->get(),
            ]);
    }

    public function show($id)
    {
        return view('restaurant.restaurant',
            [
                'restaurant' => Restaurant::with(['tables', 'reservations'])->find($id),
            ]);
    }

    public function destroy(int $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return view('restaurant.restaurants',
            [
                'restaurants' => Restaurant::with(['tables', 'reservations'])->get(),
            ]);
    }
}
