<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/addProduct" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            @error('categoryId')
                                <span class="text-error block" style="color: red;">{{ 'The category field is required.' }}</span>
                            @enderror
                            <label for="exampleInputPassword1" class="form-label">Category</label>
                            <br>
                            <select class="form-select" aria-label="Default select example" name="categoryId">
                                <option style="display: none;"></option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <br>
                            <label for="exampleInputPassword1" class="form-label">Name</label> <br>
                            @error('name')
                                <span class="text-error block" style="color: red;">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control" id="exampleInputPassword1" name='name' placeholder="" value="{{ old('name') }}">
                        </div>

                        <div>
                            <br>
                            <label for="exampleInputPassword1" class="form-label">Price</label> <br>
                            @error('price')
                                <span class="text-error block" style="color: red;">{{ $message }}</span>
                            @enderror
                            <input type="number" class="form-control" id="exampleInputPassword1" name='price' placeholder="" value="{{ old('price') }}">
                        </div>

                        <div>
                            <br>
                            <label for="exampleInputPassword1" class="form-label">Stock</label> <br>
                            @error('stock')
                                <span class="text-error block" style="color: red;">{{ $message }}</span>
                            @enderror
                            <input type="number" class="form-control" id="exampleInputPassword1" name='stock' placeholder="" value="{{ old('stock') }}">
                        </div>

                        <div class="mb-3">
                            <br>
                            @error('photo')
                                <span class="text-error block" style="color: red;">{{ $message }}</span>
                            @enderror
                            <label for="exampleInputPassword1" class="form-label">Photo</label>
                            <br>
                            <input type="file" class="form-control" id="exampleInputPassword1" name='photo' value="{{old('photo')}}">
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
