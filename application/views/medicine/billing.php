<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
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
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
								<!--begin::Card-->
								<div class="card">
									<!--begin::Card header-->
									<div class="card-header border-0 pt-6">

										<?php
						                         if($this->session->flashdata('success_message')){
						                          ?>

						                          <div class="alert alert-success">
						                            <?php echo $this->session->flashdata('success_message');?>
						                          </div>
						                          <?php
						                         }
						                ?>
						                <?php
						                         if($this->session->flashdata('failed_message')){
						                          ?>

						                          <div class="alert alert-danger">
						                            <?php echo $this->session->flashdata('failed_message');?>
						                          </div>
						                          <?php
						                         }
						                ?>

										<div class="card-title">
											<div class="card-body p-12">

												<!--begin::Form-->
												<form id="kt_modal_update_password_form" class="form" method="post" >

													<!--begin::Input group-->
													<div class="row mb-12">
														<!--begin::Col-->
														<div class="col-md-12 fv-row">
															<!--begin::Label-->
															<label class="required fs-12 fw-bold mb-2">Product Name</label>

															<select name="cart_stock_id" aria-label="Select Product" data-control="select2" data-placeholder="Select Product..." class="form-select form-select-solid form-select-lg">

																<option value="">Select Product...</option>
																
																<?php
																	foreach ($medicine_record as $key2 => $value2) {
																		$stock_unit="";

																		if($value2->stock_unit)$stock_unit=$value2->stock_unit;
																		?>
																			<option data-kt-flag="flags/indonesia.svg"
																			<?php
																			?>
																			 value="<?php echo $value2->stock_id;?>"><?php echo $value2->stock_product_name.' '.$stock_unit.' '.$value2->stock_uom.' '.$value2->stock_batch;?></option>
																		<?php
																	}
																?>
																
															</select>

															<div style="color: red;"><?php echo form_error('cart_stock_id'); ?></div>
															<!--end::Input-->
														</div>
														<!--end::Col-->
													</div>
													<!--end::Input group-->

											<div class="fv-row mb-4">
												<label class="required form-label fs-6 mb-2">IS Cutting</label>
											
												<!--begin::Input-->
												<input class="form-check-input me-3" name="is_cutting" type="radio" value="0" id="kt_modal_update_role_option_0" checked="checked">
												<!--end::Input-->
												<!--begin::Label-->
												<label class="form-check-label" for="kt_modal_update_role_option_0">
													<div class="fw-bolder text-gray-800">No</div>
												</label>
												<!--end::Label-->

												<!--begin::Input-->
												<input class="form-check-input me-3" name="is_cutting" type="radio" value="0" id="kt_modal_update_role_option_0" >
												<!--end::Input-->
												<!--begin::Label-->
												<label class="form-check-label" for="kt_modal_update_role_option_0">
													<div class="fw-bolder text-gray-800">Yes</div>
												</label>
												<!--end::Label-->
												<br>
												<label class="required form-label fs-6 mb-2">Quantity</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="cart_qty" autocomplete="off" value="1"/>

						                        <div style="color: red;"><?php echo form_error('cart_qty');?></div>
											</div>

													<!--begin::Actions-->
													<div class="row mb-5">
														<button type="submit" name="btn_submit_to_cart" class="btn btn-primary" data-kt-users-modal-action="submit">
															<span class="indicator-label">ADD</span>
															<span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														</button>
													</div>
													<!--end::Actions-->
												</form>
												<!--end::Form-->
											</div>
										</div>

										<!--begin::Card title-->
										<div class="card-title">


											<!--begin::Search-->
											<div class="d-flex align-items-center position-relative my-1">
												<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
												<span class="svg-icon svg-icon-1 position-absolute ms-6">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search user" />
											</div>
											<!--end::Search-->
										</div>
										<!--begin::Card title-->
										<!--begin::Card toolbar-->
										<div class="card-toolbar">
											<!--begin::Toolbar-->
											<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
												
												<!--begin::Add user-->
												
												<!-- <a href="<?php echo base_url().'user/export_user_list';?>" class="btn btn-primary">
												<span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
														<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
													</svg>
												</span>Export User</a> -->

											</div>
											<!--end::Toolbar-->
											<!--begin::Group actions-->
											<div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
												<div class="fw-bolder me-5">
												<span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
												<button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
											</div>
											<!--end::Group actions-->

										</div>
										<!--end::Card toolbar-->
									</div>
									<!--end::Card header-->
									<!--begin::Card body-->
									<div class="card-body py-4">
										<!--begin::Table-->
										<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

													<th class="min-w-125px">Sr. No. </th>
													<th class="min-w-125px">Product Name </th>
													<th class="min-w-125px">Unit </th>
													<th class="min-w-125px">UOM </th>
													<th class="min-w-125px">Batch </th>
													<th class="min-w-125px">Expiry </th>
													<th class="min-w-125px">Is Cutting </th>
													<th class="min-w-125px">Qty </th>
													<th class="min-w-125px">Amount </th>
													<th class="text-end min-w-100px">Actions</th>

												</tr>

											</thead>

											<tbody class="text-gray-600 fw-bold">
												<?php
												$total_gst=0;
												$total_discount=0;
												$total_amount=0;

												$total_net=0;
												$scheme_cal=0;
												

												if ($this->session->userdata('billing_record')) {
													$i=0;
													foreach ($medicine_record as $key => $value) {
														$i++;
														?>

												<tr>
													<td>
														<?php echo $value->stock_product_name;?>
													</td>
													<td><?php echo $value->stock_unit;?></td>
													<td><?php echo $value->stock_uom;?></td>
													<td><?php echo $value->stock_qty;?></td>
													<td><?php echo $value->stock_sch;?></td>
													<td><?php echo $value->stock_batch;?></td>
													<td><?php ?></td>
													<td><?php ?></td>
													<td><?php ?></td>
												</tr>

														<?php
													}
												}


												?>


											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->



						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">

								<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
									
									<!--begin::Card body-->
									<div class="card-body p-9">

						                    
										<!--begin::Form-->
										<form id="kt_modal_update_password_form" class="form" method="post" >

											<div class="fv-row mb-4">
												<label class=" form-label fs-6 mb-2">Total Amount : 0 Rs.</label>
												<input class="form-control form-control-lg form-control-solid" type="hidden" placeholder="" name="stock_bill_number" autocomplete="off" value=""/>

						                        <div style="color: red;"><?php echo form_error('stock_bill_number');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class=" form-label fs-6 mb-2">Discount</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="stock_bill_number" autocomplete="off" value=""/>

						                        <div style="color: red;"><?php echo form_error('stock_bill_number');?></div>
											</div>

											<div class="fv-row mb-4">
												<label class=" form-label fs-6 mb-2">Net Amount</label>
												<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="stock_bill_number" autocomplete="off" value=""/>

						                        <div style="color: red;"><?php echo form_error('stock_bill_number');?></div>
											</div>


											<div class="d-flex flex-column mb-7 fv-row">
												<!--begin::Label-->
												<label class="fs-6 fw-bold mb-2">
													<span class="">Doctor</span>
													
												</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select name="doctor_id" aria-label="Select Employee Post" data-control="select2" data-placeholder="Select Doctor..." class="form-select form-select-solid form-select-lg">
													<option value="">Select Doctor...</option>
													
													<?php
														foreach ($doctor_record as $key2 => $value2) {
															?>
																<option data-kt-flag="flags/indonesia.svg"
																
																 value="<?php echo $value2->user_id;?>"><?php echo $value2->user_first_name.' '.$value2->user_last_name;?></option>
															<?php
														}
													?>
													
												</select>
												<!--end::Input-->

						                        <div style="color: red;"><?php echo form_error('doctor_id');?></div>
											</div>
											<!--end::Input group-->


											<div class="d-flex flex-column mb-7 fv-row">
												<!--begin::Label-->
												<label class="fs-6 fw-bold mb-2">
													<span class="">Patient</span>
													
												</label>
												<!--end::Label-->
												<!--begin::Input-->
												<select name="patient_id" aria-label="Select Employee Post" data-control="select2" data-placeholder="Select Patient..." class="form-select form-select-solid form-select-lg">
													<option value="">Select Patient...</option>
													
													<?php
														foreach ($patient_record as $key2 => $value2) {
															?>
																<option data-kt-flag="flags/indonesia.svg"
																
																 value="<?php echo $value2->user_id;?>"><?php echo $value2->user_first_name.' '.$value2->user_last_name;?></option>
															<?php
														}
													?>
													
												</select>
													
												</select>
												<!--end::Input-->

						                        <div style="color: red;"><?php echo form_error('user_employee_type');?></div>
											</div>
											<!--end::Input group-->

											<!--begin::Actions-->
											<div class="text-center pt-15">
												<button type="submit" name="btn_add_med_stock" class="btn btn-primary" data-kt-users-modal-action="submit">
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
		<script type="text/javascript">
			 //$('#kt_table_users').DataTable().ajax.reload(); 
		</script>
	</body>
	<!--end::Body-->
</html>