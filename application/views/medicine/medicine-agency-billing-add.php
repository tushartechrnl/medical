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

					<?php $this->load->view('side_bar.php'); ?>
					<?php //include "side_bar.php"; ?>


				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--header start-->
					<?php $this->load->view('header.php'); ?>
					<?php //include "header.php"; ?>
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
													<span class="">Medicine </span>
													
												</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select  id="medicine_id" name="medicine_id" aria-label="Select medicine" data-control="select2" data-placeholder="Select Category..." class="form-select form-select-solid form-select-lg">
													<option value="">Select Medicine...</option>
													
													<?php
														foreach ($medicine_category_list as $key2 => $value2) {
															?>
																<option data-kt-flag="flags/indonesia.svg"
																<?php
																if(isset($medicine_info->medicine_id))if ($medicine_info->medicine_id==$value2->med_id) {
																	echo "selected";
																}
																?>
																 value="<?php echo $value2->med_id;?>"><?php echo $value2->med_name.' '.$value2->med_unit;?></option>
															<?php
														}
													?>
													
												</select>
												<!--end::Input-->

						                        <div style="color: red;"><?php echo form_error('medicine_id');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class="required form-label fs-6 mb-2">Manufracturer (MFG/Mfac/By)</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_mfg" name="meds_mfg" autocomplete="off" value="<?php if(isset($medicine_info->meds_mfg)){echo $medicine_info->meds_mfg;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_mfg');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class="required form-label fs-6 mb-2">Unit</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_unit" name="meds_unit" autocomplete="off" value="<?php if(isset($medicine_info->meds_unit)){echo $medicine_info->meds_unit;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_unit');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class="required form-label fs-6 mb-2">Quantity</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_quantity" name="meds_quantity" autocomplete="off" value="<?php if(isset($medicine_info->meds_quantity)){echo $medicine_info->meds_quantity;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_quantity');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class=" form-label fs-6 mb-2">Scheme</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_scheme" name="meds_scheme" autocomplete="off" value="<?php if(isset($medicine_info->meds_scheme)){echo $medicine_info->meds_scheme;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_scheme');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class=" form-label fs-6 mb-2">Batch</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_batch" name="meds_batch" autocomplete="off" value="<?php if(isset($medicine_info->meds_batch)){echo $medicine_info->meds_batch;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_batch');?></div>
											</div>
											<div class="fv-row mb-4">
												<label class=" form-label fs-6 mb-2">Expiry</label>
												<input class="form-control form-control-lg form-control-solid" type="date" placeholder="" name="meds_expiry" autocomplete="off" value="<?php if(isset($medicine_info->meds_expiry)){echo $medicine_info->meds_expiry;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_expiry');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class="required form-label fs-6 mb-2">MRP</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_mrp" name="meds_mrp" autocomplete="off" value="<?php if(isset($medicine_info->meds_mrp)){echo $medicine_info->meds_mrp;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_mrp');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class="required form-label fs-6 mb-2">Rate</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder=""  id="meds_rate" name="meds_rate" autocomplete="off" value="<?php if(isset($medicine_info->meds_rate)){echo $medicine_info->meds_rate;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_rate');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class=" form-label fs-6 mb-2">Disc %</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_disc" name="meds_disc" autocomplete="off" value="<?php if(isset($medicine_info->meds_disc)){echo $medicine_info->meds_disc;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_disc');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class="required form-label fs-6 mb-2">HSN</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_hsn" name="meds_hsn" autocomplete="off" value="<?php if(isset($medicine_info->meds_hsn)){echo $medicine_info->meds_hsn;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_hsn');?></div>
											</div>
											<div class="fv-row mb-4">
												<label class="required form-label fs-6 mb-2">Gst %</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="meds_gst_per" name="meds_gst_per" autocomplete="off" value="<?php if(isset($medicine_info->meds_gst_per)){echo $medicine_info->meds_gst_per;}?>"/>

						                        <div style="color: red;"><?php echo form_error('meds_gst_per');?></div>
											</div>

											<!--begin::Actions-->
											<div class="text-center pt-15">
												<button type="submit" name="btn_add_med_cat" class="btn btn-primary" data-kt-users-modal-action="submit">
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

					<?php $this->load->view('footer.php'); ?>
					<?php //include "footer.php"; ?>

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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

		<script type="text/javascript">

			/*functionval_take();

			$(".employee_type_click").click(function() {
				
				functionval_take();

			});

			function functionval_take() {
				
				if ($('input[name="employee_type"]:checked').val()==1) {
					$(".permanant_field").show();
				}else{
					$(".permanant_field").hide();
				}

			}*/

            var base_url = '<?php echo base_url();?>';
			
			$('#medicine_id').on('change', function() {

            	var medicine_id=$("#medicine_id").val();
                //console.log(user_pincode);
                $.ajax({
                    type: "POST",
                    url: base_url + "medicine/get_medicine_details",
                    data: {'medicine_id': medicine_id},
                    dataType: "json",
                    success: function (response) {
                       //alert(response.med_id);
                       
               			$('#meds_mfg').val(response.med_mfg);
               			$('#meds_unit').val(response.med_unit);
               			$('#meds_scheme').val(response.med_scheme);
               			$('#meds_mrp').val(response.med_mrp);
               			$('#meds_rate').val(response.med_rate);
               			$('#meds_disc').val(response.med_disc);
               			$('#meds_hsn').val(response.med_hsn);
               			$('#meds_gst_per').val(response.med_gst_per);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
               			$('#meds_mfg').val(xhr.med_id);
                       //$('#second_owner_id_info').text("");
                       //$('#second_owner_id_info').text(xhr.responseText);
                        //alert(xhr.responseText);
                    }
                });

            });

		</script>
	</body>
	<!--end::Body-->
</html>