<?php
namespace core;

use db\Db;

abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new Db();
    }
}
