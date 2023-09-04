<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse ($reports as $report)
                        <div style="margin: 20px 0px; border: solid; border-width: thin; padding-left: 20px;">
                            <p>{{ $report->message }}</p>
                            <x-primary-button style="margin: 10px 10px 10px 0px; background-color:blue;">
                                <a href="{{route('edit.product', $report->productId)}}">GO TO PRODUCT</a>
                            </x-primary-button>
                        </div>
                    @empty
                        <p>{{ 'No reports yet.' }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
