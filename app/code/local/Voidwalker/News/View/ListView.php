<?php

class Voidwalker_News_View_ListView extends Sohan_Core_View_Base
{   
    private $templatePath = 'app/design/base/templates/';

    public function render($view)
    {
        include $this->templatePath . $view;
    }
} 