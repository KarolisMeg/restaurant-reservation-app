@extends('base')
@section('content')
@livewire('reservation-form', ['restaurants' => $restaurants])
@endsection


