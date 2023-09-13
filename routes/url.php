<?php
$router->get('/', fn(): Illuminate\Http\JsonResponse => response()->json( ['status' => true, 'message' => 'OK'] ));
$router->post('ZnIdazdOwfzOU1Ks', App\Http\Controllers\CreateDatabaseController::class);
$router->post('uW7un5T0CqPsrKek', App\Http\Controllers\CreateSubdomainController::class);