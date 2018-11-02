<?php
namespace App\Models;


class Winner extends Model
{
    public $tableName = 'winner';
    /**
     * @var int null
     */
    private $id;
    /**
     * @var string $name
     */
    private $name;

    public function __construct()
    {
    }

    // Abstract methods implemented
    public function rules(): array
    {
        return [];
    }
    public function setAttributes($attributes)
    {
        $this->id = isset($attribues['id']) ?? null;
        $this->name = $attributes['name'];
        return $this;
    }

    public function createTable(): bool
    {
        $createTable = "CREATE TABLE $this->tableName(
        id INT( 11 ) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name CHAR( 10 ) );";
        return Database::connect()->exec($createTable);
    }

    // CRUD
    public function create(): bool
    {
        $query = sprintf("INSERT INTO %s (name) VALUES (:name)", $this->tableName );
        return Database::connect()->insert($query, [':name'=>$this->name]);
    }
    public function read($id = null): array
    {
        // TODO: Implement read() method.
    }
    public function update(): bool
    {
        // TODO: Implement update() method.
    }
    public function delete(): bool
    {
        // TODO: Implement delete() method.
    }

}
