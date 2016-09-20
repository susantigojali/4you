<?php

  $ID = $_POST['ID'];
  $Email = $_POST['Email'];
  $Password = $_POST['Password'];

  $con=mysqli_connect("127.0.0.1","root","","telefood");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $result = mysqli_query($con,"SELECT * FROM user WHERE username=\"".$ID."\";" );
  $row_cnt = mysqli_num_rows($result);
  echo "row count : ".$row_cnt;

  if ($row_cnt > 0)
  {
    echo "Username sudah ada";
  }
  else
  {
    mysqli_query($con, "INSERT INTO user (username, email, password) VALUES ('$ID','$Email','$Password')");
    echo "<h1>Signup Success</h1>";
  }  

  header("location: index.php?id=0");  
?>