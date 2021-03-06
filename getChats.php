<?php
require("init.php");
$userID = $_POST['uID'];
$sql = $db->prepare("SELECT * FROM events");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);
$count = count($result);
$op = array();
$op['chatCount'] = $count;

if ($userID === "1") {
    $sql = $db->prepare("SELECT COUNT(hr_viewed) AS count FROM events WHERE hr_viewed=0");
}
if ($userID === "2") {
    $sql = $db->prepare("SELECT COUNT(hr_viewed) AS count FROM events WHERE i1_viewed=0");
}
if ($userID === "3") {
    $sql = $db->prepare("SELECT COUNT(hr_viewed) AS count FROM events WHERE i2_viewed=0");
}
$sql->execute();
$countResult = $sql->fetchAll(PDO::FETCH_OBJ);

$op['unreadCount'] = (int)$countResult[0]->count;

for ($i = 0; $i < count($result); $i++) {
    $op['chats'][] =  array("title" => $result[$i]->title, "start_date" =>  $result[$i]->start_date, "id" => $result[$i]->id, "end_date" => $result[$i]->end_date, "hr_viewed" => $result[$i]->hr_viewed, "i1_viewed" => $result[$i]->i1_viewed, "i2_viewed" => $result[$i]->i2_viewed, "created_by" => $result[$i]->created_by);
}

header('Content-type: application/json');
echo json_encode($op);
