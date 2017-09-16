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

    public function get($select = '*', $take = false)
    {
        $builder = $this->model->select($select);

        if ($take) {
            $builder->take($take);
        }

        return $builder->get();
    }
}
