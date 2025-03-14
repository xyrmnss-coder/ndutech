<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/img/favicon.png" rel="icon">
    <link href="<?= base_url() ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #444;
            background: lightblue;
        }
        .container {
            display: flex;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 6px 24px rgba(0, 85, 170, 0.15);
            overflow: hidden;
            width: 800px;
        }
        .design-side {
            flex: 1;
            background: url('https://cdn.dribbble.com/users/5178848/screenshots/14214525/media/06b90e38aac47c922f60778a67aac04e.png?compress=1&resize=1600x1200&vertical=top') no-repeat center center;
            background-size: cover;
        }
        .otp-container {
            flex: 1;
            padding: 35px;
            text-align: center;
        }
        .otp-container h2 {
            font-weight: 600;
            margin-bottom: 18px;
            color: #007acc;
            font-size: 26px;
        }
        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .otp-inputs input {
            width: 45px;
            height: 55px;
            font-size: 22px;
            text-align: center;
            border: 2px solid #cce7ff;
            border-radius: 12px;
            background: #f0f8ff;
            color: #007acc;
            transition: all 0.3s ease;
        }
        .otp-inputs input:focus {
            border-color: #007acc;
            background: #ffffff;
            outline: none;
        }
        .alert {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #5dade2, #007acc);
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            color: #ffffff;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #007acc, #5dade2);
            transform: translateY(-1px);
        }
    </style>
    <script>
        function combineOTP() {
            let otpInputs = document.querySelectorAll('.otp-inputs input');
            let hiddenInput = document.getElementById('otp');
            hiddenInput.value = Array.from(otpInputs).map(input => input.value).join('');
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="design-side"></div>
        <div class="otp-container">
            <h2 class="mb-3">OTP Verification</h2>
            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('message') ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('verify_otp') ?>" method="POST" onsubmit="combineOTP()">
                <div class="mb-3">
                    <div class="otp-inputs">
                        <input type="text" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <input type="text" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <input type="text" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <input type="text" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <input type="text" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <input type="text" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <input type="hidden" name="otp" id="otp">
                </div>
                <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
            </form>
        </div>
    </div>
</body>
</html>