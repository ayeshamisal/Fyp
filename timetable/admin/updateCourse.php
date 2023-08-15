<?php include "Header.php" ?> <!-- Page (2 columns) -->
<div id="page" class="box">
    <div id="page-in" class="box"> <!-- Content -->
        <div id="content"> <!-- Article -->
            <div class="article">
                <h2><span>Add New Course</span></h2>
                <div class="login">
                    <?php
                    $id = $_GET['id'];
                    $selectQuery = "SELECT * FROM course WHERE id = $id";
                    $result = $dbConnection->query($selectQuery);
                    if ($result->num_rows > 0) {
                        // Fetch the data from the result set
                        $row = $result->fetch_assoc();
                        ?>
                        <form action="./php/updateCourse.php?id=<?php echo $id ?>" method="post" id="form2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>Course Name:</td>
                                    <td><input type="text" value="<?php echo $row["course_name"] ?>" name="courseName"
                                            id="txtName1" /></td>
                                </tr>

                                <tr>
                                    <td>credit hours</td>
                                    <td><input type="text" value="<?php echo $row["credit"] ?>" name="creditHours"
                                            id="txtName2" /></td>
                                </tr>
                                <tr>
                                    <td>No.of Students:</td>
                                    <td><input type="text" value="<?php echo $row["enrolled_students"] ?>"
                                            name="enrolledStudent" id="txtName2" /></td>
                                </tr>
                                 <tr>
                                    <td>Lab:</td>
                                     <td>
                                        <select name="lab">
                                        <option value="yes" <?php if ($row['lab'] == 'yes') echo 'selected'; ?>>Yes</option>
                                        <option value="no" <?php if ($row['lab'] != 'yes') echo 'selected'; ?>>No</option>
                                    </select>
                                            </div>
                                        </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label> <label></label>
                                            <div align="center"> <input type="submit" name="button2" class="button2"
                                                    value="Update" /> </div>
                                        </label></td>
                                </tr>
                            </table>
                        </form>
                    <?php } ?>
                </div>
                </table>
                </form>
            </div>
            <p class="btn-more box noprint">&nbsp;</p>
        </div> <!-- /article -->
        <hr class="noscreen" />
        <?php include "right.php" ?>
    </div> <!-- /content -->
</div> <!-- /page-in -->
<?php include "footer.php" ?>
</div> <!-- /page -->