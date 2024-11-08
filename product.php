<?php
session_start();
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page with Gradient Background and GSAP</title>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.10.4/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.10.4/dist/ScrollTrigger.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #E6F3FF, #FFF0F5);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <?php
    include("./config/config.php");
    $p_id = $_SESSION["id"];
    $sql = "SELECT * from product where id='$p_id' LIMIT 1";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            ?>
            <div class="container mx-auto px-4 py-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Product Images -->
                    <div class="relative">
                        <img src="./merchant/<?php echo $rows['image'] ?>" alt="Product image"
                            class="w-full h-auto rounded-lg shadow-lg hover:scale-105 transition-transform duration-500 ease-in-out"
                            id="main-image">
                    </div>
                    <!-- Product Details -->
                    <div>
                        <h1 class="text-3xl font-bold mb-4"><?php echo $rows['name'] ?></h1>
                        <div class="flex items-center mb-4">
                            <div class="flex">
                                <span class="text-yellow-400">★</span>
                                <span class="text-yellow-400">★</span>
                                <span class="text-yellow-400">★</span>
                                <span class="text-yellow-400">★</span>
                                <span class="text-gray-400">★</span>
                            </div>
                            <span class="ml-2 text-gray-600">(128 reviews)</span>
                            <span class="ml-2 text-gray-600"><?php echo $rows['brand'] ?></span>
                        </div>
                        <p class="text-2xl font-bold mb-4">₹ <?php echo $rows['price'] ?>.00</p>
                        <p class="text-gray-600 mb-6"><?php echo $rows['description'] ?></p>

                        <div class="flex items-center space-x-4 mb-6">
                            <button id="decrease-qty" class="bg-gray-200 p-2 rounded hover:bg-gray-300">-</button>
                            <span id="quantity" class="text-lg">1</span>
                            <button id="increase-qty" class="bg-gray-200 p-2 rounded hover:bg-gray-300">+</button>
                        </div>
                        <form class="flex space-x-4 mb-6" action="addProduct.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $rows['id'] ?>">
                            <input type="hidden" name="merchant" value="<?php echo $rows['merchant'] ?>">
                            <button type="submit" name="buy_product"
                                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition-colors">Buy
                                Now</button>
                            <button type="submit" name="cart_product"
                                class="bg-transparent border border-blue-500 text-blue-500 px-6 py-2 rounded hover:bg-blue-500 hover:text-white transition-colors">Add
                                to Cart</button>
                            <button type="submit" name="wishlist_product"
                                class="bg-transparent border border-gray-300 text-gray-500 p-2 rounded hover:bg-red-500 hover:text-white transition-colors">
                                ♥
                            </button>
                        </form>
                    </div>
                </div>

                <!-- GSAP Scroll Animations -->
                <section class="mt-12" id="offers-section">
                    <h2 class="text-2xl font-bold mb-4">Special Offers</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                            <h3 class="text-xl font-semibold mb-2">Bundle Deal</h3>
                            <p>Buy these headphones with a portable charger and save 15%!</p>
                            <button
                                class="bg-blue-500 text-white px-6 py-2 mt-4 rounded hover:bg-blue-600 transition-colors">Shop
                                Bundle</button>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                            <h3 class="text-xl font-semibold mb-2">Limited Time Offer</h3>
                            <p>Get a free carrying case with your purchase (Ends in 2 days)</p>
                            <button
                                class="bg-blue-500 text-white px-6 py-2 mt-4 rounded hover:bg-blue-600 transition-colors">Claim
                                Offer</button>
                        </div>
                    </div>
                </section>

                <!-- Related Products Section -->
                <section class="mt-12">
                    <h2 class="text-2xl font-bold mb-4">Related Products</h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <?php
                        $sql = "SELECT * FROM product where category='$rows[category]' LIMIT 4";
                        $query = mysqli_query($db, $sql);

                        if (mysqli_num_rows($query) > 0) {
                            while ($rows = mysqli_fetch_assoc($query)) {
                                $property_id = $rows['id'];
                                ?>
                                <div class="bg-white p-4 rounded-lg shadow hover:scale-105 transition-transform">
                                    <img src="./merchant/<?php echo $rows['image']; ?>" alt="Related Product"
                                        class="w-full h-auto mb-2">
                                    <h3 class="font-semibold"><?php echo $rows['name']; ?></h3>
                                    <p class="text-gray-600">₹ <?php echo $rows['price']; ?>.00</p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <!-- Add more products -->
                    </div>
                </section>
            </div>
            <?php
        }
    }
    ?>
    <script>
        // GSAP animations for page load
        window.addEventListener('load', () => {
            gsap.from("#main-image", { duration: 1.5, opacity: 0, scale: 0.8, ease: "power3.out" });
            gsap.from("#offers-section", { scrollTrigger: "#offers-section", duration: 1, y: 100, opacity: 0 });
        });

        // Button click effects for quantity
        document.getElementById('increase-qty').addEventListener('click', () => {
            let qty = document.getElementById('quantity').textContent;
            document.getElementById('quantity').textContent = parseInt(qty) + 1;
        });

        document.getElementById('decrease-qty').addEventListener('click', () => {
            let qty = document.getElementById('quantity').textContent;
            document.getElementById('quantity').textContent = Math.max(1, parseInt(qty) - 1);
        });
    </script>
</body>

</html>