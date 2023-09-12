<?php
$router->get('/', fn(): Illuminate\Http\JsonResponse => response()->json(['message' => 'OK' ]) );
$router->get('database', App\Http\Controllers\CreateDatabaseController::class);
$router->get('subdomain', App\Http\Controllers\CreateSubdomainController::class);
