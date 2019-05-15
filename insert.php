<?php

require_once 'init.php';

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO events 
 (title, start_date, end_date) 
 VALUES (:title,:start_date,:end_date)
 "
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_date' => $_POST['start'],
   ':end_date' => $_POST['end']
  )
 );
}


?>
