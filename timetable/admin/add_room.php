<?php include "Header.php" ?> <!-- Page (2 columns) -->
<div id="page" class="box">
   <div id="page-in" class="box"> <!-- Content -->
      <div id="content"> <!-- Article -->
         <div class="article">
            <h2><span>Room Details</span></h2>
            <div class="login">
               <form action="./php/room_insert.php" method="post" id="form2">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                        <td>Room Name :</td>
                        <td><input type="text" name="room_name" id="txtName1" />
                        </td>
                     </tr>
                     <tr>
                        <td>Capacity:</td>
                        <td><input type="text" name="capacity" id="txtName2" />
                        </td>
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
                              <div align="center"> <input type="submit" name="button2" id="button2" value="Add" />
                              </div>
                           </label></td>
                     </tr>
                  </table>
               </form>
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