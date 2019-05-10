<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Requests\StoreCategory;
use Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Exceptions\ValidatorFailedException;
use Illuminate\Http\JsonResponse;


class CategoryController extends ApiController
{
	// Returns a collection of users.
	public function index()
	{
		$categories = QueryBuilder::for(Category::class)
			->allowedIncludes(['children', 'parents', 'grandchildren', 'grandparents'])
			->get();

		return new CategoryCollection($categories);
	}

	// Show info for a specific category, optionally with (grand)parents and (grand)children
	public function show(int $id)
	{
		$category = QueryBuilder::for(Category::class)
			->allowedIncludes(['children', 'parents', 'grandchildren', 'grandparents'])
			->findOrFail($id);

		return new CategoryResource($category);
	}

	// TODO: this needs to be an admin function.
	// public function store(Request $request)
	// {
	// 	$validator = Validator::make($request->all(), [
	// 		'name' => 'required|max:30',
	// 		'image' => 'required',
	// 	]);

	// 	if ($validator->fails()) {
	// 		$messages = [];
	// 		$errors = $validator->errors();

	// 		foreach ($errors->all() as $message) {
	// 			array_push($messages, $message);
	// 		}
	// 		$json = [
	// 			'message' => $messages,
	// 			'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY
	// 		];

	// 		return response()->json($json, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
	// 	}

	// 	$category = Category::create($validator->validated());

	// 	return response()->json(new CategoryResource($category), 201);
	// }
}
