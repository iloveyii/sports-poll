<?php

namespace App\Models;


class Event extends Model
{
    const DATA_DIR = 'data';
    const JSON_FILE = 'test-assignment.json';

    /**
     * @var null|int
     */
    public $id;
    public $objectId;

    /**
     * @var string
     */
    public $awayName;
    /**
     * @var string
     */
    public $homeName;
    public $name;
    public $groupName;
    public $sport;
    public $country;
    public $state;
    public $createdAt;

    /**
     * @var string
     */
    private $tableName = 'event';


    /**
     * Post constructor.
     */
    public function __construct()
    {
    }

    /**
     * Pass request object to this method to set the object attributes
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->id = isset($attributes['id'])  ? $attributes['id'] : null;
        $this->objectId = $attributes['objectId'];
        $this->homeName = $attributes['homeName'];
        $this->awayName = $attributes['awayName'];
        $this->name = $attributes['name'];
        $this->groupName = $attributes['groupName'];
        $this->sport = $attributes['sport'];
        $this->country = $attributes['country'];
        $this->state = $attributes['state'];
        $this->createdAt = $attributes['createdAt'];
        $this->isNewRecord = true;
    }

    public function loadJsonFileToTable()
    {
        $events = $this->readJsonFile();
        foreach ($events as $event) {
            $model = new static();
            // Set groupName
            $event['groupName'] = $event['group'];
            // Format date time
            $event['createdAt'] = date('Y-m-d H:i:s', strtotime($event['createdAt']));
            $model->setAttributes($event);
            $model->create();
        }
    }

    private function readJsonFile()
    {
        $dirPath = realpath( dirname(dirname(__FILE__)) . '/' . self::DATA_DIR );
        $filePath = sprintf("%s/%s", $dirPath, self::JSON_FILE);
        $fileContents = file_get_contents($filePath);
        return json_decode($fileContents, true);
    }


    /**
     * These are the validation rules for the attributes
     * @return array
     */
    public function rules() : array
    {
        return [
            'id' => ['integer'],
            'title' => ['string', 'minLength'=>5, 'maxLength'=>140, 'alpha'],
            'description' => ['string', 'minLength'=>15, 'maxLength'=>800, 'stripTags'],
        ];
    }

    // CRUD

    /**
     * Creates a db post record
     * @return bool
     */
    public function create() : bool
    {
        $query = sprintf("INSERT INTO %s (objectId, homeName, awayName, name, groupName, sport, country, state, createdAt) 
                                 VALUES (:objectId, :homeName, :awayName, :name, :groupName, :sport, :country, :state, :createdAt)", $this->tableName);
        $params = [':objectId'=>$this->objectId, ':homeName'=>$this->homeName, ':awayName'=>$this->awayName, ':name'=>$this->name,
                    ':groupName'=>$this->groupName, ':sport'=>$this->sport, ':country'=>$this->country, ':state'=>$this->state, ':createdAt'=>$this->createdAt];
        return Database::connect()->insert($query, $params);
    }

    /**
     * Reads all posts from db into associative array
     * @return array
     */
    public function readAll() : array
    {
        $query = sprintf("SELECT id, title, description AS author, title AS filename, title AS artist FROM %s", $this->tableName);
        $rows = Database::connect()->selectAll($query, []);

        return $rows;
    }

    /**
     * Updates the given record in DB using id in Request object
     * @return bool
     */
    public function update() : bool
    {
        $query = sprintf("UPDATE %s SET title=:title, description=:description WHERE id=:id", $this->tableName);
        $params = [':id'=>$this->id, ':title'=>$this->title, ':description'=>$this->description];
        $result = Database::connect()->update($query, $params);
        return $result;

    }

    /**
     * Deletes the post with id in Request object
     * @return bool
     */
    public function delete() : bool
    {
        $query = sprintf("DELETE FROM %s WHERE id=:id", $this->tableName);
        $params = [':id'=>$this->id];
        $result = Database::connect()->delete($query, $params);
        return $result;
    }

}
