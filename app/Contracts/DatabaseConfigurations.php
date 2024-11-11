<?php

namespace App\Contracts;

interface DatabaseConfigurations
{
    const CREATE_DATABASE_QUERY = 'create_database';

    const SET_PRIVILEGES_QUERY = 'set_privileges_on_database';

    const USER_PRIVILEGES = 'ALL%20PRIVILEGES';
}
