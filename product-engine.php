<?php

$product_id = '';
$name = '';

$errors = array();

$db = new mysqli('localhost', 'root', '', 'ecommerce');

if ($db->connect_error) {
    echo "Error connecting database";
}


if (isset($_POST['product_details'])) {
    product_details();
}

function product_details()
{
    global $product_id, $db;
    $product_id = validate($_POST['id']);
    echo $product_id;
    $sql = "SELECT * FROM product where id='$product_id' LIMIT 1";
    $result = $db->query($sql);
    if ($result->num_rows == 1) {
        session_start();
        $data = $result->fetch_assoc();
        $logged_product = $data['id'];
        $_SESSION['id'] = $logged_product;
        header('location:product.php');
    } else {
        ?>
        <div class="container mx-auto p-4">
            <div class="bg-red-600 text-white p-4 rounded-md flex justify-between items-center">
                <span>Product not found</span>
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