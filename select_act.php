<?php
require_once 'init.php';

$select_id = $_POST['select_id'];
$action_by = $_POST['action_by'];

$update_select = "UPDATE registered_user 
          SET del_flag = 'Selected' , action_by = " . $action_by . " WHERE id = " . $select_id;
$update = $db->prepare($update_select);
$update->execute();
if ($update) {
    echo "Candidate selected";
}
