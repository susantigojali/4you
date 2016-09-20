<?php
	$con=mysqli_connect("127.0.0.1","root","","telefood");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$BAHAN = $_GET['bahan'];
	$ALERGI = $_GET['alergi'];
	$PENYAKIT = $_GET['penyakit'];

	echo "<br><div class=\"recommendation\"><font face=\"Monotype Corsiva\" color=\"black\"><centre> Rekomendasi </centre></div></font><hr>";

	if($BAHAN==NULL && $ALERGI==NULL && $PENYAKIT==NULL)
	{
		$result = mysqli_query($con,"SELECT * FROM resep");
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt > 0)
		{
			while($row = mysqli_fetch_array($result)) {
				echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><a href=\"resep.php?idresep=".$row['id']."&id=".$_GET['id']."\">".$row['masakan']."</a></font></div></h3></td>";
				echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";			
			}
		}
		else
		{
			echo "Maaf, kami tidak bisa merekomendasikan makanan ke Anda.";
		}
	}
	else if($BAHAN!=NULL && $ALERGI==NULL && $PENYAKIT==NULL)
	{
		$array_bahan = explode(",", $BAHAN);

		$query = "SELECT * from RESEP WHERE ";
		for ($i = 0; $i < count($array_bahan)-1; $i++) {
		    $query = $query."bahan like '%".$array_bahan[$i]."%' AND "; 
		}
		$query = $query."bahan like '%".$array_bahan[count($array_bahan)-1]."%'";
		$result = mysqli_query($con,$query);
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt > 0)
		{
			while($row = mysqli_fetch_array($result)) {
				echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><font face=\"Times New Roman\"><a href=\"resep.php?idresep=".$row['id']."&id=".$_GET['id']."\">".$row['masakan']."</a></font></div></h3></td>";
				echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";			
			}
		}
		else
		{
			echo "Maaf, kami tidak bisa merekomendasikan makanan ke Anda.";
		}

	}
	else if($BAHAN==NULL && $ALERGI!=NULL && $PENYAKIT==NULL)
	{

		$array_alergi = explode(",", $ALERGI);

		$query = "SELECT * from RESEP WHERE ";
		for ($i = 0; $i < count($array_alergi)-1; $i++) {
		    $query = $query."bahan NOT like '%".$array_alergi[$i]."%' AND "; 
		}
		$query = $query."bahan NOT like '%".$array_alergi[count($array_alergi)-1]."%'";
		$result = mysqli_query($con,$query);
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt > 0)
		{
			while($row = mysqli_fetch_array($result)) {
				echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><font face=\"Times New Roman\"><a href=\"resep.php?idresep=".$row['id']."&id=".$_GET['id']."\">".$row['masakan']."</a></font></div></h3></td>";
				echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";			
			}
		}
		else
		{
			echo "Maaf, kami tidak bisa merekomendasikan makanan ke Anda.";
		}

	}
	else if($BAHAN==NULL && $ALERGI==NULL && $PENYAKIT!=NULL)
	{

		$array_penyakit = explode(",", $PENYAKIT);
		$list_pantangan="";
		for ($i = 0; $i < count($array_penyakit)-1; $i++) {
		    $query = "SELECT pantangan from penyakit WHERE nama_penyakit='". $PENYAKIT[$i]."'";
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_array($result);
			$list_pantangan=$list_pantangan."," .$row['penyakit'];
		}
		$query = "SELECT pantangan from penyakit WHERE nama_penyakit='". $PENYAKIT[count($array_penyakit)-1]."'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$list_pantangan=$list_pantangan.",".$row['penyakit'];

		//ubah string ke array
		$array_pantangan = explode(",", $list_pantangan);

		$query = "SELECT * from RESEP WHERE ";
		for ($i = 0; $i < count($array_pantangan)-1; $i++) {
		    $query = $query."bahan NOT like '%".$array_pantangan[$i]."%' AND "; 
		}
		$query = $query."bahan NOT like '%".$array_pantangan[count($array_pantangan)-1]."%'";
		$result = mysqli_query($con,$query);

		$row_cnt = mysqli_num_rows($result);
		if($row_cnt > 0)
		{
			while($row = mysqli_fetch_array($result)) {
				echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><font face=\"Times New Roman\"><a href=\"resep.php?idresep=".$row['id']."&id=".$_GET['id']."\">".$row['masakan']."</a></font></div></h3></td>";
				echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";			
			}
		}
		else
		{
			echo "Maaf, kami tidak bisa merekomendasikan makanan ke Anda.";
		}
		
	}
	else if($BAHAN!=NULL && $ALERGI!=NULL && $PENYAKIT==NULL)
	{

		$array_bahan = explode(",", $BAHAN);
		$query = "SELECT * from RESEP WHERE ";
		for ($i = 0; $i <= count($array_bahan)-1; $i++) {
		    $query = $query."bahan like '%".$array_bahan[$i]."%' AND "; 
		}
		
		$array_alergi = explode(",", $ALERGI);
		for ($i = 0; $i < count($array_alergi)-1; $i++) {
		    $query = $query."bahan NOT like '%".$array_alergi[$i]."%' AND "; 
		}
		$query = $query."bahan NOT like '%".$array_alergi[count($array_alergi)-1]."%'";

		$result = mysqli_query($con,$query);
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt > 0)
		{
			while($row = mysqli_fetch_array($result)) {
				echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><font face=\"Times New Roman\"><a href=\"resep.php?idresep=".$row['id']."&id=".$_GET['id']."\">".$row['masakan']."</a></font></div></h3></td>";
				echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";			
			}
		}
		else
		{
			echo "Maaf, kami tidak bisa merekomendasikan makanan ke Anda.";
		}

	}
	else if($BAHAN!=NULL && $ALERGI==NULL && $PENYAKIT!=NULL)
	{

		$array_penyakit = explode(",", $PENYAKIT);
		$list_pantangan="";
		for ($i = 0; $i < count($array_penyakit)-1; $i++) {
		    $query = "SELECT pantangan from penyakit WHERE nama_penyakit='". $PENYAKIT[$i]."'";
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_array($result);
			$list_pantangan=$list_pantangan."," .$row['penyakit'];
		}
		$query = "SELECT pantangan from penyakit WHERE nama_penyakit='". $PENYAKIT[count($array_penyakit)-1]."'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$list_pantangan=$list_pantangan.",".$row['penyakit'];

		//ubah string ke array
		$array_pantangan = explode(",", $list_pantangan);

		$query = "SELECT * from RESEP WHERE ";
		for ($i = 0; $i <= count($array_pantangan)-1; $i++) {
		    $query = $query."bahan NOT like '%".$array_pantangan[$i]."%' AND "; 
		}

		$array_bahan = explode(",", $BAHAN);
		for ($i = 0; $i <= count($array_bahan)-1; $i++) {
		    $query = $query."bahan like '%".$array_bahan[$i]."%' AND "; 
		}
		$query = $query."bahan like '%".$array_bahan[count($array_bahan)-1]."%'";

		$result = mysqli_query($con,$query);
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt > 0)
		{
			while($row = mysqli_fetch_array($result)) {
				echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><font face=\"Times New Roman\"><a href=\"resep.php?idresep=".$row['id']."&id=".$_GET['id']."\">".$row['masakan']."</a></font></div></h3></td>";
				echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";			
			}
		}
		else
		{
			echo "Maaf, kami tidak bisa merekomendasikan makanan ke Anda.";
		}

	}
	else if($BAHAN==NULL && $ALERGI!=NULL && $PENYAKIT!=NULL)
	{

		$array_penyakit = explode(",", $PENYAKIT);
		$list_pantangan="";
		for ($i = 0; $i < count($array_penyakit)-1; $i++) {
		    $query = "SELECT pantangan from penyakit WHERE nama_penyakit='". $PENYAKIT[$i]."'";
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_array($result);
			$list_pantangan=$list_pantangan."," .$row['penyakit'];
		}
		$query = "SELECT pantangan from penyakit WHERE nama_penyakit='". $PENYAKIT[count($array_penyakit)-1]."'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$list_pantangan=$list_pantangan.",".$row['penyakit'];

		//ubah string ke array
		$array_pantangan = explode(",", $list_pantangan);

		$query = "SELECT * from RESEP WHERE ";
		for ($i = 0; $i <= count($array_pantangan)-1; $i++) {
		    $query = $query."bahan NOT like '%".$array_pantangan[$i]."%' AND "; 
		}

		$array_alergi = explode(",", $ALERGI);
		for ($i = 0; $i <= count($array_alergi)-1; $i++) {
		    $query = $query."bahan NOT like '%".$array_alergi[$i]."%' AND "; 
		}
		$query = $query."bahan NOT like '%".$array_alergi[count($array_alergi)-1]."%'";

		$result = mysqli_query($con,$query);
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt > 0)
		{
			while($row = mysqli_fetch_array($result)) {
				echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><font face=\"Times New Roman\"><a href=\"resep.php?idresep=".$row['id']."&id=".$_GET['id']."\">".$row['masakan']."</a></font></div></h3></td>";
				echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";			
			}
		}
		else
		{
			echo "Maaf, kami tidak bisa merekomendasikan makanan ke Anda.";
		}
	}
	else if($BAHAN!=NULL && $ALERGI!=NULL && $PENYAKIT!=NULL)
	{


		$array_penyakit = explode(",", $PENYAKIT);
		$list_pantangan="";
		for ($i = 0; $i < count($array_penyakit)-1; $i++) {
		    $query = "SELECT pantangan from penyakit WHERE nama_penyakit='". $PENYAKIT[$i]."'";
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_array($result);
			$list_pantangan=$list_pantangan."," .$row['penyakit'];
		}
		$query = "SELECT pantangan from penyakit WHERE nama_penyakit='". $PENYAKIT[count($array_penyakit)-1]."'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$list_pantangan=$list_pantangan.",".$row['penyakit'];

		//ubah string ke array
		$array_pantangan = explode(",", $list_pantangan);

		$query = "SELECT * from RESEP WHERE ";
		for ($i = 0; $i <= count($array_pantangan)-1; $i++) {
		    $query = $query."bahan NOT like '%".$array_pantangan[$i]."%' AND "; 
		}

		$array_alergi = explode(",", $ALERGI);
		for ($i = 0; $i <= count($array_alergi)-1; $i++) {
		    $query = $query."bahan NOT like '%".$array_alergi[$i]."%' AND "; 
		}
		$query = $query."bahan NOT like '%".$array_alergi[count($array_alergi)-1]."%' AND ";


		$array_bahan = explode(",", $BAHAN);
		for ($i = 0; $i <= count($array_bahan)-1; $i++) {
		    $query = $query."bahan like '%".$array_bahan[$i]."%' AND "; 
		}
		$query = $query."bahan like '%".$array_bahan[count($array_bahan)-1]."%'";

		$result = mysqli_query($con,$query);
		$row_cnt = mysqli_num_rows($result);
		if($row_cnt > 0)
		{
			while($row = mysqli_fetch_array($result)) {
				echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><font face=\"Times New Roman\"><a href=\"resep.php?idresep=".$row['id']."&id=".$_GET['id']."\">".$row['masakan']."</a></font></div></h3></td>";
				echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";			
			}
		}
		else
		{
			echo "Maaf, kami tidak bisa merekomendasikan makanan ke Anda.";
		}
	}
	else
	{
		echo "ERROR";
	}
?>