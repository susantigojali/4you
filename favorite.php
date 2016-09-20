<!DOCTYPE html>
<html lang="en">
<head>
<title>4You | Menu</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/Dynalight_400.font.js" type="text/javascript"></script>
<script src="js/FF-cash.js" type="text/javascript"></script>
<script src="js/jquery.equalheights.js" type="text/javascript"></script>
<script src="js/jquery.bxSlider.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('#slider').bxSlider({
        pager: true,
        controls: false,
        moveSlideQty: 1,
        displaySlideQty: 3
    });
});
</script>
<!--[if lt IE 9]><script type="text/javascript" src="js/html5.js"></script><![endif]-->
</head>
<body id="page2" onLoad="loadmenu()">
<!--==============================header=================================-->
<header>
  <div class="row-top">
    <div class="main">
      <div class="wrapper">
        <div class="containerlogo"><h1><a href="index.html"><img src="images/logo4.png" alt =""></span></a></h1></div>
        <nav>
          <ul class="menu">
            <?php

            $ID = $_GET['id'];
            echo "

            <li><a href=\"index.php?id=".$ID."\">Home</a></li>";

            if($ID!=0)
            {
              $con=mysqli_connect("127.0.0.1","root","","telefood");
              // Check connection
              if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }

              $result = mysqli_query($con,"SELECT username FROM user WHERE id_user=\"".$ID."\";" );

              while($row = mysqli_fetch_array($result)) {
                echo "<li><a href=\"menu.php?id=".$ID."\">Menu</a></li>";
                echo "<li><a class=\"active\" href=\"favorite.php?id=".$ID."\">Favorite</a></li>";
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
      <div class="main">
        <h2>Di balik tubuh yang kuat <br><span>terdapat makanan yang sehat</span></h2>
      </div>
    </div>
  </div>
</header>
<!--==============================content================================-->
<section id="content">
  <div class="main">
    <div class="wrapper2">
      <div class="article2">
       
        <?php 

        $result = mysqli_query($con,"SELECT masakan, gambar, id FROM favorit NATURAL JOIN resep WHERE `id_username`=".$ID);
        $row_cnt = mysqli_num_rows($result);
        if($row_cnt > 0)
        {
          echo "<br><div class=\"recommendation\"><font face=\"Monotype Corsiva\" color=\"black\"><centre> Menu Favorit </centre></div></font><hr>";
          while($row = mysqli_fetch_array($result)) {


            echo "<table style=\"width:100%\"><tr><td style=\"width:400px\" valign=\"middle\"><h3><div class=\"masakan\"><a href=\"resep.php?idresep=".$row['id']."&id=".$ID."\">".$row['masakan']."</a></div></h3></td>";
            echo "<td><img src=\"".$row['gambar']."\" width=\"200px\" height=\"200px\"></td></tr></table>";

          }

          echo "</div><br> <br>";
        }
        else
        {
          echo "<table style=\"width:100%\"><tr><td style=\"width:600px\" valign=\"middle\"> <h3>Anda tidak memiliki menu favorit. </h3></td>";
          echo "</tr></table>";
         
        }
        ?>

        <br>
      </article>
    </div>
  </div>
</section>
<!--==============================footer=================================-->
<footer>
  <div class="main">
    <div class="aligncenter"> <span>Copyright &copy; <a href="#">Tele</a> All Rights Reserved</span></div>
  </div>
</footer>

</html>
