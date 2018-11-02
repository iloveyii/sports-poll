<?php
namespace App\Controllers;


use App\Models\Event;

class EventController extends Controller
{
    const DATA_DIR = 'data';
    const JSON_FILE = 'test-assignment.json';
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Returns the index page
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
    public function random()
    {
        $model = new Event();
        return $model->readAllByRandomGroupName();
    }
}
