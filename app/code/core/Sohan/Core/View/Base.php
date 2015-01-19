<?php

/**
 * Class Sohan_Core_View_Base
 *
 * Contains base view methods
 */
class Sohan_Core_View_Base extends Object
{
    /**
     * Include view from theme set in app/config/config.ini
     *
     * @param $view
     */
    public function render($view)
    {
        include 'app/design/' . Sohan::getConfigByPath('design/theme') . '/templates/' . $view;
    }
}
