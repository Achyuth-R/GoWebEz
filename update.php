
<?php

require_once 'init.php';

if (isset($_POST["id"])) {
    $query = "
 UPDATE events 
 SET title=:title,start_date=:start_date, end_date=:end_date 
 WHERE id=:id
 ";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_date' => $_POST['start'],
            ':end_date' => $_POST['end'],
            ':id'   => $_POST['id']
        )
    );
}

?>