<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateSubdomainController extends CpanelController
{
    const CREATE_SUBDOMAIN_QUERY = 'addsubdomain';

    public function __invoke( Request $request )
    {
        $this->validate( $request, [ 'subdomain' => 'required|string' ]);

        $this->createSubdomain( $request->subdomain );

        return $this->successResponse( message: 'El subdominio se ha creado correctamente');
    }

    /**
     * @link https://api.docs.cpanel.net/openapi/cpanel/operation/addsubdomain/
     * @param  string $tenant
     * @return void
     */
    private function createSubdomain( string $subdomain ): void
    {

        $url = $this->domainRequestUrl(
            self::CREATE_SUBDOMAIN_QUERY,
            [
                'domain' => $subdomain,
                'rootdomain' => $this->cp_root_domain,
                'dir' => str_replace('/', '%2f', $this->cp_subdomain_path),
            ]
        );
        $this->getRequest( $url );
    }
}