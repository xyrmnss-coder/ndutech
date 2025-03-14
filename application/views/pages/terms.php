<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apps & Tech</title>
    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/img/favicon.png" rel="icon">
    <link href="<?= base_url() ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for Blue Theme -->
    <style>
        body {
            background-color: #e9f2f9; /* Light blue background */
            color: #003366; /* Dark blue text */
        }

        .navbar {
            background-color: #007bff; /* Blue navbar */
        }

        .navbar-brand, .nav-link {
            color: #ffffff !important; /* White text for navbar */
        }

        .container {
            background-color: #ffffff; /* White container background */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        h1, h2 {
            color: #007bff; /* Blue headings */
        }

        a {
            color: #007bff; /* Blue links */
        }

        a:hover {
            color: #0056b3; /* Darker blue on hover */
        }

        .footer {
            background-color: #007bff; /* Blue footer */
            color: #ffffff; /* White text */
            padding: 10px 0;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('login') ?>">Apps & Tech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('register') ?>">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="text-center mb-4">Terms and Conditions</h1>

        <p style="text-align: center;">
            Welcome to our website. By accessing or using our website, you agree to comply with and be bound by the following terms and conditions. If you do not agree to these terms, please do not use our website.
        </p>

        <h2>1. Intellectual Property</h2>
        <p>
            All content on this website, including text, graphics, logos, and images, is the property of our company and is protected by intellectual property laws. You may not use, reproduce, or distribute any content without our prior written permission.
        </p>

        <h2>2. User Responsibilities</h2>
        <p>
            You agree to use this website only for lawful purposes and in a way that does not infringe the rights of others or restrict their use of the website. Prohibited activities include but are not limited to:
        </p>
        <ul>
            <li>Harassing or causing distress to other users.</li>
            <li>Uploading or transmitting malicious software.</li>
            <li>Violating any applicable laws or regulations.</li>
        </ul>

        <h2>3. Limitation of Liability</h2>
        <p>
            We are not liable for any damages arising from your use of this website. This includes direct, indirect, incidental, or consequential damages. Your use of this website is at your own risk.
        </p>

        <h2>4. Changes to Terms</h2>
        <p>
            We reserve the right to modify these terms and conditions at any time. Any changes will be effective immediately upon posting on this page. Your continued use of the website constitutes acceptance of the updated terms.
        </p>

        <h2>5. Governing Law</h2>
        <p>
            These terms and conditions are governed by and construed in accordance with the laws of your jurisdiction. Any disputes arising from these terms will be subject to the exclusive jurisdiction of the courts in your jurisdiction.
        </p>

        <h2>6. Contact Us</h2>
        <p>
            If you have any questions about these terms and conditions, please contact us at:
        </p>
        <p>
            <strong>Email:</strong> support@ndutech.com<br>
            <strong>Phone:</strong> +1 (123) 456-7890
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Apps & Tech by NDUTech. All rights reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>