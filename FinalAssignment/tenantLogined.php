<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION['welcome_message'])) {
      echo "<script>alert('" . $_SESSION['welcome_message'] . "');</script>";
      unset($_SESSION['welcome_message']);
    }
?>
<html lang="en">
    <head>
      <title>Tenant</title>  <!---->     
      <link rel="stylesheet" href="signup.css"> 
    </head>
    <style>
        /*set not display the form*/
        body #PasswordResetForm{
          display: none;
        }
        body #testimonialForm{
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
        <!--once click the button then display the form-->
        <button type="button" id="resetTenant" onclick="document.getElementById('PasswordResetForm').style.display = 'block';
        ">Reset Tenant Password</button>
        
        <div id="PasswordResetForm">
            <form method="POST" name="f1">
              <h3>Password Reset:</h3>
              <table border="1">
                <!--enter name, existed password, new password, and confirm new password-->
                  <tr><td>Enter user name: </td><td><input type="text" name="username"></td></tr>
                  <tr><td>Enter current password:</td><td><input type="password" name="currentPassword" ></td></tr>
                  <tr><td>Enter new password:</td><td><input type="password" name="newPassword"></td></tr>
                  <tr><td>Confirm new password:</td><td><input type="password" name="confirmNewPassword"></td></tr>
                  <tr><td><input type="submit" value="Reset"  id="Reset" onclick="f1.action='resetTenantPassword.php'"></td></tr>              
              </table>
            </form>
          </div>

           <!--once click the button then display the testimonial function-->
          <button type="button" id="testimonial" onclick="document.getElementById('testimonialForm').style.display = 'block';
          ">Write Testimonial:</button>
          
          <div id="testimonialForm">
            <form method="POST" name="f2">
              <h3>Testimonial:</h3>
              <table border="1">
                <!--enter name, existed password, new password, and confirm new password-->
                  <tr><td>Enter service name: </td><td><input type="text" name="serviceName"></td></tr>
                  <tr><td>Enter user name:</td><td><input type="text" name="userName" ></td></tr>
                  <tr><td>Service Date:</td><td><input type="date" name="serviceDate" id="serviceDate"></td></tr>  
                 <!--script function to select purchase date only today or before today-->
                 <script>
                    // Get today's date in YYYY-MM-DD format
                    const serviceDate = document.getElementById("serviceDate");
                    // setting date format:YYYY-MM-DD
                    const today = new Date().toISOString().split("T")[0]; 
                    // Set the max date to today
                    serviceDate.max = today; 
                </script>
                  <tr><td>Add comment: </td><td>
                  <textarea name="comment" rows="10" cols="20"></textarea>
                  <tr><td><input type="submit" value="Submit Testimonial"  id="SubmitTestimonial" onclick="f2.action='testimonial.php'"></td></tr>              
              </table>
            </form>
          </div>

        <!--Log out function-->
        <form action="logoutTenant.php" method="POST">
        <input type="submit" value="Logout">
</form>
    </body>
</html>