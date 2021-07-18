<!-- Main Content -->
  <div class="hk-pg-wrapper"  style="background-color: #00BCD4;">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header">
                    <div>
						<h2 class="hk-pg-title font-weight-600 mb-10">Client</h2>
                    </div>
					
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
						<!-- Page Alerts -->
			
						<?php if ($this->session->flashdata()) { ?>
							<?php $alert = empty($this->session->flashdata('err')) ? 'alert-success' : 'alert-danger' ?>
							<div class="alert <?=$alert?> alert-wth-icon alert-dismissible fade show" role="alert">
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
													<th>Name</th>
													<th>CCH code</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Date</th>
													<th>Status</th>
													<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php $count=1; if(!empty($client)): foreach($client as $data): ?>
												<tr>											
												<td><?=$count++?></td>
												<td><?=$data->client_name?></td>
												<td><?=$data->cch_code?></td>
												<td><?=$data->email?></td>
												<td><?=$data->phone?></td>
												<td><?=date('d-m-Y',strtotime($data->date_time))?></td>
												<td><?=$data->status?></td>
												<td>  
												<button onclick="editUser('<?=$data->client_id?>')" type="button" class="btn btn-primary btn-addon m-b-sm btn-rounded btn-sm"><i class="fa fa-pencil"></i> </button>
												</td>
												</tr>
												<?php endforeach;  endif;  ?> 
                                              
                                            </tbody>
                                            <tfoot>
                                                <tr>
													<th>#</th>
													<th>Name</th>
													<th>CCH code</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Date</th>
													<th>Status</th>
													<th>Action</th>
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
				
				         <!-- Modal -->
						 <div class="modal fade" id="newUserDialog" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    
                                </div>
                                <div class="modal-body">
                                    <form id="newUserform">
                                        <input type="hidden" name="client_id" id="client_id">
                                     
                                    <div class="row">
                                         <div class="col-md-12">
                                     <label for="car_make">Office</label>
                                        <div class="form-group">
                                        <div class="form-line">
                                        <select id="office_id" name="office_id" class="form-control input-rounded" style="width: 100%">
                                        <option value="">~select office~</option>
                                        <?php if(!empty($office)): foreach ($office as  $value): ?>
                                        <option value="<?=$value['office_id']?>"><?=$value['lable']?></option>
                                         <?php endforeach; endif; ?>
                                        </select>
                                        </div>
                                        </div>
                                        </div>
									</div>


									<div class="row">
                                         <div class="col-md-6">
                                     <label for="car_make">concurrent partner</label>
                                        <div class="form-group">
                                        <div class="form-line">
                                        <select id="concurrent_partner" name="concurrent_partner" class="form-control input-rounded" style="width: 100%">
                                        <option value="">~select partner~</option>
                                        <?php if(!empty($partner)): foreach ($partner as  $value): ?>
                                        <option value="<?=$value->user_id?>"><?=$value->user_name?></option>
                                         <?php endforeach; endif; ?>
                                        </select>
                                        </div>
                                        </div>
                                        </div>

                                         <div class="col-md-6">
                                     <label for="car_make">client partner</label>
                                        <div class="form-group">
                                        <div class="form-line">
                                        <select id="client_partner" name="client_partner" class="form-control input-rounded" style="width: 100%">
                                        <option value="">~select partner~</option>
                                        <?php if(!empty($partner)): foreach ($partner as  $value): ?>
                                        <option value="<?=$value->user_id?>"><?=$value->user_name?></option>
                                         <?php endforeach; endif; ?>
                                        </select>
                                        </div>
                                        </div>
                                        </div>
									</div>

									<div class="row">
                                         <div class="col-md-12">
                                     <label for="car_make">assignment manager</label>
                                        <div class="form-group">
                                        <div class="form-line">
                                        <select id="assignment_manager" name="assignment_manager" class="form-control input-rounded" style="width: 100%">
                                        <option value="">~select manager~</option>
                                        <?php if(!empty($manager)): foreach ($manager as  $value): ?>
                                        <option value="<?=$value->user_id?>"><?=$value->user_name?></option>
                                         <?php endforeach; endif; ?>
                                        </select>
                                        </div>
                                        </div>
										</div>
									</div>

                                    <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <div class="form-line">
                                            <input type="text" id="cch_code" name="cch_code" class="form-control" placeholder="cch code" required="">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <div class="form-line">
                                            <input type="text" id="client_name" name="client_name" class="form-control" placeholder="client name" required="">
                                        </div>
                                        </div>
                                    </div>
                                                                   
                                    
                                      </div>
                                        
                                <div class="row">

								<div class="col-md-4">
                                        <div class="form-group">
                                           <div class="form-line">
                                            <input type="text" id="location" name="location" class="form-control" placeholder="location" required="">
                                        </div>
                                        </div>
									</div>
									
                                         <div class="col-sm-4"> 
                                         <div class="form-group">
                                           <div class="form-line">
                                            <input type="email" id="email" name="email" class="form-control input-rounded" placeholder="Email" required="">
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4"> 
                                         <div class="form-group">
                                           <div class="form-line">
                                            <input type="number" id="phone" name="phone" class="form-control input-rounded" placeholder="Phone" required="">
                                        </div>
                                        </div>
									</div>
								</div>
								

								<div class="row">
                                         <div class="col-md-12">
                                     <label for="car_make">status</label>
                                        <div class="form-group">
                                        <div class="form-line">
                                        <select id="status" name="status" class="form-control input-rounded" style="width: 100%">
                                        <option value="">~select status~</option>
										<option >Active</option>
										<option >Inactive</option>
                                        </select>
                                        </div>
                                        </div>
                                        </div>
									</div>


                                </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button onclick="Save()" type="button" class="btn btn-primary">Save changes</button>
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
		language: { search: "",
		searchPlaceholder: "Search",
		sLengthMenu: "_MENU_items"

		},
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});

});

		function addnewUser() {
			Type = "addnewUser";
			$('#newUserDialog').modal('show');
		}	



		function editUser(data) {
            Type = "editUser";
            $.ajax({
                url: base_url+'Home/editClients/'+data,
                type: 'GET',
                dataType: 'json',
                // data: {param1: 'value1'},
            })
            .done(function(mdata) {
                console.log("success");
				console.log(mdata);
                   $.each(mdata[0], function(index, val) {

                   $('#'+index).val(val);

                   // $('#name').val(val.user_name);
                   // $('#email').val(val.email);
                   // $('#branch_id').val(val.branch_id);
                   // $('#user_type').val(val.user_type);
                   // $('#state').val(val.active);
                   // $('#staff_id').val(val.staff_id);
               });
                  $('#newUserDialog').modal('show');
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            

        }

        function Save() {
           switch(Type){
             case 'addnewUser':
               var Url = base_url+'Home/addClients';
               Submit(Url);
             break;
             case 'editUser':
             var Url = base_url+'Home/updateClients';
               Submit(Url);
             break;
           }
        }

        function Submit(Url) {
           $.ajax({
               url: Url,
               type: 'POST',
               // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
               data: $('#newUserform').serialize(),
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
