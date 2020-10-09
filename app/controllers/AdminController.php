<?php


class AdminController
{
    public function __construct() {
        $this->model = new AdminModel();
        $this->view = new View();
        session_start();
    }

    public function index() {

        if(!isset($_SESSION['logged']))
        {
            header('Location: /admin/login');
        }
        $data['title'] = 'Список задач';
        $data['tasks'] = $this->model->getTasks();
        $this->view->render('dashboard',$data);
    }

    public function edit()
    {
        if(isset($_GET['id']))
        {
            $data['title'] = 'Редактирование задачи';
            $data['task'] = $this->model->getTask((int)$_GET['id']);
            $this->view->render('edit',$data);
        } else {
            header('Location: /admin/index');

        }
    }

    public function save()
    {
        if($this->model->save())
        {
            $_SESSION['message'] = 'Успешно сохранено';
            header('Location: /admin/index');

        }
    }

    public function login()
    {
        if(isset($_POST['login']) && isset($_POST['pass']))
        {
            if($this->model->login()) {
                $_SESSION['logged'] = true;
                header('Location: /admin/index');
            }
        } else {
            $this->view->render('auth',['data' => 'test']);
        }

    }

    public function logout()
    {
        unset($_SESSION['logged']);
        session_destroy();
        header('Location: /admin/login');

    }



}