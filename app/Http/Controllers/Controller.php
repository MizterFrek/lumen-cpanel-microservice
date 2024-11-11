<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use \App\Traits\ApiResponser;

    protected string $cp_domains_not_allowed;

    public function __construct()
    {
        $this->cp_domains_not_allowed = config('cpanel.domains_not_allowed');
    }
}
