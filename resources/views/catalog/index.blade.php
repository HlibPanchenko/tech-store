@extends('layouts.app')

@section('title', 'Каталог — Tech Store')

@section('content')
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Каталог</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <a href="{{ route('catalog.category', $category->slug) }}"
               class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition text-center">
                <div class="text-4xl mb-3">📁</div>
                <h2 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h2>
            </a>
        @endforeach
    </div>
@endsection
