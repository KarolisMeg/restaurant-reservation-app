@extends('base')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">
                    <h1>Reservation was successful!</h1>
                    <p>Reservation: {{ $reservation->uuid }}</p>
                    <p>Restaurant: {{ $reservation->restaurant->title }}</p>
                    <p>Reservation time: {{ $reservation->starts_at }} - {{ $reservation->ends_at }}</p>
                    <p>Reserved tables: {{ $reservation->tables()->count() }}</p>
                    <p>Clients count: {{ $reservation->clients()->count() }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection


