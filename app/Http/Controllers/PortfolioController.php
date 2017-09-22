<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\MenusRepository;
use Corp\Menu;
use Corp\Http\Requests;

class PortfolioController extends SiteController
{

    public function __construct(PortfoliosRepository $p_rep)
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->p_rep = $p_rep;
        $this->template = env('THEME') . '.portfolios';
    }


    public function index()
    {

        $portfolios = $this->getPortfolios();

        $content = view(env('THEME') . '.portfolios_content')
            ->with('portfolios', $portfolios)
            ->render();
        $this->vars = array_add($this->vars, 'content', $content);


        $this->keywords = 'Портфолио';
        $this->meta_desc = 'Портфолио';
        $this->title = 'Портфолио';


        return $this->renderOutput();

    }

    public function show($alias = false)
    {

        $portfolio = $this->p_rep->one($alias);
        $portfolios = $this->getPortfolios(config('settings.other_portfolios'), false);
        $content = view(env('THEME').'.portfolio_content')
            ->with(['portfolio' => $portfolio, 'portfolios' => $portfolios])
            ->render();
        $this->vars = array_add($this->vars, 'content', $content);


        $this->keywords = $portfolio->keywords;
        $this->meta_desc = $portfolio->meta_desc;
        $this->title = $portfolio->title;


        return $this->renderOutput();

    }

    protected function getPortfolios($take = false, $paginate = true)
    {

        $portfolios = $this->p_rep->get(
            '*',
            $take,
            $paginate
        );

        if ($portfolios) {

            $portfolios->load('filter');

        }

        return $portfolios;

    }
}
