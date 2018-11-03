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
    public $tableName = 'event';

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
        $num = count($events);
        Log::write("Inserted $num rows in table $this->tableName", INFO);

        return $num;
    }

    private function readJsonFile()
    {
        $dirPath = realpath( dirname(dirname(__FILE__)) . '/' . self::DATA_DIR );
        $filePath = sprintf("%s/%s", $dirPath, self::JSON_FILE);
        if( file_exists($filePath) ) {
            $fileContents = file_get_contents($filePath);
            return json_decode($fileContents, true);
        }

        Log::write("File {$filePath} does not exist", WARN);
        return [];
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

    // Abstract methods implemented
    public function createTable(): bool
    {
        $sql = "CREATE TABLE $this->tableName(
        id INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        objectId CHAR( 10 ),
        homeName VARCHAR( 80 ) NOT NULL,
        awayName VARCHAR( 80 ) NOT NULL,
        name VARCHAR( 180 ) NOT NULL,
        groupName VARCHAR( 40 ) NOT NULL,
        sport VARCHAR( 40 ) NOT NULL,
        country VARCHAR( 40 ) NOT NULL,
        state VARCHAR( 40 ) NOT NULL,
        createdAt DATETIME NOT NULL);";

        $result = Database::connect()->exec($sql);
        Log::write("Created table $this->tableName", INFO);
        return $result;
    }

    // CRUD

    /**
     * Creates a db post record
     * @return bool
     * @throws \Exception
     */
    public function create() : bool
    {
        $query = sprintf("INSERT INTO %s (objectId, homeName, awayName, name, groupName, sport, country, state, createdAt) 
                                 VALUES (:objectId, :homeName, :awayName, :name, :groupName, :sport, :country, :state, :createdAt)", $this->tableName);
        $params = [':objectId'=>$this->objectId, ':homeName'=>$this->homeName, ':awayName'=>$this->awayName, ':name'=>$this->name,
                    ':groupName'=>$this->groupName, ':sport'=>$this->sport, ':country'=>$this->country, ':state'=>$this->state, ':createdAt'=>$this->createdAt];
        return Database::connect()->insert($query, $params);
    }

    public function read($id = null): array
    {
        // TODO: Implement read() method.
    }

    /**
     * Reads all posts from db into associative array
     * @return array
     * @throws \Exception
     */
    public function readAll() : array
    {
        $query = sprintf("SELECT * FROM %s", $this->tableName);
        $rows = Database::connect()->selectAll($query, []);

        return $rows;
    }

    public function readColumnAll($columnName) : array
    {
        $query = sprintf("SELECT %s FROM %s", $columnName, $this->tableName);
        $rows = Database::connect()->selectAll($query, []);
        return $rows;
    }

    public function getRandomGroupName()
    {
        $rand = sprintf("SELECT %s FROM %s ORDER BY RAND() LIMIT 1", 'groupName', $this->tableName);
        $rows = Database::connect()->selectAll($rand, []);

        return $rows[0]['groupName'];
    }

    public function readAllByRandomGroupName()
    {
        $randomGroupName = $this->getRandomGroupName();
        $query = sprintf("SELECT * FROM %s 
                                 LEFT JOIN 
                                 ( SELECT event_id, user_id, winner_id FROM vote WHERE user_id = %d ) t1
                                 ON event.id = t1.event_id
                                 WHERE groupName=:groupName", $this->tableName, 1);
        $params = [':groupName'=>$randomGroupName];
        $rows = Database::connect()->selectAll($query, $params);
        return $rows;
    }
    /**
     * Updates the given record in DB using id in Request object
     * @return bool
     * @throws \Exception
     */
    public function update() : bool
    {
        $query = sprintf("UPDATE %s SET title=:title, description=:description WHERE id=:id", $this->tableName);
        $params = [':id'=>$this->id, ':title'=>$this->title, ':description'=>$this->description];
        $result = Database::connect()->update($query, $params);
        return $result;

    }

}
