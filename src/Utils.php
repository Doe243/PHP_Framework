<?php

namespace App;

class Utils 
{
    protected $utils;

    public function __construct($utils) 
    {
        $this->utils =  $utils;
    }

    public static function preEcho($utils): void
    {
        echo '<pre>';

        var_dump(new Utils($utils));

        echo '</pre>';

        exit;
    }
}