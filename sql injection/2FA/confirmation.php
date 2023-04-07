<?php
require_once "../database/database.php"; 
session_start();

$username= $_SESSION['username']; //get userID
$username = mysqli_real_escape_string($conn, $username);




if($_SERVER['REQUEST_METHOD']==="POST"){
    //get userID and check validation
    $a=$_POST['a'];
    $b=$_POST['b'];
    $c=$_POST['c'];
    $d=$_POST['d'];
    $_code = $a.$b.$c.$d;

    $statement = $conn->prepare('SELECT *
                        FROM user_record
                        WHERE username = ?');
    $statement->bind_param('s', $username);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();
    $otp = $user['OTP'];
    $email=$user['email'];
    $time = date("h:i:sa"). " " . date("Y/m/d");

    $email = mysqli_real_escape_string($conn, $email);
    $time = mysqli_real_escape_string($conn, $time);

    $_SESSION['username']=$username;

    if($_code==$otp){

        $sql = " INSERT INTO accounting (username,email,time) VALUES('$username','$email', '$time') ";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        if($username=='admin'){
            header('location: ../home/Admin.php');
            exit;
        }else{
            header('location: ../home/home.php');
            exit;
        }
        
    }
    header('location: OTP.php');
    exit;
    
    
    
   

}

?>
