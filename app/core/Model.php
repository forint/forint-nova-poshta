<?php
namespace App\Core;

use App\Core\Database;

/**
 * Class Model
 * @package App\Core
 */
abstract class Model
{
    /**
     * @var Database $db
     */
    protected $db;

    /**
     * @var Database|\MysqliDb|null $connection
     */
    protected $connection;

    /**
     * Films constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db::getInstance();
    }

}