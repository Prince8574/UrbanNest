<?php
ob_start(); // Start output buffering
session_start();

if (isset($_SESSION["email"])) {
  header("location:index.php");
  exit(); // Exit after header to stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Login</title>
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

<?php
include("navbar.php");
include("how-to-login.php")
  ?>

<body>
  <div class="flex min-h-screen ">
    <div class="hidden lg:flex w-1/2 bg-gradient-animate items-center justify-center">
      <div class="max-w-md text-center">
        <div class="text-primary-foreground">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <h1 class="mt-6 text-3xl font-bold text-primary-foreground">Welcome Back!</h1>
        <p class="mt-3 text-lg text-primary-foreground/80">Log in to access your account and start shopping.</p>
      </div>
    </div>
    <div class="flex flex-col justify-center w-full lg:w-1/2 p-8 lg:p-24">
      <div class="animate__animated animate__fadeInUp">
        <h2 class="text-3xl font-bold mb-6">Login</h2>
        <form action="" method="POST" class="space-y-4">
          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input id="email" name="email" type="email" placeholder="Enter your email"
              class="mt-2 p-2 border border-gray-300 rounded-md w-full">
            <?php if (isset($errors['email'])): ?>
              <p class="text-red-500 text-sm mt-1"><?php echo $errors['email']; ?></p>
            <?php endif; ?>
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-medium">Password</label>
            <div class="relative">
              <input id="password" name="password" type="password" placeholder="Enter your password"
                class="mt-2 p-2 border border-gray-300 rounded-md w-full">
              <button type="button" onclick="togglePasswordVisibility()"
                class="absolute right-3 top-1/2 transform -translate-y-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9z" />
                </svg>
              </button>
            </div>
            <?php if (isset($errors['password'])): ?>
              <p class="text-red-500 text-sm mt-1"><?php echo $errors['password']; ?></p>
            <?php endif; ?>
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out"
            name="login">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
              stroke="currentColor">
              <path fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd" />
            </svg> Log In
          </button>
        </form>

        <p class="mt-4 text-center">
          Don't have an account? <a href="how-to-register.php" class="text-blue-500 hover:underline">Register here</a>
        </p>
      </div>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      var passwordField = document.getElementById("password");
      if (passwordField.type === "password") {
        passwordField.type = "text";
      } else {
        passwordField.type = "password";
      }
    }

    // GSAP animations
    gsap.from('.animate__animated', { opacity: 0, y: 20, duration: 1, delay: 0.2 });
  </script>
</body>

</html>