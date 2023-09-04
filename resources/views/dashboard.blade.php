<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @forelse ($categories as $category)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 style="font-size: 50px;">{{ $category->name }}</h2>
                        @php
                            $x = 1
                        @endphp
                        @foreach ($products as $product)
                            @if ($product->categoryId != $category->id)
                                @continue
                            @endif
                            <div style="margin: 20px 0px; border: solid; border-width: thin; padding-left: 20px;">
                                <p style="font-weight: bold;">{{ $x++.'. '.$product->name }}</p>
                                <img src="{{asset('/storage'.'/'.$category->name.'/'.$product->photo)}}" alt="{{ $product->photo }}" style="width: 200px; height: 200px;">
                                <p>Price: Rp. {{ $product->price }}</p>
                                <p>Stock: {{ $product->stock }}</p>
                                <div style="display: flex;">
                                    @if ($product->stock != 0)
                                        <x-primary-button style="margin: 10px 10px 10px 0px; background-color:#3CB043;">
                                            <a href="{{ route('add.to.cart', $product->id) }}">ADD TO CART</a>
                                        </x-primary-button>
                                        <br>
                                        <x-primary-button style="margin: 10px 10px 10px 0px; background-color:orange;">
                                            <a href="{{ route('buy.product.now', $product->id) }}">BUY PRODUCT NOW</a>
                                        </x-primary-button>
                                    @else
                                        <p style="color: red;">{{ 'Out of stock, wait for admin to restock.' }}</p>
                                    @endif
                                </div>
                                <div style="display: flex;">
                                    @if (Auth::user()->isAdmin == 1)
                                    <br>
                                        <x-primary-button style="margin: 10px 10px 10px 0px; background-color:blue;">
                                            <a href="{{route('edit.product', $product->id)}}">EDIT</a>
                                        </x-primary-button>
                                        <form action="/delete-product/{{ $product->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <x-primary-button style="margin: 10px 10px 10px 0px; background-color: red;">
                                                <i data-feather="trash-2"></i>
                                            </x-primary-button>
                                        </form>
                                    @endif
                                    <x-primary-button style="margin: 10px 10px 10px 0px; background-color:black;">
                                        <a href="{{ route('report.product', $product->id) }}"><i data-feather="message-square"></i></a>
                                    </x-primary-button>
                                </div>
                            </div>
                        @endforeach
                        @if ($x == 1)
                            <p>{{ 'No products have been added yet.' }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>{{ 'No categories have been added yet.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</x-app-layout>
