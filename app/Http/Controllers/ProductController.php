<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    public function index() {
		$products = QueryBuilder::for(Product::class)
			->allowedIncludes(['category'])
			->jsonPaginate();

		return new ProductCollection($products);
	}

	// Show info for a specific product, optionally with categories
	public function show(int $id) {
		ProductResource::withoutWrapping();

		$product = QueryBuilder::for(Product::class)
			->allowedIncludes(['category'])
			->findOrFail($id);

		return new ProductResource($product);
	}
}
