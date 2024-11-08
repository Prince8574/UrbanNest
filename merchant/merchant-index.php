<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard</title>
    <?php
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: ../index.php");
        exit();
    }

    include("./navbar.php");
    include("engine.php");
    ?>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <style>
        .custom-cursor {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: rgba(59, 130, 246, 0.5);
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div id="customCursor" class="custom-cursor"></div>
    <div class="container mx-auto py-6 flex">
        <?php include("./sidebar.php"); ?>
        <!-- Tab Content -->
        <div class="ml-6 flex-grow">
            <div class="tab-content">
                <div id="home" class="tab-pane active hidden">
                    <?php include("./dashboard/profile.php"); ?>
                </div>
                <div id="menu1" class="tab-pane hidden">
                    <?php include("./dashboard/addProduct.php"); ?>
                </div>
                <div id="menu2" class="tab-pane hidden">
                    <center>
                        <h3 class="text-xl font-bold">View Product</h3>
                    </center>
                    <?php include("./dashboard/viewProduct.php"); ?>
                </div>
                <div id="menu4" class="tab-pane hidden">
                    <center>
                        <h3 class="text-xl font-bold">Messages</h3>
                    </center>
                </div>
                <div id="menu6" class="tab-pane hidden">
                    <center>
                        <h3 class="text-xl font-bold">Booked Product</h3>
                    </center>
                    <?php include("./dashboard/bookedProduct.php"); ?>
                </div>
                <div id="menu3" class="tab-pane hidden">
                    <center>
                        <h3 class="text-xl font-bold">Update Product</h3>
                    </center>
                    <?php include("./dashboard/updateProduct.php"); ?>
                </div>
            </div>
        </div>
    </div>

    <script>

        // Function to show the selected tab
        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab-pane');
            tabs.forEach(tab => {
                tab.classList.add('hidden');
            });

            const activeTab = document.getElementById(tabId);
            activeTab.classList.remove('hidden');

            // Add animation using GSAP
            gsap.from(activeTab, { opacity: 0, duration: 0.5 });
        }

        // Example call to show the first tab on load
        document.addEventListener('DOMContentLoaded', () => {
            showTab('home'); // Show the home tab on page load
        });

        document.addEventListener('mousemove', (e) => {
            gsap.to(cursor, {
                x: e.clientX,
                y: e.clientY - 80,
                duration: 0.3,
                scale: 1.5,
                ease: "power2.out"
            });
        });
        document.addEventListener('mouseleave', () => {
            gsap.to(cursor, {
                opacity: 0,
                scale: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
        document.addEventListener('mouseenter', () => {
            gsap.to(cursor, {
                opacity: 1,
                duration: 0.3,
                scale: 1,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
        document.addEventListener('mousedown', (e) => {
            gsap.fromTo(cursor, {
                scale: 1.5
            }, {
                scale: 0.5,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
        document.addEventListener('mousedup', (e) => {
            gsap.fromTo(cursor, {
                scale: 0.5
            }, {
                scale: 1.5,
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    </script>
</body>

</html>