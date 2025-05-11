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
         
        // hashing password
        $hashedpassword=password_hash($password,PASSWORD_DEFAULT);

        // then
        // check if the user is already existed in our database or not
        // by using php prepared statement logic to keep safe and avoid users' attack
        // check inputed name with username in our table
        $stmt1 = $con->prepare("SELECT * from landlords where UserName=?");
        $stmt1->bind_param("s",$username);
        $stmt1->execute();
        $result=$stmt1->get_result();
        // if username is found 
        if($result->num_rows>0)
        {
            // print a message say: user already exists
         // then stay the same page let user re-input
         echo "<script>
         alert('Sorry, user already exists! Please choose another name');
         window.location.href = 'Signup.html';
         </script>"; 
        
        }
        // else insert this user to our database
        else{
            $stmt=$con->prepare("INSERT INTO landlords(UserName,Password) VALUES(?,?)");
            $stmt->bind_param("ss",$username,$password);
            $result=$stmt->execute();
            if($result)
            {   
                /// then start a session
                session_start();
                $_SESSION['Landlordname']=$username;

                 // then using java script to print an alert welcome message and then jump back to home page
                 echo "<script>
                 alert('Welcome " . $_SESSION['Landlordname'] . " You have signed up successfully, Now you can login to do more operations');
                 window.location.href = 'Home.php';
                 </script>";
            }
            else {
                echo "Error updating password: " . $stmt->error;
            }
            $stmt->close();
        }
        $stmt1->close();

    }
    // else username and password are empty
    else{
         // print a message say: the name or password shouldn't be empty
         // then stay the same page let user re-input
         echo "<script>
         alert('Sorry, the name or password should not be empty');
         window.location.href = 'Signup.html';
         </script>"; 
        
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