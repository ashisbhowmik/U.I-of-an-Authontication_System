<?php

  $showAlert = false;
  $showError1 = false;
  $showError2 = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include "components/_dbconnect.php";
    $username = $_POST["name"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existsSql = "SELECT * FROM `users` WHERE `users`.`name`='$username'";
    $result1 = mysqli_query($conn, $existsSql);
    $numExistsRows = mysqli_num_rows($result1);
    if ($numExistsRows > 0) {
      // $showError = "Username already exists";
      $showError1 = true;
    }
    else{
      if ($password == $cpassword){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
            // header("location: login.php");
          }
      }
     else{
    //  $showError = "Password do not match, Please enter same password";
       $showError2 = true;

     }
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

    <title>SignUp Here</title>
</head>

<body>
    <?php require "components/_nav.php";  ?>

    <?php
     
     if ($showAlert) {
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success !</strong> Your account has been created! Please login with the password and username
         <button
           type="button"
           class="btn-close"
           data-bs-dismiss="alert"
           aria-label="Close"
         ></button>
       </div>';
     }
     ?>

    <?php

     if ($showError1) {
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Error! </strong> Username Already Exists!
         <button
           type="button"
           class="btn-close"
           data-bs-dismiss="alert"
           aria-label="Close"
         ></button>
       </div>';
     }
     if ($showError2) {
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Error! </strong> Password do not match! Please enter same password
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
        <h2 class="text-center">Please Create an account first Before Start</h2>
        <form action="/loginsystem/signup.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">UserName</label>
                <input type="text" maxlength=19 class="form-control" id="name" name="name"
                    placeholder="Choose your name here" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Type your password" />
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Comfirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword"
                    placeholder="confirm your password" />
            </div>

            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
</body>

</html>