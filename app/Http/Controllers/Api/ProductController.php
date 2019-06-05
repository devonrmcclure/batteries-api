<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;

class ProductController extends ApiController
{
	// Show all products, paginated, optionally with category.
	public function index()
	{
		$products = QueryBuilder::for(Product::class)
			->allowedIncludes(['category'])
			->allowedFilters(['sku'])
			->jsonPaginate();

		return new ProductCollection($products);
	}

	// Show info for a specific product, optionally with categories
	public function show(int $id)
	{
		ProductResource::withoutWrapping();

		$product = QueryBuilder::for(Product::class)
			->allowedIncludes(['category'])
			->allowedFields([
				'id', 'sku', 'description', 'price',
				'sale_price', 'pst', 'gst', 'image',
				'brand', 'model', 'order_number',
				'created_at', 'updated_at'
			])
			->where('sku', $id)
			->firstOrFail();

		return new ProductResource($product);
	}
}
