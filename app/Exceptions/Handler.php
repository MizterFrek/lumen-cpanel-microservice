<?php

namespace App\Exceptions;

use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use \App\Traits\ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
            $code = $exception->getStatusCode();
            $message = $exception->getMessage() ? $exception->getMessage() : Response::$statusTexts[$code];
            return $this->errorResponse($message, $code);
        }
        if($exception instanceof \Illuminate\Validation\ValidationException) {
            $errors = $exception->validator->errors()->getMessages();
            $errors = array_map( fn($item) => $item[0], $errors);
            return $this->errorResponse(implode(',', $errors ), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return $this->errorResponse($exception->getMessage(),
                Response::HTTP_FORBIDDEN
            );
        }
        if($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return $this->errorResponse($exception->getMessage(),
                Response::HTTP_UNAUTHORIZED
            );
        }
        if( env('APP_DEBUG', false) ) {
            return parent::render($request, $exception);
        }
        return $this->errorResponse(Response::$statusTexts[500], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}