@extends('layouts.app')

@section('title', 'Tech Store — Магазин техніки')

@section('content')
    <div class="text-center py-16">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Ласкаво просимо до Tech Store</h1>
        <p class="text-lg text-gray-600 mb-8">Найкраща техніка за найкращими цінами</p>
        <a href="/catalog" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-700">
            Перейти до каталогу
        </a>
    </div>
@endsection
