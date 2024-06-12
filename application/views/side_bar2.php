
					<!--begin::Aside menu-->
					<div class="aside-menu flex-column-fluid">
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
									<!--  here show mb-1 -->
									<a href="<?php echo base_url().'dashboard';?>">
									<span class="menu-link <?php if($page_title=='Dashboard'){echo 'active';}?>">

										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Dashboard</span>
										
									</span>
									</a>

								</div>


								
								
								<?php
									if ($this->admin->check_user_access('machine-list')) {
										?>
								
		                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
		                    <span class="menu-link">
		                        <span class="menu-icon">
		                            <i class="bi bi-archive fs-3"></i>
		                        </span>
		                        <span class="menu-title">Maintenance</span>
		                        <span class="menu-arrow"></span>
		                    </span>
		                    <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;" kt-hidden-height="390">

								<?php
									if ($this->admin->check_user_access('stock')) {
										?>
								

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion  <?php if($page_title=='Stock'){echo 'here show';}?>">
									<!-- here show  -->
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Machine</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">

										<?php
										if ($this->admin->check_user_access('stock-category-list')) {
											?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Machine Type'){echo 'active';}?>" href="<?php echo base_url().'machine/machine_type';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Type</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Machine Make'){echo 'active';}?>" href="<?php echo base_url().'machine/machine_make';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Make</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Machine Type List'){echo 'active';}?>" href="<?php echo base_url().'machine/machine_maintenance_type';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Checklist</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Machine List'){echo 'active';}?>" href="<?php echo base_url().'machine/machine_list';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">List</span>
											</a>
										</div>

										
											<?php
										}
										?>
									</div>
								</div>
								
								
										<?php
									}
								?>


								<?php
									if ($this->admin->check_user_access('requisition')) {
										?>
								

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion  <?php if($page_title=='Requisition'){echo 'here show';}?>">
									<!-- here show  -->
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Requisition</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">

										<?php
										if ($this->admin->check_user_access('requisition-list')) {
											?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Maintenance List'){echo 'active';}?>" href="<?php echo base_url().'machine/maintenance_list';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Preventive Maintenance</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Break Down List'){echo 'active';}?>" href="<?php echo base_url().'machine/break_down_list';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Breakdown Maintenance</span>
											</a>
										</div>

											<?php
										}
										?>

									</div>
								</div>
								
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion  <?php if($page_title=='Requisition'){echo 'here show';}?>">
									<!-- here show  -->
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Log</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">

										<?php
											if ($this->admin->check_user_access('water-log-list')) {
												?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Maintenance List'){echo 'active';}?>" href="<?php echo base_url().'waterlog';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Water</span>
											</a>
										</div>
											<?php
										}
										?>

										<?php
											if ($this->admin->check_user_access('electricity-log-list')) {
												?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Break Down List'){echo 'active';}?>" href="<?php echo base_url().'electricitylog';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Electricity</span>
											</a>
										</div>
											<?php
										}
										?>

										<?php
											if ($this->admin->check_user_access('dieselgenerator-log-list')) {
												?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Break Down List'){echo 'active';}?>" href="<?php echo base_url().'dieselgeneratorlog';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Diesel Generator</span>
											</a>
										</div>
											<?php
										}
										?>

									</div>
								</div>
							</div>


								
										<?php
									}
								?>



								
								<?php
									if ($this->admin->check_user_access('human-resource-list')) {
										?>
								
		                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
		                    <span class="menu-link">
		                        <span class="menu-icon">
		                            <i class="bi bi-archive fs-3"></i>
		                        </span>
		                        <span class="menu-title">Human Resource</span>
		                        <span class="menu-arrow"></span>
		                    </span>
		                    <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;" kt-hidden-height="390">

								<?php
									if ($this->admin->check_user_access('stock')) {
										?>
								

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion  <?php if($page_title=='Stock'){echo 'here show';}?>">
									<!-- here show  -->
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Requisition</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">

										<?php
										if ($this->admin->check_user_access('stock-category-list')) {
											?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Inspection Requisition'){echo 'active';}?>" href="<?php echo base_url().'humanresource/manpower_requisition';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Manpower</span>
											</a>
										</div>

										
											<?php
										}
										?>
									</div>
								</div>
								
								
										<?php
									}
								?>


								<?php
									if ($this->admin->check_user_access('requisition')) {
										?>
								

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion  <?php if($page_title=='Requisition'){echo 'here show';}?>">
									<!-- here show  -->
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Meetings</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">

								<?php
									if ($this->admin->check_user_access('meeting-list')) {
										?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Scheduled Meeting'){echo 'active';}?>" href="<?php echo base_url().'meeting/scheduled_meeting';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Scheduled</span>
											</a>
										</div>
											<?php
										}
										?>

										<?php
										if ($this->admin->check_user_access('unscheduled-meeting-list')) {
											?>

										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Unscheduled Meeting'){echo 'active';}?>" href="<?php echo base_url().'meeting/unscheduled_meeting';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Unscheduled</span>
											</a>
										</div>

											<?php
										}
										?>

									</div>
								</div>
								
								
										<?php
									}
								?>



		                    </div>
		                </div>

								
										<?php
									}
								?>



								
								<?php
									if ($this->admin->check_user_access('gate-keeping-list')) {
										?>
								

		                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
		                    <span class="menu-link">
		                        <span class="menu-icon">
		                            <i class="bi bi-archive fs-3"></i>
		                        </span>
		                        <span class="menu-title">Gate Keeping</span>
		                        <span class="menu-arrow"></span>
		                    </span>
		                    <div class="menu-sub menu-sub-accordion menu-active-bg" style="display: none; overflow: hidden;" kt-hidden-height="390">

								<?php
									if ($this->admin->check_user_access('stock')) {
										?>
								

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion  <?php if($page_title=='Stock'){echo 'here show';}?>">
									<!-- here show  -->
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Vehicle</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">

										<?php
										if ($this->admin->check_user_access('stock-category-list')) {
											?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Machine Type'){echo 'active';}?>" href="<?php echo base_url().'machine/machine_type';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Vehicle List</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Machine Make'){echo 'active';}?>" href="<?php echo base_url().'machine/machine_make';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Vehicle Checked In</span>
											</a>
										</div>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Machine Type List'){echo 'active';}?>" href="<?php echo base_url().'machine/machine_maintenance_type';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Vehicle History</span>
											</a>
										</div>
										
											<?php
										}
										?>
									</div>
								</div>
											<?php
										}
										?>

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion  <?php if($page_title=='Gate Keeping'){echo 'here show';}?>">
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Gate Pass</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">

										<?php
										if ($this->admin->check_user_access('employee-vehical-list')) {
											?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Employee Vehicle'){echo 'active';}?>" href="<?php echo base_url().'gatekeeping/employee_vehicle';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Generate Gate Pass</span>
											</a>
										</div>

											<?php
										}
										?>

										<?php
										if ($this->admin->check_user_access('outsider-vehical-list')) {
											?>
										<!-- <div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Outsider Vehical'){echo 'active';}?>" href="<?php echo base_url().'gatekeeping/out_sider_vehical';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Outsider Vehical</span>
											</a>
										</div> -->

											<?php
										}
										?>

										<?php
										if ($this->admin->check_user_access('gate-pass-list')) {
											?>

										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Gate Pass History'){echo 'active';}?>" href="<?php echo base_url().'gatekeeping/gate_pass_history';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Gate Pass History</span>
											</a>
										</div>


											<?php
										}
										?>


									</div>
								</div>
								
								
										<?php
									}
								?>



								

								
								<?php
									if ($this->admin->check_user_access('out-pass-list')) {
										?>
								

								<div data-kt-menu-trigger="click" class="menu-item menu-accordion  <?php if($page_title=='Out Pass'){echo 'here show';}?>">
									<!-- here show  -->
									<span class="menu-link">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
													<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Out Pass</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg">

										<?php
										if ($this->admin->check_user_access('out-pass-list')) {
											?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Out Pass List'){echo 'active';}?>" href="<?php echo base_url().'gatekeeping/out_pass_list';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Out Pass List</span>
											</a>
										</div>
											<?php
										}
										?>
										<?php
										if ($this->admin->check_user_access('out-pass-list')) {
											?>
										<div class="menu-item">
											<a class="menu-link <?php if(@$sub_sidebar=='Out Pass History'){echo 'active';}?>" href="<?php echo base_url().'gatekeeping/out_pass_history';?>">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Out Pass History</span>
											</a>
										</div>


											<?php
										}
										?>


									</div>
								</div>
								
								
										<?php
									}
								?>


								
										<?php
									}
								?>
								
								</div>
								
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Aside Menu-->
					</div>
					<!--end::Aside menu-->