<?php

require_once 'init.php';

if (isset($_POST["id"])) {
    $uID = $_POST["uID"];
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
    $query = "UPDATE events SET title=:title, start_date=:start_date, end_date=:end_date, hr_viewed=:hr_viewed, i1_viewed=:i1_viewed, i2_viewed=:i2_viewed WHERE id=:id;";
    $zero = 0;

    $statement = $db->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_date' => $_POST['start'],
            ':end_date' => $_POST['end'],
            ':hr_viewed' => $hrValue,
            ':i1_viewed' => $i1Value,
            ':i2_viewed' => $i2Value,
            ':id' => $_POST['id']
        )
    );
    echo "Holais";
}
