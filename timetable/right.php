<!-- Right column -->

<div id="col" class="noprint">
  <div id="col-in">



    <!-- Category -->
    <h3>Login</h3>
    <div class="login">
      <form name="form1" method="post" action="./php/login.php">
        <p>
          <?php
          if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
          }
          ?>
        </p>
        <table width="100%">
          <tr>
            <td><strong>User Name</strong></td>
          </tr>
          <tr>
            <td><span id="sprytextfield1">
                <label>
                  <input type="email" name="email" id="txtUser">
                </label>
            </td>
          </tr>
          <tr>
            <td><strong>Password</strong></td>
          </tr>
          <tr>
            <td><span id="sprytextfield2">
                <label>
                  <input type="password" name="password" id="txtPass">
                </label>
          </tr>
          <tr>
            <td><label>
                <div>
                  <input type="submit" name="submit" id="button" value="Login">
                </div>
              </label></td>
          </tr>
        
        </table>
      </form>
    </div>
    <br />


  </div> <!-- /col-in -->
</div> <!-- /col -->