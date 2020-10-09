<?php
define('ADMIN_LOGIN','admin');
define('ADMIN_PASS','123');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('UPLOAD_PATH','uploads/');
define('SYSTEM_PATH','app/system/');
define('CONTROLLERS_PATH','app/controllers/');
define('MODELS_PATH','app/models/');
define('VIEWS_PATH','app/views/');
define('LIMIT',3);

require_once SYSTEM_PATH . 'Router.php';
require_once SYSTEM_PATH . 'Controller.php';
require_once SYSTEM_PATH . 'Model.php';
require_once SYSTEM_PATH . 'View.php';


Router::getRoute();