<?php
  include "Header.php";
  require_once 'vendor/autoload.php'; 
  use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 
  ?>

<!-- Page (2 columns) -->
<div id="page" class="box">


  <!-- Content -->
  <div id="content">



    <!-- Article -->
    <div class="article">
      <h2><span>Course Details</span></h2>
      <p>
        <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
        ?>
      </p>
      <form action="./php/importCourse.php" method="post" enctype="multipart/form-data">
          <input type="file" class="button2" name="file" required value="">
          <button type="submit" class="button2" name="import">Import</button>
        </form>
      <table width="100%" border="1" cellpadding="1" cellspacing="2" bordercolor="#006699">
        <tr>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>Course id</strong></div>
          </th>
          
           <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>Course Name</strong></div>
          </th>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>Credit hours</strong></div>
          </th>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>Course Lab</strong></div>
          </th>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>Total Students</strong></div>
          </th>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>update</strong></div>
          </th>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>delete</strong></div>
          </th>

        </tr>

        <?php
        $selectQuery = "SELECT * FROM course ORDER BY id DESC";
        $result = $dbConnection->query($selectQuery);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <?php echo $row["course_code"] ?>
                </div>
              </td>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <?php echo $row["course_name"] ?>
                </div>
              </td>
              
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <?php echo $row["credit"] ?>
                </div>
              </td>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <?php echo $row["lab"] ?>
                </div>
              </td>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <?php echo $row["enrolled_students"] ?>
                </div>
              </td>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <a href="updateCourse.php?id=<?php echo $row['id']; ?>">update</a>
                </div>
              </td>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <a href="./php/deleteCourse.php?id=<?php echo $row['id']; ?>">Delete</a>
                </div>
              </td>
            </tr>
            <?php
          }
        } ?>

      </table>

      <!-- adding add department button -->

      <div style="text-align:center;  ">
        <a class="button2" href="./addcourse.php"><span>Add
            Course</span></a>
      </div>


    </div> <!-- /article -->

  </div> <!-- /content -->

  <?php
  include "right.php"
    ?>
</div> <!-- /page-in -->
<?php
include "footer.php"
  ?>
</div> <!-- /page -->




