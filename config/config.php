<?php

class database
{
    public $host = 'localhost';
    public $user = 'root';
    public $pass = '';
    public $name = 'cars';

    public $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if (!$this->conn) {
            echo "connect failed";
        }
    }
}
