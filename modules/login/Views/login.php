<html lang="en">
<!--begin::Head-->

<head>
    <title>Wikusama Cafe POS - Login</title>
    <meta charset="utf-8" />
    <meta name="description" content="Jet admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords" content="Jet theme, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Jet HTML Pro - Bootstrap 5 HTML Multipurpose Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/products/jet-html-pro" />
    <meta property="og:site_name" content="Keenthemes | Jet HTML Free" />
    <link rel="canonical" href="https://preview.keenthemes.com/jet-html-pro" />
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/media/logos/favicon.ico" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" /> <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?= base_url() ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

</head>
<body id="kt_body" class="auth-bg">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(<?= base_url() ?>/assets/media/illustrations/sigma-1/14.png)">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="<?= base_url() ?>/main" class="mb-12">
                    <img alt="Logo" src="<?= base_url() ?>/assets/media/logos/logo-default.svg" class="h-60px" />
                </a>
                <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form class="form w-100" id="form-Login" action="javascript:onLogin()">
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">
                                Selamat datang di <br>
                            Aplikasi POS Wikusama Cafe</h1>
                        </div>
                        <div class="fv-row mb-10">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="uname" id="uname" autocomplete="off" placeholder="Username or Email" required />
                        </div>
                        <div class="fv-row mb-10">
                            <div class="d-flex justify-content-end">
                                <a href="<?= base_url() ?>/?page=authentication/base/password-reset" class="link-primary fs-6 fw-bolder">
                                    Forgot Password ?
                                </a>
                            </div>
                            <input class="form-control form-control-lg form-control-solid" type="password" id="user_password" name="user_password" autocomplete="off" placeholder="Password" required />
                        </div>
                        <div class="text-center">
                            <button type="submit" id="doLogin" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">
                                    Continue
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        BASE_URL = "<?php echo base_url() ?>";
    </script>
    <script src="<?= base_url() ?>/assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?= base_url() ?>/assets/js/scripts.bundle.js"></script>
    <script type="text/javascript" src="<?php $baseURL ?>/assets/js/helper.js?v=<?= time() ?>"></script>
    <!-- Block UI -->
	<script type="text/javascript" src="<?php $baseURL ?>/assets/plugins/blockui/jquery.blockui.js"></script>
</body>

</html>
<?php echo view('../../modules/login/Views/javascript') ?>