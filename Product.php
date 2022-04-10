<?php

class Product {
    const TABLE_NAME = 'products';
    
    private $id;
    private $id_group;
    private $name;

    public function __construct($id, $id_group, $name){
        $this->id = $id;
        $this->name = $name;
        $this->id_group = $id_group;
    }

    public function __get($property){
        return $this->$property;
    }

    //Выбирает все записи таблицы products. Возвращает массив объектов класса Product
    public static function findALL(){
        $query = "SELECT * FROM " . self::TABLE_NAME . " ORDER BY id";
        $db= Db::instance();
        $stmt = $db->conn->prepare($query);
        $stmt->execute();
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $products[] = new Product($id, $id_group, $name);
        }
        return $products;
    }
    
     //Выбирает записи таблицы products по набору id_group. Возвращает массив объектов класса Product
    public static function findByGroup($slected_group_id, $group){
        $arr = [$slected_group_id];
        foreach ($group[0]->xpath(".//*[@id]") as $g) {
           $arr[] = (string)$g['id'];
        }
        $query = "SELECT * FROM " . self::TABLE_NAME . " WHERE id_group IN(" . implode(",", $arr) . ")";
        $db= Db::instance();
        $stmt = $db->conn->prepare($query);
        $stmt->execute();
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $products[] = new Product($id, $id_group, $name);
        }
        return $products;
    }
}