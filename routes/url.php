<?php
$router->get('/', fn(): Illuminate\Http\JsonResponse => response()->json( ['status' => true, 'message' => 'OK'] ));
$router->post(config('routes.create_database'), App\Http\Controllers\CreateDatabaseController::class);
$router->post(config('routes.create_subdomain'), App\Http\Controllers\CreateSubdomainController::class);
