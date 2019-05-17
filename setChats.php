<?php
require('init.php');
$sql = $db->prepare("UPDATE events SET viewed = 1");
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
