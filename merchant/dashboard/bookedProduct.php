<div class="container-fluid px-6 py-6">
    <!-- Search Box -->
    <div class="mb-6 flex justify-center">
        <input type="text" id="myInput" onkeyup="viewProperty()" placeholder="Search..." title="Type in a name"
            class="px-4 py-2 border rounded-lg w-full md:w-1/2 lg:w-1/3 xl:w-1/4 bg-gray-50 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table id="myTable" class="min-w-full table-auto">
            <!-- Table Header -->
            <thead>
                <tr class="bg-blue-500 text-white text-sm uppercase">
                    <th class="px-4 py-2 text-left">Id.</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Price</th>
                    <th class="px-4 py-2 text-left">Image</th>
                    <th class="px-4 py-2 text-left">Category</th>
                    <th class="px-4 py-2 text-left">Brand</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Quantity</th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody>
                <?php
                $u_email = $_SESSION['email'];
                $sql1 = "SELECT * from merchant where email='$u_email'";
                $result1 = mysqli_query($db, $sql1);

                if (mysqli_num_rows($result1) > 0) {
                    while ($rowss = mysqli_fetch_assoc($result1)) {
                        $owner_id = $rowss['id'];

                        $sql = "SELECT * from product where merchant='$owner_id' and booked>0";
                        $result = mysqli_query($db, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr class="transition-transform duration-500 hover:scale-105 hover:bg-gray-50"
                                    id="row_<?php echo $rows['id']; ?>">
                                    <td class="px-4 py-2"><?php echo $rows['id']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['name']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['price']; ?></td>
                                    <td class="px-4 py-2">
                                        <img src="<?php echo $rows['image']; ?>" alt="<?php echo $rows['name']; ?>" width="50px">
                                    </td>
                                    <td class="px-4 py-2"><?php echo $rows['category']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['brand']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['description']; ?></td>
                                    <td class="px-4 py-2"><?php echo $rows['quantity']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">No booked products found.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- GSAP Animation Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
<script>
    // Animate table rows when the page loads
    window.addEventListener('load', () => {
        gsap.from("#myTable tr", {
            opacity: 0,
            y: 20,
            stagger: 0.1,
            duration: 0.6,
            ease: "ease-out"
        });
    });

    // Function to filter the table rows based on the search input
    function viewProperty() {
        const input = document.getElementById('myInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('myTable');
        const rows = table.getElementsByTagName('tr');

        // Loop through all table rows and hide those that don't match the search query
        for (let i = 1; i < rows.length; i++) {
            const td = rows[i].getElementsByTagName('td');
            let match = false;

            // Check if any cell in the row contains the search text
            for (let j = 0; j < td.length; j++) {
                if (td[j] && td[j].innerText.toUpperCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }

            // Show or hide row based on whether it matches
            rows[i].style.display = match ? "" : "none";
        }
    }
</script>