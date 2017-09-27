<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.9.17
 * Time: 20.04
 */

namespace Corp\Repositories;


use Corp\Permission;

class PermissionsRepository extends Repository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }
}