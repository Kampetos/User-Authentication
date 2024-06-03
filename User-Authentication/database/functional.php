<?php 
  // call database
  require "databaseConfig.php";

  function connect(){
      $mysqli = new mysqli( constant('SERVER'), constant('USERNAME'), constant('PASSWORD'), constant('DATABASE') );

      if ($mysqli -> connect_errno != 0) {
          $getErrorDate = date("d-M-Y");
          $error = $mysqli -> connect_error;
          $Message = " { $error } | { $getErrorDate } \r\n ";
          file_put_contents( "log.txt", $Message, FILE_APPEND );
          return false;
        }else{
          return $mysqli;
        }
  }

  function register( $Username , $Email, $religion, $gender, $phone, $address, $Password, $CofirmPassword ){

    //configuration
    $mysqli = connect();

    //field empty check
    $array = [ $Username , $Email, $religion, $gender, $phone, $address, $Password, $CofirmPassword ];
    foreach($array as $value){
      if (empty($value)){
        return "All Field are Required";
      }
    }

    //Email
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
      return "email not valid";
    }

    $Stat = $mysqli->prepare(" SELECT `email` FROM user WHERE `email`= ? ");
    $Stat->bind_param("s",$email);
    $Stat->execute();
    $result = $Stat->get_result();
    $data = $result->fetch_assoc();

    if ($data != NULL){
      return "Email already exists. Please use another email!";
    }

    //Username
    $Stat = $mysqli->prepare(" SELECT `username` FROM user WHERE `username` = ? ");
    $Stat->bind_param("s",$Username);
    $Stat->execute();
    $result = $Stat->get_result();
    $data = $result->fetch_assoc();

    if ($data != NULL){
      return "Username already exists. Please use another Username!";
    }

    if (strlen($Username) > 25){
      return "username is way too long";
    }

    //Password
    if($Password != $CofirmPassword){
      return "Password Doesn't Match";
    }

    $securing = password_hash($Password, PASSWORD_BCRYPT);

    //INSERT 
    $Stat = $mysqli->prepare(" INSERT INTO user ( `username`, `password`, `email`, `religion`, `gender`, `phoneNumber`, `address` ) VALUE( ?, ?, ?, ?, ?, ?, ? ) ");
    $Stat->bind_param("sssssss", $Username, $securing, $Email, $religion, $gender, $phone, $address );
    $Stat->execute();
    if ($Stat->affected_rows != 1){
      return "Oops... Something Error";
    }else{
      return "success";
    }
  }

  function login($Email, $Password){
    //configure
    $mysqli = connect();

    //check field empty
    if ($Email == "" || $Password == ""){
      return "Both Field are required";
    }

    //login with email and password
    $Stat = $mysqli->prepare(" SELECT `id`, `username`, `password`, `email`, `religion`, `gender`, `phoneNumber`, `address` FROM user WHERE `email` = ? ");
    $Stat->bind_param("s",$Email);
    $Stat->execute();
    $Stat->bind_result($id, $username, $storedPassword, $email, $religion, $gender, $handphone, $address);
  
    if ($Stat->fetch()){
      if (password_verify($Password, $storedPassword)){
        $_SESSION['id']         = $id;
        $_SESSION['username']   = $username;
        $_SESSION['email']      = $email;
        $_SESSION['religion']   = $religion;
        $_SESSION['gender']     = $gender;
        $_SESSION['handphone']  = $handphone;
        $_SESSION['address']    = $address;

        header("location: ../home/index.php");
        exit();

      }else{
        return "opss.. your email or password is wrong";
      }

    }else{
      return "opss.. your email or password is wrong";
    }
  }

  function update($id, $Username, $Email, $religion, $gender, $phone, $address){
    //configuration
    $mysqli = connect();

    //field empty check
    $array = [$id, $Username, $Email, $religion, $gender, $phone, $address ];
    foreach($array as $value){
      if (empty($value)){
        return "All Field are Required";
      }
    }

    //Email
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
      return "email not valid";
    }

    $Stat = $mysqli->prepare(" SELECT `email` FROM user WHERE `email`= ? ");
    $Stat->bind_param("s",$email);
    $Stat->execute();
    $result = $Stat->get_result();
    $data = $result->fetch_assoc();

    if ($data != NULL){
      return "Email already exists. Please use another email!";
    }

    //Username
    $Stat = $mysqli->prepare(" SELECT `username` FROM user WHERE `username` = ? ");
    $Stat->bind_param("s",$Username);
    $Stat->execute();
    $result = $Stat->get_result();
    $data = $result->fetch_assoc();

    if ($data != NULL && $data == $Username){
      return "Username already exists. Please use another Username!";
    }

    if (strlen($Username) > 25){
      return "username is way too long";
    }

    //UPDATE 
    $Stat = $mysqli->prepare(" UPDATE user SET 
            `username`='$Username', 
            `email`='$Email', 
            `religion`='$religion', 
            `gender`='$gender', 
            `phoneNumber`='$phone', 
            `address`='$address' 
            WHERE `id`= ?
            ");
    $Stat->bind_param("s", $id );
    $Stat->execute();

    if (!$Stat){
      return "woops, something when wrong...";
    }else{
      $_SESSION['id']         = $id;
      $_SESSION['username']   = $Username;
      $_SESSION['email']      = $Email;
      $_SESSION['religion']   = $religion;
      $_SESSION['gender']     = $gender;
      $_SESSION['handphone']  = $phone;
      $_SESSION['address']    = $address;
      header("location: index.php");
    }

  }

  function delete( $id ){

    //configuration
    $mysqli = connect();

    //DELETE ACCOUNT
    $Stat = $mysqli->prepare("DELETE FROM `user` WHERE id= ? ");
    $Stat->bind_param("s", $id );
    $Stat->execute();

    if (!$Stat){
      return " oops something when wrong ";
    }else{
      session_destroy();
      header('location: ../index.php');
      exit();
    }
  }

  function logout(){

    //delete value
    session_destroy();

    //back to login page
    header('location: ../index.php');
    exit();
  }

  function selected(array $arr, $check){
    $array = $arr;
      foreach($array as $id => $data ){
        $ids = $id + 1;
        if ($ids == $check){
          echo "<option value='$ids' selected>$data</option>";
        }else{
          echo "<option value='$ids'>$data</option>";
        }
      }
  }