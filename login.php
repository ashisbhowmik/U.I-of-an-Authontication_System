<?php

  $login = false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    include "components/_dbconnect.php";
    $username = $_POST["name"];
    $password = $_POST["password"];

    // $sql  = "SELECT * FROM `users` WHERE `users`.`name` ='$username' AND `users`.`password`='$password'";
    $sql  = "SELECT * FROM `users` WHERE `users`.`name` ='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
              $login = true;
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $username;
              header("location: welcome.php");
            }
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Alert !</strong> Invalid Credentials!! Password do not match correctly
         <button
           type="button"
           class="btn-close"
           data-bs-dismiss="alert"
           aria-label="Close"
         ></button>
       </div>';
            }
      }
    
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Alert !</strong> Invalid Credentials!
         <button
           type="button"
           class="btn-close"
           data-bs-dismiss="alert"
           aria-label="Close"
         ></button>
       </div>';
    }
    
   

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous" />

    <title>Login Here</title>
</head>

<body>
    <?php require "components/_nav.php";  ?>

    <?php
     
     if ($login) {
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success !</strong> Your have been logged In. welcome to your account!
         <button
           type="button"
           class="btn-close"
           data-bs-dismiss="alert"
           aria-label="Close"
         ></button>
       </div>';
     }
  
?>



    <div class="container my-5">
        <h2 class="text-center">Please Login with the username and password</h2>
        <form action="/loginsystem/login.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">UserName</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Choose your name here" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Type your password" />
            </div>
            <button type="submit" class="btn btn-primary">LogIn</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
</body>

</html>