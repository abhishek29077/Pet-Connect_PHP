<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AdminLTE CSS (Minimal Setup) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom styles for smooth transitions and font */
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        

        /* Form transition animation */
        .form-container {
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
            transform-origin: center;
        }
        
        .form-visible {
            opacity: 1;
            transform: scale(1);
            position: relative;
            pointer-events: auto;
        }
        .relative-container {
            position: relative;
            min-height: 400px; /* Adjust based on form height */
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="hold-transition sidebar-mini transition" id="mainBody">
<div class="wrapper">

    <?php ob_start(); ?>
    <?php include "../header_panel.php"; ?>
    <?php include "../../db/db.php"?>
    <?php
    if (isset($_POST['submit'])) {
        $firstName = $_POST['first'] ." " . $_POST['last'];
        //echo $firstName;
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];

        // Insert user into the database
        $sql = "INSERT INTO users (name, phone, gender, address, email, password) VALUES ('$firstName', '$phone', '$gender', '$address', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('User added successfully!');</script>";
            // header("Location: index.php");
            // exit();
        } else {
            echo "<script>alert('Error adding user: " . mysqli_error($conn) . "');</script>";
        }
    }
    ?>
    
  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add User</h1>
          </div>
        </div>
      </div>


    <section class="content">
      <div class="container-fluid">
        <!-- <a href=""><button class="btn btn-primary">Add User</button></a><br> -->
        <!-- Dashboard Widgets Example -->
        <div class="row">
            <!-- Registration Form -->
        <form id="registerForm" class="form-container form-hidden" method="POST" action="">
            <div class="row mb-4">
                <div class="col-sm">
                    <label for="firstname" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                    <input id="firstname" value="" name="first" placeholder="First Name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                </div>
                <div class="col-sm">
                    <label for="lastname" class="block text-gray-700 text-sm font-bold mb-2">Surname</label>
                    <input id="lastname" value="" name="last" placeholder="Last Name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                </div>
            </div>
            <div class="mb-4">
                <label for="registerMob" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                <input type="text" value="" id="registerMob" name="phone" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="XXXXXXXXXX" required>
            </div>
            <div class="mb-4">
                <label for="registerGender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
                <select id="registerGender" name="gender" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200">
                    <option value="" hidden selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="registerAddress" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <textarea name="address" rows="5" id="registerAddress" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="Your Address" required>

                </textarea>
            </div>
            <div class="mb-4">
                <label for="registerEmail" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" value="" id="registerEmail" name="email" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="your@example.com" required>
            </div>
            <div class="mb-4">
                <label for="registerPassword" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="registerPassword" name="password" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="********" required>
            </div>
            <!-- <div class="mb-6">
                <label for="confirmPassword" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="********" required>
                <p id="passwordMatchError" class="text-red-500 text-xs italic mt-2 hidden">Passwords do not match.</p>
            </div> -->
            <!-- Changed button color to #00BD56 -->
            <button type="submit" name="submit" class="w-full bg-[#00BD56] hover:bg-[#00A04C] text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-all duration-200 shadow-md">
                Add User
            </button>
        </form>      
        </div>
      </div>
    </section>
  </div>
  </div>
  <?php include "../footer.php";?>
  <?php ob_end_flush(); ?>

  <!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script>
  document.getElementById('menuUsers').classList.add('menu-open');
  document.getElementById('linkUsers').classList.add('active');
  document.getElementById('linkUsers').classList.add('bg-dark');

</script>
</body>
</html>
