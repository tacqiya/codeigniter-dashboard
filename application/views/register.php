<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                    <h3>Admin</h3><!-- <img src="<?= base_url() ?>assets/images/logo.svg" alt="logo"> -->
                </div>
                <h4>New here?</h4>
                <h6 class="fw-light">Signing up is easy. It only takes a few steps</h6>
                <?= form_open(base_url('register')); ?><!-- <form class="pt-3"> -->
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Username">
                    <? form_error('username'); ?>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Email">
                    <? form_error('email'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                    <? form_error('password'); ?>
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                    </div>
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <input type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" value="SIGN UP">
                  </div>
                  <div class="text-center mt-4 fw-light"> Already have an account? <a href="<?= base_url('login') ?>" class="text-primary">Login</a>
                  </div>
                <?= form_close(); ?><!-- </form> -->
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/template.js"></script>
    <script src="<?= base_url() ?>assets/js/settings.js"></script>
    <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>