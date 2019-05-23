<?php
require_once 'init.php';
require_once 'includes/header-inc.php';
?>
<div id="result">

</div>
<?php
if ($_SESSION['position'] == 'admin') {
   ?>
   <section class="tableSection container">
      <div class="table-responsive">
         <table class="table  tableSectionBox table-hover">
            <thead class="text-left default-cursor">
               <tr>
                  <th class="text-muted tableSectionBoxCheckAll">
                     <input class="m-2 checkall" type="checkbox" id="checkall">
                  </th>
                  <th class="text-muted">
                     <span><i class="fa fa-user-o ml-2 mr-2" aria-hidden="true"></i> Name</span>
                  </th>
                  <th class="text-muted"><i class="fa fa-pen-o mr-1" aria-hidden="true"></i>Designation</th>
                  <th class="text-muted"><i class="fa fa-envelope-o mr-1" aria-hidden="true"></i> E-mail</th>
                  <th class="text-muted"><i class="fa fa-calendar mr-1" aria-hidden="true"></i> Date of Application</th>
                  <th class="text-muted"><i class="fa fa-line-chart mr-1" aria-hidden="true"></i> Status</th>
               </tr>
            </thead>
            <tbody class="text-left" id="candidate_list">
               <?php
               $select_candidate_list = "SELECT * FROM registered_user";
               $select_candidate_list = $db->query($select_candidate_list);


               while ($rows = $select_candidate_list->fetch(PDO::FETCH_OBJ)) {
                  if ($rows->fresher_or_experienced == "Fresher") {
                     $color = "warning";
                  } else if ($rows->fresher_or_experienced == "Experienced") {
                     $color = "dark";
                  } else {
                     $color = "info";
                  }
                  ?>

                  <?php
                  if ($rows->del_flag == 'D')
                     $status_class = 'white';
                  else
                     $status_class = 'gray_clr';
                  ?>
                  <tr class="<?php echo $status_class ?>" data-id="<?php echo $rows->id ?>">
                     <input type="hidden" class="candidate_id" name="id" value="<?php echo $rows->id ?>">
                     <td class="tablelSectionTdUl align-middle p-0">
                        <input class="mx-3 align-middle checkbox-child" type="checkbox">
                     </td>
                     <td class="align-middle">

                        <img class="rounded-circle img-fluid mr-3 tableprofileImg float-left" src="assets/images/img1.jpg">
                        <p class="align-middle text-xm-center"><?php echo $rows->name ?><span class="text-primary default-cursor font-weight-bold">
                              <br>( <?php echo $rows->qualification ?> )</span>
                        </p>
                     </td>
                     <td class="align-middle">
                        <div class="<?php echo $color ?> default-cursor btn-sm"><?php echo $rows->fresher_or_experienced; ?></div>
                     </td>
                     <td class="tableSectionEmail  align-middle"><?php echo $rows->email ?></td>
                     <td class="align-middle">11/12/2014</td>
                     <td class="spinner default-cursor align-middle">



                        <?php

                        if ($rows->del_flag == 'D') {

                           echo '<div class="spinner-grow text-success table-spinner ml-2 "></div>
                        <div class="spinner-grow text-info table-spinner"></div>
                        <div class="spinner-grow text-warning table-spinner"></div>
                        <div class="spinner-grow text-danger table-spinner"></div>
                        <div class="spinner-grow text-secondary table-spinner"></div>
                        <div class="spinner-grow text-danger table-spinner"></div>';
                        } else {

                           if ($rows->del_flag == 'Accepted')
                              $status_update = 'btn-info';
                           if ($rows->del_flag == 'Rejected')
                              $status_update = 'btn-danger';
                           if ($rows->del_flag == 'Selected')
                              $status_update = 'btn-success';

                           echo '<span class="btn-sm default-cursor font-weight-bold ' . $status_update . '"> ' . $rows->del_flag . '</span>';
                        }

                        ?>




                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </section>



   </div>
<?php
} else {


   $sql =  $db->prepare('SELECT id FROM registered_user WHERE del_flag = "Rejected" ');
   $sql->execute();
   $reject = $sql->fetchAll(PDO::FETCH_OBJ);
   $count_reject =  count($reject);
   $sql =  $db->prepare('SELECT id FROM registered_user WHERE del_flag = "Accepted" ');
   $sql->execute();
   $accept = $sql->fetchAll(PDO::FETCH_OBJ);
   $count_accept = count($accept);
   $sql =  $db->prepare('SELECT id FROM registered_user WHERE del_flag = "Selected" ');
   $sql->execute();
   $select = $sql->fetchAll(PDO::FETCH_OBJ);
   $count_select = count($select);
   $sql =  $db->prepare('SELECT id FROM registered_user;');
   $sql->execute();
   $all = $sql->fetchAll(PDO::FETCH_OBJ);
   $count_all =  count($all);
   echo '
   <h3 class="display-4" style="text-align:center; font-size: 40px;">Total Number of candidates:' . $count_all . '</h3>
   <hr>
   <div style="top:50%; transform:translate(0,50%);">
   <center>
     <div class="row">
       <div class="col-sm">
       <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
     <div class="card-header"><h4>Accepted Candidates</h4></div>
     <div class="card-body">
       <h1 class="btn btn-lg btn-warning">' . $count_accept . '</h1>
       
     </div>
   </div>
   </div>
   <div class="col-sm">
       <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
     <div class="card-header"><h4>Rejected Candidates</h4></div>
     <div class="card-body">
       <h1 class="btn btn-lg btn-warning">' . $count_reject . '</h1>
       
     </div>
   </div>
       </div>
       <div class="col-sm">
       <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
     <div class="card-header"><h4>Selected Candidates</h4></div>
     <div class="card-body">
       <h1 class="btn btn-lg btn-warning">' . $count_select . '</h1>
      
     </div>
   </div>
       </div>
     </div>
   
   
   </center>
   </div>    
      
   ';
}

?>
<?php
require_once 'includes/footer.inc.php';
?>