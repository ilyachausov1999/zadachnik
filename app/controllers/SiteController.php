<?php


class SiteController extends Controller
{
    public function __construct() {
        $this->model = new SiteModel();
        $this->view = new View();
    }

    public function index() {
        $page = 0;
        if(isset($_GET['page']) && $_GET['page'] != 1) {
            $page = (int)$_GET['page'];
            $page--;
        }
        $data['sort'] = 'name';

        if(isset($_GET['sort']))
        {
            $data['sort'] = $_GET['sort'];
        }
        //Общее кол-во страниц пагинации
        $data['total_pages'] = ceil($this->model->getCount()/LIMIT);
        $data['page'] = $page; //Текущая страница, для подсветки в пагинации
        $data['title'] = 'Список задач';
        $data['active'] = 'index';
        $data['tasks'] = $this->model->getTasks($page*LIMIT,LIMIT,$data['sort']);
        $this->view->render('site',$data);

    }

    public function index_v2() {

        $data['title'] = 'Список задач';
        $data['active'] = 'index_v2';
        $data['tasks'] = $this->model->getTasks(0,0);
        $this->view->render('site_v2',$data);

    }

    /**
     * Отображает страницу создания задачи
     */
    public function create() {
        $data['title'] = 'Создание задачи';
        $data['active'] = 'add';
        $this->view->render('add',$data);
    }

    /**
     * Принимает данные формы создания задачи
     */
    public function add() {
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['text'])) {
            if($this->model->save()) {
                $data['title'] = 'Задача успешно создана!';
                $data['active'] = 'add';
                $this->view->render('success',$data);
            } else {
                die('Ошибка, попробуйте еще раз');
            }
        }
    }

    /**
     *Возвращает одну задачу в json
     */
    public function get_task() {
        if(isset($_POST['id'])) {
            $task = $this->model->getTask($_POST['id']);
            die(json_encode($task));
        }
    }



}
