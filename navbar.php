<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ecommerce</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
  <style>
    @keyframes gradient {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    .bg-gradient-animate {
      background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
      background-size: 400% 400%;
      animation: gradient 15s ease infinite;
    }
  </style>
</head>

<body>
  <div class="bg-white shadow-lg sticky top-0 z-50 transition-all duration-300 ease-in-out" id="navbar">
    <div class="container mx-auto py-4 px-6">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <a href="index.php" class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-animate">Ecommerce</a>
          <nav class="hidden md:flex space-x-4">
            <a href="index.php"
              class="text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out transform hover:scale-110">Home</a>
            <a href="products.php"
              class="text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out transform hover:scale-110">Products</a>
            <a href="about.php"
              class="text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out transform hover:scale-110">About
              Us</a>
            <a href="contact.php"
              class="text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out transform hover:scale-110">Contact</a>
          </nav>
        </div>
        <div class="flex items-center gap-4">
          <form action="#" method="GET" class="hidden md:flex">
            <input type="text" name="search" placeholder="Search products..."
              class="py-2 px-3 rounded-l-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 ease-in-out">
            <button type="submit"
              class="bg-blue-500 text-white py-2 px-4 rounded-r-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 ease-in-out">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd" />
              </svg>
            </button>
          </form>
          <div class="relative group">
            <button id="profileButton"
              class="text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out transform hover:scale-110 focus:outline-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </button>
            <ul id="profileDropdown"
              class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden transition-all duration-300 ease-in-out opacity-0 transform scale-95">
              <?php if (isset($_SESSION["email"]) && !empty($_SESSION['email'])) { ?>
                <li><a href="profile.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-t-lg">Profile</a>
                </li>
                <li><a href="booked-product.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Orders</a></li>
                <li><a href="wishlist-product.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Wishlist</a>
                </li>
                <li><a href="logout.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-b-lg">Logout</a>
                </li>
              <?php } else { ?>
                <li><a href="how-to-register.php"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-t-lg">Register</a></li>
                <li><a href="customer-login.php"
                    class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-b-lg">Login</a></li>
              <?php } ?>
            </ul>
          </div>
          <?php if (isset($_SESSION["email"]) && !empty($_SESSION['email'])) { ?>
            <div class="relative group">
              <button id="cartButton"
                class="text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out transform hover:scale-110 focus:outline-none">
                <a href="cart.php"
                  class="text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out transform hover:scale-110">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
                </a>
              </button>
            </div>
          <?php } ?>
        </div>
        <button id="mobileMenuButton"
          class="md:hidden text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
      <nav id="mobileMenu" class="md:hidden mt-4 hidden">
        <a href="index.php"
          class="block py-2 text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out">Home</a>
        <a href="products.php"
          class="block py-2 text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out">Products</a>
        <a href="about.php"
          class="block py-2 text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out">About Us</a>
        <a href="contact.php"
          class="block py-2 text-gray-600 hover:text-blue-500 transition duration-300 ease-in-out">Contact</a>
        <form action="#" method="GET" class="mt-4">
          <input type="text" name="search" placeholder="Search products..."
            class="w-full py-2 px-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 ease-in-out">
        </form>
      </nav>
    </div>
  </div>

  <script>
    const navbar = document.getElementById('navbar');
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
      if (window.scrollY > 0) {
        navbar.classList.add('py-2');
        navbar.classList.remove('py-4');
      } else {
        navbar.classList.add('py-4');
        navbar.classList.remove('py-2');
      }
    });

    // Profile dropdown toggle
    profileButton.addEventListener('click', () => {
      profileDropdown.classList.toggle('hidden');
      gsap.to(profileDropdown, {
        opacity: profileDropdown.classList.contains('hidden') ? 0 : 1,
        scale: profileDropdown.classList.contains('hidden') ? 0.95 : 1,
        duration: 0.2,
        ease: 'power2.out'
      });
    });

    // Mobile menu toggle
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      gsap.from(mobileMenu.children, {
        opacity: 0,
        y: -20,
        stagger: 0.1,
        duration: 0.3,
        ease: 'power2.out'
      });
    });

    // Close dropdowns when clicking outside
    window.addEventListener('click', (event) => {
      if (!event.target.closest('#profileButton') && !event.target.closest('#profileDropdown')) {
        profileDropdown.classList.add('hidden');
      }
    });

    // GSAP animations
    // Initial Animation for Navbar Links
    gsap.set('header a, header button,header form', { y: -20, opacity: 0 });
    gsap.to('header a, header button,header form', {
      y: 0,
      opacity: 1,
      stagger: 0.1,
      duration: 0.5,
      ease: 'power2.out',
      delay: 0.3
    });
  </script>
</body>

</html>