<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($categories as $category)
                        <h2>{{ $category->name }}</h2>
                        @php
                            $x = 1
                        @endphp
                        @foreach ($products as $product)
                            @if ($product->categoryId != $category->id)
                                @continue
                            @endif
                            <p>{{ $x++.'. '.$product->name }}</p>
                            <img src="{{asset('/storage'.'/'.$category->name.'/'.$product->photo)}}" alt="{{ $product->photo }}">
                            <p>Price: Rp. {{ $product->price }}</p>
                            <p>Stock: {{ $product->stock }}</p>
                            @if (Auth::user()->isAdmin == 1)
                                <x-primary-button style="margin: 10px 10px; background-color:blue;">
                                    <a href="{{route('edit.product', $product->id)}}">EDIT</a>
                                </x-primary-button>
                                <form action="/delete-product/{{ $product->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <x-primary-button style="margin: 10px 10px; background-color: red;">
                                        DELETE
                                    </x-primary-button>
                                </form>
                            @endif
                            <x-primary-button style="margin: 10px 10px; background-color:#3CB043;">
                                <a href="{{ route('add.to.cart', $product->id) }}">ADD TO CART</a>
                            </x-primary-button>
                            <x-primary-button style="margin: 10px 10px; background-color:orange;">
                                <a href="{{ route('buy.product.now', $product->id) }}">BUY PRODUCT NOW</a>
                            </x-primary-button>
                            <br>
                        @endforeach
                        @if ($x == 1)
                            <p>{{ 'No products have been added yet.' }}</p>
                        @endif
                        <br>
                    @empty
                        <p>{{ 'No categories have been added yet.' }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
