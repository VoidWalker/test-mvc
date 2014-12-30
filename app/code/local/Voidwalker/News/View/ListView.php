<?php

class Voidwalker_News_View_ListView extends Sohan_Core_View_Base
{    
    public function render($view)
    {
        include 'app/code/local/Voidwalker/News/View/' . $view;
    }
} 