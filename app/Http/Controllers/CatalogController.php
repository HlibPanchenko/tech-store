<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->with('children')
            ->orderBy('sort_order')
            ->first()
            ->children;

        return view('catalog.index', compact('categories'));
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $children = $category->children()->where('is_active', true)->get();

        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->paginate(12);

        $breadcrumbs = $category->ancestorsAndSelf()->get()->reverse();

        return view('catalog.category', compact('category', 'children', 'products', 'breadcrumbs'));
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'brand', 'images', 'attributeValues.attribute'])
            ->firstOrFail();

        $breadcrumbs = $product->category->ancestorsAndSelf()->get()->reverse();

        return view('catalog.product', compact('product', 'breadcrumbs'));
    }
}
