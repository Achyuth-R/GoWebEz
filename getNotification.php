<?php
    require("init.php");
    $sql = $db->prepare("SELECT id,name, qualification, notification_viewed from registered_user where notification_viewed = 0");
    $sql->execute();
    $result=$sql->fetchAll(PDO::FETCH_OBJ);
    $count = count($result);
    $op = array();
    $op['unreadcount'] = $count; 
    for ($i=0; $i < count($result); $i++) { 
        $op['notification'][] =  array("id" => $result[$i]->id, "name" =>  $result[$i]->name, "qualification" => $result[$i]->qualification );
    }
    header('Content-type: application/json');
    echo json_encode($op);
?>