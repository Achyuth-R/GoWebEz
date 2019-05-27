<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header-inc.php';
?>

<section class="tableSection container">
	<div class="table-stripedresponsive">
		<table class="table table-hover acceptedBox">
			<thead class="text-left default-cursor">
				<tr>
					<?php if ($position == "admin") { ?>
						<th class="text-muted acceptedBoxCheckAll">
							<input class="m-2 checkall" type="checkbox">
						</th>
					<?php } ?>
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
						<i class="fas fa-calendar mr-1" aria-hidden="true"></i> Date of Application
					</th>
					<?php if ($position == "admin") { ?>
						<th class="text-muted">
							<i class="fas fa-envelope mr-1" aria-hidden="true"></i> Send Mail
						</th>
					<?php } ?>
					<th class="text-muted">
						<i class="fas fa-users mr-1" aria-hidden="true"></i> Selected By
					</th>
				</tr>
			</thead>
			<tbody class="text-left accepted">
				<?php
				$select_accepted_list = "SELECT * FROM registered_user where del_flag='Selected' ";
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
						<?php if ($position == "admin") { ?>
							<td class="acceptedsectionTdUl align-middle p-0 ">
								<input class="mx-3 align-middle checkbox-child single_email_select" type="checkbox" data-name="<?php echo $rows->name ?>" data-email="<?php echo $rows->email ?>">
							</td>
						<?php } ?>


						<td class="acceptedName py-1">
							<img class="acceptedprofileImg rounded-circle img-fluid mr-3" src="assets/images/img1.jpg">
							<p class="align-middle text-sm-center mt-2"><?php echo $rows->name ?>
								<span class="text-primary default-cursor" class="text-primary"><br><br>( <?php echo $rows->qualification ?> )</span></p><br>

						<td class="align-middle">
							<div class="<?php echo $color ?> btn-sm default-cursor">
								<?php echo $rows->fresher_or_experienced ?></div>
						</td>
						<td class="tableSectionEmail  align-middle">
							<?php echo $rows->email ?></td>
						<td class="acceptedComment  align-middle">
							11/02/2019
						</td>
						<?php if ($position == 'admin') { ?>
							<td class="align-middle"><button type="button" name="email_button" class="btn btn-primary email_button email_single" data-email="<?php echo $rows->email ?>" data-name="<?php echo $rows->name ?>" data-action="email_single" <?php if ($rows->selected_mail_flag == "1") echo 'disabled="true"' ?>>
									<i class="fas fa-envelope"></i>&nbsp;<span class="badge badge-warning"><?php if ($rows->selected_mail_flag == "1") {
																												echo "Mail Sent";
																											} ?></span></button></td>
						<?php } ?>
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
					<?php } ?>
			</tbody>
		</table>
	</div>
	<?php if ($position == "admin") { ?>
		<div class="col-sm">
			<button type="button" class="btn btn-primary float-right mb-2 email_button" id="send_allmail" data-action="send_allmail"><i class="fas fa-location-arrow"></i>&nbsp;Send e-mail for selected</button>
		</div>
	<?php } ?>

</section>

<script src="assets/js/selected_candidate.js"></script>