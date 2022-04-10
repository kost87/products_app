<?php

//Выводит группу с id slected_group_id и все её подгруппы
function openGroup($group, $slected_group_id)
{
    $content = "<ul>";
    foreach ($group->group as $sub_group) {
        $content .= "<li><a href='./?group=" . $sub_group['id'] . "'>" . $sub_group->name . "</a>";
        $products_count = $sub_group['products_count'];
        foreach ($sub_group->xpath(".//group") as $s_group) {
            $products_count += $s_group['products_count'];
        }
        $content .= "(". $products_count .")</li>";
        if (($sub_group['id'] == $slected_group_id) or ($sub_group->xpath(".//group[@id='" . $slected_group_id . "']"))) {
            $content .= openGroup($sub_group, $slected_group_id);
        }
    }    
    $content .= "</ul>";
    return $content;
}
require __DIR__ . '/autoload.php';
$db = new Db();
$groups = Group::findAll();
if (!isset($_GET['group'])) {
    $slected_group_id = 0;
    $products = Product::findALL();
}
else {
    $slected_group_id = $_GET['group'];
    $products = Product::findByGroup($slected_group_id, $groups->xpath(".//group[@id='" . $slected_group_id . "']"));
}
$content = openGroup($groups, $slected_group_id);
include 'template.php';
?>