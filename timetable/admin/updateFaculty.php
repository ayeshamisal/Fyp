<?php include "Header.php" ?>
<div id="page" class="box">
    <div id="page-in" class="box">

        <div id="content">

            <div class="article">
                <h2><span>Faculty Details</span></h2>
                <div class="login">
                    <?php
                    $id = $_GET['id'];
                    $selectQuery = "SELECT * FROM teachers WHERE id = $id";
                    $result = $dbConnection->query($selectQuery);
                    if ($result->num_rows > 0) {
                        // Fetch the data from the result set
                        $row = $result->fetch_assoc();
                        $subjects = json_decode($row['subject']);
                        $availability = json_decode($row['availability'], true);
                        ?>
                        <form action="./php/updateFaculty.php?id=<?php echo $id ?>" method="post"
                            enctype="multipart/form-data" id="form2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>Faculty Name:</td>
                                    <td> <input type="text" value="<?php echo $row['name'] ?>" name="name" id="txtName" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><input type="email" value="<?php echo $row['email'] ?>" name="email"
                                            id="txtEmail" /></td>
                                </tr>
                                <tr>
                                    <td>Monday:</td>

                                    <td style="height: auto;">
                                        <select style="width:100%" name="Monday[]" multiple>

                                            <option value="9:00 AM - 10:30 AM" <?php if (isset($availability['Monday'])) if (in_array('9:00 AM - 10:30 AM', $availability['Monday']))
                                                echo 'selected'; ?>>9:00 AM - 10:30 AM</option>
                                            <option value="11:00 AM - 12:30 PM" <?php if (isset($availability['Monday'])) if (in_array('11:00 AM - 12:30 PM', $availability['Monday']))
                                                echo 'selected'; ?>>
                                                11:00 AM - 12:30 PM</option>
                                            <option value="12:35 AM - 2:05 PM" <?php if (isset($availability['Monday'])) if (in_array('12:35 AM - 2:05 PM', $availability['Monday']))
                                                echo 'selected'; ?>>
                                                12:35 AM - 2:05 PM</option>
                                            <option value="2:10 PM - 3:40 PM" <?php if (isset($availability['Monday'])) if (in_array('2:10 PM - 3:40 PM', $availability['Monday']))
                                                echo 'selected'; ?>>2:10 PM - 3:40 PM</option>
                                            <option value="4:00 PM - 5:30 PM" <?php if (isset($availability['Monday'])) if (in_array('4:00 PM - 5:30 PM', $availability['Monday']))
                                                echo 'selected'; ?>>4:00 PM - 5:30 PM</option>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Tuesday:</td>
                                    <td style="height: auto;">
                                        <select style="width:100%" name="Tuesday[]" multiple>
                                            <option value="9:00 AM - 10:30 AM" <?php if (isset($availability['Tuesday'])) if (in_array('9:00 AM - 10:30 AM', $availability['Tuesday']))
                                                echo 'selected'; ?>>9:00 AM - 10:30 AM</option>
                                            <option value="11:00 AM - 12:30 PM" <?php if (isset($availability['Tuesday'])) if (in_array('11:00 AM - 12:30 PM', $availability['Tuesday']))
                                                echo 'selected'; ?>>
                                                11:00 AM - 12:30 PM</option>
                                            <option value="12:35 AM - 2:05 PM" <?php if (isset($availability['Tuesday'])) if (in_array('12:35 AM - 2:05 PM', $availability['Tuesday']))
                                                echo 'selected'; ?>>
                                                12:35 AM - 2:05 PM</option>
                                            <option value="2:10 PM - 3:40 PM" <?php if (isset($availability['Tuesday'])) if (in_array('2:10 PM - 3:40 PM', $availability['Tuesday']))
                                                echo 'selected'; ?>>2:10 PM - 3:40 PM</option>
                                            <option value="4:00 PM - 5:30 PM" <?php if (isset($availability['Tuesday'])) if (in_array('4:00 PM - 5:30 PM', $availability['Tuesday']))
                                                echo 'selected'; ?>>4:00 PM - 5:30 PM</option>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Wednesday:</td>
                                    <td style="height: auto;">
                                        <select style="width:100%" name="Wednesday[]" multiple>
                                            <option value="9:00 AM - 10:30 AM" <?php if (isset($availability['Wednesday'])) if (in_array('9:00 AM - 10:30 AM', $availability['Wednesday']))
                                                echo 'selected'; ?>>9:00 AM - 10:30 AM</option>
                                            <option value="11:00 AM - 12:30 PM" <?php if (isset($availability['Wednesday'])) if (in_array('11:00 AM - 12:30 PM', $availability['Wednesday']))
                                                echo 'selected'; ?>>
                                                11:00 AM - 12:30 PM</option>
                                            <option value="12:35 AM - 2:05 PM" <?php if (isset($availability['Wednesday'])) if (in_array('12:35 AM - 2:05 PM', $availability['Wednesday']))
                                                echo 'selected'; ?>>
                                                12:35 AM - 2:05 PM</option>
                                            <option value="2:10 PM - 3:40 PM" <?php if (isset($availability['Wednesday'])) if (in_array('2:10 PM - 3:40 PM', $availability['Wednesday']))
                                                echo 'selected'; ?>>2:10 PM - 3:40 PM</option>
                                            <option value="4:00 PM - 5:30 PM" <?php if (isset($availability['Wednesday'])) if (in_array('4:00 PM - 5:30 PM', $availability['Wednesday']))
                                                echo 'selected'; ?>>4:00 PM - 5:30 PM</option>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Thursday:</td>
                                    <td>
                                        <select style="width:100%" name="Thursday[]" multiple>
                                            <option value="9:00 AM - 10:30 AM" <?php if (isset($availability['Thursday'])) if (in_array('9:00 AM - 10:30 AM', $availability['Thursday']))
                                                echo 'selected'; ?>>9:00 AM - 10:30 AM</option>
                                            <option value="11:00 AM - 12:30 PM" <?php if (isset($availability['Thursday'])) if (in_array('11:00 AM - 12:30 PM', $availability['Thursday']))
                                                echo 'selected'; ?>>
                                                11:00 AM - 12:30 PM</option>
                                            <option value="12:35 AM - 2:05 PM" <?php if (isset($availability['Thursday'])) if (in_array('12:35 AM - 2:05 PM', $availability['Thursday']))
                                                echo 'selected'; ?>>
                                                12:35 AM - 2:05 PM</option>
                                            <option value="2:10 PM - 3:40 PM" <?php if (isset($availability['Thursday'])) if (in_array('2:10 PM - 3:40 PM', $availability['Thursday']))
                                                echo 'selected'; ?>>2:10 PM - 3:40 PM</option>
                                            <option value="4:00 PM - 5:30 PM" <?php if (isset($availability['Thursday'])) if (in_array('4:00 PM - 5:30 PM', $availability['Thursday']))
                                                echo 'selected'; ?>>4:00 PM - 5:30 PM</option>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Friday:</td>
                                    <td>
                                        <select style="width:100%" name="Friday[]" multiple>
                                            <option value="9:00 AM - 10:30 AM" <?php if (isset($availability['Friday'])) if (in_array('9:00 AM - 10:30 AM', $availability['Friday']))
                                                echo 'selected'; ?>>9:00 AM - 10:30 AM</option>
                                            <option value="11:00 AM - 12:30 PM" <?php if (isset($availability['Friday'])) if (in_array('11:00 AM - 12:30 PM', $availability['Friday']))
                                                echo 'selected'; ?>>
                                                11:00 AM - 12:30 PM</option>
                                            <option value="12:35 AM - 2:05 PM" <?php if (isset($availability['Friday'])) if (in_array('12:35 AM - 2:05 PM', $availability['Friday']))
                                                echo 'selected'; ?>>
                                                12:35 AM - 2:05 PM</option>
                                            <option value="2:10 PM - 3:40 PM" <?php if (isset($availability['Friday'])) if (in_array('2:10 PM - 3:40 PM', $availability['Friday']))
                                                echo 'selected'; ?>>2:10 PM - 3:40 PM</option>
                                            <option value="4:00 PM - 5:30 PM" <?php if (isset($availability['Friday'])) if (in_array('4:00 PM - 5:30 PM', $availability['Friday']))
                                                echo 'selected'; ?>>4:00 PM - 5:30 PM</option>

                                        </select>

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

                                                    if (in_array($row["course_name"], $subjects)) {
                                                        echo "<option selected value='" . $row["course_name"] . "'>" . $row["course_name"] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $row["course_name"] . "'>" . $row["course_name"] . "</option>";

                                                    }
                                                }
                                            } ?>
                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label> <label></label>
                                            <div align="center"> <input type="submit" name="button2" id="button2"
                                                    value="Update" /> </div>
                                        </label></td>
                                </tr>
                            </table>
                        </form>
                    <?php } ?>
                </div>
                <p class="btn-more box noprint">&nbsp;</p>
            </div> <!-- /article -->

        </div> <!-- /content -->
        <?php include "right.php" ?>
    </div> <!-- /page-in -->
    <?php include "footer.php" ?>