<?php

namespace Phpbook;

use Phpbook\System\Router;

class Kernel{

    public function __construct()
    {
        $this->startRouting();
    }

    public function startRouting(){
        $router = new Router();
    }
}