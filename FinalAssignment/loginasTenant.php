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
        $stmt=$con->prepare("SELECT UserName,Password from users where UserName=?");
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
            session_start();
            $_SESSION['username']=$username;
            
            // print a welcome message
            echo "Welcome back $username";
            // back to the home page
            header('Location:tenantPasswordReset.html');

            //then do something or go any pages for logined tenant

        }
        else{
            // else invalid user name or password
            // print a message
            echo "<script>alert('Sorry The user name or password is incorrect!');</script>";
            //header('Location:login.html');
        }
    

    }
    // else username and password are empty
    else{
         // print a message say: the name or password shouldn't be empty
         echo "<script>alert('Sorry, the name or password should not be empty')</script>";
         
         // then back to the sign up page
         //header('Location:SignUp.html');
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

