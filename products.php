<?php
session_start();
include("config/config.php");
include("navbar.php");

function getProducts($db)
{
    $products = [];
    $query = "SELECT id, name, price, image, category, brand, description, quantity, booked, merchant FROM product";
    $result = $db->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

$products = getProducts($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .product-row {
            overflow-x: hidden;
        }

        .product-slider {
            display: flex;
            transition: transform 0.5s ease;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-100 to-pink-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Our Products</h1>

        <div id="productContainer"></div>
    </div>

    <script>
        const products = <?php echo json_encode($products); ?>;

        const categories = products.reduce((acc, product) => {
            const category = product.category || "Others";
            if (!acc[category]) {
                acc[category] = { name: category, products: [] };
            }
            acc[category].products.push({
                id: product.id,
                name: product.name,
                price: parseFloat(product.price),
                image: product.image || './placeholder.svg',
                brand: product.brand,
                description: product.description,
                quantity: product.quantity,
                booked: product.booked,
                merchant: product.merchant
            });
            return acc;
        }, {});

        const categoriesArray = Object.values(categories);

        function createProductCard(product) {
            return `
                <div class="glassmorphism p-4 m-2 w-full sm:w-1/2 md:w-1/4 cursor-pointer product-card flex flex-col justify-between">
                    <div>
                        <div class="relative aspect-w-1 aspect-h-1 mb-4">
                            <img src="./merchant/${product.image}" alt="${product.name}" class="w-full h-full object-cover rounded-md">
                        </div>
                        <h3 class="font-semibold text-lg mb-1">${product.name}</h3>
                        <p class="text-gray-600 mb-2">$${product.price.toFixed(2)}</p>
                        <p class="text-gray-500 mb-1">Brand: ${product.brand}</p>
                        <p class="text-gray-400 text-sm mb-2">${product.description}</p>
                    </div>
                    <div class="flex justify-between items-center space-x-2">
                        <form action="product-engine.php" method="post">
                            <input type="hidden" name="id" value="${product.id}">
                            <button type="submit" name="product_details"
                            class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition-colors duration-200">View
                            Details</button>
                        </form>
                        <form action="addProduct.php" method="post" class="flex justify-between items-center space-x-2">
                                <input type="hidden" name="id" value="${product.id}">
                                <input type="hidden" name="merchant" value="${product.merchant}">
                                <button type="submit" name="cart_product"
                                    class="bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition-colors duration-200">Add
                                    to Cart</button>
                                <button type="submit" name="wishlist_product"
                                    class="text-red-500 rounded-full hover:bg-red-100 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                </button>
                        </form>
                    </div>
                </div>
            `;
        }

        function createCategorySection(category) {
            const productCards = category.products.map(createProductCard).join('');
            return `
                <div class="mb-12">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700">${category.name}</h2>
                    <div class="product-row relative">
                        <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md z-10 prev-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md z-10 next-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div class="product-slider">
                            ${productCards}
                        </div>
                    </div>
                </div>
            `;
        }

        function renderProducts() {
            const productContainer = document.getElementById('productContainer');
            productContainer.innerHTML = categoriesArray.map(createCategorySection).join('');
        }
        document.addEventListener('DOMContentLoaded', () => {
            renderProducts();
            // Add any additional slider functionality here
        });
    </script>
</body>

</html>