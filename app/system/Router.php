<?php


class Router {

    public static function getRoute() {
        //Заранее определить дефолт
        $controller = 'SiteController';
        $model = 'SiteModel';
        $method = 'index';
        $params = explode('?',$_SERVER['REQUEST_URI']); //Убрать GET параметры из запроса

        $path = explode('/', current($params));

        //Найти путь
        if(isset($path[1]) && $path[1] != '') {
            $controller = ucfirst($path[1]).'Controller';
            $model= ucfirst($path[1]).'Model';
        }

        //Найти метод
        if(isset($path[2]) && $path[2] != '') {
            $method = $path[2];
        }


        //Подтянуть нужные файлы
        require_once CONTROLLERS_PATH . $controller .'.php';
        require_once MODELS_PATH . $model .'.php';

        //Run it
        $object = new $controller();
        if(method_exists($object,$method))
        {
            $object->$method();
        } else {
            die('Ошибка');
        }

    }
}