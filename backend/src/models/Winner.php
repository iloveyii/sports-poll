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
    public function setAttributes($attribues)
    {
        $this->id = isset($attribues['id']) ?? null;
        $this->name = $attribues['name'];
        return true;
    }

    public function createTable(): bool
    {
        // TODO: Implement createTable() method.
    }

    // CRUD
    public function create(): bool
    {
        // TODO: Implement create() method.
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
