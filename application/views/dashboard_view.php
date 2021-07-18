  <!-- Main Content -->
  <div class="hk-pg-wrapper"  style="background-color: #00BCD4;">
  	<!-- Container -->
  	<div class="container mt-xl-50 mt-sm-30 mt-15">
  		<!-- Title -->
  		<div class="hk-pg-header">
		  <!-- <img class="alignnone" style="display: inline; margin: 0 10px;" title="heartica_logo" src="<?=base_url()?>assets/banner.png" alt="" width="150" height="50" /> -->

  			<div>
  				<h2 class="hk-pg-title font-weight-600 mb-10"> Dashboard</h2>
  				<!-- <p>Earnings from subscriptions that stared in the period 1 - 31 December 2018<i class="ion ion-md-help-circle-outline ml-5" data-toggle="tooltip" data-placement="top" title="Need help about earning stats"></i></p> -->
  			</div>

  		</div>
  		<!-- /Title -->

  		<!-- Row -->
  		<div class="row">
  			<div class="col-xl-12">
  				<!-- Page Alerts -->
  				<div style="display: none;" class="alert alert-primary alert-wth-icon alert-dismissible fade show" role="alert">
  					<span class="alert-icon-wrap"><i class="zmdi zmdi-help"></i></span> You're profile is waiting to be activated. Once done, you can request meetings with them.
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  						<span aria-hidden="true">×</span>
  					</button>
				  </div>
				  <div id="preloadfff" style="display: none;">
                <div class="preloader">
                                    <div class="spinner-layer pl-teal">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                    </div>

                                   <!-- Please wait as your file is being uploaded....  -->
                                   <span id="pop"></span>
                            
                </div>
  				<!-- /Page Alerts -->
  				<div class="hk-row">
  					<div class="col-md-3">
  						<div class="card card-sm">
  							<div class="card-body">
  								<div class="d-flex align-items-center justify-content-between">
  									<div>
  										<span class="d-block font-12 font-weight-500 text-dark text-uppercase mb-5"><b>Audit Reports</b></span>
  										<span class="d-block display-6 font-weight-400 text-dark"><?= count_all_audit_reports() ?></span>
  									</div>
  									<div>
  										<div id="sparkline_4"><i class="fa fa-area-chart" style="color:#ab26aa;"></i></div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  					<div class="col-md-3">
  						<div class="card card-sm">
  							<div class="card-body">
  								<div class="d-flex align-items-center justify-content-between">
  									<div>
  										<span class="d-block font-12 font-weight-500 text-dark text-uppercase mb-5"><b>My Reports</b></span>
  										<span class="d-block display-6 font-weight-400 text-dark"><?= count_my_audit_reports($user_id, $user_name) ?></span>
  									</div>
  									<div>
  										<div id="sparkline_4"><i class="fa fa-dashboard" style="color:#ab26aa;"></i></div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  					<div class="col-md-3">
  						<div class="card card-sm">
  							<div class="card-body">
  								<div class="d-flex align-items-center justify-content-between">
  									<div>
  										<span class="d-block font-12 font-weight-500 text-dark text-uppercase mb-5"><b>Files Uploaded</b></span>
  										<span class="d-block display-6 font-weight-400 text-dark"><?= count_my_uploaded_files($user_id, $user_name) ?></span>
  									</div>
  									<div>
  										<div id="sparkline_4"><i class="fa fa-upload" style="color:#ab26aa;"></i></div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>

  					<div class="col-md-3">
  						<div class="card card-sm">
  							<div class="card-body">
  								<div class="d-flex align-items-center justify-content-between">
  									<div>
  										<span class="d-block font-12 font-weight-500 text-dark text-uppercase mb-5"><b>Files Pending</b></span>
  										<span class="d-block display-6 font-weight-400 text-dark"><?= count_my_signed_reports($user_id, $user_name) ?></span>
  									</div>
  									<div>
  										<div id="sparkline_4"><i class="fa fa-file" style="color:#ab26aa;"></i></div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
  				<div class="row">
  					<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
  						<div class="card">
  							<div class="card-header">
  								<b>Add New Audit Report</b>
  							</div>
  							<div class="card-body">

  								<!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#newAuditReport">Add New</a> -->

  								 <button class="btn btn-primary btn-wth-icon btn-rounded icon-right" data-toggle="modal" data-target="#newAuditReport"><span class="btn-text">Add New</span> <span class="icon-label"><span class="feather-icon"><i data-feather="plus-circle"></i></span> </span>
                                        </button>

  							</div>

  						</div>
  					</div>
  					<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
  						<div class="card">
  							<div class="card-header">
  								<b>Archive Audit Files</b>
  							</div>
  							<div class="card-body">

  								<!-- <a href="javascript:uploadAudit()" class="btn btn-primary">Upload</a> -->
                                <a href="javascript:uploadAudit()">
  								<button class="btn btn-primary btn-wth-icon btn-rounded icon-right"><span class="btn-text">Upload</span> <span class="icon-label"><span class="feather-icon"><i data-feather="upload-cloud"></i></span> </span>
                                </button>
                               </a>
  							</div>

  						</div>
  					</div>

  					<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
  						<div class="card">
  							<div class="card-header">
  								View and Sign Audit Report
  							</div>
  							<div class="card-body">

  								<!-- <a href="javascript:signAudit()" class="btn btn-primary">Sign Report</a> -->

  								 <a href="javascript:signAudit()">
  								<button class="btn btn-primary btn-wth-icon btn-rounded icon-right"><span class="btn-text">Sign</span> <span class="icon-label"><span class="feather-icon"><i data-feather="check-square"></i></span> </span>
                                </button>
                               </a>

  							</div>

  						</div>
  					</div>

				  </div>
				  
				 <div class="row"> 

					<div class="col-md-6">
					<div class="card">
					<div class="card-header">
  								View and Sign Audit Report
  					</div>
						<div class="card-body">
							<div class="col-sm">
								<div class="table-wrap">
									<table id="table_dash_sign" class="table table-hover w-100 display pb-30">
										<!-- <table id="all-contacts" class="table table-hover w-100 display pb-30"> -->
										<thead>
											<tr>
												<th>#</th>
												<th>Ref No.</th>
												<th>Year End</th>
												<th>Client</th>
												<th>Date</th>
											</tr> 
										</thead>
										<tbody>
											
											<?php $count=1; if(!empty($createdAU)): foreach($createdAU as $data): if($data->report_state !="created"){continue;} ?>
												<tr>
													<td><?=$count++?></td>
													<td><?=$data->ref_no?></td>
													<td><?=$data->year_end?></td>
													<td><?=get_client_name($data->client_id)?></td>
													<?php $date= date_format(date_create($data->date_time),'d-m-Y')  ?>
													<td><?=$date?></td>


												</tr>
											<?php endforeach; endif; ?>	

										</tbody>
										<tfoot>
											<tr>
											    <th>#</th>
												<th>Ref No.</th>
												<th>Year End</th>
												<th>Client</th>
												<th>Date</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
					</div>

					<div class="col-md-6">
					<div class="card">
					<div class="card-header">
					SIGNED AUDIT REPORTS

  					</div>
						<div class="card-body">
							<div class="col-sm">
								<div class="table-wrap">
								<table id="table_dash_create" class="table table-hover w-100 display pb-30">
										<!-- <table id="all-contacts" class="table table-hover w-100 display pb-30"> -->
										<thead>
											<tr>
												<th>#</th>
												<th>Ref No.</th>
												<th>Year End</th>
												<th>Client</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											
										<?php $count=1; if(!empty($signedAU)): foreach($signedAU as $data): if($data->report_state !="signed"){continue;} ?>
												<tr>
													<td><?=$count++?></td>
													<td><?=$data->ref_no?></td>
													<td><?=$data->year_end?></td>
													<td><?=get_client_name($data->client_id)?></td>
													<?php $date= date_format(date_create($data->date_time),'d-m-Y')  ?>
													<td><?=$date?></td>


												</tr>
											<?php endforeach; endif; ?>	

										</tbody>
										<tfoot>
											<tr>
											    <th>#</th>
												<th>Ref No.</th>
												<th>Year End</th>
												<th>Client</th>
												<th>Date</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
					</div>


				</div>

				<!-- </div>    -->
				  

  			</div>
  		</div>
  		<!-- /Row -->
  	</div>
  	<!-- /Container -->

  	<!-- modals -->
  	<div class="modal fade" id="newAuditReport" tabindex="-1" role="dialog" aria-labelledby="newAuditReport" style="display: none;" aria-hidden="true">
  		<div class="modal-dialog" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h5 class="modal-title">Add New Audit Report</h5>
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						<span aria-hidden="true">×</span>
  					</button>
  				</div>
  				<div class="modal-body">
  					<form id="form_audit_report" method="POST">
  						<!-- <input type="hidden" class="form-control" id = "audit_type_id" name="audit_type_id"> -->
  						<!-- <input type="hidden" class="form-control" id="partner_incharge_id" name="partner_incharge_id"> -->
  						<!-- <input type="hidden" class="form-control" id="concurrent_partner_id" name="concurrent_partner_id"> -->
  						<!-- <input type="hidden" class="form-control" id="manager_incharge_id" name="manager_incharge_id"> -->
  						<!-- <input type="hidden" class="form-control" id = "client_id" name="client_id"> -->

  						<div class="row">
  							<div class="col-md-6">
  								<div class="form-group">
  									<label for="reportType">Report Type</label>
  									<select required name="audit_type_id" id="audit_type_id" class="form-control show-tick">
  										<option></option>
  										<?php if (!empty($auditType)) : foreach ($auditType as $row) : ?>
  												<option value="<?= $row->audit_type_id; ?>"><?= $row->lable; ?></option>
  										<?php endforeach;
											endif; ?>
  										<select>
  								</div>
  							</div>
  							<div class="col-md-6">
  								<div class="form-group">
  									<label for="reportType">Client</label>
  									<select required id="client_select" name="client_select" class="form-control select2" onchange="getvalt(this.value)" data-live-search="true">
  										<option></option>
  										<?php if (!empty($clients)) : foreach ($clients as $row) : ?>
  												<option value="<?= trim($row->client_id); ?>"><?= $row->cch_code . "~" . trim($row->client_name); ?></option>
  										<?php endforeach;
											endif; ?>
  									</select>
  								</div>
  							</div>
  						</div>
  						<div class="form-group">
  							<label for="reportType">Partner in Charge</label>
  							<select required name="partner_incharge_id" id="partner_incharge_id" class="form-control select2">
  								<option></option>
  								<?php if (!empty($partner)) : foreach ($partner as $row) : ?>
  										<option value="<?= $row->user_id ?>"><?= trim($row->user_name); ?></option>
  								<?php endforeach;
									endif; ?>
  							</select>
  						</div>

  						<div class="row">
  							<div class="col-md-6">
  								<div class="form-group">
  									<label for="reportType">Concurrent Partner</label>
  									<select required name="concurrent_partner_id" id="concurrent_partner_id" class="form-control select2" data-show-subtext="true" data-live-search="true">
  										<option></option>
  										<?php if (!empty($partner)) : foreach ($partner as $row) : ?>
  												<option value="<?= $row->user_id ?>"><?= trim($row->user_name); ?></option>
  										<?php endforeach;
											endif; ?>
  										<select>
  								</div>
  							</div>
  							<div class="col-md-6">
  								<div class="form-group">
  									<label for="reportType">Manager in charge</label>
  									<select required name="manager_incharge_id" id="manager_incharge_id" class="form-control select2" data-show-subtext="true" data-live-search="true">
  										<option></option>
  										<?php if (!empty($manager)) : foreach ($manager as $row) : ?>
  												<option value="<?= $row->user_id ?>"><?= trim($row->user_name); ?></option>
  										<?php endforeach;
											endif; ?>
  									</select>
  								</div>
  							</div>
  						</div>

  						<div class="form-group">
  							<label for="exampleDropdownFormEmail1">Year End</label>
  							<input class="form-control date" type="text" id="year_end" name="year_end" value="" />

  						</div>

  						<!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
						  </form>

  				</div>
  				<div class="modal-footer">
  					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
  					<button type="button" id="save_btn" onclick="Save();" class="btn btn-primary waves-effect">SAVE CHANGES</button>

  				</div>
  			</div>
  		</div>
  	</div>

		<!-- modals -->
		<div class="modal fade" id="signAuditReport" tabindex="-1" role="dialog" aria-labelledby="newAuditReport" style="display: none;" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h5 class="modal-title">SIGN AUDIT REPORT</h5>
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						<span aria-hidden="true">×</span>
  					</button>
  				</div>
  				<div class="modal-body">

				  <div class="table-wrap">
					<table id="audit-reportd" class="table table-sm  table-hover w-100 display pb-30">
						<thead>
							<tr>
								<th>#</th>
                                <th>Ref No</th>
                                <th>Year End</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Actions</th>
							</tr>
						</thead>
						<tbody>
						
						<?php $count=1; if(!empty($createdAU)): foreach($createdAU as $data): if($data->report_state !="created"){continue;} ?>
							<tr>
								<td><?=$count++?></td>
								<td><?=$data->ref_no?></td>
								<td><?=$data->year_end?></td>
								<td><?=get_client_name($data->client_id)?></td>
								<?php $date= date_format(date_create($data->date_time),'d-m-Y')  ?>
								<td><?=$date?></td>
								<td>
								<button data-toggle="tooltip" data-original-title="View report Details" onclick="viewAuditReport('<?=$data->audit_report_id;?>')" class="btn btn-icon btn-icon-circle btn-warning btn-icon-style-3"><span class="btn-icon-wrap"><i class="icon-rocket"></i></span></button>
								<!-- <button type="button" class="btn btn-info" >View</button> -->
								</td>
								
							</tr>
						<?php endforeach; endif; ?>	
						</tbody>
						<tfoot>
							<tr>
								<th>#</th>
                                <th>Ref No</th>
                                <th>Year End</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Actions</th>
							</tr>
						</tfoot>
					</table>
                                    </div>
				 
  				<div class="modal-footer">
  					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
  				</div>
  			</div>
  		</div>
  		</div>  
		</div>

			<!-- modals -->
		<div class="modal fade" id="signOffAuditReport" tabindex="-1" role="dialog" aria-labelledby="newAuditReport" style="display: none;" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h5 class="modal-title">SIGN AUDIT REPORT</h5>
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						<span aria-hidden="true">×</span>
  					</button>
  				</div>
  				<div class="modal-body">

				  <div id="table"></div>

				  <form method="post" action="<?=base_url()?>Home/signAuditReport"> 

				  <input type="hidden" id="audit_report_id" name="audit_report_id" />
				  <div class="form-group">
  							<label for="exampleDropdownFormEmail1">Year End</label>
  							<input class="form-control date" type="text" id="datepicker" name="sign_off_date" />

  						</div>

  						<button type="submit" class="btn btn-primary">Sign</button>
				 </form>
				  
                </div>
				 
  				<div class="modal-footer">
  					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
  				</div>
  			</div>
  		</div>
  		</div>  
		</div>

			<!-- modals -->
		<div class="modal fade" id="uploadAuditReport" tabindex="-1" role="dialog" aria-labelledby="newAuditReport" style="display: none;" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h5 class="modal-title">Upload and archive audit report</h5>
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						<span aria-hidden="true">×</span>
  					</button>
  				</div>
  				<div class="modal-body">

				  <div class="table-wrap">
					<table id="upload-tbl" class="table table-sm  table-hover w-100 display pb-30">
						<thead>
							<tr>
								<th>#</th>
                                <th>Ref No</th>
                                <th>Year End</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Actions</th>
							</tr>
						</thead>
						<tbody>
						
						<?php $count=1; if(!empty($signedAU)): foreach($signedAU as $data): if($data->report_state !="signed"){continue;} ?>
							<tr>
								<td><?=$count++?></td>
								<td><?=$data->ref_no?></td>
								<td><?=$data->year_end?></td>
								<td><?=get_client_name($data->client_id)?></td>
								<?php $date= date_format(date_create($data->date_time),'d-m-Y')  ?>
								<td><?=$date?></td>
								<td>
								<button data-toggle="tooltip" data-original-title="Archive Details" onclick="uploadAuditReport('<?=$data->audit_report_id;?>')" class="btn btn-icon btn-icon-circle btn-warning btn-icon-style-3"><span class="btn-icon-wrap">
									<i class="icon-rocket"></i>
								</span></button>
								<!-- <button type="button" class="btn btn-info" >View</button> -->
								</td>
								
							</tr>
						<?php endforeach; endif; ?>	
						</tbody>
						<tfoot>
							<tr>
								<th>#</th>
                                <th>Ref No</th>
                                <th>Year End</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Actions</th>
							</tr>
						</tfoot>
					</table>
                                    </div>
				 
  				<div class="modal-footer">
  					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
  				</div>
  			</div>
  		</div>
  		</div>  
		</div>


		<!--Dropzone Modal starts here -->
        <div class="modal fade" id="Dropzonemodal" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <h4 class="modal-title" id="defaultModalLabel">
                        <div class="modal-header">
						Upload and Archive Audit Report
                        </div>
                         </h4>
                        <div class="modal-body">

						<div class="alert alert-danger" role="alert">
 						  Please make sure that the file name does not include the following characters
						   <hr>
  						 <p class="mb-0"><strong>" , . : ' { [ ] } / \ & ~ `</strong></p>
						</div>

                        <form id="frmFileUpload" class="dropzone dz-clickable" method="post" enctype="multipart/form-data">
                     <input type="hidden" class="form-control" id = "parent_id" name="parent_id">
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h3>Drop files here or click to upload.</h3>
                                </div>
                            </form>
                         

                        
                      
                        <div class="modal-footer">

                        <div class="demo-checkbox">
                                <input type="checkbox" id="confirm_checkbox" unchecked="">
                                <label for="confirm_checkbox">Tick to confirm that upload-m-Yile matches client work and year end</label>
                            </div>
                            
                            <button id="finishbutton" onclick="FinishDropzone()" type="button" class="btn btn-link waves-effect" data-dismiss="modal">UPLOAD FILE</button>

                            <!-- <button  type="button"  class="btn bg-blue btn-circle-lg waves-effect waves-circle waves-float">
                                    <i class="material-icons">done_all</i>
                                </button> -->
                        </div>
                         
                    </div>
                </div>
        </div>
        </div>
<!-- Modal ends here -->

	<div class="modal fade" id="myPleaseWait" tabindex="-1" role="dialog" style="display: none;">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-blue-grey">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel"></h4>
				</div>
				<div class="modal-body">
				<h4>    Please Wait.............. </h4>
					<br >
					<div class="progress">
						<div id="progress" class="progress-bar bg-cyan progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
							<div id="progress" > CYAN PROGRESS BAR </div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
					<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
				</div>
			</div>
		</div>
    </div>

	<div class="modal fade" id="infoFileModal" tabindex="-1" role="dialog" style="display: none;">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-col-blue-grey">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel"></h4>
				</div>
				<div class="modal-body">
				 
				 <div class="alert alert-danger" role="alert">
 						  Please make sure that the file name does not include the following characters
						   <hr>
  						 <p class="mb-0"><strong>" , . : ' { [ ] } / \ & ~ `</strong></p>
						   <hr>
						 <p>The file will be removed please try again with correct naming convention</p> 
				 </div>

				</div>
				<div class="modal-footer">
					<!-- <!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
					<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">OK</button> 
				</div>
			</div>
		</div>
    </div>

  
  </div>
  <!-- /Main Content -->

  <script type="text/javascript">

	$(document).ready(function() {

	$('#audit-reportd').DataTable({
		responsive: true,
		autoWidth: false,
		language: { search: "",
		searchPlaceholder: "Search",
		sLengthMenu: "_MENU_items"

		}
	});

	$('#upload-tbl').DataTable({
		responsive: true,
		autoWidth: false,
		language: { search: "",
		searchPlaceholder: "Search",
		sLengthMenu: "_MENU_items"

		}
	});

	$('#table_dash_sign').DataTable({
		responsive: true,
		autoWidth: false,
		language: { search: "",
		searchPlaceholder: "Search",
		sLengthMenu: "_MENU_items"

		}
	});

	$('#table_dash_create').DataTable({
		responsive: true,
		autoWidth: false,
		language: { search: "",
		searchPlaceholder: "Search",
		sLengthMenu: "_MENU_items"

		}
	});

	
	});


  	$('.date').daterangepicker({
		  
  		singleDatePicker: true,
  		showDropdowns: true,
  		minYear: 1901,
  		format: 'MM-DD-YYYY',
  		"cancelClass": "btn-secondary",
  	});
  	$('.date').on('apply.daterangepicker', function(ev, picker) {
  		//   console.log(picker.endDate.format('DD-MM-YYYY'));

  		$('#year_end').val(picker.endDate.format('DD-MM-YYYY'));

		$('#datepicker').val(picker.endDate.format('DD-MM-YYYY'));
  	})


  	function Save() {


  		// var validate = $("#form_audit_report").validate();

  		// console.log(validate);	

  		// $('#save_btn').hide();


  		// signed
  		// ajax adding data to database
  		var urls;
  		urls =  base_url + 'Home/insertAuditReport';
  		$.ajax({
  			url: urls,
  			type: "POST",
  			data: $('#form_audit_report').serialize(),
  			// dataType: "JSON",
  			success: function(data) {
  				swal({
  						title: "Save?",
  						text: "The Record Was successfully Saved",
  						type: "success",
  						showCancelButton: true,
  						confirmButtonColor: "#03A9F4",
  						confirmButtonText: "OK",
  						closeOnConfirm: false
  					}).then((postData) => {
  						location.reload();
  					});  

  				// notify('Sucess', 'information updated successfully', '2');
  				// location.reload(); // for reload a page
  			},
  			error: function(jqXHR, textStatus, errorThrown) {
  				// alert(errorThrown + '  update data ');

  			}
  		});

  	}

	function signAudit(){
     $('#signAuditReport').modal('show');
	}  

	function uploadAudit(){
	
		$('#uploadAuditReport').modal('show');
	}

	function viewAuditReport(audit_report_id) { 

        $('#audit_report_id').val(audit_report_id);
		$('#table').html('');
		$.ajax({
			type: "GET",
			url: base_url+'Home/auditReportDetails/'+audit_report_id,
			// data: "data",
			// dataType: "dataType",
			success: function (response) {
				

                $('#table').append(response);
				$('#signOffAuditReport').modal('show');

			}
		});

	}

	function uploadAuditReport(audit_report_id) { 

		$('#parent_id').val(audit_report_id);

		$('#Dropzonemodal').modal('show');

	}

	function FinishDropzone()
    {
       $('#Dropzonemodal').modal('hide');
       $('#uploadAuditReport').modal('hide');

    }


  </script>

<script src="<?=base_url()?>vendors/dropzone/dist/dropzone.js"></script>

 <script type="text/javascript">

var specialChars = "#%&*:<>?/{|},'[]~`";
var preloadfff = document.getElementById('preloadfff');
var Percentage ;
Dropzone.options.frmFileUpload = {acceptedFiles: ".zip"}
Dropzone.autoDiscover = false;
jQuery(document).ready(function() {
var errors = true; 
  var myDropzone = new Dropzone("#frmFileUpload", {
    url: base_url+'Home/fileUpload',
    autoProcessQueue:false,
    // maxFilesize: 1000,
    filesizeBase: 1024,
    maxFilesize: 10000,
    init: function() {

		var drop = this; // Closure

		this.on("addedfile", function (file) {

			if (file.type == "application/pdf" || file.type == "application/zip") {
                file.previewElement.querySelector("[data-dz-thumbnail]").src = "assets/file_zip_icon.png";
            }

			var name = file.name;
			var withspecial = false;
			for (j = 0; j < specialChars.length; j++) {
				if (name.indexOf(specialChars[j]) > -1) {

					withspecial = true;

				}
			}

			if(withspecial==true){

				// var removeButton = Dropzone.createElement("<div class='column'><span class='btn btn-danger btn-xs pull-right cancel'><i class='fa fa-times'></i> Remove File</span></div>");
				// file.previewElement.appendChild(removeButton);
				$('#infoFileModal').modal('show');
				// self.removeFile(file);
				drop.removeFile(file);

			}

		});	
		
      this.on("error", function(file, response) {
       errors = false;

	           console.log(response);

            // swal("oow snap!", "The file you are trying to upload already exists!", "error");
        swal({
        title: "oow snap!",
        text: "The file you are trying to upload already exists!",
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#03A9F4",
        confirmButtonText: "OK",
        closeOnConfirm: false
  		}).then((postData) => {
  				location.reload();
  		});  

        });
          
      this.on("uploadprogress", function(file, progress) {
        if (errors==true) {

        $('#myPleaseWait').modal({
        backdrop: 'static',
        keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
        $('#myPleaseWait').modal('show');

        console.log("File progress", progress);
        var Percentage = progress.toFixed();
        preloadfff.style.display = 'table';

        $('#defaultModalLabel').text('Uploading');
        $("#progress").css('width',Percentage+'%');
        $("#progress").html(Percentage+'%');

        }

      });
       this.on("queuecomplete", function (file) {
        if (errors==true) {
        //   alert("All files have uploaded ");
        // Alert('All files have been uploaded');
        // preloadfff.style.display = 'none';
        // console.log('Your files have been uploaded','success');
          location.reload();
      }
      });

    }

  });
  

  $('#finishbutton').on('click',function(e){
    e.preventDefault();
    myDropzone.processQueue();  

  });   
});

 </script>
