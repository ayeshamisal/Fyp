<?php include "Header.php" ?>
<div id="page" class="box">
	<div id="page-in" class="box">

		<div id="content">

			<div class="article">
				<h2><span>Student Details</span></h2>
				<div class="login">
					<form action="./php/addStudent.php" method="post" enctype="multipart/form-data" id="form2">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>Student id:</td>
								<td> <input type="text" name="id" id="txtName" />
								</td>
							</tr>
                            <tr>
								<td>Student Name:</td>
								<td> <input type="text" name="name" id="txtName" />
								</td>
							</tr>
							
							<tr>
								<td>Subjects:</td>
								<td>
									<select multiselect-search="true" style="width:100%" name="Subjects[]" multiple>
										<?php
										$selectQuery = "SELECT * FROM course ORDER BY id DESC";
										$result = $dbConnection->query($selectQuery);
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo "<option value='" . $row["course_name"] . "'>" . $row["course_name"] . "</option>";
											}
										} ?>
									</select>

								</td>
							</tr>
							<tr>
								<td colspan="2"><label> <label></label>
										<div align="center"> <input type="submit" name="button2" id="button2"
												value="Submit" /> </div>
									</label></td>
							</tr>
						</table>
					</form>
				</div>
				<p class="btn-more box noprint">&nbsp;</p>
			</div> <!-- /article -->

		</div> <!-- /content -->
		<?php include "right.php" ?>
	</div> <!-- /page-in -->
	<?php include "footer.php" ?>
</div>