<?php

require_once 'init.php';

if (isset($_POST["id"])) {
    $uID = $_POST["uID"];
    $hrValue = 0;
    $i1Value = 0;
    $i2Value = 0;

    if ($uID === "1") {
        $hrValue = 2;
        $created_by = 1;
    }
    if ($uID === "2") {
        $i1Value = 2;
        $created_by = 2;
    }
    if ($uID === "3") {
        $i2Value = 2;
        $created_by = 3;
    }
    $query = "UPDATE events SET title=:title, start_date=:start_date, end_date=:end_date, hr_viewed=:hr_viewed, i1_viewed=:i1_viewed, i2_viewed=:i2_viewed, created_by=:created_by WHERE id=:id;";

    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_date' => $_POST['start'],
            ':end_date' => $_POST['end'],
            ':hr_viewed' => $hrValue,
            ':i1_viewed' => $i1Value,
            ':i2_viewed' => $i2Value,
            ':created_by' => $created_by,
            ':id' => $_POST['id']
        )
    );
    echo "Updated Event";
}
