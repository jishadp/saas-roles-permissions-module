<?php

namespace Jishadp\SaasRolesPermissions\Models;

use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    protected $connection='mysql';
    protected $guarded = [];
}
