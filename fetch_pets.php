<?php
include "db/db.php"; // adjust path

$searchTerm = isset($_POST['pet']) ? mysqli_real_escape_string($conn, $_POST['pet']) : '';

if ($searchTerm != '') {
    $str = "SELECT pets.*, pettypes.type_name
            FROM pets
            INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
            WHERE pets.status = 'available'
              AND (pets.name LIKE '%$searchTerm%'
              OR pettypes.type_name LIKE '%$searchTerm%'
              OR pets.breed LIKE '%$searchTerm%')";
} else {
    $str = "SELECT pets.*, pettypes.type_name
            FROM pets
            INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
            WHERE pets.status = 'available'";
}

$result = mysqli_query($conn, $str);

while ($row = mysqli_fetch_assoc($result)) {
    $pet_id = $row['pet_id'];
    $petname = $row['name'];
    $type = $row['type_name'];
    $age = $row['age'];
    $gender = $row['gender'];
    $breed = $row['breed'];
    $images = explode(',', $row['image_url']);
    $firstImage = $images[0];
?>
  <div class="col-md-4 ftco-animate">
    <div class="blog-entry align-self-stretch">
      <a href="pet-single.php?id=<?php echo $pet_id; ?>" 
         class="block-20 rounded" 
         style="background-image: url('images/<?php echo $firstImage; ?>');">
      </a>
      <div class="text p-4">
        <div class="meta mb-2">
          <div><a href="#" class="meta-chat"><?php echo $type; ?></a></div>
        </div>
        <h3 class="heading">
          <a href="pet-single.php?id=<?php echo $pet_id; ?>">
            <table class="table" style="width: 100%;">
              <tr><td colspan="2" align="center"><b><?php echo $petname; ?></b></td></tr>
              <tr><th>Type</th><td><?php echo $type; ?></td></tr>
              <tr><th>Age</th><td><?php echo $age; ?> years</td></tr>
              <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
              <tr><th>Breed</th><td><?php echo $breed; ?></td></tr>
            </table>
          </a>
        </h3>
      </div>
    </div>
  </div>
<?php } ?>
