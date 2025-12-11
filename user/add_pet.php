<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet</title>
     
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Google Fonts for consistency -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <style>
        
        :root {
            --primary-color: #16a34a; /* A vibrant, friendly green */
            --dark-color: #153e2a;    /* A deep, professional forest green */
            --gray-light: #f0fdf4;   /* A light, soft green for the background */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-light);
        }

        .bg-dark-pet { background-color: var(--dark-color); }
        .text-dark-pet { color: var(--dark-color); }
        .bg-primary-pet { background-color: var(--primary-color); }
        .text-primary-pet { color: var(--primary-color); }

        /* The sidebar is now a fixed-position element on mobile */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            transition: transform 0.3s ease-in-out;
            transform: translateX(0);
        }

        /* This class hides the sidebar on mobile by default */
        .sidebar.hidden-mobile {
            transform: translateX(-100%);
        }

        /* On larger screens, the sidebar is visible and part of the flow */
        @media (min-width: 768px) {
            .sidebar.hidden-mobile {
                transform: translateX(0);
            }
        }

        .main-content {
            flex-grow: 1;
        }

        .navbar-nav .nav-item {
            position: relative;
        }
    
    </style>
    
</head>
<body>
    <?php
    session_start();
    include '../db/db.php';
    if(!isset($_SESSION['uname']))
    {
        header('Location:http://localhost/PetConnect/login.php');
        exit;
    }
    if(isset($_POST['logout']))
    {
        unset($_SESSION['uname']);
        header('Location:http://localhost/PetConnect/login.php');
        exit;
    }
    if(isset($_POST['submit']))
    {
        $pet_name = $_POST['pet_name'];
        $pet_type = $_POST['pet_type'];
        $pet_breed = $_POST['pet_breed'];
        $pet_age = $_POST['pet_age'];
        $pet_gender = $_POST['pet_gender'];
        $user_id = $_POST['userid'];
        $pet_description = $_POST['pet_description'];
        
        if (!empty($_FILES['image']['name'][0])) {
            foreach ($_FILES['image']['name'] as $key => $name) {
                $tmp_name = $_FILES['image']['tmp_name'][$key];
                $error    = $_FILES['image']['error'][$key];

                if ($error === UPLOAD_ERR_OK) {
                    $target = '../images/' . basename($name);
                    if (move_uploaded_file($tmp_name, $target)) {
                        //echo "<script>alert('Uploaded Successfully');</script>";
                    } else {
                        //echo "<script>alert('Failed to Upload');</script>";
                    }
                }
            }
        }
        $pet_images = implode(',',$_FILES['image']['name']);
        // Database query to insert pet data
        $query = "INSERT INTO pets (name, pet_type_id, breed, age, gender, description, owner_id, image_url) VALUES ('$pet_name', '$pet_type', '$pet_breed', '$pet_age','$pet_gender','$pet_description', '$user_id', '$pet_images')";
        $result = mysqli_query($conn, $query);

        if($result)
        {
            echo "<script>alert('Pet added successfully!');</script>";
            echo "<script>window.location.href='http://localhost/PetConnect/user/';</script>";
        }
        else
        {
            echo "<script>alert('Error adding pet.');</script>";
        }
    }
    
    // Database query to fetch user-specific data
    $user_id = $_SESSION['uname'];
    // $user_id = "we@hj.lcrtr";
    $str = "SELECT * FROM users WHERE email = '$user_id'";
    $result = mysqli_query($conn, $str);
    $user_data = mysqli_fetch_assoc($result);
    // print_r($user_data); // Debugging line to check user data
    // die;
?>

<header class="bg-dark-pet shadow-lg p-1 w-full">
            <div class="w-full flex justify-between items-center flex-wrap px-4">
                <a class="text-white font-bold text-lg md:text-2xl flex items-center" href="#">
                    <i class="fas fa-paw text-white mr-2"></i> Pet Connect
                </a>
                <button id="nav-toggle" class="text-white md:hidden text-2xl">
                    <i class="fa fa-bars"></i>
                </button>
                <div id="nav-menu" class="hidden md:flex flex-col md:flex-row md:ml-auto w-full md:w-auto mt-3 mb-3 md:mt-0">
                    <ul class="navbar-nav flex flex-col md:flex-row md:space-x-6">
                        <li class="nav-item">
                            <a href="http://localhost/PetConnect/" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/PetConnect/about.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/PetConnect/pet.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Browse Pets</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/PetConnect/vet.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Veterinarian</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/PetConnect/gallery.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/PetConnect/contact.php" class="nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block">Contact</a>
                        </li>
                        <li class="nav-item">
                           
                                <form action="" method="post">
                                    <button class="btn nav-link text-gray-300 hover:text-white transition-colors duration-200 p-1 block" type="submit" name="logout">Logout</button>
                                </form>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </header>
       
    <br>
     <section class="content">
      <div class="container-fluid">
        <!-- <a href=""><button class="btn btn-primary">Add User</button></a><br> -->
        <!-- Dashboard Widgets Example -->
        <div class="row">
            <!-- Registration Form -->
        <form id="registerForm" class="form-container form-hidden" method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-4">
                <div class="col-sm">
                    <label for="petname" class="block text-gray-700 text-sm font-bold mb-2">Pet Name</label>
                    <input id="petname" name="pet_name" placeholder="Pet Name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="text">
                </div>
                <div class="col-sm">
                    <label for="pettype" class="block text-gray-700 text-sm font-bold mb-2">Pet Type</label>
                    <select name="pet_type" id="pettype" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200">
                        <option value="" hidden selected>Select Pet Type</option>
                        <?php
                        $n=0;
                        $sql = "SELECT * FROM pettypes";
                        $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['pet_type_id'] . "'>" . $row['type_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
                    <input id="userid" value="<?php echo $user_data['user_id']; ?>" name="userid"  class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" type="hidden">
            <div class="mb-4">
                <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Pet Age</label>
                <input type="number" min="1" max="50" value="1" maxlength="20" id="age" name="pet_age" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" required>
            </div>
            <div class="mb-4">
                <label for="breed" class="block text-gray-700 text-sm font-bold mb-2">Pet's Breed</label>
                <select name="pet_breed" id="breed" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200">
                    <option value="" hidden selected>Select Breed</option>
                    <span id="breed-options"></span>
                </select>
            </div>
            <div class="mb-4">
                <label for="registerGender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
                <select id="registerGender" name="pet_gender" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200">
                    <option value="" hidden selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <!-- <option value="other">Other</option> -->
                </select>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="pet_description" rows="5" id="description" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" placeholder="Your Description" required></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                <input type="file" id="image" name="image[]" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200" required>
                <div class="" id="add_img"></div>
                <br>
                <?php
                    // while($n<5)
                    // {
                    //     echo `<button type="button" id="pet_img" class="btn btn-outline-success">
                    //             Add Images
                    //         </button>`;
                    // }
                ?>
                <button type="button" id="pet_img" class="btn btn-outline-success">
                    Add Images
                </button>
            </div>
            <button type="submit" name="submit" class="w-full bg-[#00BD56] hover:bg-[#00A04C] text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-all duration-200 shadow-md">
                Add Pet
            </button>
        </form>      
        </div>
        <div>&nbsp;</div>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="../js/breed.js"></script>
<script>
    var n=0;
    function fetchOwnerName(value) {
        $.ajax({
            url: 'fetch_owner_name.php',
            type: 'POST',
            data: { userid: value },
            success: function(response) {
                // Set the response as the textbox value
                $('#username').val(response);
            }
        });
    }

$(document).ready(function () {
    
    let n = 1; // assuming 1 file input is already present
    $('#pet_img').click(function () {
        if (n < 5) {
            $('#add_img').append(`
                <input type="file" name="image[]" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-[#00BD56] transition-all duration-200 mt-2" required>
            `);
            n++;
        } else {
            alert("Maximum 5 images allowed");
        }
    });
    $("#pettype").change(function () {
        let petType = $(this).val();

        // Populate breeds
        // Clear old options before appending new ones
        $("#breed-options").empty();

        var breeds = [];

        if (petType == 1) breeds = data.dog;
        else if (petType == 2) breeds = data.cat;
        else if (petType == 3) breeds = data.rabbit;

        $.each(breeds, function (i, breed) {
            $("#breed-options").append('<option value="' + breed + '">' + breed + '</option>');
        });

    });

});

</script>

</body>
</html>