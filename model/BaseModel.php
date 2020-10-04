<?php

require_once __DIR__.'/../core/Database.php';

class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
}