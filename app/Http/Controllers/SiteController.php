<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Lavary\Menu\Menu;

class SiteController extends Controller
{
    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;

    protected $template;

    protected $vars = array();

    protected $contentRightBar = false;
    protected $contentLeftBar = false;

    protected $bar = false;


    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }


    protected function getMenu()
    {
        $menu = $this->m_rep->get();

        $mBuilder = new Menu();
        $mBuild = $mBuilder->make('MyNav', function ($m) use ($menu) {

            foreach ($menu as $item) {
                if (0 == $item->parent_id) {
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if ($m->find($item->parent_id)) {
                        $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }

        });
        //dd($mBuild);

        return $mBuild;
    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();
        $navigation = view(env('THEME').'.navigation')
            ->with('menu', $menu)
            ->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);


        if ($this->contentRightBar) {
            $rightBar = view(env('THEME').'.rightBar')
                ->with('content_rightBar', $this->contentRightBar)
                ->render();
            $this->vars = array_add($this->vars, 'rightBar', $rightBar);
        }


        return view($this->template)->with($this->vars);
    }
}
