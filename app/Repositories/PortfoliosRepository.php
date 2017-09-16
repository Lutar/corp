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
}
