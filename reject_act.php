
<?php
require_once 'init.php';

$reject_id = $_POST['reject_id'];
$reject_reason = $_POST['reject_reason'];

$update_reject = "UPDATE registered_user 
		  SET del_flag = 'Rejected', reject_reason = '";
$update_reject = $update_reject . $reject_reason . "', action_by = " . $_POST["action_by"] . " WHERE id=" . $reject_id;
$update = $db->prepare($update_reject);
$update->execute();
if ($update) {
	echo $_POST["action_by"];
}

?>