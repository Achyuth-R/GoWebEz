<?php
require_once 'init.php';

$accept_id = $_POST['accept_id'];

$update_accept = "UPDATE registered_user 
          SET del_flag = 'Accepted'
              
              WHERE id=" . $accept_id;
$update = $db->prepare($update_accept);
$update->execute();
if ($update) {
	header('Location: candidate_pofile.php');
}
