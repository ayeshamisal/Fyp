<?php include "Header.php" ?> <!-- Page (2 columns) -->
<div id="page" class="box">
  <div id="page-in" class="box"> <!-- Content -->
    <div id="content"> <!-- Article -->
      <div class="article">
        <h2><span>Students Detail</span></h2>
        <form action="./php/importStudent.php" method="post" enctype="multipart/form-data">
          <input type="file" class="button2" name="file" required value="">
          <button type="submit" class="button2" name="import">Import</button>
        </form>
        <p>
          <?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          } ?>
        </p>
        <table width="100%" border="1" cellpadding="1" cellspacing="2" bordercolor="#006699">
          <tr>
            <th bgcolor="#006699" class="style3">
              <div align="left" class="style9 style5 style2"><strong>Id</strong></div>
            </th>
            <th bgcolor="#006699" class="style3">
              <div align="left" class="style9 style5 style2"><strong>Name</strong></div>
            </th>
            <th bgcolor="#006699" class="style3">
              <div align="left" class="style9 style5 style2"><strong>View</strong></div>
            </th>
            <th bgcolor="#006699" class="style3">
              <div align="left" class="style9 style5 style2"><strong>Delete</strong></div>
            </th>

          </tr>
          <?php $selectQuery = "SELECT * FROM students ORDER BY id DESC";
          $result = $dbConnection->query($selectQuery);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
            
              <tr>
                <td class="style3">
                  <div align="left" class="style9 style5 style2">
                    <?php echo $row['s_id']; ?>
                  </div>
                </td>
                <td class="style3">
                  <div align="left" class="style9 style5 style2">
                    <?php echo $row['name']; ?>
                  </div>
                </td>
                <td class="style3">
                  <div align="left" class="style9 style5 style2"> <a
                      href="updateStudent.php?id=<?php echo $row['id']; ?>">View
                      Detail</a>
                  </div>
                </td>
                <td class="style3">
                  <div align="left" class="style9 style5 style2"> <a
                      href="./php/deleteStudent.php?id=<?php echo $row['id']; ?>">Delete</a>
                  </div>
                </td>
              </tr>
            <?php }
          } ?>
        </table>
        <div style="text-align:center;"> <a href="addStudent.php" class="button2" style="vertical-align:middle"><span>
              Add student</span></a> </div>
        <p class="btn-more box noprint">&nbsp;</p>
      </div> <!-- /article -->
    </div> <!-- /content -->
    <?php include "right.php" ?>
  </div> <!-- /page-in -->
</div> <!-- /page -->
<?php include "footer.php" ?>