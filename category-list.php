<div class="container mx-auto px-4">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Product Categories</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Category Item -->
        <form action="category-engine.php" method="post">
            <input type="hidden" name="category" value="Clothing">
            <button type="submit" name="show_category"
                class="group bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                <img src="./images/clothes.png" alt="Clothing" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-500 transition duration-300">
                        Clothing
                    </h3>
                </div>
            </button>
        </form>
        <!-- Repeat the above structure for other categories -->
        <form action="category-engine.php" method="post">
            <input type="hidden" name="category" value="Electronics">

            <button type="submit" name="show_category"
                class="group bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                <img src="./images/electronics.png" alt="Electronics" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-500 transition duration-300">
                        Electronics
                    </h3>
                </div>
            </button>
        </form>
        <!-- Repeat the above structure for other categories -->

        <form action="category-engine.php" method="post">
            <input type="hidden" name="category" value="Home & Decor">
            <button type="submit" name="show_category"
                class="group bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                <img src="./images/home.png" alt="Home Decor" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-500 transition duration-300">
                        Home
                        Decor
                    </h3>
                </div>
            </button>
        </form>
        <!-- Repeat the above structure for other categories -->

        <!-- Add more category items as needed -->
    </div>
</div>