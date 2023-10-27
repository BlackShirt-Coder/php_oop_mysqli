<?php

namespace app\database;

use Cassandra\Date;

class DBGen
{
    private $conn;
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASS = "";
    const DB_NAME = "restaurant";

    public function __construct()
    {
        $this->conn = new \mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);

    }

    public function getSingleShop($id)
    {
        $stmt = $this->conn->prepare("select * from shops where id=?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->bind_result($id, $name, $ipadd, $username, $password, $state, $created_at);
        while ($stmt->fetch()) {
            echo "name is " . $name . "<br> address is " . $ipadd . "<br> user name is " . $username;
        }
    }

    public function getMultipleShop($state)
    {
        $stmt = $this->conn->prepare("select * from shops where state=?");
        $stmt->bind_param("i", $state);
        $result = $stmt->execute();
        $stmt->bind_result($id, $name, $ipadd, $username, $password, $state, $created_at);
        while ($stmt->fetch()) {
            echo $id . "\t" . $name . "\t" . $ipadd . "\t" . "<hr>";
        }
    }

    public function getAll()
    {
        $stmt = $this->conn->query("select * from shops");
        while ($rows = $stmt->fetch_object()) {
            echo "name is " . $rows->name . "   ip add is " . $rows->ipadd . "<hr>";
        }
    }

    public function insertSingleShop($name, $ipadd, $username, $password, $state)
    {
        $created_at = \date("Y-m-d H:m:s");
        $stmt = $this->conn->prepare("insert into shops (name,ipadd,username,password,state,created_at) values (?,?,?,?,?,?)");
        $stmt->bind_param("ssssis", $name, $ipadd, $username, $password, $state, $created_at);
        $result = $stmt->execute();
        echo $result ? "Successfully Inserted" : "insertion Failed";
    }

    public function insertMultipleShops($shops)
    {
        $created_at = \date("Y-m-d H:m:s");
        $stmt = $this->conn->prepare("insert into shops (name,ipadd,username,password,state,created_at) values (?,?,?,?,?,?)");
        foreach ($shops as $shop) {
            $stmt->bind_param("ssssis", $shop[0], $shop[1], $shop[2], $shop[3], $shop[4], $created_at);
            $result = $stmt->execute();
            $lastInsertId = $stmt->insert_id;
            echo $result ? "Successfully Inserted Id With " . $lastInsertId : "insertion Failed";
            echo "<hr>";
        }

    }

    public function updateName($name, $id)
    {
        $stmt = $this->conn->prepare("update shops set name=? where id=?");
        $stmt->bind_param('si', $name, $id);
        $result = $stmt->execute();
        echo $result;
    }

    public function deleteData($id)
    {
        $stmt = $this->conn->prepare("delete from shops where id=?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        echo $result?"Delete Successfully":"Failed to Delete" ;
    }

}