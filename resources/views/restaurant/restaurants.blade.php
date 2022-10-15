@extends('base')
@section('content')
    @livewire('restaurant-form', ['restaurants' => $restaurants])
@endsection
