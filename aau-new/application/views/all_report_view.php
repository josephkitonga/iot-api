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

					<div class="row" >
					 
					<div class="col-sm-6 col-md-6">
					<label for="lastname">Start Date</label>

					<div id="all-users_filter" class="dataTables_filter"><label>
					<input id="start_date" name="start_date" type="text" data-date-format="dd-mm-yyyy" class="form-control form-control-sm date" placeholder="Search" aria-controls="all-users" value="<?=$start_date?>"></label>
					</div>
					</div>

					<div class="col-sm-6 col-md-6">
					<label for="lastname">End Date</label>

					<div id="all-users_filter" class="dataTables_filter"><label>
					<input onchange="getSearched()" name="end_date" id="end_date" data-date-format="dd-mm-yyyy" type="text" class="form-control form-control-sm date" placeholder="Search" aria-controls="all-users" value="<?=$end_date?>"></label>
					</div>
					</div>
					</div>
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
											<th>Sign off date</th>
											<th>Archive date</th>
											<th>Year End</th>
											<th>Created at</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
									<tfoot>
										<tr>
										<th>#</th>
										    <th>Ref No</th>
											<th>Client</th>
											<th>Partner</th>
											<th>Manager</th>
											<th>Office</th>
											<th>Sign off date</th>
											<th>Archive date</th>
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
		
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		
		$('#all-users').DataTable({
			dom: 'Bfrtip',
			responsive: true,
			autoWidth: true,
			"bDestroy": true,
			bFilter: false, bInfo: false,
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"ajax": {
				url : base_url+"/Reports/searchAllReport/",
				type : 'POST',
				data : {'start_date':start_date,'end_date':end_date}
			},
		});


	


	});

	$('.date').daterangepicker({
		
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		format: 'DD-MM-YYYY',
		"cancelClass": "btn-secondary",
		});
// 	$("input[type=date]").datepicker({
//   dateFormat: 'yy-mm-dd',
//   onSelect: function(dateText, inst) {
//     $(inst).val(dateText); // Write the value in the input
//   }
// });



function getSearched(){

var searchd = $('#searchd').val();
var start_date = $('#start_date').val();
var end_date = $('#end_date').val();

 $('#all-users').DataTable({
	dom: 'Bfrtip',
			responsive: true,
			autoWidth: true,
	"bDestroy": true,
			bFilter: false, bInfo: false,
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"ajax": {
				url : base_url+"/Reports/searchAllReport/",
				type : 'POST',
				data : {'start_date':start_date,'end_date':end_date}
			}
 });

}





</script>
