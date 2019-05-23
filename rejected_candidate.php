<?php
require_once 'init.php';
require_once 'includes/header-inc.php';
?>


<!-- ===================================================================================== -->
<!--=============================== Rejected dash board start ================================-->


<section class="container">
   <div class="table-responsive">
      <table class="table table-striped table-hover rejectBox">
         <thead class="text-left default-cursor ">
            <tr>
               <th class="text-muted rejectBoxCheckAll">
                  <input class="m-2 checkall" type="checkbox">
               </th>
               <th class="rejectBoxName">
                  <span class="text-muted"><i class="fas fa-user mr-2 mr-2"></i> Name</span>
               </th>
               <th class="text-muted">
                  Designation<i class="fa fa-status mr-2 mr-2"></i>
               </th>
               <th class="text-muted"><i class="fas fa-comments mr-1"></i>Comment</th>
               <th class="text-muted"><i class="fas fa-user mr-1"></i>Rejected By</th>
            </tr>
         </thead>

         <?php
         $select_candidate_list = "SELECT * FROM registered_user WHERE del_flag ='Rejected'";
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
            <tbody class="text-left reject">
               <tr>
                  <td class="rejectsectionTdUl align-middle p-0">
                     <input class="mx-3 align-middle checkbox-child" type="checkbox">
                  </td>
                  <td class="rejectName py-1">
                     <img class="rejectprofileImg rounded-circle img-fluid mr-3" src="assets/images/img1.jpg">
                     <p class="align-middle text-xm-center">
                        <?php echo $rows->name ?> <br><br><span class="text-primary default-cursor ">(<?php echo $rows->qualification ?>)</span></p>
                  </td>
                  <td class="align-middle default-cursor ">
                     <div class="<?php echo $color ?> btn-sm">
                        <?php echo $rows->fresher_or_experienced ?></div>
                  </td>
                  <td class="rejectComment  align-middle">
                     <?php echo $rows->reject_reason ?></td>
                     <td>
								<?php if ($rows->action_by == "1") {
									echo "<button class='btn btn-danger btn-block'>Admin</button>";
								}
								if ($rows->action_by == "2") {
									echo "<button class='btn btn-info btn-block'>Interviewer 1</button>";
								}
								if ($rows->action_by == "3") {
									echo "<button class='btn btn-info btn-block'>Interviewer 2</button>";
								} ?>
							</td>
						
               </tr>

            </tbody>
         <?php } ?>
      </table>
   </div>
</section>


<!-- Rejected dash board end -->
<!-- =================================================================================================== -->