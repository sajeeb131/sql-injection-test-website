<?php

session_start();
$username=$_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        /* Style for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>User List</h1>

    <?php
    // Establish a database connection
    require_once "../database/database.php";

    // Fetch user data from the database
    $sql = 'SELECT * FROM accounting';
    $result = mysqli_query($conn, $sql);

    $sql = 'SELECT * FROM user_record';
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    // Display user data in an HTML table
    echo '<table>';
    echo '<tr><th>username</th><th>email</th><th>time</th><th>block user</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['time'] . '</td>';
        echo '<td>';
        echo '<form action="delete.php" method="post">';
        echo '<button type="submit">block</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    

    echo '</table>';

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>

