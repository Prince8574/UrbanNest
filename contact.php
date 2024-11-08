<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Your E-commerce Store</title>
</head>

<?php
session_start();
include('navbar.php');
?>

<body>
    <div class="bg-gradient-to-r from-purple-100 to-pink-100 min-h-screen flex items-center justify-center">
        <div class="container mx-auto p-4 md:p-8">
            <h1 class="text-4xl font-bold mb-6 text-center text-purple-800 opacity-1" id="pageTitle">Contact Us</h1>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $subject = $_POST['subject'];
                $message = $_POST['message'];

                $to = "ecomerce123@gmail.com";
                $headers = "From: $email";
                $email_body = "You have received a new message from your website contact form.\n\n" .
                    "Name: $name\n" .
                    "Email: $email\n" .
                    "Subject: $subject\n" .
                    "Message:\n$message";

                if (mail($to, $subject, $email_body, $headers)) {
                    echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 opacity-0" role="alert" id="successMessage">
                        <strong class="font-bold">Thank you!</strong>
                        <span class="block sm:inline"> Your message has been sent successfully.</span>
                      </div>';
                } else {
                    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 opacity-0" role="alert" id="errorMessage">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline"> Sorry, there was an error sending your message. Please try again later.</span>
                      </div>';
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 opacity-1" id="contactForm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105"
                        id="name" name="name" type="text" placeholder="Your Name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105"
                        id="email" name="email" type="email" placeholder="your@email.com" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">
                        Subject
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105"
                        id="subject" name="subject" type="text" placeholder="Subject" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                        Message
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105"
                        id="message" name="message" placeholder="Your message here" rows="6" required></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-110"
                        type="submit" id="submitButton">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Page load animation
        window.addEventListener('load', () => {
            gsap.from("#pageTitle", { opacity: 0, y: -50, duration: 1, ease: "power3.out" });
            gsap.from("#contactForm", { opacity: 0, y: 50, duration: 1, delay: 0.5, ease: "power3.out" });

            // Animate success or error message if present
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');
            if (successMessage) {
                gsap.from(successMessage, { opacity: 0, y: -20, duration: 0.5, delay: 1 });
            }
            if (errorMessage) {
                gsap.from(errorMessage, { opacity: 0, y: -20, duration: 0.5, delay: 1 });
            }
        });

        // Hover animations
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('mouseenter', () => {
                gsap.to(input, { scale: 1.05, duration: 0.3, ease: "power1.out" });
            });
            input.addEventListener('mouseleave', () => {
                gsap.to(input, { scale: 1, duration: 0.3, ease: "power1.out" });
            });
        });

        // Click animation for submit button
        const submitButton = document.getElementById('submitButton');
        submitButton.addEventListener('click', (e) => {
            if (document.querySelector('form').checkValidity()) {
                e.preventDefault(); // Prevent immediate form submission
                gsap.to(submitButton, {
                    scale: 0.95,
                    duration: 0.1,
                    onComplete: () => {
                        gsap.to(submitButton, {
                            scale: 1,
                            duration: 0.1,
                            onComplete: () => {
                                document.querySelector('form').submit(); // Submit the form after animation
                            }
                        });
                    }
                });
            }
        });
    </script>

</body>