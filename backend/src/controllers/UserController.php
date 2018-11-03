<?php
namespace App\Controllers;


use App\Models\Event;
use App\Models\User;

class UserController extends Controller
{

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Returns the form page for new post entry
     * It the HTTP request is a post then it save it to DB
     * And redirects to index page
     */
    public function create()
    {
        $model = new User();
        $attributes = $this->request->body();

        if($this->request->isPost() && $model->setAttributes($attributes)->validate() && $model->create() ) {
            if($model->login()) {
                header("Location: /events/index");
                exit;
            } else {
                header("Location: /user/login");
                exit;
            }
        }

        $this->render('create', $model);
    }

    /**
     * Returns the index page
     */
    public function indexPage()
    {
        $model = new Event();
        $events = $model->readAllByRandomGroupName();
        $this->render('index', $events);
    }

    /**
     * Returns the list of events
     */
    public function index()
    {
        $model = new Event();
        $events = $model->readAll();
        return ['events'=>$events];
    }

    /**
     * Returns a rows by random group name
     */
    public function login()
    {
        $model = new User();

        if($this->request->isPost()) {
            $params = $this->request->body();
            if($model->setAttributes($params)->validate() && $model->login()) {
                header("Location: /events/random");
                exit;
            }

        }
        $this->render('login', $model);
    }

    public function logout()
    {
        $model = new User();
        $model->logout();
        header("Location: /user/login");
    }

}
