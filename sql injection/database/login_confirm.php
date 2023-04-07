<?php 
session_start();

require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Get username and check validation
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $statement = $conn->prepare('SELECT *
                                 FROM user_record
                                 WHERE username = ?');
    $statement->bind_param('s', $username);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();

    if (empty($user)) {
        header('Location: ../login_page/login_page.php');
        exit;
    } else {
        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header('Location: ../2FA/generate.php');
            exit;
        } else {
            header('Location: ../login_page/login_page.php');
            exit;
        }
    }
}

