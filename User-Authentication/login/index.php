<?php 

require "../database/functional.php";

if (isset($_POST["Register"])){
  $RESPONREGISTER = register(
    $_POST['Username'], 
    $_POST['Email'], 
    $_POST['Gender'], 
    $_POST['Religion'], 
    $_POST['handphone'], 
    $_POST['Address'], 
    $_POST['Password'], 
    $_POST['Confirm']
  );
}

if (isset($_POST["Login"])){
  $RESPONLOGIN = login(
    $_POST['Email'], 
    $_POST['Password']
  );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>USER AUTHENTICATION</title>
  <link rel="stylesheet" href="../css/style.css">

</head>
<body>

  <div class="container">

    <!-- form design -->
    <div class="containerBackground"></div>

    <div class="verticalLine"></div>

    <!-- Login Form -->
    <div class="column">

      <h1>LOGIN</h1>

        <form action="" method="post">

          <input type="text" name="Email"     id="Email"    placeholder="Email..."    value=""><br><br>

          <input type="text" name="Password"  id="Password" placeholder="Password..." value=""><br><br>

          <button name="Login">LOGIN</button>

        </form>

        <p>forget password? email to admin@gmail.com</p>

        <p class="error"><?= @$RESPONLOGIN; ?></p>

    </div>

    <!-- Register Form -->
    <div class="column">

      <h1>REGISTER</h1>

        <form action="" method="post">

          <input type="text" name="Username"  id="Username"   placeholder="Username..."         value=""><br><br>

          <input type="text" name="Email"     id="Email"      placeholder="Email..."            value=""><br><br>
          
          <select name="Gender" id="Gender">
            <option value="1">Male</option>
            <option value="2">Female</option>
          </select><br><br>

          <select name="Religion" id="Religion">
            <option value="1">Islam</option>
            <option value="2">Christian</option>
            <option value="3">budha</option>
            <option value="4">Catholic</option>
          </select><br><br>

          <input type="text" name="handphone" id="handphone"  placeholder="phone Number..."     value=""><br><br>

          <input type="text" name="Address"   id="Address"    placeholder="Address..."          value=""><br><br>

          <input type="text" name="Password"  id="Password"   placeholder="Password..."         value=""><br><br>

          <input type="text" name="Confirm"   id="Confirm"    placeholder="Confirm Password..." value=""><br><br>

          <button name="Register">Register</button>

        </form>

        <?php 

        if (@$RESPON == "success"){

          ?> 

          <p>you register is Successful</p>

          <?php 

        }else{

          ?>

          <p class="error"><?= @$RESPONREGISTER; ?></p>

          <?php 

        } ?>

    </div>
  </div>

</body>
</html>