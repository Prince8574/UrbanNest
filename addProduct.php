<?php
$errors = array();
session_start();
include('./config/config.php');
$customer_email = '';
if (isset($_SESSION['email'])) {
    $customer_email = $_SESSION['email'];
}
if (empty($customer_email)) {
    header("Location: customer-login.php");
    exit();
}
$sql = "SELECT * FROM customer where Email='$customer_email' LIMIT 1";
$result = $db->query($sql);
$data = $result->fetch_assoc();
$customer_id = $data['id'];
if ($db->connect_error) {
    echo "Error connecting database";
}


if (isset($_POST['buy_product'])) {
    buy_product();
}
if (isset($_POST['cart_product'])) {
    cart_product();
}
if (isset($_POST['wishlist_product'])) {
    wishlist_product();
}
if (isset($_POST['remove_details'])) {
    remove_details();
}
if (isset($_POST['remove_wishlist_product'])) {
    remove_wishlist_product();
}

function buy_product()
{
    global $product_id, $db, $customer_id;
    $product_id = validate($_POST['id']);
    $merchant_id = validate($_POST['merchant']);
    $sql = "INSERT INTO `cart` (`id`, `customer_id`, `merchant_id`, `product_id`) VALUES (NULL, '$customer_id', '$merchant_id', '$product_id')";
    $result = $db->query($sql);
    if ($result) {
        ?>
        <script>
            alert('Product added to cart');
            window.location.href = 'product.php';
        </script>
        <?php
    } else {
        ?>
        <div class="container mx-auto p-4">
            <div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
                <span>Product not added to cart</span>
                <span class="cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
                <div>
                    Click here to <a href="merchant-register.php" class="text-blue-200 underline"><b>Register</b></a>.
                </div>
            </div>
        </div>
        <?php
    }
}
function cart_product()
{
    global $product_id, $db, $customer_id;
    $product_id = validate($_POST['id']);
    $merchant_id = validate($_POST['merchant']);
    $sql = "INSERT INTO `cart` (`id`, `customer_id`, `merchant_id`, `product_id`) VALUES (NULL, '$customer_id', '$merchant_id', '$product_id')";
    $result = $db->query($sql);
    if ($result) {
        ?>
        <script>
            alert('Product added to cart');
            window.history.back();
        </script>
        <?php
    } else {
        ?>
        <div class="container mx-auto p-4">
            <div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
                <span>Product not added to cart</span>
                <span class="cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
                <div>
                    Click here to <a href="merchant-register.php" class="text-blue-200 underline"><b>Register</b></a>.
                </div>
            </div>
        </div>
        <?php
    }
}
function wishlist_product()
{
    global $product_id, $db, $customer_id;
    $product_id = validate($_POST['id']);
    $merchant_id = validate($_POST['merchant']);
    $sql = "INSERT INTO `wishlist` (`id`, `customer_id`, `merchant_id`, `product_id`) VALUES (NULL, '$customer_id', '$merchant_id', '$product_id')";
    $result = $db->query($sql);
    if ($result) {
        ?>
        <script>
            alert('Product added to Wishlist');
            window.history.back();
        </script>
        <?php
    } else {
        ?>
        <div class="container mx-auto p-4">
            <div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
                <span>Product not added to cart</span>
                <span class="cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
                <div>
                    Click here to <a href="merchant-register.php" class="text-blue-200 underline"><b>Register</b></a>.
                </div>
            </div>
        </div>
        <?php
    }
}
function remove_details()
{
    global $db;
    $cart_id = validate($_POST['id']);
    $sql = "DELETE FROM cart where id='$cart_id'";
    $result = $db->query($sql);
    if ($result) {
        ?>
        <script>
            alert('Product removed from cart');
            window.history.back();
        </script>
        <?php
    } else {
        ?>
        <div class="container mx-auto p-4">
            <div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
                <span>Error while removing product</span>
                <span class="cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
                <div>
                    Click here to <a href="merchant-register.php" class="text-blue-200 underline"><b>Register</b></a>.
                </div>
            </div>
        </div>
        <?php
    }
}
function remove_wishlist_product()
{
    global $db;
    $wishlist_id = validate($_POST['id']);
    $sql = "DELETE FROM wishlist where id='$wishlist_id'";
    $result = $db->query($sql);
    if ($result) {
        ?>
        <script>
            alert('Product removed from wishlist');
            window.history.back();
        </script>
        <?php
    } else {
        ?>
        <div class="container mx-auto p-4">
            <div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
                <span>Error while removing product</span>
                <span class="cursor-pointer" onclick="this.parentElement.style.display='none';">&times;</span>
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