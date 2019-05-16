<?php
require_once 'includes/dbh.inc.php';
?>

<?php
//send_mail.php
if (isset($_POST['email_data'])) {
    $value = $_POST['email_data'];

    foreach ($value as $key) {

        $email_to = implode(',', $key);
        $subject = 'Testing PHP Mail';
        $message = 'This mail is sent using the PHP mail function';
        $headers = 'From:aravindansridhars@gmail.com';
        $retval = mail($email_to, $subject, $message, $headers);

        if ($retval == true) {
            echo "success";
        } else {
            echo "fail";
        }
    }
}

?>