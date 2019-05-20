<?php

require_once 'init.php';

$title  = $_POST["title"];
$start = $_POST["start"];
$uID = $_POST["uID"];
// $end = $_POST["end"];

$hrValue = 0;
$i1Value = 0;
$i2Value = 0;

if ($uID === "1") {
    $hrValue = 1;
}
if ($uID === "2") {
    $i1Value = 1;
}
if ($uID === "3") {
    $i2Value = 1;
}
if (isset($title)) {
    $query = "
 INSERT INTO events 
 (title, start_date, end_date, hr_viewed, i1_viewed, i2_viewed) 
 VALUES (:title,:start_date,:end_date, :hr_viewed, :i1_viewed, :i2_viewed)
 ";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':title'  => $title,
            ':start_date' => $start,
            ':end_date' => $start, // For defaulting the event duration to 2 hours
            ':hr_viewed' => $hrValue,
            ':i1_viewed' => $i1Value,
            ':i2_viewed' => $i2Value,
        )
    );
}
