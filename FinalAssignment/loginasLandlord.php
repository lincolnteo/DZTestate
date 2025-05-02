<?php


// database connection
$con = mysqli_connect("localhost", "root", "", "dzt_db");

if (!$con) {
    echo "Connection failed ", mysqli_connect_error();
}

// Get the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // First, we check if they are setted and not empty
    // if is set and not empty
    if(isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["password"])){

        // get input name and password and parse data through the method pass_input()
        $username = pass_input($_POST["username"]);
        $password = pass_input($_POST["password"]);
    
        // then
        // check if the user is existed in our database or not
        // by using php prepared statement logic to keep safe and avoid users' attack
        // check inputed name with username in our table
        $stmt=$con->prepare("SELECT UserName,Password from landlords where UserName=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        
        // get username and password from database
        $stmt->bind_result($dbuserName,$dbpassword);
        $stmt->fetch();
    
        // then check if they are matched or not
        if($username==$dbuserName && $password==$dbpassword)
        {
            // if valid input
            // then start a session
<<<<<<< HEAD
             
             session_start();          
             $_SESSION['Landlordname']=$username;
             $_SESSION['welcome_message'] = "Welcome back $username";
             // back to the tenant logined page
             header('Location:landlordLogined.php');
             exit(); 
            
=======
            session_start();
            $_SESSION['username']=$username;
            // print a welcome message
            echo "<script>alert('Welcome back $username!');</script>";
            // back to the home page
            header('Location:landlordPasswordReset.html');
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb


            //then do something or go any pages for logined landlord
        }
        else{
            // else invalid user name or password
<<<<<<< HEAD
            // then stay the same page let user re-input
            echo "<script>
            alert('Sorry, the name or password is incorrect! Please re-enter......');
            window.location.href = 'login.html';
            </script>"; 
=======
            // print a message
            echo "<script>alert('Sorry the user name or password is incorrect!');</script>";
            //header('Location:login.html');
>>>>>>> 5c1c4024f986f4e484d2afad73437f4534d91dfb
        }
    

    }
    // else username and password are empty
    else{
<<<<<<< HEAD
          // else invalid user name or password
            // then stay the same page let user re-input
            echo "<script>
            alert('Sorry, the name or password is empty!');
            window.location.href = 'login.html';
            </script>"; 
=======
         // print a message say: the name or password shouldn't be empty
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

?>
