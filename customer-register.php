<?php
include("navbar.php");
?>

<div class="container mx-auto p-6">
  <h3 class="text-2xl font-bold text-center">Customer Registration</h3>
  <hr class="my-4">
  <form method="POST" action="customer-engine.php" enctype="multipart/form-data"
    class="bg-white rounded-lg shadow-md p-8">

    <!-- Circular image upload box -->
    <div class="flex justify-center mb-6">
      <label for="card_photo" class="cursor-pointer">
        <div class="relative w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
          <input type="file" id="card_photo" name="profile" accept="image/*"
            class="absolute inset-0 opacity-0 cursor-pointer" onchange="preview_image(event)" required>
          <img id="output_image" class="w-full h-full object-cover rounded-full" alt="Image preview"
            style="display: none;">
          <svg class="w-16 h-16 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
        </div>
      </label>
    </div>

    <div class="mb-4">
      <label for="full_name" class="block text-gray-700">Full Name:</label>
      <input type="text" class="mt-1 block w-full border rounded-lg p-2" id="full_name" placeholder="Enter Full Name"
        name="full_name" required>
    </div>

    <div class="mb-4">
      <label for="email" class="block text-gray-700">Email:</label>
      <input type="email" class="mt-1 block w-full border rounded-lg p-2" id="email" placeholder="Enter Email"
        name="email" required>
    </div>

    <div class="mb-4">
      <label for="password1" class="block text-gray-700">Password:</label>
      <input type="password" class="mt-1 block w-full border rounded-lg p-2" id="password1" placeholder="Enter Password"
        name="password" required>
    </div>

    <div class="mb-4">
      <label for="password2" class="block text-gray-700">Confirm Password:</label>
      <input type="password" class="mt-1 block w-full border rounded-lg p-2" id="password2"
        placeholder="Enter Password Again" required>
    </div>

    <div class="mb-4">
      <label for="phone_no" class="block text-gray-700">Phone No.:</label>
      <input type="number" class="mt-1 block w-full border rounded-lg p-2" id="phone_no" placeholder="Enter Phone No."
        name="phone_no" required>
    </div>

    <div class="mb-4">
      <label for="address" class="block text-gray-700">Address:</label>
      <input type="text" class="mt-1 block w-full border rounded-lg p-2" id="address" placeholder="Enter Address"
        name="address" required>
    </div>

    <hr class="my-4">
    <button id="submit" name="customer_register"
      class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition"
      onclick="return Validate()">Register</button>

    <div class="mt-4 text-right">
      <label class="text-gray-600">Register as a <a href="merchant-register.php"
          class="text-blue-500 underline">Merchant</a>?</label>
    </div>
  </form>
</div>

<script type='text/javascript'>
  function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function () {
      var output = document.getElementById('output_image');
      output.src = reader.result;
      output.style.display = 'block'; // Show the image
    }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
<script type="text/javascript">
  function Validate() {
    var password = document.getElementById("password1").value;
    var confirmPassword = document.getElementById("password2").value;
    if (password !== confirmPassword) {
      alert("Passwords do not match.");
      return false;
    }
    return true;
  }
</script>