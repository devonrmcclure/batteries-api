<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category as CategoryResource;

use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
	// Returns a collection of users.
    public function index() {

		$categories = QueryBuilder::for(Category::class)
			->allowedIncludes(['children', 'parents', 'grandchildren', 'grandparents'])
			->get();

		return new CategoryCollection($categories);
	}

	// Show info for a specific category, optionally with (grand)parents and (grand)children
	public function show(int $id) {

		$category = QueryBuilder::for(Category::class)
			->allowedIncludes(['children', 'parents', 'grandchildren', 'grandparents'])
			->findOrFail($id);

		return new CategoryResource($category);
	}
}
