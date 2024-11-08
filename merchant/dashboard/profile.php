<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-6 py-6">
        <?php
        include("../config/config.php");
        $u_email = $_SESSION["email"];

        $sql = "SELECT * from merchant where email='$u_email'";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {

                ?>
                <main class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-8">
                        <div class="mb-8 flex flex-col items-center animate-on-load">
                            <img id="profileImage" src="../<?php echo $rows['profile']; ?>" alt="Profile Picture"
                                class="w-32 h-32 rounded-full object-cover mb-4">
                            <h2 class="text-2xl font-semibold text-gray-700" id="userName"><?php echo $rows['name']; ?></h2>
                        </div>

                        <section class="mb-8 animate-on-load">
                            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Personal Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="text-lg text-gray-800" id="userEmail"><?php echo $rows['email']; ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Phone</p>
                                    <p class="text-lg text-gray-800" id="userPhone"><?php echo $rows['mobile']; ?></p>
                                </div>
                            </div>
                        </section>

                        <section class="mb-8 animate-on-load">
                            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Shipping Address</h2>
                            <p class="text-lg text-gray-800" id="userAddress"><?php echo $rows['address']; ?></p>
                        </section>

                        <section class="mb-8 animate-on-load">
                            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Account Preferences</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Preferred Language</p>
                                    <p class="text-lg text-gray-800" id="userLanguage">English</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Preferred Currency</p>
                                    <p class="text-lg text-gray-800" id="userCurrency">USD</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Newsletter Subscription</p>
                                <p class="text-lg text-gray-800" id="userNewsletter">Subscribed</p>
                            </div>
                        </section>
                    </div>

                    <div class="bg-gray-50 px-8 py-4 animate-on-load">
                        <button id="updateProfileBtn"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">
                            Update Profile
                        </button>
                    </div>
                </main>
            </div>

            <!-- Edit Profile Modal -->
            <div id="editProfileModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg p-8 w-full max-w-2xl">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Profile</h2>
                    <form id="editProfileForm" method="POST">
                        <div class="mb-4 flex flex-col items-center">
                            <img id="editProfileImage" src="../<?php echo $rows['profile']; ?>" alt="Profile Picture"
                                class="w-32 h-32 rounded-full object-cover mb-4">
                            <label for="imageUpload" class="bg-blue-500 text-white rounded-full p-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </label>
                            <input type="file" id="imageUpload" class="hidden" accept="image/*">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="editName" name="name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="editEmail" name="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100" readonly>
                            </div>
                            <div>
                                <label for="editPhone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="tel" id="editPhone" name="phone"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="editAddress" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" id="editAddress" name="address"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="editLanguage" class="block text-sm font-medium text-gray-700">Preferred
                                    Language</label>
                                <select id="editLanguage" name="language"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option>English</option>
                                    <option>Spanish</option>
                                    <option>French</option>
                                    <option>German</option>
                                </select>
                            </div>
                            <div>
                                <label for="editCurrency" class="block text-sm font-medium text-gray-700">Preferred
                                    Currency</label>
                                <select id="editCurrency" name="currency"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option>USD</option>
                                    <option>EUR</option>
                                    <option>GBP</option>
                                    <option>JPY</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="editNewsletter" name="newsletter"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2">Subscribe to newsletter</span>
                            </label>
                        </div>
                        <div class="mt-6 flex justify-end space-x-2">
                            <button type="button" id="cancelEditBtn"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded transition duration-300 ease-in-out">
                                Cancel
                            </button>
                            <button type="submit" name="owner_update"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300 ease-in-out">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            }
        }
        ?>
    <script>
        // GSAP animations
        gsap.from('.animate-on-load', {
            opacity: 0,
            y: 20,
            stagger: 0.2,
            duration: 1,
            ease: 'power3.out'
        });

        const interactiveElements = document.querySelectorAll('button, input, select, label[for="imageUpload"]');
        interactiveElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                gsap.to(cursor, { scale: 1.5, duration: 0.3 });
            });
            element.addEventListener('mouseleave', () => {
                gsap.to(cursor, { scale: 1, duration: 0.3 });
            });
        });

        // Profile image upload
        const imageUpload = document.getElementById('imageUpload');
        const profileImage = document.getElementById('profileImage');
        const editProfileImage = document.getElementById('editProfileImage');

        imageUpload.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profileImage.src = e.target.result;
                    editProfileImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Edit profile modal functionality
        const updateProfileBtn = document.getElementById('updateProfileBtn');
        const editProfileModal = document.getElementById('editProfileModal');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const editProfileForm = document.getElementById('editProfileForm');

        updateProfileBtn.addEventListener('click', () => {
            editProfileModal.classList.remove('hidden');
            gsap.from(editProfileModal.children[0], {
                scale: 0.8,
                opacity: 0,
                duration: 0.3,
                ease: 'power2.out'
            });

            // Populate form with current user data
            document.getElementById('editName').value = document.getElementById('userName').textContent;
            document.getElementById('editEmail').value = document.getElementById('userEmail').textContent;
            document.getElementById('editPhone').value = document.getElementById('userPhone').textContent;
            document.getElementById('editAddress').value = document.getElementById('userAddress').textContent;
            document.getElementById('editLanguage').value = document.getElementById('userLanguage').textContent;
            document.getElementById('editCurrency').value = document.getElementById('userCurrency').textContent;
            document.getElementById('editNewsletter').checked = document.getElementById('userNewsletter').textContent === 'Subscribed';
        });

        cancelEditBtn.addEventListener('click', () => {
            gsap.to(editProfileModal.children[0], {
                scale: 0.8,
                opacity: 0,
                duration: 0.3,
                ease: 'power2.in',
                onComplete: () => {
                    editProfileModal.classList.add('hidden');
                }
            });
        });

        editProfileForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // Update user data
            document.getElementById('userName').textContent = document.getElementById('editName').value;
            document.getElementById('userEmail').textContent = document.getElementById('editEmail').value;
            document.getElementById('userPhone').textContent = document.getElementById('editPhone').value;
            document.getElementById('userAddress').textContent = document.getElementById('editAddress').value;
            document.getElementById('userLanguage').textContent = document.getElementById('editLanguage').value;
            document.getElementById('userCurrency').textContent = document.getElementById('editCurrency').value;
            document.getElementById('userNewsletter').textContent = document.getElementById('editNewsletter').checked ? 'Subscribed' : 'Not Subscribed';

            // Close modal
            gsap.to(editProfileModal.children[0], {
                scale: 0.8,
                opacity: 0,
                duration: 0.3,
                ease: 'power2.in',
                onComplete: () => {
                    editProfileModal.classList.add('hidden');
                }
            });

            // Show success message (you can replace this with a more sophisticated notification system)
            alert('Profile updated successfully!');
        });
    </script>
</body>

</html>