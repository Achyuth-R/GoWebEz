<?php
require("init.php");
$sql = $db->prepare("SELECT title, start_date from events where viewed=:viewed;");
$sql->execute(array(':viewed' => 0));
$result = $sql->fetchAll(PDO::FETCH_OBJ);
$count = count($result);
$op = array();
$op['unreadcount'] = $count;

for ($i = 0; $i < count($result); $i++) {
    $op['chats'][] =  array("title" => $result[$i]->title, "start_date" =>  $result[$i]->start_date);
}
header('Content-type: application/json');
echo json_encode($op);
