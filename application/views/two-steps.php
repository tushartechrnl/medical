<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title><?=$this->lang->line('project_title');?> Verification</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?php echo base_url();?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Two-stes -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">


				<?php include("login_sidebar.php");?>


				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-600px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100 mb-10" novalidate="novalidate" id="kt_sing_in_two_steps_form" method="post">
								<!--begin::Icon-->
								<div class="text-center mb-10">
									<img alt="Logo" class="mh-125px" src="<?php echo base_url();?>assets/media/svg/misc/smartphone.svg" />
								</div>
								<!--end::Icon-->
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Two Step Verification</h1>
									<!--end::Title-->
									<!--begin::Sub-title-->
									<div class="text-muted fw-bold fs-5 mb-5">Enter the verification code we sent to your senior</div>
									<!--end::Sub-title-->
									<!--begin::Mobile no-->
									<!-- <div class="fw-bolder text-dark fs-3">******7859</div> -->
									<!--end::Mobile no-->
								</div>
								<!--end::Heading-->
								<!--begin::Section-->
								<div class="mb-10 px-md-10">
									<!--begin::Label-->
									<!-- <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Type your 6 digit security code</div> -->
									<!--end::Label-->
									<!--begin::Input group-->
									<div class="d-flex flex-wrap flex-stack">
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="user_otp[]" value="" />
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="user_otp[]" value="" />
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="user_otp[]" value="" />
										<input type="text" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" name="user_otp[]" value="" />
									</div>
									
									<?php
									if ($this->session->flashdata('failed_message')){
										?>
										<div class="alert alert-danger"><?php echo $this->session->flashdata('failed_message');?>
										</div>
										<?php
									}
									?>
									
										<div style="color: red;text-align: center;"><?php echo form_error('user_otp[]');?></div>
									<!--begin::Input group-->
								</div>
								<!--end::Section-->
								<!--begin::Submit-->
								<div class="d-flex flex-center">
									<button type="submit" id="" name="btn_submit_otp" class="btn btn-lg btn-primary fw-bolder">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Submit-->
							</form>
							<!--end::Form-->
							<!--begin::Notice-->
							<!-- <div class="text-center fw-bold fs-5">
								<span class="text-muted me-1">Didn’t get the code ?</span>
								<a href="#" class="link-primary fw-bolder fs-5 me-1">Resend</a>
								<span class="text-muted me-1">or</span>
								<a href="#" class="link-primary fw-bolder fs-5">Call Us</a>
							</div> -->
							<!--end::Notice-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Links-->
						<!-- <div class="d-flex flex-center fw-bold fs-6">
							<a href="https://keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">About</a>
							<a href="https://devs.keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
							<a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
						</div> -->
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Two-stes-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "<?php echo base_url();?>assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?php echo base_url();?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url();?>assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php echo base_url();?>assets/js/custom/authentication/sign-in/two-steps.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>