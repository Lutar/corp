<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.9.17
 * Time: 20.04
 */

namespace Corp\Repositories;


use Corp\Permission;
use Gate;

class PermissionsRepository extends Repository
{
    private $rol_rep;

    public function __construct(Permission $permission, RolesRepository $rol_rep)
    {
        $this->model = $permission;
        $this->rol_rep = $rol_rep;
    }

    public function changePermissions($request)
    {
        if (Gate::denies('change', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token');
        $roles = $this->rol_rep->get();

        foreach ($roles as $role) {
            if (isset($data[$role->id])) {
                $role->savePermissions($data[$role->id]);
            } else {
                $role->savePermissions([]);
            }
        }

        return ['status' => 'Права обновлены'];
    }
}