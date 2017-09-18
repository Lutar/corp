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

    public function one($alias, $attr = array())
    {
        $article = parent::one($alias, $attr);

        if ($article && !empty($attr)) {
            $article->load('comments');
            $article->comments->load('user');
        }

        return $article;
    }
}
