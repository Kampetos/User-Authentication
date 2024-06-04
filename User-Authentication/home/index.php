<?php 

  require "../database/functional.php";

  if (!isset($_SESSION["id"])){
    header("location: index.php");
  }

  if (isset($_POST["logout"])){
    logout();
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

  if ( isset($_POST["delete"]) ){
    delete( $_POST['id'] ); //IDK WHY THIS IS ERROR WHILE IT'S NOT ERROR
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