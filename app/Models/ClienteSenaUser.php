<?php

namespace App\Models;

class ClienteSenaUser extends User
{
    protected $connection = 'adminsena';

    protected $table = 'users';
}
