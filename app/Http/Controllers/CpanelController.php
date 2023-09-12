<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * CpanelController
 * @version cPanel-UAPI 11.114.0.2
 * @link https://api.docs.cpanel.net/cpanel/introduction/
 *
 * @property string $cp_url
 * Registra la Url del subdominio de Cpanel donde se ejecutaran las APIs
 *
 * @property string $cp_root_domain
 * Registra el host donde se aloja el proyecto, es el dominio de $cp_url
 *
 * @property string $cp_port
 * Registra el número de Puerto para las peticiones API de Cpanel
 *
 * @property string $cp_prefix_db
 * Registra el prefix de la base de datos del Cpanel
 *
 * @property string $cp_username
 * Registra el usuario con el que se hace login a Cpanel
 *
 * @property string $cp_token
 * Registra el Token de autenticación para las peticiones API
 *
 * @property string $cp_mysql_user
 * Registra el Usuario Mysql que se asignará a todas las bases de datos a crear
 *
 * @property string $cp_mysql_password
 * Registra el Password del Usuario Mysql que se asignará a todas las bases de datos a crear
 *
 * @property string $cp_subdomain_path
 * Registra el directorio de los Archivos de Cpanel donde apuntará el subdominio a crear
 */
class CpanelController extends BaseController
{
    use \App\Traits\ApiResponser;
    use \App\Traits\CpanelHttpClient;

    protected string $cp_url;
    protected string $cp_root_domain;
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

        $cp_url = explode('.', $this->cp_url );
        $i = count($cp_url);
        $this->cp_root_domain = $cp_url[$i-2] . '.' . $cp_url[$i-1];
    }
}