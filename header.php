<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Connect</title>
	<link rel="icon" href="images/12638.png" type="image/png">
</head>
<body>
    <?php 
	include "db/db.php";
	// session_start();
	?>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	    	<a class="navbar-brand" href="http://localhost/PetConnect/"><span class="flaticon-pawprint-1 mr-2"></span>Pet Connect</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	            <li id="navhome" class="nav-item"><a href="http://localhost/PetConnect/" class="nav-link">Home</a></li>
	        	<li id="navabout" class="nav-item"><a href="http://localhost/PetConnect/about.php" class="nav-link">About</a></li>
	        	<li id="navblog" class="nav-item"><a href="http://localhost/PetConnect/pet.php" class="nav-link">Browse Pets</a></li>
                <li id="navvet" class="nav-item"><a href="http://localhost/PetConnect/vet.php" class="nav-link">Veterinarian</a></li>
	            <li id="navgallery" class="nav-item"><a href="http://localhost/PetConnect/gallery.php" class="nav-link">Gallery</a></li>
	            <li id="navcontact" class="nav-item"><a href="http://localhost/PetConnect/contact.php" class="nav-link">Contact</a></li>
                <li id="navlogin"  class="nav-item"><a href="<?php if(isset($_SESSION['uname'])){ echo "http://localhost/PetConnect/user/"; } else{ echo "http://localhost/PetConnect/login.php"; } ?>" class="nav-link"><?php if(isset($_SESSION['uname'])){ echo $_SESSION['uname']; } else{ echo "Login/Register"; } ?></a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
</body>
</html>