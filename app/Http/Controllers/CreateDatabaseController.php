<?php

namespace App\Http\Controllers;

use App\Services\DatabaseService;
use Illuminate\Http\Request;

class CreateDatabaseController extends Controller
{
    public function __invoke( Request $request, DatabaseService $service ): \Illuminate\Http\JsonResponse
    {

        $this->validate( $request, [ 'tenant' => $this->tenantRule() ]);

        $service
            ->setDatabaseName($request->tenant)
            ->createMysqlDatabase()
            ->updateMysqlUserPrivileges()
        ;

        return $this->successResponse( message: 'La base de datos se ha creado correctamente');
    }

    public function tenantRule(): string
    {
        return "required|string|not_in:$this->cp_domains_not_allowed";
    }
}
