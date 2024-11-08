<?php

$merchant_id = '';
$name = '';
$email = '';
$password = '';
$mobile = '';
$address = '';
$profile = '';

$errors = array();

$db = new mysqli('localhost', 'root', '', 'ecommerce');

if ($db->connect_error) {
	echo "Error connecting database";
}


if (isset($_POST['merchant_register'])) {
	merchant_register();
}

if (isset($_POST['merchant_login'])) {
	merchant_login();
}

function merchant_register()
{
	if (isset($_FILES['profile'])) {
		$profile = 'merchant-photo/' . $_FILES['profile']['name'];

		// echo $_FILES['image']['name'].'<br>';

		if (!empty($_FILES['profile'])) {
			$path = "merchant-photo/";
			$path = $path . basename($_FILES['profile']['name']);
			if (move_uploaded_file($_FILES['profile']['tmp_name'], $path)) {
				echo "The file " . basename($_FILES['profile']['name']) . " has been uploaded";
			} else {
				echo "There was an error uploading the file, please try again!";
			}
		}

	}
	global $merchant_id, $name, $email, $password, $mobile, $address, $profile, $errors, $db;
	$merchant_id = validate($_POST['merchant_id']);
	$name = validate($_POST['name']);
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);
	$mobile = validate($_POST['mobile']);
	$address = validate($_POST['address']);
	$profile = $_POST['profile'];
	$password = md5($password); // Encrypt password
	$sql = "INSERT INTO merchant(name,password,mobile,address,profile,email) VALUES('$name','$password','$mobile','$address','$path','$email')";
	if ($db->query($sql) === TRUE) {
		header("location:merchant-login.php");
	}
}
function merchant_login()
{
	global $email, $db;
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);

	$password = md5($password);
	$sql = "SELECT * FROM merchant where email='$email' AND password='$password' LIMIT 1";
	$result = $db->query($sql);
	if ($result->num_rows == 1) {
		$data = $result->fetch_assoc();
		$logged_user = $data['email'];
		$_SESSION['email'] = $logged_user;
		header('location:merchant/merchant-index.php');
	} else {
		?>
		<div class="container mx-auto p-4">
			<div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
				<span>Incorrect Email/Password or not registered.</span>
				<span class="cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
				<div>
					Click here to <a href="merchant-register.php" class="text-blue-200 underline"><b>Register</b></a>.
				</div>
			</div>
		</div>
		<?php
	}
}
function validate($data)
{
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>