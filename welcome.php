<?php

  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true) {
    header("location: login.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0"
      crossorigin="anonymous"
    />

    <title>Welcome, <?php echo $_SESSION['username']; ?></title>
  </head>
  <body>
    <?php     
        require "components/_nav.php";
    ?>

    <div class="container my-5">
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">
            <?php
            echo "Welcome, ".$_SESSION['username'];?>
        </h4>
        <p>
          Welcome to our simple Website, you have successfully logged in. Now
          enjoy our website..
        </p>

        <p class="mb-0">Logged out whenever you want</p>
        <hr />
        <a href="/loginsystem/logout.php">Logout</a>

      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
