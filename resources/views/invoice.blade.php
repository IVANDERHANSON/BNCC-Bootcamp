<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php
                        $x = 1
                    @endphp
                    @foreach ($invoices as $invoice)
                        @if ($invoice->userId != Auth::user()->id)
                            @continue
                        @endif
                        <div style="margin: 20px 0px; border: solid; border-width: thin; padding-left: 20px;">
                            <p style="font-weight: bold;">{{ $x++.'. '.$invoice->productName }}</p>
                            <img src="{{asset('/storage'.'/'.$invoice->category.'/'.$invoice->productPhoto)}}" alt="{{ $invoice->productPhoto }}" style="width: 200px; height: 200px;">
                            <p>Category: {{ $invoice->category }}</p>
                            <p>Price: Rp. {{ $invoice->productPrice }}</p>
                            <p>Quantity: {{ $invoice->quantity }}</p>
                            <p>Address: {{ $invoice->address }}</p>
                            <p>Postal Code: {{ $invoice->postalCode }}</p>
                            <p>Total Price: Rp. {{ $invoice->totalPrice }}</p>
                            <p></p>
                        </div>
                    @endforeach
                    @if ($x == 1)
                        <p>{{ 'Your shopping invoice is empty.' }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
