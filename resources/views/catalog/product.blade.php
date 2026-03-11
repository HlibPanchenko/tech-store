@extends('layouts.app')

@section('title', $product->name . ' — Tech Store')

@section('content')
    {{-- Breadcrumbs --}}
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('catalog.index') }}" class="hover:text-gray-700">Каталог</a>
        @foreach($breadcrumbs as $crumb)
            @if($crumb->slug !== 'katalog')
                <span class="mx-1">/</span>
                <a href="{{ route('catalog.category', $crumb->slug) }}" class="hover:text-gray-700">{{ $crumb->name }}</a>
            @endif
        @endforeach
        <span class="mx-1">/</span>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Images --}}
        <div>
            @if($product->images->count())
                <img id="mainImage"
                     src="{{ asset('storage/' . $product->images->first()->path) }}"
                     alt="{{ $product->name }}"
                     class="rounded-lg w-full h-96 object-contain bg-white border">

                @if($product->images->count() > 1)
                    <div class="grid grid-cols-5 gap-2 mt-3">
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->path) }}"
                                 alt="{{ $product->name }}"
                                 onclick="document.getElementById('mainImage').src=this.src"
                                 class="rounded border cursor-pointer h-20 w-full object-contain bg-white hover:border-blue-500 transition">
                        @endforeach
                    </div>
                @endif
            @else
                <div class="bg-gray-200 rounded-lg h-96 flex items-center justify-center text-gray-400 text-6xl">
                    📷
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
            <p class="text-sm text-gray-500 mb-4">SKU: {{ $product->sku }} · {{ $product->brand->name }}</p>

            <div class="flex items-center gap-3 mb-6">
                <span class="text-3xl font-bold text-gray-900">{{ number_format($product->price, 0, '', ' ') }} ₴</span>
                @if($product->old_price)
                    <span class="text-lg text-gray-400 line-through">{{ number_format($product->old_price, 0, '', ' ') }} ₴</span>
                @endif
            </div>

            @if($product->quantity > 0)
                <span class="inline-block bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full mb-6">В наявності</span>
            @else
                <span class="inline-block bg-red-100 text-red-700 text-sm px-3 py-1 rounded-full mb-6">Немає в наявності</span>
            @endif

            {{-- Attributes --}}
            @if($product->attributeValues->count())
                <div class="border-t pt-4 mb-6">
                    <h3 class="font-semibold text-gray-900 mb-3">Характеристики</h3>
                    @foreach($product->attributeValues->groupBy('attribute.name') as $attrName => $values)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-500">{{ $attrName }}</span>
                            <span class="text-gray-900">{{ $values->pluck('value')->join(', ') }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <button class="w-full bg-blue-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
                Додати в кошик
            </button>

            @if($product->description)
                <div class="mt-6 text-gray-600 leading-relaxed">
                    {!! nl2br(e($product->description)) !!}
                </div>
            @endif
        </div>
    </div>
@endsection
