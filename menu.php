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
      <div class="main">
        <h2>Di balik tubuh yang kuat <br><span>terdapat makanan yang sehat</span></h2>
      </div>
    </div>
  </div>
</header>
<!--==============================content================================-->
<section id="content">
  <div class="main">
    <div class="wrapper">
      <article class="column">
        <h3 class="p1" padding-left:"200px">Cari Menu Pilihan Anda</h3>
        <form id="form" method="post" onSubmit="return addmenu()" enctype="multipart/form-data">
          <fieldset>
            <div class="wrapper">
              <div class="text-form">Daftar Bahan yang Anda miliki</div>
              <div class="extra-wrap">
                <textarea placeholder="contoh: ayam,telur,tepung" id="bahan"></textarea>
              </div>
              <br>
              <div class="text-form">Alergi yang Anda miliki</div>
              <div class="extra-wrap">
                <textarea placeholder="contoh: udang,kacang,susu" id="alergi"></textarea>
              </div>
              <br>
              <div class="text-form">Penyakit yang baru saja Anda derita</div>
              <div class="extra-wrap">
                <textarea placeholder="contoh: diabetes,jantung" id="penyakit"></textarea>
              </div>
              <div id="contact-area2"><input type="submit" name="submit" value="Kirim"></div>
            </div>
          </fieldset>
        </form>
        <br>
        <p id="load"></p>
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
<script type="text/javascript">Cufon.now();</script>
<script type="text/javascript">
</script>
<script>
function get(name){
   if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
      return decodeURIComponent(name[1]);
}
</script>
<script>
    function loadmenu()
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
              document.getElementById("load").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getmenu.php?bahan="+document.getElementById("bahan").value+"&alergi="+document.getElementById("alergi").value+"&penyakit="+document.getElementById("penyakit").value+"&id="+get('id'),true);
        xmlhttp.send();
    }
</script>
<script>
function addmenu()
{
    var xmlhttp=new XMLHttpRequest();
    
    xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("load").innerHTML=xmlhttp.responseText;
        loadmenu();
        document.getElementById("bahan").value="";
        document.getElementById("penyakit").value="";
        document.getElementById("alergi").value="";
    }
  }
    
    xmlhttp.open("POST","getmenu.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("bahan="+document.getElementById("bahan").value+"&alergi="+document.getElementById("alergi").value+"&penyakit="+document.getElementById("penyakit").value+"&id="+get('id'));

    return false;
}
</script>
</html>
