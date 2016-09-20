<!DOCTYPE html>

<?php
	$con=mysqli_connect("127.0.0.1","root","","telefood");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	
  $ID = $_GET['id'];
?>


<html lang="en">
<head>
<title>4You - Recipe</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/Dynalight_400.font.js" type="text/javascript"></script>
<script src="js/FF-cash.js" type="text/javascript"></script>
<script src="js/tms-0.3.js" type="text/javascript"></script>
<script src="js/tms_presets.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.equalheights.js" type="text/javascript"></script>
<!--[if lt IE 9]><script type="text/javascript" src="js/html5.js"></script><![endif]-->
</head>
<body id="page1">
<!--==============================header=================================-->
<header>
  <div class="row-top">
    <div class="main">
      <div class="wrapper">
        <div class="containerlogo"><h1><a href="index.html"><img src="images/logo4.png" alt=""></a></h1></div>
        <nav>
          <ul class="menu">
            <?php
            echo "
            <li><a href=\"index.php?id=".$ID."\">Home</a></li>";

            if($ID!=0)
            {
              $result = mysqli_query($con,"SELECT username FROM user WHERE id_user=\"".$ID."\";" );

              while($row = mysqli_fetch_array($result)) {
                echo "<li><a class=\"active\" href=\"menu.php?id=".$ID."\">Menu</a></li>";
                echo "<li><a href=\"favorite.php?id=".$ID."\">Favorite</a></li>";
                echo "<li><a href=\"aboutus.php?id=".$ID."\">About Us</a></li>";
                echo "<li><div class=\"selamat\">Selamat datang, ".$row['username']."! <a href=index.php?id=0>Logout</a></div></li>";
              }
            }
            else
            {
              echo "<li><a href=\"aboutus.php?id=".$ID."\">About Us</a></li>";
              echo("<li><a href=\"loginregister.php?id=0\">Login / Register</a></li>");
            }
            ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <div class="row-bot">
    <div class="row-bot-bg">
      <div class="main"> <h2><span id="test"> 
        <?php
        $table = "resep";
  $ID_resep = $_GET['idresep'];
  $sql="SELECT * from $table WHERE ID= '".$ID_resep."'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);

  $sql2="SELECT * from favorit WHERE id= '".$ID_resep."' AND id_username='".$ID."'";
          $result2 = mysqli_query($con,$sql2);
          $row_cnt2 = mysqli_num_rows($result2);
          if ($row_cnt2 == 0)
          {
            echo $row['masakan']."<a href=\"favorite_change.php?id=".$ID."&idresep=".$ID_resep."\"><img src=\"images/whitestar.png\"></a>";
          }
          else
          {

            echo $row['masakan']."<a href=\"favorite_change.php?id=".$ID."&idresep=".$ID_resep."\"><img src=\"images/star.png\"></a>"; 

          }
        ?>
       

          </span></h2>
        <div class="slider-wrapper">
			<div class="slider">
				<img src="<?php echo $row['gambar'];?>" width="940" height="466" alt=""/>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!--==============================content================================-->
<section id="content">
  <div class="main">
	<?php
	   
		$bahan = $row["bahan"];
		$tulis = "Bahan";
		$exploded = explode(",",$bahan);
		$space = "  ";
		echo "<h2><span>".$tulis."</span></h2>";
		for($x = 0; $x < count($exploded); $x++)
		{
			$temp = explode("-",$exploded[$x]);
				echo "<h3><center>". $temp[0].$space.$temp[1]."</center></h3>";
			
		}
		
		$cara = $row["langkah"];
		$tulis2= "Cara Membuat";
		$exploded1 = explode("-",$cara);
		$numbering = ".  ";
		echo "<h2><span>".$tulis2."</span></h2>";
		for($y = 1; $y < count($exploded1); $y++)
		{
			echo  "<h3>".$y.$numbering.$exploded1[$y]."</h3>";
		}
		
	
	?>
  </div>
</section>
<!--==============================footer=================================-->
<footer>
  <div class="main">
    <div class="aligncenter"> <span>Copyright &copy; <a href="#">Tele</a> All Rights Reserved</span></div>
  </div>
</footer>
<script type="text/javascript">Cufon.now();</script>
<script type="text/javascript">
$(window).load(function () {
    $('.slider')._TMS({
        duration: 1000,
        easing: 'easeOutQuint',
        preset: 'slideDown',
        slideshow: 7000,
        banners: false,
        pauseOnHover: true,
        pagination: true,
        pagNums: false
    });
});
</script>
<!--<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>-->
</html>
