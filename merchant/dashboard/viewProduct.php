<div class="container mx-auto p-6">
    <!-- Search Box -->
    <input type="text" id="myInput" onkeyup="viewProperty()" placeholder="Search..." title="Type in a name"
        class="px-4 py-2 border rounded-lg mb-4 w-full">

    <div>
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="text-left bg-gray-100">
                    <th class="px-4 py-2 border">Id.</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Image</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Brand</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Update</th>
                    <th class="px-4 py-2 border">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch products based on the current session's merchant email
                $u_email = $_SESSION['email'];
                $sql1 = "SELECT * from merchant where email='$u_email'";
                $result1 = mysqli_query($db, $sql1);

                if (mysqli_num_rows($result1) > 0) {
                    while ($rowss = mysqli_fetch_assoc($result1)) {
                        $owner_id = $rowss['id'];

                        $sql = "SELECT * from product where merchant='$owner_id'";
                        $result = mysqli_query($db, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr class="transition-transform duration-500 hover:scale-105 hover:bg-gray-50"
                                    id="row_<?php echo $rows['id']; ?>">
                                    <td class="px-4 py-2"><?php echo $rows['id']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['name']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['price']; ?></td>
                                    <td class="px-4 py-2"><img src="<?php echo $rows['image']; ?>" alt="<?php echo $rows['name']; ?>"
                                            width="50px"></td>
                                    <td class="px-4 py-2"><?php echo $rows['category']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['brand']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['description']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['quantity']; ?></td>
                                    <td class="px-4 py-2">
                                        <!-- Edit Button with a custom id and onclick -->
                                        <button type="button"
                                            class="btn btn-lg px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                                            data-id="<?php echo $rows['id']; ?>" data-name="<?php echo $rows['name']; ?>"
                                            data-price="<?php echo $rows['price']; ?>" data-image="<?php echo $rows['image']; ?>"
                                            data-category="<?php echo $rows['category']; ?>" data-brand="<?php echo $rows['brand']; ?>"
                                            data-description="<?php echo $rows['description']; ?>"
                                            data-quantity="<?php echo $rows['quantity']; ?>" onclick="openEditModal(this)">
                                            Edit
                                        </button>
                                    </td>
                                    <td class="px-4 py-2">
                                        <button type="button"
                                            class="btn btn-lg px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                                            id="deleteBtn<?php echo $rows['id']; ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div class="modal fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50 hidden z-50"
        id="myModalUpdate">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg transform scale-75 opacity-0">
            <div class="modal-header flex justify-between items-center mb-4">
                <button type="button" class="close text-xl font-bold" onclick="closeModal()">×</button>
                <h4 class="modal-title text-lg font-semibold">Update Product</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group mb-4">
                        <label for="product_name" class="text-sm font-medium">Name:</label>
                        <input type="text" class="form-control w-full p-3 border border-gray-300 rounded"
                            id="product_name" name="product_name">
                    </div>
                    <div class="form-group mb-4">
                        <label for="product_price" class="text-sm font-medium">Price:</label>
                        <input type="text" class="form-control w-full p-3 border border-gray-300 rounded"
                            id="product_price" name="product_price">
                    </div>
                    <div class="form-group mb-4">
                        <label for="product_image" class="text-sm font-medium">Image:</label>
                        <input type="text" class="form-control w-full p-3 border border-gray-300 rounded"
                            id="product_image" name="product_image" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label for="product_category" class="text-sm font-medium">Category:</label>
                        <select class="form-control w-full p-3 border border-gray-300 rounded" name="product_category"
                            id="product_category">
                            <option value="">--Select Category--</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Home & Garden">Home & Garden</option>
                            <option value="Health & Beauty">Health & Beauty</option>
                            <option value="Sports">Sports</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="product_brand" class="text-sm font-medium">Brand:</label>
                        <input type="text" class="form-control w-full p-3 border border-gray-300 rounded"
                            id="product_brand" name="product_brand">
                    </div>
                    <div class="form-group mb-4">
                        <label for="product_description" class="text-sm font-medium">Description:</label>
                        <textarea class="form-control w-full p-3 border border-gray-300 rounded"
                            id="product_description" name="product_description"></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="product_quantity" class="text-sm font-medium">Quantity:</label>
                        <input type="number" class="form-control w-full p-3 border border-gray-300 rounded"
                            id="product_quantity" name="product_quantity">
                    </div>
                    <button type="submit" name="update_product"
                        class="w-full bg-blue-500 text-white rounded-lg py-2 mt-4 hover:bg-blue-600">Update</button>
                </form>
            </div>
        </div>
    </div>

    <!-- GSAP Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
    <script>
        // Function to open the edit modal and pass data to the form
        function openEditModal(button) {
            // Extract the data from the button using data- attributes
            const product = {
                id: button.getAttribute('data-id'),
                name: button.getAttribute('data-name'),
                price: button.getAttribute('data-price'),
                image: button.getAttribute('data-image'),
                category: button.getAttribute('data-category'),
                brand: button.getAttribute('data-brand'),
                description: button.getAttribute('data-description'),
                quantity: button.getAttribute('data-quantity')
            };

            // Populate the modal form fields with the product data
            document.getElementById('product_id').value = product.id;
            document.getElementById('product_name').value = product.name;
            document.getElementById('product_price').value = product.price;
            document.getElementById('product_image').value = product.image;
            document.getElementById('product_category').value = product.category;
            document.getElementById('product_brand').value = product.brand;
            document.getElementById('product_description').value = product.description;
            document.getElementById('product_quantity').value = product.quantity;

            // Show the modal with GSAP animation
            gsap.fromTo("#myModalUpdate", { opacity: 0, scale: 0.75 }, { opacity: 1, scale: 1, duration: 0.5 });
            document.getElementById('myModalUpdate').classList.remove('hidden');
        }

        // Close modal with animation
        function closeModal() {
            gsap.to("#myModalUpdate", {
                opacity: 0, scale: 0.75, duration: 0.3, onComplete: () => {
                    document.getElementById('myModalUpdate').classList.add('hidden');
                }
            });
        }
    </script>
</div>