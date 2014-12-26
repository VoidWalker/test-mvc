<?php

class Voidwalker_News_View_ListView
{
    public $_storage;
    
    public function includeView($view)
    {
        return require 'app/code/local/Voidwalker/News/View/' . $view . '.php';
    }
} 