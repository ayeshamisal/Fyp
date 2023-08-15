<?php include "Header.php" ?> <!-- Page (2 columns) -->
<div id="page" class="box">
    <div id="page-in" class="box"> <!-- Content -->
        <div id="content"> <!-- Article -->
            <div class="article">
                <h2><span>Room Details</span></h2>

                <div class="login">
                    <?php
                    $id = $_GET['id'];
                    $selectQuery = "SELECT * FROM room WHERE id = $id";
                    $result = $dbConnection->query($selectQuery);
                    if ($result->num_rows > 0) {
                        // Fetch the data from the result set
                        $row = $result->fetch_assoc();
                        ?>
                        <form action="./php/update_room.php?id=<?php echo $id ?>" method="post" id="form2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>Room Name :</td>
                                    <td><input type="text" value="<?php echo $row['room_name'] ?>" name="room_name"
                                            id="txtName1" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Capacity:</td>
                                    <td><input type="text" value="<?php echo $row['capacity'] ?>" name="capacity"
                                            id="txtName2" />
                                    </td>
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
                                            <div align="center"> <input type="submit" name="button2" id="button2"
                                                    value="Update" />
                                            </div>
                                        </label></td>
                                </tr>
                            </table>
                        </form>
                    <?php } ?>
                </div>
                </table>
                </form>
            </div>
        </div> <!-- /article -->
        <hr class="noscreen" />
        <?php include "right.php" ?>
    </div> <!-- /content -->
</div> <!-- /page-in -->
<?php include "footer.php" ?>
</div> <!-- /page -->