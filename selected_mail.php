<?php
require_once 'init.php';
$mailFlag = $db->prepare("UPDATE registered_user SET selected_mail_flag = 1 WHERE email = :email; ");
if (isset($_POST['email_data'])) {
    $email_data = $_POST['email_data'];
    $count = count($email_data);
    for ($i = 0; $i < $count; $i++) {
        $email_to = $email_data[$i]["email"];
        $subject = 'Re : Your application for a position at GoWebEz - Human Resource @ GoWebEz';
        $message = 'Dear ' . $email_data[$i]["name"] . ", \n\nYou have been accepted for your position with GoWebEz!\n\nRegards,\nTeam GoWebEz.";
        $headers = 'From:aravindansridhars@gmail.com';
        $retval = mail($email_to, $subject, $message, $headers);
        $mailFlag->bindParam(':email', $email_data[$i]["email"], PDO::PARAM_STR);
        $mailFlag->execute();
        echo $retval;
    }
}
