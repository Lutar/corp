<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Gate;
use Menu;
use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;

class MenusController extends AdminController
{
    private $m_rep;

    public function __construct(MenusRepository $m_rep, ArticlesRepository $a_rep, PortfoliosRepository $p_rep)
    {
        parent::__construct();

        if (Gate::denies('VIEW_ADMIN_MENU')) {
            abort(403);
        }

        $this->m_rep = $m_rep;
        $this->a_rep = $a_rep;
        $this->p_rep = $p_rep;

        $this->template = env('THEME').'.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Менеджер меню';
        $menu = $this->getMenus();

        $this->content = view(env('THEME').'.admin.menus_content')
            ->with('menu', $menu)
            ->render();

        return $this->renderOutput();
    }

    private function getMenus()
    {
        $menu = $this->m_rep->get();

        if ($menu->isEmpty()) {
            return false;
        }

        return Menu::make('forMenuPart', function ($m) use ($menu) {
            foreach ($menu as $item) {
                if (0 == $item->parent_id) {
                    $m->add($item->title, $item->path)->id($item->id);
                } elseif ($m->find($item->parent_id)) {
                    $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id);
                }
            }
        });
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
        //
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
