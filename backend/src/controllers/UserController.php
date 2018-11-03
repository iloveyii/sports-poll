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
    public function create() : string
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
     * Does use login
     * @return bool
     */
    public function login() : bool
    {
        $model = new User();

        if($this->request->isPost()) {
            $params = $this->request->body();
            if($model->setAttributes($params)->validate() && $model->login()) {
                header("Location: /events/index");
                return true;
            }

        }
        return $this->render('login', $model);
    }

    /**
     * Does user logout
     * @return bool
     */
    public function logout() : bool
    {
        $model = new User();
        $model->logout();
        header("Location: /user/login");
        return true;
    }

}
