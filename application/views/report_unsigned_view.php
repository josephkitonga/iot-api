<!-- Main Content -->
<div class="hk-pg-wrapper"  style="background-color: #00BCD4;">
	<!-- Container -->
	<div class="container mt-xl-50 mt-sm-30 mt-15">
		<!-- Title -->
		<div class="hk-pg-header">
			<div>
				<h2 class="hk-pg-title font-weight-600 mb-10"><?=$tittle?></h2>
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
					</h5>

					<div class="row">
						<div class="col-sm">
							<div class="table-wrap">
								<table id="all-users" class="table table-hover w-100 display pb-30 ">
									<thead>
										<tr>

											<th>#</th>
											<th>Ref No</th>
											<th>Client</th>
											<th>Partner</th>
											<th>Manager</th>
											<th>Office</th>
											<th>Year End</th>
											<th>Created at</th>
										</tr>
									</thead>
									<tbody>
										<?php $count = 1; 
										if (!empty($report)) : foreach ($report as $data) : if ($data->report_state != $state) {
													continue;
												} ?>
												<tr>
													<td><?= $count++ ?></td>
													<td><?= $data->ref_no ?></td>
													<td><?=get_client_name($data->client_id) ?></td>
													<td><?=get_partner_manager_name($data->partner_incharge_id) ? get_partner_manager_name($data->partner_incharge_id) : $data->partner_incharge_id ?></td>
													<td><?=get_partner_manager_name($data->manager_incharge_id) ? get_partner_manager_name($data->manager_incharge_id) : $data->manager_incharge_id ?></td>
													<td><?=get_office_name($data->office)?></td>
													<td><?=$data->year_end?></td>
													<td><?=date_format(date_create($data->date_time), 'd-m-Y')?></td>
												</tr>
										<?php endforeach;
										endif; ?>

									</tbody>
									<tfoot>
										<tr>
										<th>#</th>
											<th>Ref No</th>
											<th>Client</th>
											<th>Partner</th>
											<th>Manager</th>
											<th>Office</th>
											<th>Year End</th>
											<th>Created at</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</section>



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


	// 	$('.date').daterangepicker({
		  
  	// 	singleDatePicker: true,
  	// 	showDropdowns: true,
  	// 	minYear: 1901,
  	// 	format: 'MM-DD-YYYY',
  	// 	"cancelClass": "btn-secondary",
  	// });
  	// $('.date').on('apply.daterangepicker', function(ev, picker) {
  	// 	//   console.log(picker.endDate.format('DD-MM-YYYY'));

  	// 	$('#year_end').val(picker.endDate.format('DD-MM-YYYY'));

	// 	$('#datepicker').val(picker.endDate.format('DD-MM-YYYY'));
  	// })


	});

</script>
