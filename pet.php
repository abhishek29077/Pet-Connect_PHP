<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pet Connect</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">


    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    
    <?php
      session_start();
      include "header.php";
      
    ?>

    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Pets <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread">Pets</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
        <!-- <div class="row">
            <div class="col-md-7"><form action="" method="get"></div>
            <div class="col-md-4"><input type="search" name="pet" placeholder="Search Pets" class="form-control" id=""></div>
            <div class="col-md-1"><button type="submit" class="btn btn-primary"><img src="https://upload.wikimedia.org/wikipedia/commons/3/36/Search_Icon.png" height="25px" alt="Search Icon"></button></div>
          </form>
        </div> -->
        <br>
        <div class="row d-flex">
          <?php

            $str="SELECT pets.*, pettypes.type_name
              FROM pets
              INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
              WHERE pets.status = 'available'";
              $result = mysqli_query($conn, $str);

              while($row = mysqli_fetch_assoc($result)) {
                  $pet_id = $row['pet_id'];
                  $petname=$row['name'];
                  $type=$row['type_name'];
                 
                  $age=$row['age'];
                  $gender=$row['gender'];
                  $breed=$row['breed'];
                  
                  $images = explode(',', $row['image_url']); 
                  $firstImage = "../images/".$images[0];
          ?>
          <div class="col-md-4  ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="pet-single.php?id=<?php echo $pet_id; ?>" class="block-20 rounded" style="background-image: url('images/<?php echo $firstImage; ?>');">
              </a>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="#" class="meta-chat"><?php echo $type;?></a></div>
                </div>
                <h3 class="heading">
                  <a href="pet-single.php?id=<?php echo $pet_id; ?>">
                   <table class="table" style="width: 100%;">
                      <tr>
                        <td colspan="2" align="center"><b><?php echo $petname; ?></b></td>
                      </tr>
                      <tr>
                        <th>Type</th>
                        <td><?php echo $type; ?></td>
                      </tr>
                      <tr>
                        <th>Age</th>
                        <td><?php echo $age; ?> years</td>
                      </tr>
                      <tr>
                        <th>Gender</th>
                        <td><?php echo $gender; ?></td>
                      </tr>
                      <tr>
                        <th>Breed</th>
                        <td><?php echo $breed; ?></td>
                      </tr>
                    </table>
                  </a>
                </h3>
              </div>
            </div>
          </div>
          <?php } ?>
          
        </div>
        <!-- <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div> -->
      </div>
    </section>

    <?php include "footer.php";?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script>
	function onload() {
    document.getElementById("navblog").classList.add("active");
		document.getElementById("navabout").classList.remove("active");
		document.getElementById("navhome").classList.remove("active");
		document.getElementById("navvet").classList.remove("active");
		document.getElementById("navservices").classList.remove("active");
		document.getElementById("navgallery").classList.remove("active");
		document.getElementById("navpricing").classList.remove("active");
		document.getElementById("navcontact").classList.remove("active");
	}
	window.onload = onload();
  </script>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>


    
  </body>
</html>