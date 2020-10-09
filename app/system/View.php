<?php


class View
{
    public function render($template, $data) {
        include ROOT . '/' . VIEWS_PATH . $template.'.php';
    }

}