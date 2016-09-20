<!DOCTYPE html>
<html lang="en">
<head>
<title>4You - Home</title>
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

            $ID = 0;
            if(isset($_GET['id']))
            {
                $ID = $_GET['id'];
            }
            echo "

            <li><a class=\"active\" href=\"index.php?id=".$ID."\">Home</a></li>";

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
        <div class="slider-wrapper">
          <div class="slider">
            <ul class="items">
              <li> <img src="images/slider-img1.jpg" alt="" /> </li>
              <li> <img src="images/slider-img2.jpg" alt="" /> </li>
              <li> <img src="images/slider-img3.jpg" alt="" /> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!--==============================content================================-->
<section id="content">
  <div class="main">
    <div>
      <article class="col-1"><img class="img-border" src="images/menu-1.jpg" alt=""></article>
      <article class="col-1"><img class="img-border" src="images/chef.jpg" alt=""></article>
      <article class="col-2"><img class="img-border" src="images/menuuu.jpg" alt=""></article>
      <br>
      <br>
    </div>
    <div class="wrapper">
      <article class="column-1">
        <div class="indent-left">
          <div class="maxheight indent-bot">
            <!--<h3>Our Services</h3>
            <ul class="list-1">
              <li><a href="#">Duis autem vel eum iriure dolor</a></li>
              <li><a href="#">Hendrerit in vulputate velit esse molestie </a></li>
              <li><a href="#">Consequat vel illum dolore</a></li>
              <li><a href="#">Feugiat nulla facilisis at vero eros</a></li>
              <li><a href="#">Accumsan et iusto odio dignissim qui</a></li>
              <li><a href="#">Blandit praesent luptatum azril</a></li>
              <li><a href="#">Delenit augue duis dolore te feugait</a></li>
            </ul>-->
          </div>
      </article>
      <article class="column-2">
        <div class="maxheight indent-bot">
          <!--<h3 class="p1">About the Catering</h3>
          <h6 class="p2">Catering is one of free website templates created by TemplateMonster.com team. This website template is optimized for 1280X1024 screen resolution. It is also XHTML &amp; CSS valid.</h6>
          <p class="p2">This Catering Template goes with two packages – with PSD source files and without them. PSD source files are available for free for the registered members of TemplatesMonster.com. The basic package (without PSD source) is available for anyone without registration.</p>
          This website template has several pages: <a href="index.html">About</a>, <a href="menu.html">Menu</a>, <a href="catalogue.html">Catalogue</a>, <a href="shipping.html">Shipping</a>, <a href="faq.html">FAQ</a>, <a href="contact.html">Contact</a> (note that contact us form – doesn’t work). </div>
        <a class="button-2" href="#">Read More</a> </article>-->
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
</html>
