<?php
require_once "../database/database.php";
session_start();

$username=$_SESSION['username'];

$username = mysqli_real_escape_string($conn, $username);

$statement = $conn->prepare('SELECT *
                            FROM user_record
                            WHERE username = ?');
$statement->bind_param('s', $username);
$statement->execute();
$result = $statement->get_result();
$user = $result->fetch_assoc();
$email = $user['email'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>My Profile Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
  </head>
<body>
	<section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">
              <div class="card mb-3" style="border-radius: .5rem;">
                <div class="row g-0">
                  <div class="col-md-4 gradient-custom text-center text-white"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                    <img src="../assets/download.png"
                      alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                    <h5 id="" name="name"><?php echo $username?></h5>
                    <p>Web Designer</p>
                    <i class="far fa-edit mb-5"></i>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body p-4">
                      <h6>Information</h6>
                      <hr class="mt-0 mb-4">
                      <div class="row pt-1">
                        <div class="col-6 mb-3">
                          <h6>Email</h6>
                          <p class="text-muted"><?php echo $email?></p>
                        </div>
                        
                      </div>
                      <h6>Projects</h6>
                      <hr class="mt-0 mb-4">
                      <div class="row pt-1">
                        <div class="col-6 mb-3">
                          <h6>Recent</h6>
                          <p class="text-muted">Lorem ipsum</p>
                        </div>
                        <div class="col-6 mb-3">
                          <h6>Most Viewed</h6>
                          <p class="text-muted">Dolor sit amet</p>
                        </div>
                      </div>
                      <div class="d-flex justify-content-start">
                        <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                        <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                        <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                      </div>
                      <div class="section-button">
                        <form action="../login_page/login_page.php" mathod="GET">
                            <button type="submit" class="btn btn-primary">Log Out</button>
                        </form>
                        <form action="panel.php" mathod="GET">
                            <button type="submit" class="btn btn-primary">Admin panel</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
	
</body>
</html>
