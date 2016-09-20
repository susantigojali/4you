<?php

  $ID = $_POST['ID'];
  $Password = $_POST['Password'];
  $ID_num=0;

  echo $ID." ".$Password;

  $host = "db4free.net:3306/telefood";
  $user = "teletubis";
  $pass = "teletubis";
  $database = "telefood";

  $con=mysqli_connect("127.0.0.1","root","","telefood");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $result = mysqli_query($con,"SELECT * FROM user WHERE username=\"".$ID."\";" );
  $row_cnt = mysqli_num_rows($result);
  if ($row_cnt == 0)
  {
    echo "Login error";
  }
  else
  {
    $row = mysqli_fetch_array($result);
    $usernameDB=$row['username'];
    $passwordDB=$row['password'];
    if($ID==$usernameDB && $Password==$passwordDB)
    {
      echo "login success";
      $ID_num=$row['id_user'];
    }
    else
    {
      echo "invalid password";
    }
   
  }  

header("location: index.php?id=".$ID_num);
  
  
?>