<?php
session_start();
include("navbar.php");
include("config/config.php");
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Orders</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
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
  <style>
    .glassmorphism {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(10px);
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .loading-spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #f3f3f3;
      border-top: 5px solid #3498db;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .add-to-cart-button {
      background: linear-gradient(145deg, #3490dc, #2779bd);
      color: white;
      padding: 8px 16px;
      border-radius: 50px;
      font-weight: bold;
      transition: all 0.3s ease;
      box-shadow: 4px 4px 8px #b8c9d9,
        -4px -4px 8px #ffffff,
        inset 0 0 0 rgba(255, 255, 255, 0);
    }

    .add-to-cart-button:hover {
      background: linear-gradient(145deg, #3b9eee, #2d87d4);
      box-shadow: 2px 2px 4px #b8c9d9,
        -2px -2px 4px #ffffff,
        inset 0 0 5px rgba(255, 255, 255, 0.2);
    }

    .add-to-cart-button:active {
      background: linear-gradient(145deg, #2779bd, #3490dc);
      box-shadow: inset 2px 2px 4px #1c5a88,
        inset -2px -2px 4px #3490dc;
    }
  </style>
</head>

<div class="min-h-screen bg-gradient-to-br from-softblue to-softpink">
  <div class="loading-overlay">
    <div class="loading-spinner"></div>
  </div>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800 shadow-sm">Orders</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <?php
      // Ensure the email is set
      if (isset($_SESSION["email"])) {
        $u_email = $_SESSION['email'];
        // Use prepared statements to avoid SQL injection
        $stmt = $db->prepare("
                    SELECT 
            cart.id AS cart_id, 
            customer.name AS customer_name, 
            merchant.name AS merchant_name, 
            product.name AS product_name, 
            product.price AS product_price, 
            product.description AS product_description,
            product.image AS product_image  -- Assuming the column name for the image is 'image_url'
        FROM 
            cart
        JOIN 
            customer ON cart.customer_id = customer.id
        JOIN 
            merchant ON cart.merchant_id = merchant.id
        JOIN 
            product ON cart.product_id = product.id
        WHERE 
            customer.email = ?"
        );

        $stmt->bind_param("s", $u_email);
        $stmt->execute();
        $result3 = $stmt->get_result();

        // Check if any results were returned
        if ($result3->num_rows > 0) {
          while ($row = $result3->fetch_assoc()) {
            echo '<div class="glassmorphism p-6 wishlist-card">
                                <div class="flex justify-between items-start mb-4">
                                    <img src="./merchant/' . htmlspecialchars($row['product_image']) . '" alt="' . htmlspecialchars($row['product_name']) . '" class="w-32 h-32 object-cover rounded-md shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800 mb-2">' . htmlspecialchars($row['product_name']) . '</h2>
                                <p class="text-gray-600 mb-4">Merchant: ' . htmlspecialchars($row['merchant_name']) . '</p>
                                <p class="text-gray-800 mb-4">Price: $' . htmlspecialchars($row['product_price']) . '</p>
                                <p class="text-gray-600 mb-4">' . htmlspecialchars($row['product_description']) . '</p>
                                <div class="flex justify-between items-center">
                                    <button class="text-blue-600 hover:text-blue-800 font-semibold">View Details</button>
                                    <button class="add-to-cart-button">Add to Cart</button>
                                </div>
                            </div>';
          }
        } else {
          echo '<p class="text-gray-600 text-center">No items in your ordered list.</p>';
        }

        // Close connections
        $stmt->close();
      } else {
        echo '<center><h1>Please log in to see your booked properties.</h1></center>';
      }

      // Close database connection
      $db->close();
      ?>
    </div>
  </div>
</div>

<script>
  // Loading animation
  window.addEventListener('load', () => {
    gsap.to('.loading-overlay', {
      opacity: 0,
      duration: 0.5,
      onComplete: () => {
        document.querySelector('.loading-overlay').style.display = 'none';
      }
    });

    gsap.from('.container > *', {
      opacity: 0,
      y: 20,
      stagger: 0.1,
      duration: 0.5,
      ease: 'power2.out'
    });
  });

  // Hover animation for wishlist cards
  document.querySelectorAll('.wishlist-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      gsap.to(card, {
        scale: 1.05,
        duration: 0.3,
        ease: 'power2.out'
      });
    });

    card.addEventListener('mouseleave', () => {
      gsap.to(card, {
        scale: 1,
        duration: 0.3,
        ease: 'power2.out'
      });
    });
  });

  // Add to Cart button animation
  document.querySelectorAll('.add-to-cart-button').forEach(button => {
    button.addEventListener('mouseenter', () => {
      gsap.to(button, {
        scale: 1.05,
        duration: 0.3,
        ease: 'power2.out'
      });
    });

    button.addEventListener('mouseleave', () => {
      gsap.to(button, {
        scale: 1,
        duration: 0.3,
        ease: 'power2.out'
      });
    });

    button.addEventListener('mousedown', () => {
      gsap.to(button, {
        scale: 0.95,
        duration: 0.1,
        ease: 'power2.out'
      });
    });

    button.addEventListener('mouseup', () => {
      gsap.to(button, {
        scale: 1,
        duration: 0.1,
        ease: 'power2.out'
      });
    });
  });
</script>