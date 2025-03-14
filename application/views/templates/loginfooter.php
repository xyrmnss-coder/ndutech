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

<script>

    function showPassword() {
      var pass = document.getElementById('yourPassword'); // Corrected ID
      var checkbox = document.getElementById('rememberMe');
      if (pass.type === "password") {
        pass.type = "text";
        checkbox.nextElementSibling.textContent = "Hide Password";
      } else {
        pass.type = "password";
        checkbox.nextElementSibling.textContent = "Show Password";
      }
    }

    setTimeout(function () {
      var flashMessage = document.getElementById('flashMessage');
      if (flashMessage) {
        flashMessage.style.display = 'none';
      }
    }, 3000);

</script>
  
</body>

</html>