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
        $result = Database::connect()->exec($createTable);
        Log::write("Created table $this->tableName", INFO);
        return $result;

    }

    // CRUD
    public function create(): bool
    {
        $query = sprintf("INSERT INTO %s (name) VALUES (:name)", $this->tableName );
        $result = Database::connect()->insert($query, [':name'=>$this->name]);
        Log::write("Inserted {$this->name} as a new row into table {$this->tableName}", INFO);
        return $result;
    }
    public function read($id = null): array
    {
        // TODO: Implement read() method.
    }
    public function update(): bool
    {
        // TODO: Implement update() method.
    }

}
