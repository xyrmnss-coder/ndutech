<main>
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-4 d-flex flex-column align-items-center justify-content-center">
            <div class="card mb-2">
              <div class="card-body">
                <div class="pt-1 pb-1">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter username & password to login</p>
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

                <?= form_open(base_url(), ['class' => 'row g-3 needs-validation', 'novalidate' => true]) ?>
                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="username" class="form-control" id="yourUsername" required>
                      <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="bi bi-eye"></i> <!-- Bootstrap Icons (eye icon) -->
                        </span>
                    </div>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <!--<div class="col-12">
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                          <label class="form-check-label" for="rememberMe">Remember Me</label>
                      </div>
                  </div>-->

                  <!-- CAPTCHA Section -->
                  <div class="col-12">
                    <div class="form-group">
                      <div id="captcha-img" class="text-center"><?= $image ?></div>
                      <input type="text" name="captcha_input" class="form-control" placeholder="Enter CAPTCHA" required>
                      <p class="text-center mt-2">Can't read the image? Click <a href="javascript:void(0);" class="refresh-captcha">here</a> to refresh.</p>
                    </div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>

                  <div class="col-12">
                    <p class="small mb-0">Don't have account? <a href="<?= base_url('register') ?>">Create an account</a></p>
                  </div>
                <?= form_close() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

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
      togglePasswordVisibility('yourPassword', 'togglePassword');
  });

/*
function showPassword() {
    const passwordInput = document.getElementById('yourPassword');
    const checkbox = document.getElementById('rememberMe');

    if (checkbox.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}*/

//document.getElementById('rememberMe').addEventListener('click', showPassword);

   $(document).ready(function() {
    $('a.refresh-captcha').on('click', function(e) {
      e.preventDefault(); 
      $.get('<?= base_url('NDUTechController/refreshCaptcha') ?>', function(data) {
        $('#captcha-img').html(data); 
      });
    });
  });
</script>
  
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