<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="{url}/uploads/logos/thumbs/logo.png" />

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{url}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{url}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

	</head>
	<body id="kt_body" class="bg-body">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #181c32">
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #FFFFFF;">Welcome to Appstarter</h1>
							<p class="fw-bold fs-2" style="color: #9e9e9e;">Discover Amazing Codeigniter <span>&#770;</span>4 and Metronic 8
								<br />with great build tools
							</p>
						</div>
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({url}/assets/media/illustrations/sketchy-1/12-dark.png"></div>
					</div>
				</div>
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
								<div class="fv-row mb-10">
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<input class="form-control form-control-lg form-control-solid" type="text" name="Email" value="appstarter@gmail.com" autocomplete="off" />
								</div>
								<div class="fv-row mb-10">
									<div class="d-flex flex-stack mb-2">
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
										<a href="" class="link-primary fs-6 fw-bolder">
											Forgot Password ?
										</a>
									</div>
									<input class="form-control form-control-lg form-control-solid" type="password" name="Password" value="@appstarter12345" autocomplete="off" />
								</div>
								<div class="fv-row mb-10">
									<div class="g-recaptcha" id="captcha" data-sitekey="{siteKey}"></div>
								</div>	
								<div class="text-center">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Continue</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
									<a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
										<img alt="Logo" src="{url}/assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />
										Continue with Google
									</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">var APP_URL = "{url}/";</script>

		<script src="{url}/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{url}/assets/js/scripts.bundle.js"></script>
		<script src="{url}/assets/js/custom/authentication/sign-in/general.js"></script>
		<script src="https://www.google.com/recaptcha/api.js"></script>

	</body>
</html>