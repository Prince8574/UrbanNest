<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Product Addition - Responsive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-100 to-blue-100 p-4 md:p-8">
    <form id="productAdditionForm" class="glassmorphism p-6 md:p-12 w-full max-w-4xl" method="POST"
        enctype="multipart/form-data">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 md:mb-8 text-gray-800">Add New Product</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <div class="relative">
                <input type="text" id="product_name" name="product_name"
                    class="peer w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500 placeholder-transparent pt-4 bg-transparent"
                    placeholder="Product Name" required>
                <label for="product_name"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Product
                    Name</label>
            </div>

            <div class="relative">
                <input type="number" id="price" name="price" step="0.01" min="0"
                    class="peer w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500 placeholder-transparent pt-4 bg-transparent"
                    placeholder="Price" required>
                <label for="price"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Price
                </label>
            </div>

            <div class="relative md:col-span-2">
                <select id="category" name="category"
                    class="peer w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500 bg-transparent pt-4"
                    required>
                    <option value="" disabled selected>--Select Category--</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Home & Garden">Home & Garden</option>
                    <option value="Health & Beauty">Health & Beauty</option>
                    <option value="Sports">Sports</option>
                </select>
                <label for="category"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Category</label>
            </div>

            <div class="relative md:col-span-2">
                <textarea id="description" name="description" rows="4"
                    class="peer w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500 placeholder-transparent pt-4 bg-transparent resize-none"
                    placeholder="Description" required></textarea>
                <label for="description"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Description</label>
            </div>

            <div class="relative">
                <input type="number" id="quantity" name="quantity" min="0"
                    class="peer w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500 placeholder-transparent pt-4 bg-transparent"
                    placeholder="Quantity" required>
                <label for="quantity"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Quantity
                    in Stock</label>
            </div>

            <div class="relative">
                <input type="text" id="brand" name="brand"
                    class="peer w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-blue-500 placeholder-transparent pt-4 bg-transparent"
                    placeholder="Brand" required>
                <label for="brand"
                    class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Brand</label>
            </div>
        </div>

        <div class="mt-8">
            <label for="product_image" class="block text-gray-600 text-sm mb-2">Product Image</label>
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div id="imagePreview"
                    class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center cursor-pointer overflow-hidden">
                    <span class="text-gray-400">Upload</span>
                </div>
                <input type="file" id="product_image" name="product_image" class="hidden" accept="image/*">
                <button type="button" onclick="document.getElementById('product_image').click()"
                    class="glassmorphism px-6 py-3 rounded-md text-blue-600 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-300">
                    Choose Image
                </button>
            </div>
        </div>

        <button type="submit" value="Add Product" name="add_product"
            class="w-full mt-8 glassmorphism py-4 rounded-md text-blue-600 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-300 text-lg font-semibold">
            Add Product
        </button>
    </form>

    <script>
        // GSAP animations
        gsap.from("#productAdditionForm", { opacity: 0, y: 50, duration: 1, ease: "power3.out" });
        gsap.from("#productAdditionForm > *", { opacity: 0, y: 20, duration: 0.8, stagger: 0.1, ease: "power2.out" });

        // Custom cursor (only for desktop)
        const cursor = document.getElementById('customCursor');

        if (window.innerWidth >= 768) {
            const interactiveElements = document.querySelectorAll('button, input, textarea, select, #imagePreview');
            interactiveElements.forEach(element => {
                element.addEventListener('mouseenter', () => {
                    gsap.to(cursor, { scale: 1.5, duration: 0.3 });
                });
                element.addEventListener('mouseleave', () => {
                    gsap.to(cursor, { scale: 1, duration: 0.3 });
                });
            });
        }

        // Product image preview
        document.getElementById('productImage').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Product" class="w-full h-full object-cover">`;
                    gsap.from(imagePreview, { scale: 0.8, opacity: 0, duration: 0.5, ease: "back.out(1.7)" });
                }
                reader.readAsDataURL(file);
            }
        });

        // Form submission
        document.getElementById('productAdditionForm').addEventListener('submit', function (e) {
            e.preventDefault();
            // Here you would typically send the form data to your server
            console.log('Product Addition Form submitted');
            // Animate form on submission
            gsap.to("#productAdditionForm", {
                scale: 0.95,
                opacity: 0,
                duration: 0.5,
                ease: "power2.in",
                onComplete: () => {
                    alert('Product added successfully!');
                    this.reset();
                    gsap.to("#productAdditionForm", { scale: 1, opacity: 1, duration: 0.5, ease: "power2.out" });
                }
            });
        });
    </script>
</body>

</html>