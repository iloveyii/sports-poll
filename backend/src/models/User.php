<?php

namespace App\Models;


class User extends Model
{
    /**
     * @var null|int
     */
    public $id;
    public $username;
    public $password;

    /**
     * @var string
     */
    public $tableName = 'user';


    /**
     * Post constructor.
     */
    public function __construct()
    {
    }

    /**
     * Set the attributes from the passed associate array
     * @param $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->id = isset($attributes['id'])  ? $attributes['id'] : null;
        $this->username = $attributes['username'];
        $this->password = $attributes['password'];
        $this->isNewRecord = $this->id === null ? true : false;
        return $this;
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

    // Abstract methods
    public function createTable(): bool
    {
        $createTable = "CREATE TABLE $this->tableName(
        id INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username CHAR( 10 ), 
        password CHAR( 60 )
        );";
        return Database::connect()->exec($createTable);
    }

    // CRUD

    /**
     * Creates a db post record
     * @return bool
     * @throws \Exception
     */
    public function create() : bool
    {
        $query = sprintf("INSERT INTO %s (username, password) 
                                 VALUES (:username, :password)", $this->tableName);
        $params = [':username'=>$this->username, ':password'=>password_hash($this->password, PASSWORD_BCRYPT)];
        return Database::connect()->insert($query, $params);
    }

    /**
     * Reads all posts from db into associative array
     * @param null | integer $id
     * @return array
     * @throws \Exception
     */
    public function read( $id = null) : array
    {
        $query = sprintf("SELECT * FROM %s", $this->tableName);
        $params = [];

        if($id !== null) {
            $query = sprintf("SELECT * FROM %s WHERE id=:id", $this->tableName);
            $params = [':id'=>$id];
        }
        $rows = Database::connect()->selectAll($query, $params);

        return $rows;
    }

    public function readColumnAll($columnName) : array
    {
        $query = sprintf("SELECT %s FROM %s", $columnName, $this->tableName);
        $rows = Database::connect()->selectAll($query, []);
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
