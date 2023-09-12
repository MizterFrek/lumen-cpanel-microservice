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
    public function successResponse(mixed $data, string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(['data'=> $data, 'message' => $message, 'code' => $code], $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse(mixed $message, int $code): JsonResponse
    {
        return new JsonResponse(['error' => $message, 'code' => $code], $code);
    }
}