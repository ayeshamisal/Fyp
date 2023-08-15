<?php include "Header.php" ?> <!-- Page (2 columns) -->
<div id="page" class="box">
  <div id="page-in" class="box"> <!-- Content -->
    <div id="content"> <!-- Article -->
      <div class="article">
        <h2><span>Add New Course</span></h2>
        
        <div class="login">
          <form action="./php/addCourse.php" method="post" id="form2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Semester No.:</td>
                <td><input type="text" name="semester" id="txtName1" /></td>
              </tr>
              <tr>
                <td>Course Code:</td>
                <td><input type="text" name="courseCode" id="txtName1" /></td>
              </tr>
              <tr>
                <td>Course Name:</td>
                <td><input type="text" name="courseName" id="txtName1" /></td>
              </tr>

              <tr>
                <td>credit hours</td>
                <td><input type="text" name="creditHours" id="txtName2" /></td>
              </tr>
              <tr>
                <td>No.of Students:</td>
                <td><input type="text" name="enrolledStudent" id="txtName2" /></td>
              </tr>
              <tr>
                <td>Lab:</td>
                <td>
                   <select name="lab">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select> 
                      </div>
                </td>
              </tr> 

              <tr>
                <td colspan="2"><label> <label></label>
                    <div align="center"> <input type="submit" name="button2" class="button2" value="Add" /> </div>
                  </label></td>
              </tr>
            </table>
          </form>
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