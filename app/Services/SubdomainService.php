<?php

namespace App\Services;

use App\Contracts\Cpanel;
use App\Contracts\SubdomainConfigurations;

class SubdomainService extends Cpanel implements SubdomainConfigurations
{
    /**
     * @link https://api.docs.cpanel.net/openapi/cpanel/operation/addsubdomain/
     * @param  string $tenant
     * @return void
     */
    public function createSubdomain( string $subdomain ): self
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

        return $this;
    }
}
