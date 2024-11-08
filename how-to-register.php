<?php
session_start();
if (isset($_SESSION["email"])) {
    header("location:index.php");
}
include("navbar.php");
?>
<section class="container mx-auto py-10">
    <div class="text-center">
        <h3 class="text-3xl font-bold mb-4">How do you want to Register?</h3>
        <hr class="border-t-2 border-gray-300 mb-6">
        <p class="mb-8 text-lg">If you want to register as a customer, click on the customer register button. Otherwise,
            click on the merchant register button.</p>
        <div class="flex justify-center space-x-4">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200"
                onclick="window.location.href='customer-register.php'">
                Customer Register
            </button>
            <button
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-200"
                onclick="window.location.href='merchant-register.php'">
                Merchant Register
            </button>
        </div>
    </div>
</section>