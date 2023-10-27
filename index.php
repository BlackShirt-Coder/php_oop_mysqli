<?php

use app\database\DBGen;

require_once "vendor/autoload.php";
class index
{
   private $db;
   public function __construct()
   {
       $this->db=new DBGen();
      //$this->db->insertSingleShop("asus","192.168.100.2","asus","123",1);
       $shops=[
           ["Hp","192.168.100.1","hp","123",0],
           ["Dell","192.168.100.2","dell","123",1],
           ["Acer","192.168.100.6","acer","123",1]
       ];
//       $this->db->insertMultipleShops($shops);
//       $this->db->updateName("Asus",6);
       $this->db->fetchAll(1);
   }

}
$idx=new index();
