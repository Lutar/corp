<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.9.17
 * Time: 20.04
 */

namespace Corp\Repositories;


use Corp\Role;

class RolesRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }
}