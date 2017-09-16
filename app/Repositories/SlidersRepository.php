<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 16.9.17
 * Time: 18.05
 */

namespace Corp\Repositories;

use Corp\Slider;

class SlidersRepository extends Repository
{
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }
}
