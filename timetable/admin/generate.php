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
      <h2><span>Generate Time Table</span></h2>
      <p>
        <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
        ?>
      </p>
      <form action="./php/generate.php" method="post" enctype="multipart/form-data">
          <button type="submit" class="button2" name="import">Generate</button>
        </form>
      <table width="100%" border="1" cellpadding="1" cellspacing="2" bordercolor="#006699">
        <tr>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>Id</strong></div>
          </th>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>approve</strong></div>
          </th>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>delete</strong></div>
          </th>
          <th style="background-color: #006699; color:#fff;" class="style3">
            <div style="text-align:left" class="style9 style5 style2"><strong>View</strong></div>
          </th>

        </tr>

        <?php
        $selectQuery = "SELECT * FROM timetable ORDER BY id DESC";
        $result = $dbConnection->query($selectQuery);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <?php echo $row["id"] ?>
                </div>
              </td>
              
              
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <a href="./php/approveTimeTable.php?id=<?php echo $row['id']; ?>">Approve</a>
                </div>
              </td>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <a href="./php/rejectTimeTable.php?id=<?php echo $row['id']; ?>">Delete</a>
                </div>
              </td>
              <td class="style3">
                <div style="text-align:left" class="style9 style5 style2">
                  <a target="_blank" href="./viewTimetable.php?id=<?php echo $row['id']; ?>">View</a>
                </div>
              </td>
            </tr>
            <?php
          }
        } ?>

      </table>

    

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




