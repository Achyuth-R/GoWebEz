<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header-inc.php';
?>


<!-- ===================================================================================== -->
<!--=============================== accepteded dash board start ================================-->
<section class="tableSection container">
   <div class="table-stripedresponsive">
      <table class="table table-striped table-hover acceptedBox">
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
               <th class="text-muted">
                  <i class="fas fa-calendar mr-1" aria-hidden="true"></i> Date
               </th>
               <th class="text-muted">
                  <i class="fas fa-location-arrow mr-1" aria-hidden="true"></i> Send Mail
               </th>
            </tr>
         </thead>
         <tbody class="text-left accepted">
            <?php
            $select_accepted_list = "SELECT * FROM registered_user where del_flag='Accepted' ";
            $select_accepted_list = $db->query($select_accepted_list);
            // echo $select_accepted_list;
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
                     <input class="mx-3 align-middle checkbox-child single_email_select" type="checkbox" data-email="  <?php echo $rows->email ?>" data-name=" <?php echo $rows->name ?>">
                  </td>
                  <td class="acceptedName py-1">
                     <img class="acceptedprofileImg rounded-circle img-fluid mr-3" src="assets/images/img1.jpg">
                     <p class="align-middle default-cursor  text-sm-center mt-2"><?php echo $rows->name ?><br><br>
                        <span class="text-primary" class="text-primary">( <?php echo $rows->qualification ?> )</span></p><br>

                  <td class="align-middle default-cursor">
                     <div class="<?php echo $color ?> btn-sm">
                        <?php echo $rows->fresher_or_experienced ?></div>
                  </td>
                  </td>
                  <td class="tableSectionEmail  align-middle">
                     <?php echo $rows->email ?></td>
                  <td class="acceptedComment  align-middle">
                     11/02/2019
                  </td>
                  <td class="align-middle"><button type="button" name="email_button" class="btn btn-primary email_button email_single" id="<?php echo "$count" ?>" data-email="<?php echo $rows->email ?>" data-action="email_single">
                        <i class="fa fa-envelope"></i></button></td>

               </tr>
            <?php } ?>
         </tbody>
      </table>
      <button type="button" class="btn btn-primary float-right mb-2 email_button" id="send_allmail" data-action="send_allmail"><i class="fas fa-location-arrow"></i>&nbsp;Send e-mail for selected</button>
   </div>
</section>
<!-- accepteded dash board end -->
<!-- =================================================================================================== -->

<?php
require_once 'includes/footer.inc.php';
?>