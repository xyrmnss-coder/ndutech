<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Apps & Tech</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url() ?>assets/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-2">
                <div class="card-body">
        
                  <div class="pt-2 pb-1">
                    <h5 class="card-title text-center pb-0 fs-4">Register Account</h5>
                  </div>

                  <!-- Display Flash Messages -->
                  <?php
                    $flash_message = $this->session->flashdata('flashmessages');
                    if (!empty($flash_message)) {
                        $message = $flash_message['message'];
                        $status = $flash_message['status'];
                        if ($status == 'negative') {
                            echo '<div class="alert alert-danger" id="flashMessage">' . $message . '</div>';
                        } else if ($status == 'positive') {
                            echo '<div class="alert alert-success" id="flashMessage">' . $message . '</div>';
                        }
                    }
                  ?>

                  <form class="row g-1 needs-validation" action="<?= base_url('register/process_registration') ?>" method="POST" onsubmit="return validatePassword()" novalidate>
   
                    <div class="mb-1">
                      <label for="accountname" class="form-label">Name</label>
                      <input type="text" class="form-control" id="accountname" name="accountname" placeholder="Enter your name" required>
                    </div>

                    <div class="mb-1">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                      <small class="form-text text-muted">Your username must be at least 5 characters long and unique.</small>
                    </div>

                    <div class="mb-1">
                      <label for="email" class="form-label">Email Address</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" required>
                    </div>

                    <div class="mb-1">
                        <label for="password" class="form-label">Password</label>
                        <div style="position: relative;">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required oninput="checkPasswordMatch()">
                            <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <i class="bi bi-eye"></i> 
                            </span>
                        </div>
                        <small class="form-text text-muted">Your password must be at least 8 characters long, include an uppercase letter and a special character.</small>
                    </div>

                    <div class="mb-2">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div style="position: relative;">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter your password" required oninput="checkPasswordMatch()">
                            <span id="toggleConfirmPassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <i class="bi bi-eye"></i> 
                            </span>
                        </div>
                        <small id="passwordMatchError" class="text-danger" style="display: none;">Passwords do not match.</small>
                    </div>

                    <div class="col-12">
                      <label for="terms" class="form-label">Privacy Notice</label>

                      <div class="mb-3 p-2" style="background-color: lightgrey;">
                        <p class="mb-1">
                          All personal information you have submitted will only be used to process your registration. This includes but is not limited to your name, email address, contact number, and other relevant details provided during registration.
                        </p>
                        <p class="mb-1">
                          By submitting your application, you agree to the following:
                        </p>
                        <ol class="mb-1">
                          <li>Your personal information will be stored securely and used solely for the purpose of processing your registration.</li>
                          <li>We will not share your personal information with third parties without your explicit consent, except as required by law.</li>
                          <li>You have the right to access, update, or request the deletion of your personal information at any time.</li>
                        </ol>
                        <p class="mb-1 mt-1">
                          If you have any questions or concerns regarding the use of your personal information, please contact us at support@ndutech.com.
                        </p>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the terms and conditions.</label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                          <div id="captcha-img" class="text-center"><?= $image ?></div>
                          <input type="text" name="captcha_input" class="form-control" placeholder="Enter CAPTCHA" required>
                          <p class="text-center mt-2">Can't read the image? Click <a href="javascript:void(0);" class="refresh-captcha">here</a> to refresh.</p>
                      </div>
                  </div>

                    <div class="col-12 mt-4">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>

                    <div class="col-12">
                        <p class="small mb-0">Already have an account? <a href="<?= base_url('login') ?>">Log in</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= base_url() ?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/quill/quill.js"></script>
  <script src="<?= base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url() ?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>assets/js/main.js"></script>

  <!-- Include reCAPTCHA Script -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>

    function togglePasswordVisibility(inputId, toggleId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(toggleId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.innerHTML = '<i class="bi bi-eye-slash"></i>'; 
        } else {
            passwordInput.type = "password";
            toggleIcon.innerHTML = '<i class="bi bi-eye"></i>'; 
        }
    }

    document.getElementById('togglePassword').addEventListener('click', function() {
        togglePasswordVisibility('password', 'togglePassword');
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        togglePasswordVisibility('confirm_password', 'toggleConfirmPassword');
    });

    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const errorElement = document.getElementById('passwordMatchError');

        if (password !== confirmPassword) {
            errorElement.style.display = 'block';
        } else {
            errorElement.style.display = 'none';
        }
    }

    function validatePassword() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        var passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;

        if (!passwordPattern.test(password)) {
            alert('Your password must be at least 8 characters long and include an uppercase letter and a special character.');
            return false;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match. Please check and try again.');
            return false;
        }

        return true;
    }

    setTimeout(function () {
      var flashMessage = document.getElementById('flashMessage');
      if (flashMessage) {
        flashMessage.style.display = 'none';
      }
    }, 6000);

    $(document).ready(function() {
      $('a.refresh-captcha').on('click', function(e) {
          e.preventDefault();
          $.get('<?= base_url('NDUTechController/refreshCaptcha') ?>', function(data) {
              $('#captcha-img').html(data); 
          });
      });
  });

  </script>

</body>

</html>

<style type="text/css">
  #captcha-img {
      margin-bottom: 15px;
      text-align: center;
  }

  input[name="captcha_input"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
  }

  .refresh-captcha {
      color: #007bff;
      text-decoration: none;
  }

  .refresh-captcha:hover {
      text-decoration: underline;
  }
</style>
