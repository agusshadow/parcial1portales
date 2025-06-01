@extends('layout.app')

@section('title', 'Gracias por tu compra')

@section('content')
<div class="py-12 text-center">
    <h1 class="text-3xl font-bold mb-4">¡Gracias por tu compra!</h1>
    <p class="text-lg text-gray-300 mb-6">Tu orden ha sido recibida correctamente. Pronto recibirás una confirmación por email.</p>

    <a href="{{ route('orders.index') }}" class="inline-block mt-4 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
        Ver mis órdenes
    </a>
</div>
@endsection
