<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="">
	<meta charset="utf-8" />
	<title>APLIKASI POS | Do'a Ibu Coffee</title>
	<meta name="description" content="Jet admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
	<meta name="keywords" content="Jet theme, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
	<link rel="canonical" href="Https://preview.keenthemes.com/jet-free" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="<?php $baseURL ?>/assets/media/logos/favicon.png" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="<?php $baseURL ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php $baseURL ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

	<!-- begin::CustomCSS -->
	<!-- LDS Loading CSS -->
	<link href="<?php $baseURL ?>/assets/css/custom-css/lds.css" rel="stylesheet" type="text/css" />
	<!-- End:CustomCSS -->
	<!-- datepicker -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- moment -->
	<script src="https://momentjs.com/downloads/moment.js"></script>

	<!-- datepicker -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>

	<!-- datatable -->
	<link href="<?php $baseURL ?>/assets/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js">

	<!-- select2 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2-bootstrap.min.css" integrity="sha512-Vr+A4cYbRn/wywBxGPCIcJJoniIymzzUhMjTTtT9rP+lUn5BNR1MSxCatMJtZ0QIlzLrddtpzdV+uSg2vQpPcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.css" integrity="sha512-WVPV4X/HI/9wClnD+CxFC0qSDE7blZgqZQLjrnEXQUhkm0nkDcoux3ysgIb3oG74MEHobuvEQg7W3XvZK9ZC/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-row flex-column-fluid">
			<!--begin::Aside-->
			<div id="kt_aside" class="aside aside-extended bg-white" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
				<!--begin::Primary-->
				<div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto bg-info bg-gradient">
					<!--begin::Logo-->
					<div class="aside-logo d-none d-lg-flex flex-column pt-5 my-5" id="kt_aside_logo">
						<a href="javascript:void(0)">
							<img alt="Logo" src="<?php $baseURL ?>/assets/media/logos/logo_dados_Dtok.png" class="h-60px" />
						</a>
					</div>
					<!--end::Logo-->
					<!--begin::Nav-->
					<div class="aside-nav d-flex w-100 pt-5 pt-lg-0" id="kt_aside_nav">
						<!--begin::Primary menu-->
						<div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5" data-kt-menu="true">
							<?= $menu ?>
						</div>
						<!--end::Primary menu-->
					</div>
					<!--end::Nav-->
				</div>
				<!--end::Primary-->
				<!--begin::Action-->
				<!--end::Action-->
			</div>
			<!--end::Aside-->
			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
					<!--begin::Container-->
					<div class="container-fluid d-flex align-items-stretch justify-content-between bg-dark bg-gradient" id="kt_header_container">
						<!--begin::Page title-->
						<div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
							<!--begin::Heading-->
							<h1 class="text-dark font-weight-bolder my-1 fs-2">Aplikasi Management Kasir
								<small class="text-muted fs-6 fw-normal ms-1"></small>
							</h1>
							<!--end::Heading-->
							<!--begin::Breadcrumb-->
							<ul class="breadcrumb fw-bold fs-base my-1">
								<li class="breadcrumb-item text-muted">
									<span class="text-muted">Do'a Ibu Coffee</span>
								</li>
							</ul>
							<!--end::Breadcrumb-->
						</div>
						<!--end::Page title=-->
						<!--begin::Wrapper-->
						<div class="d-flex d-lg-none align-items-center ms-n2 me-2">
							<!--begin::Aside mobile toggle-->
							<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
								<!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
								<span class="svg-icon svg-icon-2x">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
											<path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3" />
										</g>
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<!--end::Aside mobile toggle-->
							<!--begin::Logo-->
							<a href="index.html" class="d-flex align-items-center">
								<img alt="Logo" src="<?php $baseURL ?>/assets/media/logos/logo-compact.svg" class="max-h-40px" />
							</a>
							<!--end::Logo-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Toolbar wrapper-->
						<div class="d-flex align-items-stretch flex-shrink-0">
							<!--begin::User-->
							<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
								<!--begin::Menu wrapper-->
								<div class="cursor-pointer symbol symbol-30px symbol-md-40px" title="Options" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="bottom">
									<div class="symbol symbol-35px">
										<img alt="Logo" src="<?php $baseURL ?>/assets/media/avatars/150-24.jpg" />
									</div>
								</div>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<div class="menu-content d-flex align-items-center px-3">
											<!--begin::Avatar-->
											<div class="symbol symbol-50px me-5">
												<img alt="Logo" src="<?php $baseURL ?>/assets/media/avatars/150-24.jpg" />
											</div>
											<!--end::Avatar-->
											<!--begin::Username-->
											<div class="d-flex flex-column">
												<div class="fw-bolder d-flex align-items-center fs-5" id="sideUname"><?= $name ?>
												</div>
												<a href="javascript:void(0)" class="fw-bold text-muted text-hover-primary fs-7" id="sideEmail"><?= $email ?></a>
											</div>
											<!--end::Username-->
										</div>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu separator-->
									<div class="separator my-2"></div>
									<!--end::Menu separator-->
									<!--begin::Menu item-->
									<div class="menu-item px-5">
										<a href="javascript:void(0)" class="menu-link px-5 text-hover-danger" onclick="javascript:logout()">Sign Out</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
								<!--end::Menu wrapper-->
							</div>
							<!--end::User -->
						</div>
						<!--end::Toolbar wrapper-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Header-->
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid bg-secondary-custom bg-gradient" id="kt_content">
					<!-- begin::Container
					<div class="container" id="kt_content_container"> -->
					<!-- </div> -->
					<!--end::Container-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="footer py-4 d-flex flex-lg-column bg-dark bg-gradient" id="kt_footer">
					<!--begin::Container-->
					<div class="container-fluid d-flex flex-column flex-md-row flex-stack">
						<!--begin::Copyright-->
						<div class="text-dark order-2 order-md-1">
							<span class="text-gray-400 fw-bold me-1">Created by</span>
							<a href="javascript:void(0)" class="text-muted text-hover-primary fw-bold me-2 fs-6">Dados, Sampun Dalu</a>
						</div>
						<!--end::Copyright-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Root-->

	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotone/Navigation/Up-2.svg-->
		<span class="svg-icon">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<polygon points="0 0 24 0 24 24 0 24" />
					<rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10" rx="1" />
					<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
				</g>
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->
	<!--end::Main-->
	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="<?php $baseURL ?>/assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?php $baseURL ?>/assets/js/scripts.bundle.js"></script>
	<!-- Block UI -->
	<script type="text/javascript" src="<?php $baseURL ?>/assets/plugins/blockui/jquery.blockui.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.js" integrity="sha512-E/kDI3wGWMS9Ea/EsDJMduyGSSx/VfdNXAMr/URDQwOAGkGn3uYaZa4Y7bim3ad/6mMA82l+9FxNWl64BR9pkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/js/select2.full.min.js" integrity="sha512-rE0X9hnjMukCIay2mLEjgIvSq6KnARFMWw9DkyAcBe4vPvtx8U90RE8x1v9v0tcp+jTn3bLoHU6RZGEHWSWGNw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2_locale_id.min.js" integrity="sha512-D5OAT1N+957fKsON/GC4X9B7vaUaL8nUxNDyFwd9pvVU39UsWGaXPwtar7/xhtJZLnxGWPZSZ4hlPlzWbFaN9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<!-- datatable -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
	<!-- amchart -->
	<!-- <script src=""></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js" integrity="sha512-v3ygConQmvH0QehvQa6gSvTE2VdBZ6wkLOlmK7Mcy2mZ0ZF9saNbbk19QeaoTHdWIEiTlWmrwAL4hS8ElnGFbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- <script src="https://cdn.amcharts.com/lib/4/charts.js"></script> -->
	<!-- <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script> -->
	<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Micro.js"></script>
	<script>
		BASE_URL = "<?php echo base_url() ?>/";
	</script>
	<script type="text/javascript" src="<?php $baseURL ?>assets/plugins/datatables/datatables.bundle.js"></script>
	<!-- HELPER JS -->
	<script type="text/javascript" src="<?php $baseURL ?>/assets/js/helper.js?v=<?= time() ?>"></script>
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="<?php $baseURL ?>/assets/js/custom/widgets.js"></script>
	<!--end::Page Custom Javascript-->
	<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script> -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
<?php echo view('../../modules/main/Views/javascript') ?>