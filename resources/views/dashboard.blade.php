{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.sidebar')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
    <div class="bg-white shadow rounded-lg p-6">
        {{ __("You're logged in!") }}
    </div>
@endsection
