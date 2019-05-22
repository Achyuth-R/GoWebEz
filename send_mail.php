<?php
require_once 'init.php';

$sql = $db->prepare("SELECT start_date, end_date FROM events WHERE id=:id");
$sql->execute(array(":id" => $_POST["email_data"][0]["eventID"]));
$result = $sql->fetchAll(PDO::FETCH_OBJ);
$startdate = $result[0]->start_date;
$enddate = $result[0]->end_date;
echo json_encode($_POST["email_data"]);
if (isset($_POST['email_data'])) {
    $email_data = $_POST['email_data'];
    $count = count($email_data);

    for ($i = 0; $i < $count; $i++) {
        $email_to = $email_data[$i]["email"];
        $subject = 'Re : Interview with GoWebEz - Human Resource @ GoWebEz';
        $message = 'Dear ' . $email_data[$i]["name"] . ", \n\nYou have been selected for an interview with GoWebEz!\n\nDate : " . substr($startdate, 0, 10) . "\nTIMINGS (24-hour Format)\n\tFrom : " . substr($startdate, 11, 15) . "\n\tTo     : " . substr($enddate, 11, 15) . "\n\n\nKindly be present in time with your updated resume and relevant documents.\n\nRegards,\nTeam GoWebEz.";
        $headers = 'From:aravindansridhars@gmail.com';
        $retval = mail($email_to, $subject, $message, $headers);
        echo $retval;
    }
}
