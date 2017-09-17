<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Menu;
use Illuminate\Http\Request;
use Config;
use Corp\Http\Requests;

class ArticlesController extends SiteController
{

    public function __construct(
        PortfoliosRepository $p_rep,
        ArticlesRepository $a_rep
    )
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->template = env('THEME') . '.articles';
        $this->bar = 'right';
    }


    public function index()
    {
        $articles = $this->getArticles();
        $content = view(env('THEME') . '.articles_content')
            ->with('articles', $articles)
            ->render();
        $this->vars = array_add($this->vars, 'content', $content);


        $this->keywords = 'Home Page';
        $this->meta_desc = 'Home Page';
        $this->title = 'Home Page';


        return $this->renderOutput();
    }

    protected function getArticles()
    {
        $articles = $this->a_rep->get(
            ['id', 'title', 'created_at', 'img', 'alias', 'desc', 'user_id', 'category_id'],
            false,
            true
        );

        /*if ($articles) {
            $articles->load('category', 'user', 'comment');
        }*/

        return $articles;
    }

    protected function getPortfolios()
    {
        $portfolios = $this->p_rep->get('*', Config::get('settings.home_port_count'));

        return $portfolios;
    }
}
