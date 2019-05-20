<?php
require_once 'includes/dbh.inc.php';
?>

<?php
if (isset($_POST['email_data'])) {
    $emailValue = $_POST['email_data'];
    $nameValue = $_POST['name'];
    foreach ($value as $key) {

        $email_to = implode(',', $key);
        $subject = 'Testing PHP Mail';
        $message = 'This mail is sent using the PHP mail function' .;
        $headers = 'From:aravindansridhars@gmail.com';
        $retval = mail($email_to, $subject, $message, $headers);

        echo $email_to;
        // if ($retval == true) {
        //     echo "success";
        // } else {
        //     echo "fail";
        // }
    }
}
?>