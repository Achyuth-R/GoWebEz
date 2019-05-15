<?php

require_once 'init.php';

$title  = $_POST["title"];
$start = $_POST["start"];
$end = $_POST["end"];
$start_time = $_POST["startTime"];
$end_time = $_POST["endTime"];

if (isset($title)) {
    $query = "
 INSERT INTO events 
 (title, start_date, end_date, start_time, end_time) 
 VALUES (:title,:start_date,:end_date,:start_time,:end_time)
 ";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':title'  => $title,
            ':start_date' => $start,
            ':end_date' => $end,
            ':start_time' => $start_time,
            ':end_time' => $end_time
        )
    );
}
