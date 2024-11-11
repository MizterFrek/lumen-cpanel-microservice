<?php

namespace App\Http\Controllers;

use App\Services\SubdomainService;
use Illuminate\Http\Request;

class CreateSubdomainController extends Controller
{
    public function __invoke( Request $request, SubdomainService $service )
    {
        $this->validate( $request, [ 'subdomain' => $this->subdomainRule() ]);

        $service->createSubdomain( $request->subdomain );

        return $this->successResponse( message: 'El subdominio se ha creado correctamente');
    }

    protected function subdomainRule(): string
    {
        return "required|string|not_in:$this->cp_domains_not_allowed";
    }
}
