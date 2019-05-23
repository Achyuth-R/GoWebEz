<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/header-inc.php';
?>
<?php
if ($_SESSION['position'] == 'admin') {
	?>
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
						<th class="text-muted">
							<i class="fas fa-calendar mr-1" aria-hidden="true"></i> Date of Application
						</th>
						<th class="text-muted">
							<i class="fas fa-user mr-1" aria-hidden="true"></i> Selected By
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
							<td class="acceptedsectionTdUl align-middle p-0 ">
								<input class="mx-3 align-middle checkbox-child single_email_select" type="checkbox" data-email="  <?php echo $rows->email ?>">
							</td>
							<td class="acceptedName py-1">
								<img class="acceptedprofileImg rounded-circle img-fluid mr-3" src="assets/images/img1.jpg">
								<p class="align-middle text-sm-center mt-2"><?php echo $rows->name ?>
									<span class="text-primary" class="text-primary"><br><br>( <?php echo $rows->qualification ?> )</span></p><br>

							<td class="align-middle">
								<div class="<?php echo $color ?> btn-sm default-cursor">
									<?php echo $rows->fresher_or_experienced ?></div>
							</td>
							</td>
							<td class="tableSectionEmail  align-middle">
								<?php echo $rows->email ?></td>
							<td class="acceptedComment  align-middle">
								11/02/2019
							</td>
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

	</section>

<?php } else {
	echo '<div class="alert alert-danger" role="alert">
		<h4 class="alert-heading">Oops! You are in the wrong page.</h4>
		<p>Unauthorized Access.</p>
		<hr>
		<p class="mb-0">Please return to Interview Schedule.</p>
	</div>';
} ?>