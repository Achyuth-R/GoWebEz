<?php
require('init.php');
//$sql = $db->prepare("UPDATE registered_user SET notification_viewed = 1 WHERE id = :ids");
$jsonip = $_POST['id'];
$jsonip = explode(",", $jsonip);

// for ($i = 0; $i < count($jsonip); $i++) {
//     try {
//         $param = (int)$jsonip[$i];
//         $sql->bindParam(':ids', $param, PDO::PARAM_INT);
//         $sql->execute();
//     } catch (exception $e) { };
// };
echo $jsonip;
