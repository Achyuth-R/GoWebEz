<?php

require_once 'init.php';

$title  = $_POST["title"];
$start = $_POST["start"];
// $end = $_POST["end"];


if (isset($title)) {
    $query = "
 INSERT INTO events 
 (title, start_date, end_date) 
 VALUES (:title,:start_date,:end_date)
 ";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':title'  => $title,
            ':start_date' => $start,
            ':end_date' => $start // For defaulting the event duration to 2 hours
        )
    );
}
