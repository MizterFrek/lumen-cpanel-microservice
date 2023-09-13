<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateDatabaseController extends CpanelController
{
    const CREATE_DATABASE_QUERY = 'create_database';
    const SET_PRIVILEGES_QUERY = 'set_privileges_on_database';
    const USER_PRIVILEGES = 'ALL%20PRIVILEGES';
    protected string $database_name;

    public function __invoke( Request $request ): \Illuminate\Http\JsonResponse
    {
        $this->validate( $request, [ 'tenant' => "required|string|not_in:$this->cp_domains_not_allowed" ]);
        $this->database_name = (string) $this->cp_prefix_db . $request->tenant;
        $this->createMysqlDatabase( $this->database_name );
        $this->updateMysqlUserPrivileges();
        return $this->successResponse( message: 'La base de datos se ha creado correctamente');
    }

    /**
     * @link https://api.docs.cpanel.net/openapi/cpanel/operation/Mysql-create_user/
     */
    private function createMysqlDatabase( string $database )
    {
        $url = $this->mysqlRequestUrl(
            self::CREATE_DATABASE_QUERY,
            [ 'name' => $database ]
        );
        $this->getRequest( $url );
    }

    /**
     * @link https://api.docs.cpanel.net/openapi/cpanel/operation/set_privileges_on_database/
     */
    public function updateMysqlUserPrivileges()
    {
        $url = $this->mysqlRequestUrl(
            self::SET_PRIVILEGES_QUERY,
            [
                'database' => $this->database_name,
                'user' => $this->cp_mysql_user,
                'privileges' => self::USER_PRIVILEGES
            ]
        );
        $this->getRequest( $url );
    }
}