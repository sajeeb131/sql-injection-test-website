<?php

require_once "../database/database.php";

session_start();

$username=$_SESSION['username'];
echo $username;
$username = mysqli_real_escape_string($conn, $username);

$statement = $conn->prepare('SELECT *
                            FROM user_record
                            WHERE username = ?');
$statement->bind_param('s', $username);
$statement->execute();
$result = $statement->get_result();
$user = $result->fetch_assoc();
$email = $user['email'];

// Update data in the database
// $update = "UPDATE user_record SET block_status='blocked'";

// if (mysqli_query($conn, $sql)) {
//     echo "Record updated successfully";
// } else {
//     echo "Error updating record: " . mysqli_error($conn);
// }


$sql = " INSERT INTO blocklist (username,email) VALUES('$username','$email') ";
if (mysqli_query($conn, $sql)) {
    header('Location: Admin.php');
            exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>