<!-- Main Content -->
<div class="hk-pg-wrapper"  style="background-color: #00BCD4;">
	<!-- Container -->
	<div class="container mt-xl-50 mt-sm-30 mt-15">
		<!-- Title -->
		<div class="hk-pg-header">
			<div>
				<h2 class="hk-pg-title font-weight-600 mb-10">Audit Report</h2>
			</div>

		</div>
		<!-- /Title -->

		<!-- Row -->
		<div class="row">
			<div class="col-xl-12">
				<!-- Page Alerts -->

				<?php if ($this->session->flashdata()) { ?>
					<?php $alert = empty($this->session->flashdata('err')) ? 'alert-success' : 'alert-danger' ?>
					<div class="alert <?= $alert ?> alert-wth-icon alert-dismissible fade show" role="alert">
						<span class="alert-icon-wrap"><i class="zmdi zmdi-help"></i></span>
						<?= $this->session->flashdata('message'); ?>
						<?= $this->session->flashdata('err'); ?>
					</div>
				<?php } ?>



				<section class="hk-sec-wrapper">
					<h5 class="hk-sec-title">
						<button onclick="addnewUser()" class="btn btn-primary btn-wth-icon icon-wthot-bg btn-lg"><span class="btn-text">Add new</span></button>
					</h5>
					<div class="row">
						<div class="col-sm">
							<div class="table-wrap">
								<table id="all-users" class="table table-hover w-100 display pb-30">
									<thead>
										<tr>

											<th>#</th>
											<th>Ref No</th>
											<th>Year End</th>
											<th>Client</th>
											<th>Office</th>
											<th>Date</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php $count = 1;
										if (!empty($createdAU)) : foreach ($createdAU as $data) : if ($data->report_state != "created") {
													continue;
												} ?>
												<tr>
													<td><?= $count++ ?></td>
													<td><?= $data->ref_no ?></td>
													<td><?= $data->year_end ?></td>
													<td><?= get_client_name($data->client_id)?></td>
													<td><?=get_office_name($data->office)?></td>
													<?php $date = date_format(date_create($data->date_time), 'd-m-Y')  ?>
													<td><?= $date ?></td>
													<td>
														<button data-toggle="tooltip" data-original-title="View report Details" onclick="viewAuditReport('<?= $data->audit_report_id; ?>')" class="btn btn-icon btn-icon-circle btn-warning btn-icon-style-3"><span class="btn-icon-wrap"><i class="icon-rocket"></i></span></button>
														<!-- <button type="button" class="btn btn-info" >View</button> -->
													</td>

												</tr>
										<?php endforeach;
										endif; ?>

									</tbody>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Ref No</th>
											<th>Year End</th>
											<th>Client</th>
											<th>Office</th>

											<th>Date</th>
											<th>Actions</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</section>



			</div>
		</div>
		<!-- /Row -->

		<!-- modals -->
		<div class="modal fade" id="newAuditReport" tabindex="-1" role="dialog" aria-labelledby="newAuditReport" style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Audit Report</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="form_audit_report" method="POST">

						  <input type="hidden" name="audit_report_id" id="audit_report_id" >
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
										<select required id="client_id" name="client_id" class="form-control select2"  data-live-search="true">
											<option></option>
											<?php if (!empty($clients)) : foreach ($clients as $row) : ?>
													<option value="<?=$row->client_id ?>"><?= $row->cch_code . "~" . trim($row->client_name); ?></option>
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

	</div>
	<!-- /Container -->

	<!-- Footer -->
	<!-- <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Pampered by<a href="https://hencework.com/" class="text-dark" target="_blank">Hencework</a> © 2019</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p class="d-inline-block">Follow us</p>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                        </div>
                    </div>
                </footer>
            </div> -->
	<!-- /Footer -->
</div>
<!-- /Main Content -->

<script>
	$(document).ready(function() {

		$('#all-users').DataTable({
			dom: 'Bfrtip',
			responsive: true,
			autoWidth: true,
			language: {
				search: "",
				searchPlaceholder: "Search",
				sLengthMenu: "_MENU_items"

			},
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
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


	});

	Type = "";
	function addnewUser() {
		Type = "addnewUser";
		$('#newAuditReport').modal('show');
	}



	function viewAuditReport(data) {

		// var partners = new Array();

		var partner = '<?= json_encode($partnerAssoc); ?>';
		var partnerObj = jQuery.parseJSON(partner);

		console.log(partnerObj['Daniel Ongaya']);

		// console.log(partners);
		// var partnerObjAsc = [];




		Type = "editUser";
		$.ajax({
				url: base_url + 'Home/editAuditReport/' + data,
				type: 'GET',
				dataType: 'json',
				// data: {param1: 'value1'},
			})
			.done(function(mdata) {
				console.log("success");
				console.log(mdata);
				$.each(mdata[0], function(index, val) {

					// alert(index);


					$('#' + index).val(val).change();;

					if (partnerObj[val] != null) {

						$('#' + index).val(partnerObj[val]).change();

					}

					// if (index == "client_id") {
					// 	$('#client_id').val(val).change();
					// }




				});
				$('#newAuditReport').modal('show');
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});


	}

	function Save() {
		switch (Type) {
			case 'addnewUser':
				var Url = base_url + 'Home/insertAuditReport';
				Submit(Url);
				break;
			case 'editUser':
				var Url = base_url + 'Home/updateAuditReport';
				Submit(Url);
				break;
		}
	}

	function Submit(Url) {
		$.ajax({
				url: Url,
				type: 'POST',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: $('#form_audit_report').serialize(),
			})
			.done(function(data) {
				console.log("success");
				console.log(data);

				location.reload();

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

	}
</script>
