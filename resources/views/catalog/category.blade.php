@extends('layouts.app')

@section('title', $category->name . ' — Tech Store')

@section('content')
    {{-- Breadcrumbs --}}
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('catalog.index') }}" class="hover:text-gray-700">Каталог</a>
        @foreach($breadcrumbs as $crumb)
            @if($crumb->slug !== 'katalog')
                <span class="mx-1">/</span>
                @if($crumb->id === $category->id)
                    <span class="text-gray-900">{{ $crumb->name }}</span>
                @else
                    <a href="{{ route('catalog.category', $crumb->slug) }}" class="hover:text-gray-700">{{ $crumb->name }}</a>
                @endif
            @endif
        @endforeach
    </nav>

    <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $category->name }}</h1>

    {{-- Subcategories --}}
    @if($children->count())
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            @foreach($children as $child)
                <a href="{{ route('catalog.category', $child->slug) }}"
                   class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition text-center">
                    <h3 class="font-semibold text-gray-900">{{ $child->name }}</h3>
                </a>
            @endforeach
        </div>
    @endif

    {{-- Products --}}
    @if($products->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <a href="{{ route('catalog.product', $product->slug) }}"
                   class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                    @if($product->images->count())
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                            <img
                                 src="{{ asset('storage/' . $product->images->first()->path) }}"
                                 alt="{{ $product->name }}"
                                 class="rounded-lg w-full h-96 max-h-full object-contain bg-white">
                        </div>
                    @else
                        <div class="h-48 flex items-center justify-center bg-white">
                            📷
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 text-sm mb-2">{{ $product->name }}</h3>
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-gray-900">{{ number_format($product->price, 0, '', ' ') }} ₴</span>
                            @if($product->old_price)
                                <span class="text-sm text-gray-400 line-through">{{ number_format($product->old_price, 0, '', ' ') }} ₴</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-gray-500">Товарів поки немає</p>
    @endif
@endsection
