<?php
include 'config.php';
if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['Name']);
  $Sname = mysqli_real_escape_string($conn, $_POST['Sname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, ($_POST['password']));
  $cpassword = mysqli_real_escape_string($conn, ($_POST['cpassword']));

  $select_users = mysqli_query($conn, "SELECT * FROM admin_info WHERE email = '$email'") or die('query failed');

  if (mysqli_num_rows($select_users) != 0) {
    $message[] = 'Admin Already exist!';
  } else {
    if ($password != $cpassword) {
      $message[] = 'Confirm password not matched.';
    } else {
      mysqli_query($conn, "INSERT INTO admin_info(`firstname`, `lastname`, `email`, `password`) VALUES('$name','$Sname','$email','$password')") or die('Query failed');
      $message[] = 'Registration Done Successfully';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/registerStyle.css  " />

  <title>Register</title>
  <style>
    .container2 {
      display: flex;
      justify-content: center;
      background-image: linear-gradient(45deg,
          rgba(0, 0, 3, 0.1),
          rgba(0, 0, 0, 0.5)), url(../bgimg/2.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      height: 98vh;
    }

    .container form .link {
      text-decoration: none;
      color: white;
      border-radius: 17px;
      padding: 8px 18px;
      margin: 0px 10px;
      background: rgb(0, 0, 0);
      font-size: 20px;
    }

    .container form .link:hover {
      background: rgb(0, 167, 245);
    }
  </style>
</head>

<body>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '
        <div class="message" id= "messages"><span>' . $message . '</span>
        </div>
        ';
    }
  }
  ?>
  <div class="container">
    <form action="" method="post">
      <h3 style="color:white">Register to Use <a href="index.php"><span style="color:indigo">Grow</span><span style="color:lightgreen">Green</span></a></h3>
      <input type="text" name="Name" placeholder="Enter Firstname" required class="text_field ">
      <input type="text" name="Sname" placeholder="Enter Lastname" required class="text_field">
      <input type="email" name="email" placeholder="Enter Email Id" required class="text_field">
      <input type="password" name="password" placeholder="Enter password" required class="text_field">
      <input type="password" name="cpassword" placeholder="Confirm password" required class="text_field">
      <input type="submit" value="Register" name="submit" class="btn text_field">
      <p>Already have a Account? <br> <a class="link" href="admin_login.php">Login</a><a class="link" href="admin_index.php">Back</a></p>
    </form>
  </div>


  <script>
    setTimeout(() => {
      const box = document.getElementById('messages');
      box.style.display = 'none';
    }, 8000);
  </script>
</body>

</html>