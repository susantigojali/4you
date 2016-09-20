<?php
	$con=mysqli_connect("127.0.0.1","root","","telefood");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$id = $_GET['id'];
	$idresep = $_GET['idresep'];

	$sql2="SELECT * from favorit WHERE id= '".$idresep."' AND id_username='".$id."'";
          $result2 = mysqli_query($con,$sql2);
          $row_cnt2 = mysqli_num_rows($result2);

          echo $row_cnt2;

          if ($row_cnt2 == 0)
		{
			$sql="INSERT INTO favorit (id_username, id) VALUES('".$id."','".$idresep."')";
			  $result = mysqli_query($con,$sql);
			  
		  }
		  else
		  {
		  	$sql="DELETE FROM favorit WHERE id_username='$id' AND id='$idresep'";
			  $result = mysqli_query($con,$sql);
			  
		  }

header("location: resep.php?idresep=".$idresep."&id=".$id."");

?>