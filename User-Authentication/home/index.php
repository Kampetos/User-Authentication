<?php 

  require "../database/functional.php";

  if (!isset($_SESSION["id"])){
    header("location: index.php");
  }

  if (isset($_POST["logout"])){
    logout();
  }

  if ( isset($_POST["delete"]) ){
    delete( $_POST['id'] ); //idk why this error while it's not ( already think and search for 5 hours )
  }

  if (isset($_POST["update"])){
    $RESPONUPDATE = update(
      $_SESSION['id'], 
      $_POST['Username'], 
      $_POST['Email'], 
      $_POST['Religion'], 
      $_POST['Gender'], 
      $_POST['Handphone'], 
      $_POST['Address']
    );
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login register</title>
  <style>

    body{
      margin: 0;
      background-color: black;
    }

    .container{
      position: fixed;
      width: 75%;
      height: 550px;
      margin: 0 auto;
      top: 50%;
      left: 50%;
      transform: translate( -50%, -50% );
      text-align: center;
    }

    .column{
      width: 50%;
      float: left;
    }

    .verticalLine{
      margin: 0 auto;
      height: 90%;
      border-left: 3px solid white;
      position: absolute;
      left: 50%;
      top: 5%;
    }

    input, button, select{
      width: 75%;
      height: 32px;
      border-radius: 32px;
      border: 0;
    }

    .error{
      color: red;
      text-shadow: 2px 2px white;
    }
    button{
      cursor: pointer;
    }

    .containerBackground{
      position: absolute;
      z-index: -1;
      background-color: white;
      border-radius: 32px;
      opacity: 0.8;
      width: 100%;
      height: 100%;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="containerBackground"></div>

      <h1>Welcome <?= $_SESSION['username'] ?></h1>

      <?php 
      if (!isset($_GET['page'])){
      ?>
      <a href="?page=update"><button>UPDATE</button></a><br><br>
      <a href="?page=delete"><button>DELETE</button></a><br><br>
      <?php 
    }else{
      switch($_GET['page']){
        case 'update':
          include "update.php";
        break;
        case 'delete':
          include "delete.php";
        break;
      }
    }
    ?>
      <form action="" method="post">
        <button name="logout" id="logout">LOGOUT</button>
    </form>
  </div>
    
</body>
</html>