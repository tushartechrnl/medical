<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<title><?php echo $page_title;?></title>
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
		<link rel="shortcut icon" href="<?php echo base_url();?>/assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="<?php echo base_url();?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?php echo base_url();?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<!--begin::Brand-->
					<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						<!--begin::Logo-->
						<a href="<?php echo base_url();?>">
							<img alt="Logo" src="<?php echo base_url();?>/assets/media/logos/logo.png" class="h-25px logo" />
						</a>
						<!--end::Logo-->
						<!--begin::Aside toggler-->
						<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
							<span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Aside toggler-->
					</div>
					<!--end::Brand-->


					<?php $this->load->view("side_bar.php"); ?>


				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--header start-->
					
					<?php $this->load->view("header.php"); ?>
				    <!--header end-->
					
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<!--begin::Container-->
							<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
								<!--begin::Page title-->
								<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									<!--begin::Title-->
									<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"><?php echo $page_title;?></h1>
									<!--end::Title-->
									<!--begin::Separator-->
									<span class="h-20px border-gray-300 border-start mx-4"></span>
									<!--end::Separator-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="<?php echo base_url();?>" class="text-muted text-hover-primary">Home</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-300 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted"><?php echo $page_title;?></li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->

							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">

								<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
									
									<!--begin::Card body-->
									<div class="card-body p-9">

						                    
										<!--begin::Form-->
										<form id="kt_modal_update_password_form" class="form" method="post" >


											<div class="d-flex flex-column mb-7 fv-row">
												<!--begin::Label-->
												<label class="fs-6 fw-bold mb-2">
													<span class="required">Patient Name</span>
													
												</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select name="pre_patient_id" id="pre_patient_id" aria-label="Select patient name" data-control="select2" data-placeholder="Select Patient Name..." class="form-select form-select-solid form-select-lg">
													
													<?php


														foreach ($patient_list as $key2 => $value2) {
															?>
																<option data-kt-flag="flags/indonesia.svg"
																<?php 
																if(isset($prescription_info->pre_patient_id)){
																	if ($prescription_info->pre_patient_id==$value2->user_id) {
																		echo "selected";
																	}
																}
																?>
																 value="<?php echo $value2->user_id;?>"><?php echo $value2->user_first_name.' '.$value2->user_last_name.' / '.$value2->user_phone_number;?></option>
															<?php
														}
													?>
													
												</select>


												<input type="hidden" id="pre_id" name="pre_id" value="<?php if(isset($prescription_info->pre_id)){echo $prescription_info->pre_id;}?>">

						                        <div style="color: red;"><?php echo form_error('pre_patient_id');?></div>
											</div>

											<div class="d-flex flex-column mb-7 fv-row">
												<!--begin::Label-->
												<label class="fs-6 fw-bold mb-2">
													<span class="">Medicine</span>
												</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select name="pre_details[]" id="pre_details" aria-label="Select medicine" data-control="select2" data-placeholder="Select medicine..." class="form-select form-select-solid form-select-lg" multiple>
													<option value="">Select medicine...</option>
													
													<?php
														$pre_details_array = array();

														if (isset($prescription_info->pre_details)) {

															$pre_details_array = explode(',',$prescription_info->pre_details);

														}
														foreach ($medicine_list as $key2 => $value2) {
															?>
																<option data-kt-flag="flags/indonesia.svg"
																<?php
																if(isset($pre_details_array))if (in_array($value2->med_name, $pre_details_array)) {
																	echo "selected";
																}
																?>
																 value="<?php echo $value2->med_name;?>"><?php echo $value2->med_name;?></option>
															<?php
														}
													?>
													
												</select>
												<!--end::Input-->

						                        <div style="color: red;"><?php echo form_error('pre_details');?></div>
											</div>


											<div class="d-flex flex-column mb-7 fv-row">

												<table class="s-6 fw-bold mb-2" id="medicine_tab_list">
													<tbody>
															
														<!-- <tr>
															<td><input type="text" name="medicine_tab[]" value=""></td>
															<td><input type="text" name="medicine_weight[]" value="100mg"></td>
															<td><input type="text" name="medicine_timings[]" value="1+0+1"></td>
															<td><input type="text" name="medicine_day_course[]" value="5 Days"></td>
															<td><input type="text" name="medicine_tab_after_before[]" value="After Food"></td>
														</tr> -->
													</tbody>
												</table>
											</div>


											<div class="d-flex flex-column mb-7 fv-row">
												<!--begin::Label-->
												<label class="fs-6 fw-bold mb-2">
													<span class="">Lab Test</span>
												</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select name="pre_lab_test[]" aria-label="Select test" data-control="select2" data-placeholder="Select test..." class="form-select form-select-solid form-select-lg" multiple>
													<option value="">Select test...</option>
													
													<?php
													$pre_lab_test_array=array();
														if(isset($prescription_info->pre_lab_test))$pre_lab_test_array=explode(',',$prescription_info->pre_lab_test);

														foreach ($lab_test_list as $key2 => $value2) {
															?>
																<option data-kt-flag="flags/indonesia.svg"
																<?php
																if (in_array($value2->lab_test_name, $pre_lab_test_array)) {
																	echo "selected";
																}
																?>
																 value="<?php echo $value2->lab_test_name;?>"><?php echo $value2->lab_test_name;?></option>
															<?php
														}
													?>
													
												</select>
												<!--end::Input-->

						                        <div style="color: red;"><?php echo form_error('pre_lab_test');?></div>
											</div>

											<!--begin::Input group=-->
											<div class="fv-row mb-4">
												<label class="form-label fs-6 mb-2">Advice</label>
												<textarea class="form-control form-control-lg form-control-solid"  name="pre_advice"><?php if(isset($prescription_info->pre_advice))echo $prescription_info->pre_advice;?></textarea>
												
						                        <div style="color: red;"><?php echo form_error('pre_advice');?></div>
											</div>
											<!--end::Input group=-->


											<!--begin::Actions-->
											<div class="text-center pt-15">
												<button type="submit" name="btn_add_prescription" class="btn btn-primary" data-kt-users-modal-action="submit">
													<span class="indicator-label">Submit</span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
											</div>
											<!--end::Actions-->
										</form>
										<!--end::Form-->
									</div>
								</div>

							</div>
						</div>
					</div>
					<!--end::Content-->

					<?php $this->load->view("footer.php"); ?>

				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->

		<!--end::Main-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->

		<!--begin::Javascript-->
		<script>var hostUrl = "<?php echo base_url();?>/assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?php echo base_url();?>/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url();?>/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="<?php echo base_url();?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php echo base_url();?>/assets/js/custom/apps/user-management/users/list/table.js"></script>
		<script src="<?php echo base_url();?>/assets/js/custom/apps/user-management/users/list/export-users.js"></script>
		<script src="<?php echo base_url();?>/assets/js/custom/apps/user-management/users/list/add.js"></script>
		<script src="<?php echo base_url();?>/assets/js/widgets.bundle.js"></script>
		<script src="<?php echo base_url();?>/assets/js/custom/widgets.js"></script>
		<script src="<?php echo base_url();?>/assets/js/custom/apps/chat/chat.js"></script>
		<script src="<?php echo base_url();?>/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="<?php echo base_url();?>/assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="<?php echo base_url();?>/assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
		<script type="text/javascript">
			
    		function selectAll(){
				var items=document.getElementsByClassName('select_all');
				for(var i=0; i<items.length; i++){
					if(items[i].type=='checkbox')
						items[i].checked=true;
				}
			}
			
			function UnSelectAll(){
				var items=document.getElementsByClassName('select_all');
				for(var i=0; i<items.length; i++){
					if(items[i].type=='checkbox')
						items[i].checked=false;
				}
			}	
   			
   			$(document).ready(function(){
			  
			  	$("#pre_details").change(function(){

				  //alert($('#pre_details').val());
					
					$("#medicine_tab_list > tbody").html("");
					$.each($('#pre_details').val(), function(index, text) { 
						//alert(text)
						//$("#medicine_tab_list").empty();
				    	$('#medicine_tab_list tbody').append('<tr><td><input type="text" name="medicine_tab[]" value="'+text+'"></td><td><input type="text" name="medicine_weight[]" value="100mg"></td><td><input type="text" name="medicine_timings[]" value="1+0+1"></td><td><input type="text" name="medicine_day_course[]" value="5 Days"></td><td><input type="text" name="medicine_tab_after_before[]" value="After Food"></td></tr>');
					}); 

				});
			});
		</script>


	</body>
	<!--end::Body-->
</html>