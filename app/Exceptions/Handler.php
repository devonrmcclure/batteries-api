<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\QueryBuilder\Exceptions\InvalidIncludeQuery;
use Spatie\QueryBuilder\Exceptions\InvalidFieldQuery;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use League\OAuth2\Server\Exception\OAuthServerException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    // protected $dontReport = [
    //     \League\OAuth2\Server\Exception\OAuthServerException::class,
    // ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
		parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
		$response = null;
		if ($request->wantsJson() || $request->ajax()) {
			switch(true) {
				case $exception instanceof ModelNotFoundException:
					$response = response()->json([
						'message' => $exception->getMessage(),
						'status' => 404
					])->setStatusCode(404);
					break;
				
				case $exception instanceof InvalidIncludeQuery:
					$response = response()->json([
						'message' => $exception->getMessage(),
						'status' => 400
					])->setStatusCode(400);
					break;

				case $exception instanceof InvalidFieldQuery:
					$response = response()->json([
						'message' => $exception->getMessage(),
						'status' => 400
					])->setStatusCode(404);
					break;

				case $exception instanceof NotFoundHttpException:
					$response = response()->json([
						'message' => 'Not found',
						'status' => 404
					])->setStatusCode(404);
					break;

				case $exception instanceof MethodNotAllowedHttpException:
					$response = response()->json([
						'message' => 'Not allowed',
						'status' => 405
					])->setStatusCode(405);
					break;
				
				case $exception instanceof \Illuminate\Auth\AuthenticationException:
					$response = response()->json([
						'message' => 'bad token',
						'status' => 401
					])->setStatusCode(401);
					break;

				default:
						dd($exception instanceof \Illuminate\Auth\AuthenticationException);
					$response = response()->json([
						'message' => 'Something went wrong',
						'status' => 500
					])->setStatusCode(500);
			}

			return $response;
		}

        return parent::render($request, $exception);
    }
}
