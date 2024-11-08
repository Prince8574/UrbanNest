<?php
include("config/config.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <?php

  $sql = "SELECT * FROM product LIMIT 5";
  $query = mysqli_query($db, $sql);

  if (mysqli_num_rows($query) > 0) {
    while ($rows = mysqli_fetch_assoc($query)) {
      $property_id = $rows['id'];
      ?>
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <img src="./merchant/<?php echo $rows['image']; ?>" alt="Product 1" class="w-full h-64 object-cover">
        <div class="p-4">
          <h3 class="text-lg font-semibold text-gray-800"><?php echo $rows['name'] ?></h3>
          <p class="text-gray-600 mb-2"><?php echo $rows['description'] ?></p>
          <p class="text-gray-700 font-semibold">₹ <?php echo $rows['price'] ?>.00</p>
          <form action="product-engine.php" method="post">
            <input type="hidden" name="id" value="<?php echo $rows['id'] ?>">
            <button type="submit" name="product_details"
              class="block mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-center font-semibold focus:outline-none focus:ring focus:border-blue-300">View
              Details</button>
          </form>
        </div>
      </div>
      <?php
    }
  }
  ?>