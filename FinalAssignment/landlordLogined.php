<!DOCTYPE html>
<?php
    // print a welcome back message to the user
    session_start();
    if (isset($_SESSION['welcome_message'])) {
      echo "<script>alert('" . $_SESSION['welcome_message'] . "');</script>";
      unset($_SESSION['welcome_message']);
    }
?>
<html lang="en">
    <head>
      <title>House Appliance Inventory</title>  <!---->     
      <link rel="stylesheet" href="signup.css"> 
    </head>
    <style>
        /*set the form no display*/
        body #PasswordResetForm{
          display: none;
        }
       
    </style>
    <body>
      <!--a header with our logo and a navigation: griffith college logo, three links -->
      <div class="header1">
          <!--logo-->
          <img src="images/logo.png" alt="Logo" class="logo">
          <div class="footer"> 
            <!--griffith college logo-->
            <a href="https://www.griffith.ie/"><img src="images/GriffithLogo.jpg" height="100" alt="griffithlogo" class="griffithlogo"></a><!--griffith logo with website-->
            <ul><!--navigation-->
                <li><a href="">About Us</a></li> <!--link to another page to description of us-->
                <li><a href="mailto:longkaiz0324@gmail.com">Contact Us</a></li><!--send email to me--> 
                <li><a href="Home.php">Back to Home</a></li><!--back to Home page-->
            </ul>
        </div>
      </div>
        <!--after click the button show the form-->
        <button type="button" id="resetTenant" onclick="document.getElementById('PasswordResetForm').style.display = 'block';
        ">Reset Landlord Password</button>
        
        <div id="PasswordResetForm">
            <form method="POST" name="f1">
              <h3>Password Reset:</h3>
              <table border="1">
                <!--enter name, existed password, new password, and confirm new password-->
                  <tr><td>Enter user name: </td><td><input type="text" name="username"></td></tr>
                  <tr><td>Enter current password:</td><td><input type="password" name="currentPassword" ></td></tr>
                  <tr><td>Enter new password:</td><td><input type="password" name="newPassword"></td></tr>
                  <tr><td>Confirm new password:</td><td><input type="password" name="confirmNewPassword"></td></tr>
                  <tr><td><input type="submit" value="reset"  id="reset" onclick="f1.action='resetLandLordPassword.php'"></td></tr>              
              </table>
            </form>
          </div>

            <!--once click the button then display the testimonial function-->
            <button type="button" id="PropertyList">Add Your propery</button>

        <!--Log out function-->
        <form action="logoutLandlord.php" method="POST">
            <input type="submit" value="Logout">
        </form>

    </body>
</html>