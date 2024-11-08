<?php
include("./config/config.php");
$errors = array();

if (isset($_POST['login'])) {
    login();
}
function login()
{
    global $db;
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $password = md5($password);
    $query = "SELECT * FROM customer where Email='$email' AND Password='$password' LIMIT 1";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $data = $result->fetch_assoc();
        $logged_user = $data['Email'];
        $_SESSION['email'] = $logged_user;
        header('location:profile.php');
        exit();
    } else {
        $query = "SELECT * FROM merchant where email='$email' AND password='$password' LIMIT 1";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            $data = $result->fetch_assoc();
            $logged_user = $data['email'];
            $_SESSION['email'] = $logged_user;
            header('location:merchant/merchant-index.php');
            exit();
        } else {
            $query = "SELECT * FROM admin where email='$email' AND password='$password' LIMIT 1";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) == 1) {
                $data = $result->fetch_assoc();
                $logged_user = $data['email'];
                $_SESSION['email'] = $logged_user;
                header('location:admin/admin-index.php');
                exit();
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