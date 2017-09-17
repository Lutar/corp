<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\MenusRepository;
use Corp\Menu;
use Illuminate\Http\Request;
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
        $this->template = env('THEME').'.articles';
        $this->bar = 'right';
    }


    public function index()
    {
        $articles = $this->getArticles();
        dd($articles);

        return $this->renderOutput();
    }

    protected function getArticles($alias = false)
    {
        $article = $this->a_rep->get(
            ['title', 'alias', 'desc', 'img', 'created_at'],
            false,
            true
        );

        if ($article) {
            //$article->load('users', 'categories', 'comments');
        }

        return $article;
    }
}
