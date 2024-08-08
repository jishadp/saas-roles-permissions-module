<?php

namespace Jishadp\SaasRolesPermissions\Models;

use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    protected $connection='mysql';
    protected $guarded = [];
}
