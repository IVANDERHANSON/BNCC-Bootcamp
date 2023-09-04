<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buy Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>{{ $cart->productName }}</p>
                    <img src="{{asset('/storage'.'/'.$cart->category.'/'.$cart->productPhoto)}}" alt="{{ $cart->productPhoto }}">
                    <h2>Category: {{ $cart->category }}</h2>
                    <p>Price: Rp. {{ $cart->productPrice }}</p>
                    <p>Quantity: {{ $cart->quantity }}</p>
                    <p>Total Price: {{ $cart->productPrice*$cart->quantity }}</p>
                    <br>
                    <form action="/buyProduct/{{ $cart->id }}" method="POST">
                        @csrf
                        <div>
                            <label for="exampleInputPassword1" class="form-label">Address</label> <br>
                            @error('address')
                                <span class="text-error block" style="color: red;">{{ $message }}</span>
                            @enderror
                            <textarea name='address' placeholder="" rows="3" style="resize: none;">{{ old('address') }}</textarea>
                        </div>

                        <br>
                        <div>
                            <label for="exampleInputPassword1" class="form-label">Postal Code</label> <br>
                            @error('postalCode')
                                <span class="text-error block" style="color: red;">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="exampleInputPassword1" name='postalCode' placeholder="" value="{{ old('postalCode') }}">
                        </div>

                        <div>
                            <br>
                            <x-primary-button class="mt-2">
                                <input type="submit" value="Submit">
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
