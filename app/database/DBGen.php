<?php
namespace app\database;

class DBGen
{
    private $conn;
    const DB_HOST="localhost";
    const DB_USER="root";
    const DB_PASS="";
    const DB_NAME="restaurant";
    public function __construct()
    {
        $this->conn=new \mysqli(self::DB_HOST,self::DB_USER,self::DB_PASS,self::DB_NAME);

    }

}