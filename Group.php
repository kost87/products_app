<?php

class Group {
    const TABLE_NAME = 'groups';

    private $id;
    private $id_parent;
    private $name;

    public function __construct($id, $name, $id_parent){
        $this->id = $id;
        $this->name = $name;
        $this->id_parent = $id_parent;
    }

    public function __get($property){
        return $this->$property;
    }

    //Выбирает все зщаписи табоицы groups с количеством товаров в каждой группе. Возвращает объект класса SimpleXMLElement
    public static function findAll(){
        $db= Db::instance();
        $query = "SELECT g.`id`,g.`id_parent`,g.`name`,COUNT(p.id) as products_count FROM `" . self::TABLE_NAME . "` as g LEFT JOIN products as p ON g.id = p.id_group GROUP BY g.id ORDER BY `g`.`id` ASC";
        $stmt = $db->conn->prepare($query);
        $stmt->execute();
        $groups = new SimpleXMLElement("<?xml version='1.0' standalone='yes'?><groups></groups>");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            if ($id_parent == 0) {
                $group = $groups->addChild('group');
                $group->addAttribute('id', $id);
                $group->addAttribute('products_count', $products_count );
                $group->addChild('name', $name);
            }
            else {
                foreach ($groups->xpath('//group') as $group) {
                    if ((string) $group['id'] == $id_parent) {
                        $group = $group->addChild('group');
                        $group->addAttribute('id', $id);
                        $group->addAttribute('products_count', $products_count );
                        $group->addChild('name', $name);
                    }
                }
            }
        }
        return $groups;
    }
}