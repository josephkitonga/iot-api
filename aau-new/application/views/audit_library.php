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
					
				<!-- <input class="form-control" onkeyup="ContactsearchFX()" placeholder="Search.." id="myInput" type="text"> -->
					<div class="row">
					<div class="col-sm-12 col-md-12">
					<div id="all-users_filter" class="dataTables_filter"><label>
					<input onkeyup="getSearched()" id="searchd" type="search" class="form-control form-control-sm" placeholder="Search" aria-controls="all-users"></label>
					</div>
					</div>

						<div class="col-sm">
							<div class="table-wrap">
								<table id="all-users" class="table table-hover w-100 display pb-30">
									<thead>
										<tr id="header">

											<th>#</th>
											<th>Ref No</th>
											<th>Client</th>
											<th>Year End</th>
											<th>Date</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
									
									</tbody>
									<tfoot>
										<tr>
											
										<th>#</th>
											<th>Ref No</th>
											<th>Client</th>
											<th>Year End</th>
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
		<div class="modal fade" id="auditReport" tabindex="-1" role="dialog" aria-labelledby="newAuditReport" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Audit Report</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
					
					<div id="Getrelated">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
	responsive: true,
	autoWidth: true,
	bFilter: false, bInfo: false
});

$('.dataTables_paginate').hide();


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


$ ('.dataTables_filter: input [type = search]'). on ('keyup', function (e) {

	alert('pop');
});


$('#all-users input').unbind() // Unbind previous default bindings
    .bind("input", function (e) {
        
        // if ($(this).val().length < 3)
        //     myTable.fnFilter("");
        // else
        // 	myTable.fnFilter($(this).val());

		alert($(this).val());
    });

// 	$ ('. dataTables_filter: input [type = search]'). on ('keyup', function (e) {
// if ((e.keyCode! = 8) && (e.keyCode! = 37) && (e.keyCode! = 39))
// {
// close_details ();
// }
// });


   function getSearched(){

	   var searchd = $('#searchd').val();
	   var table = $('#all-users').DataTable({
			"bDestroy": true,
			bFilter: false, bInfo: false,
			// "ajax": {
			// 	url : base_url+"/Home/searchArchivedReport/"+searchd,
			// 	type : 'GET'
			// },
		});

	   if(searchd.length === 0){

		table.clear().draw();
	   }else{

		$('#all-users').DataTable({
			"bDestroy": true,
			bFilter: false, bInfo: false,
			"ajax": {
				url : base_url+"/Home/searchArchivedReport/"+searchd,
				type : 'POST',
				data:{"searchd":searchd}
			},
		});
	   }

   }

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


<script type="text/javascript">

    function GetMore(client_id)
    {

    var urls = base_url+'home/auditByClient/'+client_id;
    $.ajax({
    url:urls,
    type:"POST",
    success:function(response){
    var responseData = JSON.parse(response);
    $('.modal-header').text('More from same Client'); // Set title to Bootstrap modal title
    $('#Getrelated').html(responseData.sliderData);
    $('#auditReport').modal('show');
    },
    error:function(req,status,error){
    swal(
    'Oops...',
    'Something went wrong!',
    'error'
    )
    }
    });   

    }
   
    function LogDownload(parent_id) {
     
    var urls = "<?php echo site_url('AuditLibrary/LogDownloads')?>";
    $.ajax({
    url:urls,
    type:"POST",
    data:{'parent_id':parent_id},
    success:function(response){
    var responseData = JSON.parse(response);

    },
    error:function(req,status,error){
    swal(
    'Oops...',
    'Something went wrong!',
    'error'
    )
    }
    });   


    }
    
    </script>


