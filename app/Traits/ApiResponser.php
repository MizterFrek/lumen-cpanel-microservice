<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponser
{
    /**
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse(string $message = '', bool $status = true, int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(['message' => $message, 'status' => $status , 'code' => $code], $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse(string $message, int $code, bool $status = false): JsonResponse
    {
        return new JsonResponse(['status' => $status, 'error' => $message, 'code' => $code], $code);
    }
}