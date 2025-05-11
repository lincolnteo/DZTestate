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
            session_start();
            $_SESSION['username'] = $username;        
            $_SESSION['Landlordname']=$username;
            $_SESSION['is_landlord'] = 1; // Set the session variable to indicate landlord status
            $_SESSION['welcome_message'] = "Welcome back $username";
            $stmt->close();
            // Fetch the LandlordID from the database
            $stmt = $con->prepare("SELECT ID FROM landlords WHERE UserName = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($landlordID);
            $stmt->fetch();
            $_SESSION['landlord_id'] = $landlordID; // Store the LandlordID in the session
            $stmt->close();
            // back to the tenant logined page
            header('Location:LandlordLogined.php');
            exit();   
            
        }
        else{
           // else invalid user name or password
            // then stay the same page let user re-input
            echo "<script>
            alert('Sorry, the name or password is incorrect! Please re-enter......');
            window.location.href = 'Login.html';
            </script>"; 
        }
    

    }
    // else username and password are empty
    else{
          // print a message say: the name or password shouldn't be empty
        // then stay the same page let user re-input
        echo "<script>
        alert('Sorry, the name or password should not be empty');
        window.location.href = 'Login.html';
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
