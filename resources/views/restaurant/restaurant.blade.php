@extends('base')
@section('content')
<div class="container">
  <div class="row">
      <div class="col-12">
      <h1>Restaurant - {{ $restaurant->title }}</h1>
      </div>
      <div class="col-4">
          @livewire('tables-form', ['restaurant' => $restaurant])
      </div>
      <div class="col-12">
          <h2>Reservations:</h2>
          <table class="table">
              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Starts At</th>
                  <th scope="col">Ends At</th>
                  <th scope="col">Tables</th>
                  <th scope="col">Clients</th>
                  <th scope="col">Name</th>
                  <th scope="col">Surname</th>
                  <th scope="col">Phone</th>
              </tr>
              </thead>
              <tbody>
              @foreach($restaurant->reservations as $index => $reservation)
                  <tr>
                      <th scope="row">{{ $index + 1 }}</th>
                      <td>{{ $reservation->starts_at }}</td>
                      <td>{{ $reservation->ends_at }}</td>
                      <td>{{ $reservation->tables_count }}</td>
                      <td>{{ $reservation->clients_count }}</td>
                      <td>{{ $reservation->name }}</td>
                      <td>{{ $reservation->surname }}</td>
                      <td>{{ $reservation->phone }}</td>
                  </tr>
              @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>
@endsection
