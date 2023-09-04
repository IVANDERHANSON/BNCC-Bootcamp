<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php
                        $x = 1
                    @endphp
                    @foreach ($carts as $cart)
                        @if ($cart->userId != Auth::user()->id)
                            @continue
                        @endif
                        <p>{{ $x++.'. '.$cart->productName }}</p>
                        <img src="{{asset('/storage'.'/'.$cart->category.'/'.$cart->productPhoto)}}" alt="{{ $cart->productPhoto }}">
                        <p>Category: {{ $cart->category }}</p>
                        <p>Price: Rp. {{ $cart->productPrice }}</p>
                        <p>Quantity: {{ $cart->quantity }}</p>
                        <p>Total Price: {{ $cart->productPrice*$cart->quantity }}</p>
                        <x-primary-button style="margin: 10px 10px; background-color:blue;">
                            <a href="{{route('edit.cart', $cart->id)}}">EDIT</a>
                        </x-primary-button>
                        <form action="/delete-cart/{{ $cart->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <x-primary-button style="margin: 10px 10px; background-color: red;">
                                DELETE
                            </x-primary-button>
                        </form>
                        <x-primary-button style="margin: 10px 10px; background-color:orange;">
                            <a href="{{ route('buy.product', $cart->id) }}">BUY</a>
                        </x-primary-button>
                        <br>
                    @endforeach
                    @if ($x == 1)
                        <p>{{ 'Your shopping cart is empty.' }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
