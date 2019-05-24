<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header-inc.php';

?>


<!-- ===================================================================================== -->
<!--=============================== accepteded dash board start ================================-->
<section class="tableSection container">
   <div class="table-stripedresponsive">
      <table class="table table-hover acceptedBox">
         <thead class="text-left default-cursor">
            <tr>
               <th class="text-muted acceptedBoxCheckAll">
                  <input class="m-2 checkall" type="checkbox">
               </th>
               <th class="acceptedBoxName">
                  <span class="text-muted"><i class="fas fa-user mr-2 mr-2"></i> Name</span>
               </th>
               <th class="text-muted">
                  <i class="fas fa-chevron mr-2 mr-2"></i>Designation
               </th>

               <th class="text-muted">
                  <i class="fas fa-envelope mr-1" aria-hidden="true"></i> E-mail
               </th>
               <th class="text-muted" style="width: 12%;">
                  <i class="fas fa-calendar mr-1" aria-hidden="true"></i> Date of Application
               </th>
               <?php if ($position == 'admin') { ?>
                  <th class="text-muted" style="width: 18%;">
                     <i class="fas fa-location-arrow mr-1" aria-hidden="true"></i> Send Mail
                  </th>
               <?php } ?>
               <th class="text-muted" style="width: 18%;">
                  <i class="fas fa-filter mr-1" aria-hidden="true"></i>Action
               </th>
            </tr>
         </thead>
         <tbody class="text-left accepted">
            <?php
            $select_accepted_list = "SELECT * FROM registered_user where del_flag='Accepted' ";
            $select_accepted_list = $db->query($select_accepted_list);
            $count = 0;
            while ($rows = $select_accepted_list->fetch(PDO::FETCH_OBJ)) {
               $count = $count + 1;

               if ($rows->fresher_or_experienced == "Fresher") {
                  $color = "warning";
               } else if ($rows->fresher_or_experienced == "Experienced") {
                  $color = "dark";
               } else {
                  $color = "info";
               }
               ?>
               <tr class="<?php echo $status_class ?>" data-id="<?php echo $rows->id ?>">
                  <input type="hidden" class="candidate_id " name="id" value="<?php echo $rows->id ?>">
                  <td class="acceptedsectionTdUl align-middle p-0 ">
                     <input class="mx-3 align-middle checkbox-child single_email_select" type="checkbox" data-email="<?php echo $rows->email ?>" data-name="<?php echo $rows->name ?>">
                  </td>
                  <td class="acceptedName py-1">
                     <img class="acceptedprofileImg rounded-circle img-fluid mr-3" src="assets/images/img1.jpg">
                     <p class="align-middle text-sm-center mt-2"><?php echo $rows->name ?>
                        <span class="text-primary" class="text-primary"><br><br>( <?php echo $rows->qualification ?> )</span></p><br>

                  <td class="align-middle">
                     <div class="<?php echo $color ?> btn-sm">
                        <?php echo $rows->fresher_or_experienced ?></div>
                  </td>
                  </td>
                  <td class="tableSectionEmail  align-middle">
                     <?php echo $rows->email ?></td>
                  <td class="acceptedComment  align-middle">
                     11/02/2019
                  </td>
                  <?php if ($position == 'admin') { ?>
                     <td class="align-middle"><button type="button" name="email_button" class="btn btn-primary email_button email_single" data-email="<?php echo $rows->email ?>" data-name="<?php echo $rows->name ?>" data-action="email_single">
                           <i class="fas fa-envelope"></i>&nbsp;<span class="badge badge-warning"><?php if ($rows->mail_sent == "1") {
                                                                                                      echo "Mail Sent";
                                                                                                   } ?></span></button></td>
                  <?php } ?>
                  <td class="align-middle">


                     <button id="selectButton" class="btn btn-outline-success mr-3 text-md-center select" data-id="<?php echo $rows->id ?>"> Select</button>
                     <button class="btn btn-outline-danger rejectButton" data-toggle="modal" data-target="#rejectModal" data-id="<?php echo $rows->id ?>"> Reject</button>
               </tr>

            <?php } ?>
         </tbody>
      </table>



   </div>
   <?php if ($_SESSION['position'] == 'admin') { ?>
      <div class="container">
         <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-sm">
               <select id="eventID" class="custom-select">
                  <option value="notSelected" selected>Interview Slots</option>
                  <?php
                  $events = "SELECT * FROM events";
                  $events = $db->query($events);
                  while ($rows = $events->fetch(PDO::FETCH_OBJ)) { ?>
                     <option value=" <?php echo $rows->id ?> "> <?php echo substr($rows->start_date, 0, 16) . " to " . substr($rows->end_date, 11, 5) ?> <span style="font-weight:bold;"> &nbsp;|&nbsp; <?php if ($rows->created_by == "1") {
                                                                                                                                                                                                            echo "Admin";
                                                                                                                                                                                                         }
                                                                                                                                                                                                         if ($rows->created_by == "2") {
                                                                                                                                                                                                            echo "Interviewer 1";
                                                                                                                                                                                                         }
                                                                                                                                                                                                         if ($rows->created_by == "3") {
                                                                                                                                                                                                            echo "Interviewer 2";
                                                                                                                                                                                                         } ?></span></option>
                  <?php }
               ?>
               </select>
            </div>
            <div class="col-sm">
               <button type="button" class="btn btn-primary float-right mb-2 email_button" id="send_allmail" data-action="send_allmail"><i class="fas fa-location-arrow"></i>&nbsp;Send e-mail for selected</button>
            </div>
         </div>
      </div>
   <?php } ?>


   <div class="modal fade" id="rejectModal" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" name="rejectModalLabel">Reason for rejection:</h5>
            </div>
            <div class="modal-body">
               <form id="rejectForm" name="rejectForm">
                  <div class="form-group"></div>
                  <input id="rejectDescription" class="form-control" name="rejectDescription" type="text" size="50">
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal">Cancel</button>

               <button type="button" class="btn btn-danger reject_button" data-dismiss="modal">Reject</button>
            </div>
         </div>
      </div>
   </div>

</section>
<script src="assets/js/accepted_candidate.js"></script>



<!-- accepteded dash board end -->
<!-- =================================================================================================== -->