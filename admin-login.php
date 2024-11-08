<?php
session_start();
if (isset($_SESSION["email"])) {
  header("location:admin/admin-index.php");
}

include("navbar.php");
include("admin-engine.php");
?>

<div class="container mx-auto p-6">
  <h3 class="text-2xl font-bold text-center">Admin Login</h3>
  <hr class="my-4">
  <form method="POST" class="bg-white rounded-lg shadow-md p-8">
    <div class="mb-4">
      <label for="email" class="block text-gray-700">Email:</label>
      <input type="email" class="mt-1 block w-full border rounded-lg p-2" id="email" placeholder="Enter email"
        name="email" required>
    </div>
    <div class="mb-4">
      <label for="pwd" class="block text-gray-700">Password:</label>
      <input type="password" class="mt-1 block w-full border rounded-lg p-2" id="pwd" placeholder="Enter password"
        name="password" required>
    </div>
    <div class="mb-4">
      <a href="forgot-password-owner.php" class="text-blue-500 hover:underline">Lost your Password?</a>
    </div>
    <center>
      <input type="submit" id="submit" name="admin_login"
        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition" value="Login">
    </center>
  </form>
</div>