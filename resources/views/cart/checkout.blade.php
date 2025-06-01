@extends('layout.app')

@section('title', 'Checkout')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-6">Información de Pago</h2>

                <form id="checkout-form" action="{{ route('cart.process') }}" method="POST">
                    @csrf
                    <!-- Campos comunes para ambos métodos de pago -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Nombre Completo</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white" required>
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email ?? '' }}" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white" required>
                    </div>

                    <!-- Selector de método de pago -->
                    <div class="mb-6">
                        <label for="payment_method" class="block text-sm font-medium text-gray-400 mb-1">Método de Pago</label>
                        <select id="payment_method" name="payment_method" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white" onchange="togglePaymentForm()" required>
                            <option value="card">Tarjeta de Crédito/Débito</option>
                            <option value="transfer">Transferencia Bancaria</option>
                        </select>
                    </div>

                    <!-- Campos específicos para tarjeta -->
                    <div id="card-fields">
                        <div class="mb-4">
                            <label for="card" class="block text-sm font-medium text-gray-400 mb-1">Número de Tarjeta</label>
                            <input type="text" id="card" name="card" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white">
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="expiry" class="block text-sm font-medium text-gray-400 mb-1">Fecha de Expiración</label>
                                <input type="text" id="expiry" name="expiry" placeholder="MM/AA" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white">
                            </div>

                            <div>
                                <label for="cvv" class="block text-sm font-medium text-gray-400 mb-1">CVV</label>
                                <input type="text" id="cvv" name="cvv" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white rounded-md py-3 font-medium transition">
                            Confirmar Pedido
                        </button>
                    </div>

                    <!-- Campos específicos para transferencia -->
                    <div id="transfer-fields" style="display: none;">
                        <div class="mb-6 p-5 bg-gray-700 rounded-md">
                            <h3 class="text-lg font-medium text-white mb-3">Datos Bancarios para Transferencia</h3>

                            <div class="space-y-3 text-gray-200">
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
                        </div>

                        <div class="mb-4 p-4 bg-gray-700 rounded-md">
                            <p class="text-sm text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-blue-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Tu pedido será procesado una vez se confirme el pago de la transferencia. Por favor, envianos el comprobante de la transferencia a nuestro mail.
                            </p>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white rounded-md py-3 font-medium transition">
                            Confirmar Pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-6">Resumen del Pedido</h2>

                <div class="space-y-4 mb-6">
                    @foreach($cart->items as $item)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-400">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                            </div>
                            <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-700 pt-4">
                    <div class="flex justify-between items-center font-bold text-lg mt-4">
                        <span>Total</span>
                        <span>${{ number_format($cart->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePaymentForm() {
        const paymentMethod = document.getElementById('payment_method').value;
        const cardFields = document.getElementById('card-fields');
        const transferFields = document.getElementById('transfer-fields');

        if (paymentMethod === 'card') {
            cardFields.style.display = 'block';
            transferFields.style.display = 'none';
        } else {
            cardFields.style.display = 'none';
            transferFields.style.display = 'block';
        }
    }
</script>
@endsection
