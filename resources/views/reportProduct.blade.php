<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p style="font-weight: bold;">{{ $product->name }}</p>
                    <img src="{{asset('/storage'.'/'.$category.'/'.$product->photo)}}" alt="{{ $product->photo }}" style="width: 200px; height: 200px;">
                    <h2>Category: {{ $category }}</h2>
                    <p>Price: Rp. {{ $product->price }}</p>
                    <p>Stock: {{ $product->stock }}</p>

                    <form action="/reportProduct/{{ $product->id }}" method="POST">
                        @csrf
                        <br>
                        <div>
                            <label for="exampleInputPassword1" class="form-label">Message</label> <br>
                            @error('message')
                                <span class="text-error block" style="color: red;">{{ $message }}</span>
                            @enderror
                            <textarea name='message' placeholder="" rows="3" style="resize: none;">{{ old('message') }}</textarea>
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
