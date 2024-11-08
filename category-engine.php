<?php
include('config/config.php');
include('navbar.php');
$category = $_POST['category'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        softblue: '#E6F3FF',
                        softpink: '#FFF0F5',
                    },
                    boxShadow: {
                        'neu-button': '5px 5px 10px #b8c9d9, -5px -5px 10px #ffffff',
                        'neu-card': '10px 10px 20px #b8c9d9, -10px -10px 20px #ffffff',
                    },
                },
            },
        }
    </script>
    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .add-to-cart-button {
            background: linear-gradient(145deg, #3490dc, #2779bd);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 4px 4px 8px #b8c9d9,
                -4px -4px 8px #ffffff,
                inset 0 0 0 rgba(255, 255, 255, 0);
        }

        .add-to-cart-button:hover {
            background: linear-gradient(145deg, #3b9eee, #2d87d4);
            box-shadow: 2px 2px 4px #b8c9d9,
                -2px -2px 4px #ffffff,
                inset 0 0 5px rgba(255, 255, 255, 0.2);
        }

        .add-to-cart-button:active {
            background: linear-gradient(145deg, #2779bd, #3490dc);
            box-shadow: inset 2px 2px 4px #1c5a88,
                inset -2px -2px 4px #3490dc;
        }
    </style>
</head>

<div class="min-h-screen bg-gradient-to-br from-softblue to-softpink">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6"><?php echo $category ?></h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            $sql = "SELECT * FROM product WHERE category = '$category'";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['id'];
                    $quantity = $row['quantity'];
                    $product_name = $row['name'];
                    $product_price = $row['price'];
                    $product_image = $row['image'];
                    $product_brand = $row['brand'];
                    $product_merchant = $row['merchant'];
                    ?>
                    <div class="group bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                        <img src="./merchant/<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>
                    class=" w-full h-64 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-500 transition duration-300">
                                <?php echo $product_name; ?>
                            </h3>
                            <p class="text-gray-600 mt-2">$<?php echo $product_price; ?></p>
                            <p class="text-gray-600 mt-2"><?php echo $product_brand; ?></p>
                            <p class="text-gray-600 mt-2">Quantity: <?php echo $quantity; ?></p>
                        </div>
                        <div class="flex justify-between items-center space-x-1 p-2">
                            <form action="product-engine.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                                <button type="submit" name="product_details"
                                    class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition-colors duration-200">View
                                    Details</button>
                            </form>
                            <form action="addProduct.php" method="post" class="flex justify-between items-center space-x-2">
                                <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="merchant" value="<?php echo $product_merchant; ?>">
                                <button type="submit" name="cart_product"
                                    class="bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition-colors duration-200">Add
                                    to Cart</button>
                                <button type="submit" name="wishlist_product"
                                    class="text-red-500 rounded-full hover:bg-red-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<h3 class='text-2xl font-semibold text-gray-800 mb-6'>No items found</h3>";
            }
            ?>
        </div>
    </div>
</div>