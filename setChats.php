<?php
require('init.php');
$userID = $_POST['uID'];
$eventID = explode(",", $_POST['eventID']);
$eventsCount = count($eventID) - 1;
// echo $eventID[3];
if ($userID === "1") {
    $query = "UPDATE events SET hr_viewed = 1 WHERE id=:id";
    $sql = $db->prepare($query);
}
if ($userID === "2") {
    $sql = $db->prepare("UPDATE events SET i1_viewed = 1 WHERE id=:id");
}
if ($userID === "3") {
    $sql = $db->prepare("UPDATE events SET i2_viewed = 1 WHERE id=:id");
}

for ($num = 0; $num <= $eventsCount; $num += 1) {
    $sql->execute(
        array(
            ':id' => $eventID[$num]
        )
    );
}
