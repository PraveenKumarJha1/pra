<?php

// Start Session
session_start();

// Database connection
require __DIR__ . '/database.php';
$db = DB();

// Application library ( with DemoLib class )
require __DIR__ . '/lib/library.php';
$app = new DemoLib();

$login_error_message = '';
$register_error_message = '';

// check Login request
if (!empty($_POST['btnLogin'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "") {
        $login_error_message = 'Username field is required!';
    } else if ($password == "") {
        $login_error_message = 'Password field is required!';
    } else {
        $user_id = $app->Login($username, $password); // check user login
        if($user_id > 0)
        {
            $_SESSION['user_id'] = $user_id; // Set Session
            header("Location: profile.php"); // Redirect user to the profile.php
        }
        else
        {
            $login_error_message = 'Invalid login details!';
        }
    }
}

// check Register request
if (!empty($_POST['btnRegister'])) {
    if ($_POST['name'] == "") {
        $register_error_message = 'Name field is required!';
    } else if ($_POST['email'] == "") {
        $register_error_message = 'Email field is required!';
    } else if ($_POST['username'] == "") {
        $register_error_message = 'Username field is required!';
    } else if ($_POST['password'] == "") {
        $register_error_message = 'Password field is required!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $register_error_message = 'Invalid email address!';
    } else if ($app->isEmail($_POST['email'])) {
        $register_error_message = 'Email is already in use!';
    } else if ($app->isUsername($_POST['username'])) {
        $register_error_message = 'Username is already in use!';
    } else {
        $user_id = $app->Register($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password']);
        // set session and redirect user to the profile page
        $_SESSION['user_id'] = $user_id;
        header("Location: profile.php");
    }
}
?>

<!DOCTYPE html>
<html>


<meta name="viewport" content="width=device-width, initial-scale=1">

<head>

<title> Online Admission portal</title>

</head>
    <style>
 
.b{
    text-align: center;
}       
.d {
    float: left;
    width: 31.3%;
    padding: 8px;
}
 
.g {
    float: left;
    width: 31.3%;
    padding: 8px;
}

.l {
    float: left;
    width: 31.3%;
    padding: 8px;
}
    </style>
<link rel="stylesheet" href="css/css1.css" >
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
 
 <nav> 	
     <div>
         
         <h1><span style="font-family:Monotype Corsiva; font-size: 2.5em;">C</span><span style="font-family:Monotype Corsiva " >Buddy.com</span></h1>
         
     </div>
     
     <div>   
         <ul>
             <li><a href="online.php">Home</a></li>
             <li><a href="about_us.php">About Us </a></li>
             <li><a href="admin.php">Admin </a></li>
	<li><a href="contact.php">Contact Us</a></li>
	<li><a href="#">Toll- Free: 100-2000</a></li>	            
    </ul>
     </div>

</nav>

<header>
	<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="image/1.jpg" style="width:100%; height: 400px;">
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="image/2.jpg" style="width:100%; height: 400px;">
  
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="image/3.jpg" style="width:100%; height: 400px; ">
  
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

    	<h1>Online Admission Portal</h1>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 4000); // Change image every 2 seconds
}
</script>
    
  </header>

<div id="main" style="overflow-x:auto;">
    <div id="main2">
<h2>Welcome</h2>
 <?php
            if ($login_error_message != "") {
                echo '<div class="aler  t alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
            }
            ?>
<form action="online.php" method="post"> 
    
	  <input type="text" placeholder="Your email/name" name="username" required>
	  <input type="password" placeholder="Your Password" name="password" required>  
	  <input type="submit" name="btnLogin" value="login" >


</form>
</div>
    
   <div class="row" id="main1">
        <div class="sign_in"  >
        <MARQUEE BEHAVIOR=ALTERNATE SCROLLDELAY=250>
            <b> <font size="3" face="Monotype Corsiva" color="blue">Hi! Please Sig_In, if you don't Register yet! </b>
            
    
</MARQUEE>
            
            <?php
            if ($register_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $register_error_message . '</div>';
            }
            ?>
            <form action="online.php" method="post" >
                <div class="formgroup" >
                    <label for="">Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="name" placeholder="Name" class="formcontrol" size="30"/>
                </div><br>
                <div class="formgroup">
                    <label for="">Email</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="email" name="email" placeholder="Email" class="formcontrol" size="30"/>
                </div><br>
                <div class="formgroup">
                    <label for="">Username</label>&nbsp;&nbsp;
                    <input type="text" name="username" placeholder="User Name" class="formcontrol" size="30"/>
                </div>
                <div class="formgroup"><br>
                    <label for="">Password</label>&nbsp;&nbsp;&nbsp;
                    <input type="password" name="password" placeholder="Password" class="formcontrol" size="30"/>
                </div>
                <div class="clearfix">
                    <input type="submit" name="btnRegister" class="button" value="Register"/>
                    <button type="reset" class="button"> Reset</button>
                </div>
            </form>
        </div>
    </div>
 </div>
    <br><br>
    <!-- Grid -->
    <div  id="ab">
      <div class="a2" style=" text-align: center; background-color: pink; padding:20px ">
      <span class="a3">What We Offer</span>
    </div>
    <div class="a4" style="height:220px; float: left;  width: 25%; padding: 8px;background-color: #ec971f">
             <h3>Acknowledge</h3>
      <p style=" background-color:wheat; padding: 6px; width: 100%; ">
          we provide you best services that acknowledge by various student which lead to success in her life.
      <p>.</p>
    </div>

    <div class="a5" style=" height:220px ; float: left;  width: 25%; padding: 8px; background-color: yellow">
      <h3>Branding</h3>
      <p style=" background-color:wheat; padding: 6px; width: 100%; ">we make your brand by helping you to get best college in the world.</p>
    </div>

    <div class="a6" style=" height:220px; float: left; width: 25%; padding: 8px;background-color: yellowgreen ">
      <h3>Consultation</h3>
      <p style=" background-color:wheat; padding: 6px; width: 100%; ">for your profit and we aware you with what career is better for you   .</p>
    </div>

    <div class="a7" style=" height:220px; width: 25%; display: inline-block; background-color: #46b8da ">
      <h3>Promises</h3>
      
      <p style=" background-color:wheat; padding: 6px; width: 96%; ">we provide you best service.</p>
    </div>
      </div>
  </div>

  
    <br><br><br>
        <!-- Grid -->
  <div class="a" >
      
    <div class="b" id="b">
      <span class="c">Who We Are</span>
    </div>

    <div class="d">
      <div class="e">
          <img src="image/img1.jpg" alt="bhaskar & praveen"
               style="width:100%; height:420px">
        <div class="container">
          <h3>Bhaskar Roy</h3>
          <p class="w3-opacity">CEO </p>
          <p> Make it simple.</p>
          <p><button class="f">Contact</button></p>
        </div>
      </div>
    </div>

    <div class="g">
      <div class="h">
          <img src="image/img2.jpg" alt="Mike" style="width:100%; height:420px  " >
        <div class="i">
          <h3>Praveen Kr Jha</h3>
          <p class="j">Designer & Founder</p>
          <p> Think out of box to solve any problem </p>
          <p><button class="k">Contact</button></p>
        </div>
      </div>
    </div>

    <div class="l">
      <div class="m">
          <img src="image/img3.jpg" alt="Jane" style="width:100%; height:420px">
        <div class="n">
          <h3>Priya</h3>
          <p class="o">Designer</p>
          <p> Love to coding.</p>
          <p><button class="p">Contact</button></p>
        </div>
      </div>
    </div>
  </div>
  

    
    
    
    <br><br>
    <table border="0" width="100%"  >
        <tr>
            <td >
<div align="left" id="address" >
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h9>Address of Center </h9>
   <div> 
       <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Center: Near mullana university <br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact:999-600-6380<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email:-praveen9511@gmail.com
       </p>
   </div>       
</div>
        </td>
        <td>
<div align="center"> <h8> Location of Center </h8>
<div id="map" style="width:625px;height:150px" >
   

<script>
function myMap() {
  var myCenter = new google.maps.LatLng(30.251179,77.045737);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 14};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter, animation: google.maps.Animation.BOUNCE});
  marker.setMap(map);
}
</script>

<script
    
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD--QVN5kkOL7Hdki15-9TGjdro9-VurxM&callback=myMap">
</script>
</div>
</div>
    </td>
    <td>
        <div align="center">Outlook of center</div><div align="center"  >
        
    <video width="290" height="150" controls>  
        <source src="image/A Grade Deemed University in North India, College in Ambala.mp4" type="video/mp4">  
  Your browser does not support the html video tag.  
</video>  
        </div>\</td>
</tr>
    </table>
<div id="footer" width="auto">
Copyright @ <span style="font-size: 1.5em; color: #191970">C</span>
                <span style="font-family:Monotype Corsiva; color: #191970" >Buddy.com</span> .com
</div>
    </div>
</body>
</html>
