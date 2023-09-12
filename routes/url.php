<?php
$router->get('/', fn() => response()->json(['status' => true ]) );
$router->get('create-database', App\Http\Controllers\CreateDatabaseController::class);