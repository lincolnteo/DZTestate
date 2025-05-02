<?php
session_start();

// database connection
$con = mysqli_connect("localhost", "root", "", "dzt_db");

if (!$con) {
    echo "Connection failed ", mysqli_connect_error();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // first check all input shouldn't be empty
    if(isset($_POST['serviceName']) && !empty($_POST['serviceName']) && isset($_POST['userName']) && !empty($_POST['userName']) &&
    isset($_POST['serviceDate']) && !empty($_POST['serviceDate']) &&  isset($_POST['comment']) && !empty($_POST['comment']) ){

        // then store them in variables
        $serviceName = $_POST['serviceName'];
        $userName = pass_input($_POST['userName']);
        $serviceDate = pass_input($_POST['serviceDate']);
        $comment = pass_input($_POST['comment']);
        
        // then check if the user name is matched to the logined name
        if($userName == $_SESSION['Tenantname']){

            // if matched then insert variables to our table: testimonial
            $stmt=$con->prepare("INSERT INTO testimonials(UserName,ServiceName,Date,Comment) VALUES(?,?,?,?)");
            $stmt->bind_param("ssss",$userName,$serviceName,$serviceDate,$comment);
            $result=$stmt->execute();

            if($result){  
                
            echo "<script>
            alert('The testimonial has been submitted successfully');
            window.location.href = 'TenantLogined.php';
            </script>";

            }
            else {
                echo "Error submitting testimonial: " . $stmt->error;
            }
            $stmt->close();
        }
        else{
            // print the user name is not same as logined name
           
            echo "<script>
            alert('Sorry, the username is not matched to logined name');
            window.location.href = 'TenantLogined.php';
            </script>";
        }
    }
    else{
        //print out a message and stay in the page
        echo "<script>
        alert('Sorry, the name or password or comment should not be empty');
        window.location.href = 'TenantLogined.php';
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

