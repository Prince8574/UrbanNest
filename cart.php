<?php
session_start();
include("navbar.php");
include("config/config.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
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

        .buy-now-button {
            background: linear-gradient(145deg, #3490dc, #2779bd);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 6px 6px 12px #b8c9d9,
                -6px -6px 12px #ffffff,
                inset 0 0 0 rgba(255, 255, 255, 0);
        }

        .buy-now-button:hover {
            background: linear-gradient(145deg, #3b9eee, #2d87d4);
            box-shadow: 4px 4px 8px #b8c9d9,
                -4px -4px 8px #ffffff,
                inset 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .buy-now-button:active {
            background: linear-gradient(145deg, #2779bd, #3490dc);
            box-shadow: inset 4px 4px 8px #1c5a88,
                inset -4px -4px 8px #3490dc;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-gradient-to-br from-softblue to-softpink">
        <div class="loading-overlay">
            <div class="loading-spinner"></div>
        </div>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-bold mb-8 text-center text-gray-800 shadow-sm">Your Shopping Cart</h1>
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-3/5">
                    <!-- Cart Items -->
                    <?php
                    $subtotal = 0;

                    // Ensure the email is set
                    if (isset($_SESSION["email"])) {
                        $u_email = $_SESSION['email'];

                        // Use prepared statements to avoid SQL injection
                        $stmt = $db->prepare("
                            SELECT 
                                cart.id AS cart_id, 
                                customer.name AS customer_name, 
                                merchant.name AS merchant_name, 
                                product.name AS product_name, 
                                product.id AS product_id, 
                                product.price AS product_price, 
                                product.description AS product_description,
                                product.image AS product_image  
                            FROM 
                                cart
                            JOIN 
                                customer ON cart.customer_id = customer.id
                            JOIN 
                                merchant ON cart.merchant_id = merchant.id
                            JOIN 
                                product ON cart.product_id = product.id
                            WHERE 
                                customer.email = ?
                        ");

                        $stmt->bind_param("s", $u_email);
                        $stmt->execute();
                        $result3 = $stmt->get_result();

                        // Check if any results were returned
                        if ($result3->num_rows > 0) {
                            while ($row = $result3->fetch_assoc()) {
                                $subtotal += $row['product_price']; // Accumulate subtotal
                                echo '<div class="glassmorphism p-6 mb-6 product-card">
                                    <div class="flex flex-col md:flex-row justify-between items-center">
                                        <div class="flex items-center">
                                            <img src="./merchant/' . htmlspecialchars($row['product_image']) . '" alt="' . htmlspecialchars($row['product_name']) . '" class="w-24 h-24 object-cover rounded-md shadow-md">
                                            <div class="ml-4">
                                                <h2 class="text-xl font-bold text-gray-800">' . htmlspecialchars($row['product_name']) . '</h2>
                                                <p class="text-gray-600">$' . htmlspecialchars($row['product_price']) . '</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center mt-4 md:mt-0">
                                            <button class="bg-white shadow-neu-button px-3 py-1 rounded-l-md hover:bg-gray-100 transition duration-300">-</button>
                                            <span class="bg-white px-4 py-1">1</span>
                                            <button class="bg-white shadow-neu-button px-3 py-1 rounded-r-md hover:bg-gray-100 transition duration-300">+</button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between" >                                    
                                        <form action="product-engine.php" method="post">
                                        <input type="hidden" name="id" value="' . htmlspecialchars($row['product_id']) . '">
                                        <button type="submit" name="product_details"
                                        class="mt-4 text-blue-600 hover:text-blue-800 font-semibold">View
                                        Details</button>
                                        </form>
                                        <form action="addProduct.php" method="post">
                                        <input type="hidden" name="id" value="' . htmlspecialchars($row['cart_id']) . '">
                                        <button type="submit" name="remove_details"
                                        class="mt-4 text-red-600 hover:text-blue-800 font-semibold">Remove</button>
                                        </form>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo '<p class="text-gray-600 text-center">No items in your cart.</p>';
                        }

                        // Close connections
                        $stmt->close();
                    } else {
                        echo '<center><h1>Please log in to see your cart.</h1></center>';
                    }

                    // Close database connection
                    $db->close();
                    ?>
                </div>

                <div class="lg:w-2/5">
                    <div class="bg-white shadow-neu-card rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800">Order Summary</h2>
                        <div class="flex justify-between mb-2 text-gray-700">
                            <span>Subtotal</span>
                            <span>₹<?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        <div class="flex justify-between mb-2 text-gray-700">
                            <span>Shipping</span>
                            <span>₹<?php echo number_format($subtotal * 0.01, 2); ?></span>
                        </div>
                        <div class="flex justify-between mb-2 text-gray-700">
                            <span>Tax</span>
                            <span>₹<?php echo number_format($subtotal * 0.08, 2); ?></span> <!-- Assuming 8% tax -->
                        </div>
                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between mb-2 text-gray-800">
                                <span class="font-bold">Total</span>
                                <span
                                    class="font-bold">₹<?php echo number_format($subtotal + ($subtotal * 0.01) + ($subtotal * 0.08), 2); ?></span>
                            </div>
                        </div>
                        <button class="buy-now-button w-full mt-4">
                            Buy Now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Loading animation
            window.addEventListener('load', () => {
                gsap.to('.loading-overlay', {
                    opacity: 0,
                    duration: 0.5,
                    onComplete: () => {
                        document.querySelector('.loading-overlay').style.display = 'none';
                    }
                });

                gsap.from('.container > *', {
                    opacity: 0,
                    y: 20,
                    stagger: 0.1,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            });

            // Hover animation for product cards
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    gsap.to(card, {
                        scale: 1.05,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });

                card.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });

            // Buy Now button animation
            const buyNowButton = document.querySelector('.buy-now-button');

            buyNowButton.addEventListener('mouseenter', () => {
                gsap.to(buyNowButton, {
                    scale: 1.05,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            buyNowButton.addEventListener('mouseleave', () => {
                gsap.to(buyNowButton, {
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            buyNowButton.addEventListener('mousedown', () => {
                gsap.to(buyNowButton, {
                    scale: 0.95,
                    duration: 0.1,
                    ease: 'power2.out'
                });
            });

            buyNowButton.addEventListener('mouseup', () => {
                gsap.to(buyNowButton, {
                    scale: 1.05,
                    duration: 0.1,
                    ease: 'power2.out'
                });
            });
        </script>
    </div>
</body>