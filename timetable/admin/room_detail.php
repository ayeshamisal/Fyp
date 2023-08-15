<?php
include "Header.php"
  ?>

<!-- Page (2 columns) -->
<div id="page" class="box">
  <div id="page-in" class="box">
    <!-- Content -->
    <div id="content">
      <!-- Article -->
      <div class="article">
        <h2><span>Room Details</span></h2>
        <form action="./php/importRoom.php" method="post" enctype="multipart/form-data">
          <input type="file" class="button2" name="file" required value="">
          <button type="submit" class="button2" name="import">Import</button>
        </form>
        <p>
          <?php
          if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          }
          ?>
        </p>
        
        <table width="100%" border="1" cellpadding="1" cellspacing="2" bordercolor="#006699">
          <tr>
            <th style="background-color:#006699; color:#fff;" class="style3">
              <div align="left" class="style9 style5 style2"><strong>Room Name</strong></div>
            </th>
            <th style="background-color:#006699; color:#fff;" class="style3">
              <div align="left" class="style9 style5 style2"><strong>Capacity</strong></div>
            </th>
            <th style="background-color:#006699; color:#fff;" class="style3">
              <div align="left" class="style9 style5 style2"><strong>update</strong></div>
            </th>
            <th style="background-color:#006699; color:#fff;" class="style3">
              <div align="left" class="style9 style5 style2"><strong>delete</strong></div>
            </th>
          </tr>
          <?php
          $selectQuery = "SELECT * FROM room ORDER BY id DESC";
          $result = $dbConnection->query($selectQuery);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              ?>
              <tr>
                <td class="style3">
                  <div align="left" class="style9 style5 style2">
                    <?php echo $row["room_name"] ?>
                  </div>
                </td>
                <td class="style3">
                  <div align="left" class="style9 style5 style2">
                    <?php echo $row["capacity"] ?>
                  </div>
                </td>
                <td class="style3">
                  <div align="left" class="style9 style5 style2">
                    <a href="./update_room.php?id=<?php echo $row['id']; ?>">Update</a>
                  </div>
                </td>
                <td class="style3">
                  <div align="left" class="style9 style5 style2">
                    <a href="./php/delete_room.php?id=<?php echo $row['id']; ?>">delete</a>
                  </div>
                </td>
              </tr>
              <?php
            }
          } ?>

        </table>

        <!-- adding add department button -->

        <div style="text-align:center;">
          <a href="./add_room.php" class="button2" style="vertical-align:middle"><span>Add Room</span></a>
        </div>


        <p class="btn-more box noprint">&nbsp;</p>
      </div> <!-- /article -->
      <hr class="noscreen" />

    </div> <!-- /content -->

    <?php
    include "right.php"
      ?>
  </div> <!-- /page-in -->
  <?php
  include "footer.php"
    ?>
</div> <!-- /page -->