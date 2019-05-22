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
                  if ($rows->del_flag == 'Accepted')
                     $status_class = 'gray_clr';
                  else if ($rows->del_flag == 'Rejected')
                     $status_class = 'gray_clr';
                  else if ($rows->del_flag == 'D')
                     $status_class = 'white';
                  else if ($rows->del_flag == 'Selected')
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
   echo "<h1> you are an interviewer, please check interview schedule for updates</h1>";
}

?>
<?php
require_once 'includes/footer.inc.php';
?>