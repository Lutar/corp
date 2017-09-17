<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 17.9.17
 * Time: 9.19
 */

namespace Corp\Repositories;

use Corp\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }
}
