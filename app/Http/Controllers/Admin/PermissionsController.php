<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Repositories\PermissionsRepository;
use Corp\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Gate;
use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;

class PermissionsController extends AdminController
{
    private $per_rep;
    private $rol_rep;

    public function __construct(PermissionsRepository $per_rep, RolesRepository $rol_rep)
    {
        parent::__construct();

        if (Gate::denies('EDIT_USERS')) {
            abort(403);
        }

        $this->per_rep = $per_rep;
        $this->rol_rep = $rol_rep;

        $this->template = env('THEME').'.admin.permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Менеджер прав пользователей';

        $roles = $this->getRoles();
        $permissions = $this->getPermissions();

        $this->content = view(env('THEME').'.admin.permissions_content')
            ->with(['roles' => $roles, 'priv' => $permissions])
            ->render();

        return $this->renderOutput();
    }

    private function getRoles()
    {
        $roles = $this->rol_rep->get();

        return $roles;
    }

    private function getPermissions()
    {
        $permissions = $this->per_rep->get();

        return $permissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->per_rep->changePermissions($request);
            return back()->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
