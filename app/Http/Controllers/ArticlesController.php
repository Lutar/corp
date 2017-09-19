<?php

namespace Corp\Http\Controllers;

use Corp\Category;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;
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
        CommentsRepository $c_rep,
        ArticlesRepository $a_rep
    )
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->p_rep = $p_rep;
        $this->c_rep = $c_rep;
        $this->a_rep = $a_rep;
        $this->template = env('THEME') . '.articles';
        $this->bar = 'right';
    }


    public function index($cat_alias = false)
    {
        $articles = $this->getArticles($cat_alias);
        $content = view(env('THEME') . '.articles_content')
            ->with('articles', $articles)
            ->render();
        $this->vars = array_add($this->vars, 'content', $content);


        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $comments = $this->getComments(config('settings.recent_comments'));
        $this->contentRightBar = view(env("THEME").'.articlesBar')
            ->with('portfolios', $portfolios)
            ->with('comments', $comments)
            ->render();


        $this->keywords = 'Blog Page';
        $this->meta_desc = 'Blog Page';
        $this->title = 'Blog Page';


        return $this->renderOutput();
    }

    public function show($alias = false)
    {
        $article = $this->a_rep->one($alias, ['comments' => true]);
        if ($article) {
            $article->img = json_decode($article->img);
        }
        //dd($article->comments->groupBy('parent_id'));
        $content = view(env('THEME').'.article_content')
            ->with('article', $article)
            ->render();
        $this->vars = array_add($this->vars, 'content', $content);


        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $comments = $this->getComments(config('settings.recent_comments'));
        $this->contentRightBar = view(env("THEME").'.articlesBar')
            ->with('portfolios', $portfolios)
            ->with('comments', $comments)
            ->render();


        $this->keywords = 'Article Page';
        $this->meta_desc = 'Article Page';
        $this->title = 'Article Page';


        return $this->renderOutput();
    }

    protected function getArticles($alias = false)
    {
        $where = false;

        if ($alias) {
            $id = Category::select('id')->where('alias', $alias)->first()->id;
            $where = ['category_id', $id];
        }

        $articles = $this->a_rep->get(
            ['id', 'title', 'created_at', 'img', 'alias', 'desc', 'user_id', 'category_id'],
            false,
            true,
            $where
        );

        if ($articles) {
            $articles->load('category', 'user', 'comments');
        }

        return $articles;
    }

    protected function getComments($take)
    {
        $comments = $this->c_rep->get(
            ['text', 'name', 'email', 'site', 'article_id', 'user_id'],
            $take
        );

        if($comments) {
            $comments->load('article','user');
        }

        return $comments;
    }

    protected function getPortfolios($take)
    {
        $portfolios = $this->p_rep->get(
            ['title', 'text', 'alias', 'customer', 'img', 'filter_alias'],
            $take
        );

        return $portfolios;
    }
}
