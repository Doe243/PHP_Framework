<?php

namespace App\middlewares;

abstract class BaseMiddleware
{
    abstract public function execute();
}