@extends('layout.app')

@section('title', 'Gracias por tu compra')

@section('content')
<div class="py-12 text-center">

    <h1 class="text-3xl font-bold mb-4">¡Gracias por tu compra!</h1>

    @if ($paymentMethod === 'transfer')
        <p class="text-lg text-gray-300 mb-6">
            Elegiste pagar por transferencia bancaria. Te enviaremos los datos por email para completar el pago.
        </p>

        <div class="max-w-lg mx-auto mb-6 p-5 bg-gray-800 rounded-md text-left">
            <h3 class="text-lg font-semibold text-white mb-4">Datos Bancarios para Transferencia</h3>

            <div class="space-y-3 text-gray-200 text-sm">
                <div>
                    <span class="block text-xs text-gray-400">Titular de la cuenta</span>
                    <span class="block font-medium">Digital Games S.A.</span>
                </div>
                <div>
                    <span class="block text-xs text-gray-400">Banco</span>
                    <span class="block font-medium">Banco Nacional</span>
                </div>
                <div>
                    <span class="block text-xs text-gray-400">Número de Cuenta</span>
                    <span class="block font-medium">4567-8901-2345-6789</span>
                </div>
                <div>
                    <span class="block text-xs text-gray-400">CBU</span>
                    <span class="block font-medium">0000999988887777666655554444</span>
                </div>
                <div>
                    <span class="block text-xs text-gray-400">CUIT</span>
                    <span class="block font-medium">30-71234567-8</span>
                </div>
                <div>
                    <span class="block text-xs text-gray-400">Alias</span>
                    <span class="block font-medium">DIGITAL.GAMES.STORE</span>
                </div>
            </div>

            <div class="mt-4 bg-gray-700 p-4 rounded-md">
                <p class="text-sm text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-blue-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Tu pedido será procesado una vez se confirme el pago de la transferencia. Por favor, envianos el comprobante de la transferencia a nuestro mail.
                </p>
            </div>
        </div>

    @elseif ($paymentMethod === 'card')
        <p class="text-lg text-gray-300 mb-6">
            Tu pago con tarjeta fue procesado con éxito. Pronto recibirás un comprobante por email.
        </p>
    @elseif ($paymentMethod === 'mercadopago')
        <p class="text-lg text-gray-300 mb-6">
            Has completado tu compra con Mercado Pago. En breve recibirás la confirmación por email.
        </p>
    @else
        <p class="text-lg text-gray-300 mb-6">
            Gracias por tu compra. Te mantendremos informado por email.
        </p>
    @endif

    <a href="{{ route('orders.index') }}" class="inline-block mt-4 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
        Ver mis órdenes
    </a>
</div>
@endsection
