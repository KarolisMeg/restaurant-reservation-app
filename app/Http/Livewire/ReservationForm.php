<?php

namespace App\Http\Livewire;

use App\Services\ReservationService;
use Livewire\Component;

class ReservationForm extends Component
{
    public $restaurants;

    public $name;

    public $surname;

    public $phone;

    public $email;

    public $duration;

    public $time;

    public $date;

    public $clients;

    public $inputs = [];

    public $index = 1;

    public $restaurant;

    public $notification = null;

    protected $rules = [
        'restaurant' => 'required',
        'name' => 'required|string',
        'surname' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|integer',
        'duration' => 'required|integer',
        'time' => 'required',
        'date' => 'required||after_or_equal:now',
        'clients.*.name' => 'required|string',
        'clients.*.surname' => 'required|string',
        'clients.*.email' => 'required|email',
        'clients' => 'required|array|min:1',
    ];

    protected $messages = [
        'date' => 'The date should be today or later.',
        'clients' => 'A minimum of one customer is required.',
        'clients.*.name' => 'The name field is required.',
        'clients.*.surname' => 'The surname field is required.',
        'clients.*.email' => 'The email field is required.',
    ];

    public function add($index)
    {
        $index = $index + 1;
        $this->index = $index;
        $this->inputs[] = $index;
    }

    public function remove($index)
    {
        unset($this->inputs[$index]);
    }

    public function submit(ReservationService $reservationService)
    {
        $this->notification = null;
        $response = $reservationService->makeReservation(collect($this->validate()));

        if ($response['reservation']) {
            redirect()->route('reservation-success', ['uuid' => $response['reservation']->uuid]);
        }

        $this->notification = $response['message'];
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}
