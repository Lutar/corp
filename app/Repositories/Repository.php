<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 16.9.17
 * Time: 11.39
 */

namespace Corp\Repositories;

use Config;

abstract class Repository
{
    protected $model = false;

    public function get()
    {
        $builder = $this->model->select('*');

        return $builder->get();
    }
}