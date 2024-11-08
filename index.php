<?php
session_start();
include("navbar.php");
?>
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

<div class="container mx-auto px-4 py-12">
  <div class="flex flex-col md:flex-row items-center justify-between">
    <div class="w-full md:w-1/2 mb-8 md:mb-0">
      <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4">Discover Our New Arrivals</h1>
      <p class="text-lg mb-6">Explore our latest products and find something special for yourself or your loved ones.
      </p>
      <a href="customer-login.php"
        class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-lg text-lg font-semibold shadow-lg focus:outline-none focus:ring focus:border-blue-300">Shop
        Now</a>
    </div>
    <div class="w-full md:w-1/2">
      <img src="./images/hero.png" alt="Hero Image" class="rounded-lg w-5/6 m-auto">
    </div>
  </div>
</div>
</section>
<section class="featured-products py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Featured Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <!-- Product Item -->
      <?php
      include("product-list.php");
      ?>
    </div>
  </div>
</section>
<section class="product-categories py-12">
  <?php include("category-list.php"); ?>
</section>
<section class="bg-gray-100 py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Customer Testimonials</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Testimonial Item 1 -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
          <p class="text-gray-700 mb-4">"Great products and excellent service! Will definitely shop here again."</p>
          <p class="text-gray-600">- John Doe</p>
        </div>
      </div>
      <!-- Testimonial Item 2 -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
          <p class="text-gray-700 mb-4">"Highly recommend! Fast shipping and quality items."</p>
          <p class="text-gray-600">- Jane Smith</p>
        </div>
      </div>
      <!-- Testimonial Item 3 -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
          <p class="text-gray-700 mb-4">"Love their customer support! Very helpful and responsive."</p>
          <p class="text-gray-600">- Michael Johnson</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">About Us</h2>
    <div class="text-gray-700 mb-6">
      <p>Your brand's story, mission, and values can be written here to give visitors a brief overview.</p>
    </div>
    <a href="about.php"
      class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-lg text-lg font-semibold focus:outline-none focus:ring focus:border-blue-300">Learn
      More</a>
  </div>
</section>
<section class="bg-gray-100 py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Newsletter Signup</h2>
    <form action="#" method="POST" class="max-w-lg mx-auto">
      <div class="flex items-center border-b border-b-2 border-blue-500 py-2">
        <input type="email" name="email" id="email" placeholder="Enter your email address"
          class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-lg font-semibold focus:outline-none focus:ring focus:border-blue-300">Subscribe</button>
      </div>
      <p class="text-gray-600 mt-2">Subscribe to our newsletter for updates, promotions, and product launches.</p>
    </form>
  </div>
</section>
<section class="bg-gray-100 py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Follow Us for More</h2>
    <div class="flex items-center justify-center space-x-6">
      <a href="#" class="text-gray-700 hover:text-blue-500 transition duration-300">
        <i data-lucide="facebook"></i>
      </a>
      <a href="#" class="text-gray-700 hover:text-blue-500 transition duration-300">
        <i data-lucide="twitter"></i>
      </a>
      <a href="#" class="text-gray-700 hover:text-blue-500 transition duration-300">
        <i data-lucide="linkedin"></i>
      </a>
    </div>
  </div>
</section>
<footer class="bg-gray-800 text-white">
  <div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Contact Information -->
      <div>
        <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
        <p class="text-gray-400 mb-2">123 Main Street, City</p>
        <p class="text-gray-400 mb-2">Phone: +123 456 7890</p>
        <p class="text-gray-400 mb-2">Email: info@example.com</p>
      </div>
      <!-- Quick Links -->
      <div>
        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
        <ul>
          <li><a href="#" class="text-gray-400 hover:text-blue-500 transition duration-300">Terms of Service</a></li>
          <li><a href="#" class="text-gray-400 hover:text-blue-500 transition duration-300">Privacy Policy</a></li>
          <li><a href="#" class="text-gray-400 hover:text-blue-500 transition duration-300">Shipping Information</a>
          </li>
        </ul>
      </div>
      <!-- Social Media Icons -->
      <div>
        <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-400 hover:text-blue-500 transition duration-300">
            <i data-lucide="facebook"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-blue-500 transition duration-300">
            <i data-lucide="twitter"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
<section class="bg-gray-100 py-12">
  <div class="container mx-auto px-4">
    <div class="flex justify-center items-center space-x-6">
      <i data-lucide="shield-plus"></i>
      <i data-lucide="banknote"></i>
      <i data-lucide="shield-check"></i>  
    </div>
  </div>
</section>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>