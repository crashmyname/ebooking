<?php

namespace App\Models;
use Support\BaseModel;

class User extends BaseModel
{
    // Model logic here
    protected $table = 'users';
    protected $primaryKey = 'users_id';
}
