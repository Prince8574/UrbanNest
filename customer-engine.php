<?php
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


if (isset($_POST['customer_register'])) {
	customer_register();
}

if (isset($_POST['customer_login'])) {
	customer_login();
}

if (isset($_POST['customer_update'])) {
	customer_update();
}

function customer_register()
{
	if (isset($_FILES['profile'])) {
		$profile = 'custmer-photo/' . $_FILES['profile']['name'];

		// echo $_FILES['image']['name'].'<br>';

		if (!empty($_FILES['profile'])) {
			$path = "customer-photo/";
			$path = $path . basename($_FILES['profile']['name']);
			if (move_uploaded_file($_FILES['profile']['tmp_name'], $path)) {
				echo "The file " . basename($_FILES['profile']['name']) . " has been uploaded";
			} else {
				echo "There was an error uploading the file, please try again!";
			}
		}

	}
	global $customer_id, $name, $email, $password, $mobile, $address, $profile, $errors, $db;
	$customer_id = validate($_POST['customer_id']);
	$name = validate($_POST['full_name']);
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);
	$mobile = validate($_POST['phone_no']);
	$address = validate($_POST['address']);
	$profile = $_POST['profile'];
	$password = md5($password); // Encrypt password
	$sql = "INSERT INTO customer(Name,Email,Password,Mobile,Address,profile) VALUES('$name','$email','$password','$mobile','$address','$path')";
	if ($db->query($sql) === TRUE) {
		header("location:customer-login.php");
	}
}

function customer_login()
{
	global $email, $db;
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);

	$password = md5($password);
	$sql = "SELECT * FROM customer where Email='$email' AND Password='$password' LIMIT 1";
	$result = $db->query($sql);
	if ($result->num_rows == 1) {
		$data = $result->fetch_assoc();
		$logged_user = $data['Email'];
		$_SESSION['email'] = $logged_user;
		header('location:profile.php');
	} else {
		?>
		<div class="container mx-auto p-4">
			<div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
				<span>Incorrect Email/Password or not registered.</span>
				<span class="cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
				<div>
					Click here to <a href="customer-register.php" class="text-blue-200 underline"><b>Register</b></a>.
				</div>
			</div>
		</div>
		<?php
	}
}

function customer_update()
{
	global $owner_id, $full_name, $email, $password, $phone_no, $address, $id_type, $id_photo, $errors, $db;
	$customer_id = validate($_POST['customer_id']);
	$full_name = validate($_POST['full_name']);
	$email = validate($_POST['email']);
	$phone_no = validate($_POST['phone_no']);
	$address = validate($_POST['address']);
	$id_type = validate($_POST['id_type']);
	$password = md5($password); // Encrypt password
	$sql = "UPDATE customer SET full_name='$full_name',email='$email',phone_no='$phone_no',address='$address',id_type='$id_type' WHERE customer_id='$customer_id'";
	$query = mysqli_query($db, $sql);
	if (!empty($query)) {
		?>
		<div class="container mx-auto p-4">
			<div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
				<span>Incorrect Email/Password or not registered.</span>
				<span class="cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
				<div>
					Click here to <a href="customer-register.php" class="text-blue-200 underline"><b>Register</b></a>.
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