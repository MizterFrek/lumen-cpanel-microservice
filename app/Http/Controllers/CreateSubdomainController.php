<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateSubdomainController extends CpanelController
{
    const CREATE_SUBDOMAIN_QUERY = 'addsubdomain';

    public function __invoke( Request $request )
    {
        $this->validate( $request, [ 'tenant' => 'required|string' ]);

        $this->createSubdomain( $request->tenant );

        return $this->successResponse( message: 'OK');
    }

    /**
     * @link https://api.docs.cpanel.net/openapi/cpanel/operation/addsubdomain/
     * @param  string $tenant
     * @return void
     */
    private function createSubdomain( string $tenant ): void
    {
        $cp_url = explode('.', $this->cp_url );
        $i = count($cp_url);
        $rootDomain = $cp_url[$i-2] . '.' . $cp_url[$i-1];
        $url = $this->domainRequestUrl(
            self::CREATE_SUBDOMAIN_QUERY,
            [
                'domain' => $tenant,
                'rootdomain' => $rootDomain,
                'dir' => str_replace('/', '%2f', $this->cp_subdomain_path),
            ]
        );
        $this->getRequest( $url );
    }
}
