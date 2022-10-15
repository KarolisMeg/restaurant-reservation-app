<?php

namespace App\Http\Livewire;

use App\Models\Restaurant;
use Livewire\Component;

class RestaurantForm extends Component
{
    public $restaurants;

    public $restaurantTitle;

    public $opensAt;

    public $closesAt;

    public $restaurant;

    protected $rules = [
        'restaurantTitle' => 'required',
        'opensAt' => 'required',
        'closesAt' => 'required',
    ];

    public function addRestaurant()
    {
        $this->validate();
        $restaurant = new Restaurant();
        $restaurant->title = $this->restaurantTitle;
        $restaurant->opens_at = $this->opensAt;
        $restaurant->closes_at = $this->closesAt;
        $restaurant->save();

        redirect()->route('admin');
    }

    public function showRestaurant($id)
    {
        redirect()->route('restaurant', ['id' => $id]);
    }

    public function deleteRestaurant($id)
    {
        Restaurant::findOrFail($id)->delete();

        redirect()->route('admin');
    }

    public function render()
    {
        return view('livewire.restaurant-form');
    }
}
