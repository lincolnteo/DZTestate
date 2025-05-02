<?php
<<<<<<< HEAD
session_start(); 
=======
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
// database connection
$con = mysqli_connect("localhost", "root", "", "dzt_db");

if (!$con) {
    echo "Connection failed ", mysqli_connect_error();
}

// Get the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     // First, we check data if they are setted and not empty
    // if is set and not empty
    if(isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["currentPassword"]) && !empty($_POST["currentPassword"])
       && isset($_POST["newPassword"]) && !empty($_POST["newPassword"]) && isset($_POST["confirmNewPassword"]) && !empty($_POST["confirmNewPassword"])){

        // then check the new password and confirmed password must be same
        if($_POST["newPassword"] == $_POST["confirmNewPassword"]){

            // get input name and password and parse data through the method pass_input()
            $username = pass_input($_POST["username"]);
            $currentpassword = pass_input($_POST["currentPassword"]);
            $newPassword = pass_input($_POST["newPassword"]);
   
            // then
            // check if the user is existed in our database or not
            // by using php prepared statement logic to keep safe and avoid users' attack
            // check inputed name with username in our table: users
            $stmt=$con->prepare("SELECT UserName,Password from users where UserName=?");
            $stmt->bind_param("s",$username);
            $stmt->execute();
            
            // get username and password from database
            $stmt->bind_result($dbuserName,$dbpassword);
            $stmt->fetch();
            
            // then check if they are matched or not
            if($username==$dbuserName && $currentpassword==$dbpassword)
            {
                    // it belongs to table: users

                    $stmt->close();
                    // then update the password in table: users
                    $stmt = $con->prepare("UPDATE users SET Password = ? WHERE UserName = ?");
                    if (!$stmt) {
                        die("Prepare failed: " . $con->error);
                    }
            
                    $stmt->bind_param("ss", $newPassword, $username);
                    if ($stmt->execute()) {
<<<<<<< HEAD
                        session_start();   
                        // print a message say: password has been updated successfully    
                        echo "<script>
                        alert('Your password has been updated successfully!');
                        window.location.href = 'tenantLogined.php';
                        </script>";
=======
                        echo "Password updated successfully.";
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
                    } else {
                        echo "Error updating password: " . $stmt->error;
                    }
                    $stmt->close();
                
               
            }
         
            // not match any information in two tables
            else{
            
<<<<<<< HEAD
                // print a message say: the name or current password you entered is invalid!      
                echo "<script>
                alert('Sorry, the name or current password you entered is invalid! ');
                window.location.href = 'tenantLogined.php';
                </script>";
=======
                // print a message say: the name or password shouldn't be empty        
                echo "<script>alert('Sorry, the name or current password you entered is invalid!')</script>";        
                // then back to the sign up page        
                //header('Location:SignUp.html');
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
         
            }
        }
        else{
<<<<<<< HEAD
            // print a message say: the new password and confirmed password is difference
         // then stay the same page let user re-input
         echo "<script>
         alert('Sorry, the new password and confirmed password is difference!');
         window.location.href = 'tenantLogined.php';
         </script>";
=======
            // print a message say: the name or password shouldn't be empty
         echo "<script>alert('Sorry, the new password and confirmed password is difference!')</script>";
         
         // then back to the sign up page
         //header('Location:SignUp.html');
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
        }
     

    }
    // if one of them is empty
    else{
         // print a message say: the name or password shouldn't be empty
<<<<<<< HEAD
         // then stay the same page let user re-input
         echo "<script>
         alert('Sorry, the name or password should not be empty');
         window.location.href = 'tenantLogined.php';
         </script>";
=======
         echo "<script>alert('Sorry, the name or password should not be empty')</script>";
         
         // then back to the sign up page
         //header('Location:SignUp.html');
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
    }
}

//function pass_input() to sanitize and validate the XSS attacks
function pass_input($data){
    $data = trim($data);// trim remove unneeded space
    $data = stripcslashes($data);
    $data = strip_tags($data);// remove html elment
    return $data;// return validated data value
}


$con->close();
?>