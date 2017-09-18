<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 18.9.17
 * Time: 19.35
 */

namespace Corp\Repositories;

use Corp\Comment;

class CommentsRepository extends Repository
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}