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
        $this->title = 'Меню менеджер';
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
        $this->title = 'Меню менеджер';
        $tmp = $this->getMenus()->roots();
        $menus = $tmp->reduce(function ($returnMenus, $menu) {

            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;

        }, [0 => 'Родительский пункт меню']);


        $categories = \Corp\Category::select('title', 'alias', 'parent_id', 'id')->get();
        $list = array(0 => 'Не используется');
        $list['parent'] = 'Раздел блог';


        foreach ($categories as $category) {
            if (0 == $category->parent_id) {
                $list[$category->title] = array();
            } else {
                $list[
                    $category
                        ->where('id', $category->parent_id)
                        ->first()
                        ->title
                ][$category->alias] = $category->title;
            }
        }


        $articles = $this->a_rep->get(['id', 'title', 'alias']);
        $articles = $articles->reduce(function ($returnArticles, $article) {

            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;

        }, []);


        $filters = \Corp\Filter::select(['id', 'title', 'alias'])->get()->reduce(function ($returnFilters, $filter) {

            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;

        }, ['parent' => 'Раздел портфолио']);


        $portfolios = $this->p_rep->get(['id', 'title', 'alias']);
        $portfolios = $portfolios->reduce(function ($returnPortfolios, $potfolio) {

            $returnPortfolios[$potfolio->alias] = $potfolio->title;
            return $returnPortfolios;

        }, []);


        $this->content = view(env('THEME').'.admin.menus_create_content')
            ->with([
                'menus' => $menus,
                'categories' => $list,
                'articles' => $articles,
                'filters' => $filters,
                'portfolios' => $portfolios
            ])->render();


        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MenusRequest $request)
    {
        $result = $this->m_rep->addMenu($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
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
    public function edit(\Corp\Menu $menu)
    {
        //dd($menu);
        $this->title = 'Редактирование меню ' . $menu->title;

        $type = false;
        $option = false;

        $route = app('router')->getRoutes()->match(app('request')->create($menu->path));

        $aliasRoute = $route->getName();
        $parameters = $route->parameters();

        if ($aliasRoute == 'articles.index' || $aliasRoute == 'articlesCat') {
            $type = 'blogLink';
            $option = isset($parameters['cat_alias']) ? $parameters['cat_alias'] : 'parent';
        } elseif ($aliasRoute == 'articles.show') {
            $type = 'blogLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';
        } elseif ($aliasRoute == 'portfolios.index') {
            $type = 'portfolioLink';
            $option = 'parent';
        } elseif ($aliasRoute == 'portfolios.show') {
            $type = 'portfolioLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';
        } else {
            $type = 'customLink';
        }

        $tmp = $this->getMenus()->roots();
        $menus = $tmp->reduce(function ($returnMenus, $menu) {

            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;

        }, [0 => 'Родительский пункт меню']);


        $categories = \Corp\Category::select('title', 'alias', 'parent_id', 'id')->get();
        $list = array(0 => 'Не используется');
        $list['parent'] = 'Раздел блог';


        foreach ($categories as $category) {
            if (0 == $category->parent_id) {
                $list[$category->title] = array();
            } else {
                $list[
                $category
                    ->where('id', $category->parent_id)
                    ->first()
                    ->title
                ][$category->alias] = $category->title;
            }
        }


        $articles = $this->a_rep->get(['id', 'title', 'alias']);
        $articles = $articles->reduce(function ($returnArticles, $article) {

            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;

        }, []);


        $filters = \Corp\Filter::select(['id', 'title', 'alias'])->get()->reduce(function ($returnFilters, $filter) {

            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;

        }, ['parent' => 'Раздел портфолио']);


        $portfolios = $this->p_rep->get(['id', 'title', 'alias']);
        $portfolios = $portfolios->reduce(function ($returnPortfolios, $potfolio) {

            $returnPortfolios[$potfolio->alias] = $potfolio->title;
            return $returnPortfolios;

        }, []);


        $this->content = view(env('THEME').'.admin.menus_create_content')
            ->with([
                'type' => $type,
                'option' => $option,
                'menus' => $menus,
                'menu' => $menu,
                'categories' => $list,
                'articles' => $articles,
                'filters' => $filters,
                'portfolios' => $portfolios
            ])->render();


        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \Corp\Menu $menu)
    {
        $result = $this->m_rep->updateMenu($request, $menu);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Corp\Menu $menu)
    {
        $result = $this->m_rep->deleteMenu($menu);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }
}
