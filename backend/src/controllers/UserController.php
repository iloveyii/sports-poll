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
        $winningIds = [
            'home'=>1,
            'draw'=>2,
            'away'=>3
        ];

        if($this->request->isPost()) {
            $vote = new \App\Models\Vote();
            $posts = $this->request->body();

            foreach ($posts as $var => $value) {
                $arr = explode('_', $var);
                $event_id = $arr[1];
                $user_id = 1;
                $winner_id = $winningIds[$value];
                $attributes = [
                    'event_id' => $event_id,
                    'user_id' => $user_id,
                    'winner_id' => $winner_id
                ];

                $vote->setAttributes($attributes)->create();
            }
            header("Location: /events/index");

        }

        $model = new Event();
        $events = $model->readAllByRandomGroupName();
        $this->render('index', $events);
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
        $this->render('login', $model);
    }
}
