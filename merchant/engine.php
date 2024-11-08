<?php

$db = new mysqli('localhost', 'root', '', 'ecommerce');

if ($db->connect_error) {
	die("Error connecting to database: " . $db->connect_error);
}

// Check for form submissions
if (isset($_POST['add_product'])) {
	add_property();
}

if (isset($_POST['owner_update'])) {
	owner_update();
}
if (isset($_POST['update_product'])) {
	update_product();
}
if (isset($_POST['confirm_delete'])) {
	confirm_delete();
}

function add_property()
{
	global $db;

	// Validate inputs
	$name = validate($_POST['product_name']);
	$price = validate($_POST['price']);
	$category = validate($_POST['category']);
	$brand = validate($_POST['brand']);
	$description = validate($_POST['description']);
	$quantity = validate($_POST['quantity']);
	$booked = 0;
	$email = $_SESSION['email'];

	// Get merchant ID
	$sql1 = "SELECT id FROM merchant WHERE email='$email'";
	$result1 = mysqli_query($db, $sql1);
	if ($result1 && mysqli_num_rows($result1) > 0) {
		$rowss = mysqli_fetch_assoc($result1);
		$merchant = $rowss['id'];

		// Handle product image upload
		$image = '';
		if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
			$image = 'product-photo/' . basename($_FILES['product_image']['name']);
			if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $image)) {
				echo "There was an error uploading the main image.";
				return; // Exit the function if upload fails
			}
		}

		// Insert product into database
		$sql = "INSERT INTO product (name, price, image, category, brand, description, quantity, booked, merchant) 
                VALUES ('$name', '$price', '$image', '$category', '$brand', '$description', '$quantity', '$booked', '$merchant')";

		if (mysqli_query($db, $sql)) {
			echo alert("Your product has been uploaded.");
		} else {
			echo "Error inserting product: " . mysqli_error($db);
		}
	} else {
		echo "Merchant not found.";
	}
}

function update_product()
{

	global $db;

	// Validate inputs
	$name = validate($_POST['product_name']);
	$price = validate($_POST['product_price']);
	$category = validate($_POST['product_category']);
	$brand = validate($_POST['product_brand']);
	$description = validate($_POST['product_description']);
	$quantity = validate($_POST['product_quantity']);
	$id = validate($_POST['product_id']);
	$email = $_SESSION['email'];

	// Get merchant ID
	$sql1 = "SELECT id FROM merchant WHERE email='$email'";
	$result1 = mysqli_query($db, $sql1);
	if ($result1 && mysqli_num_rows($result1) > 0) {
		$rowss = mysqli_fetch_assoc($result1);
		$merchant = $rowss['id'];

		// Handle product image upload
		// $image = '';
		// if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
		// 	$image = 'product-photo/' . basename($_FILES['product_image']['name']);
		// 	if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $image)) {
		// 		echo "There was an error uploading the main image.";
		// 		return; // Exit the function if upload fails
		// 	}
		// }

		// Insert product into database
		$sql = "UPDATE product SET 
            name='$name', 
            price='$price', 
            category='$category', 
            brand='$brand', 
            description='$description', 
            quantity='$quantity' 
            WHERE id='$id'";

		if (mysqli_query($db, $sql)) {
			echo alert("Your product has been uploaded.");
		} else {
			echo "Error inserting product: " . mysqli_error($db);
		}
	} else {
		echo "Merchant not found.";
	}
}
function confirm_delete()
{

	global $db;

	// Validate inputs
	$id = validate($_POST['delete_product_id']);
	$email = $_SESSION['email'];

	// Get merchant ID
	$sql1 = "SELECT id FROM merchant WHERE email='$email'";
	$result1 = mysqli_query($db, $sql1);
	if ($result1 && mysqli_num_rows($result1) > 0) {
		$rowss = mysqli_fetch_assoc($result1);
		$merchant = $rowss['id'];
		$sql = "DELETE FROM product WHERE id='$id'";

		if (mysqli_query($db, $sql)) {
			echo alert("Your product has been deleted.");
		} else {
			echo "Error deleting product: " . mysqli_error($db);
		}
	} else {
		echo "Merchant not found.";
	}
}

function owner_update()
{
	global $db;

	// Validate inputs
	$owner_id = validate($_POST['owner_id']);
	$full_name = validate($_POST['full_name']);
	$email = validate($_POST['email']);
	$phone_no = validate($_POST['phone_no']);
	$address = validate($_POST['address']);
	$id_type = validate($_POST['id_type']);

	// Check for optional password update
	$password = !empty($_POST['password']) ? md5(validate($_POST['password'])) : null;

	$sql = "UPDATE owner SET full_name='$full_name', email='$email', phone_no='$phone_no', address='$address', id_type='$id_type'";
	if ($password) {
		$sql .= ", password='$password'";
	}
	$sql .= " WHERE owner_id='$owner_id'";

	if (mysqli_query($db, $sql)) {
		echo alert("Your information has been updated.");
	} else {
		echo "Error updating owner: " . mysqli_error($db);
	}
}

function alert($message)
{
	return "
    <div class='container'>
        <div class='alert' role='alert'>
            <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>
            <center><strong>$message</strong></center>
        </div>
    </div>
    <style>
        .alert {
            padding: 20px;
            background-color: #DC143C;
            color: white;
        }
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .closebtn:hover {
            color: black;
        }
    </style>
    <script>
        window.setTimeout(function () {
            document.querySelector('.alert').style.display = 'none';
        }, 2000);
    </script>
    ";
}

function validate($data)
{
	global $db;
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return mysqli_real_escape_string($db, $data);
}
?>