<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class CpanelController extends BaseController
{
    use \App\Traits\ApiResponser;
    use \App\Traits\CpanelHttpClient;

    protected string $cp_url;
    protected string $cp_port;
    protected string $cp_prefix_db;
    protected string $cp_username;
    protected string $cp_token;
    protected string $cp_mysql_user;
    protected string $cp_mysql_password;
    protected string $cp_subdomain_path;

    public function __construct()
    {
        $this->cp_url = config('cpanel.url');
        $this->cp_port = config('cpanel.port');
        $this->cp_prefix_db = config('cpanel.prefix_db');
        $this->cp_username = config('cpanel.username');
        $this->cp_token = config('cpanel.token');
        $this->cp_mysql_user = config('cpanel.mysql_user');
        $this->cp_mysql_password = config('cpanel.mysql_password');
        $this->cp_subdomain_path = config('cpanel.subdomain_path');
    }
}