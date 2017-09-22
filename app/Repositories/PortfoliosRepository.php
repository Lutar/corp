<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 16.9.17
 * Time: 20.26
 */

namespace Corp\Repositories;

use Corp\Portfolio;

class PortfoliosRepository extends Repository
{
    public function __construct(Portfolio $portfolio)
    {
        $this->model = $portfolio;
    }

    public function one($alias, $attr = array())
    {

        $portfolio = parent::one($alias, $attr = array());

        if ($portfolio && $portfolio->img) {
            $portfolio->img = json_decode($portfolio->img);
        }

        return $portfolio;

    }
}
