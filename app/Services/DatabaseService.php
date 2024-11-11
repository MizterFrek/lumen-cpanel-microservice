<?php

namespace App\Services;

use App\Contracts\Cpanel;
use App\Contracts\DatabaseConfigurations;

class DatabaseService extends Cpanel implements DatabaseConfigurations
{
    protected string $database_name;

    public function setDatabaseName(string $name)
    {
        $this->database_name = (string) $this->cp_prefix_db . $name;
        return $this;
    }
    /**
     * @link https://api.docs.cpanel.net/openapi/cpanel/operation/Mysql-create_user/
     */
    public function createMysqlDatabase()
    {
        $url = $this->mysqlRequestUrl(
            self::CREATE_DATABASE_QUERY,
            [ 'name' => $this->database_name ]
        );
        $this->getRequest( $url );
        return $this;
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
        return $this;
    }
}
