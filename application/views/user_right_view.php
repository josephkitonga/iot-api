<!-- Main Content -->
<div class="hk-pg-wrapper"  style="background-color: #00BCD4;">
	<!-- Container -->
	<div class="container mt-xl-50 mt-sm-30 mt-15">
		<!-- Title -->
		<div class="hk-pg-header">
			<div>
				<h2 class="hk-pg-title font-weight-600 mb-10">User Rights</h2>
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

                     <?php if(!empty($UserType)): foreach($UserType as $val): ?>
						<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                            <div class="card border-success">
                                <div class="card-header">
								<h5 "><?=$val->lable?> </h5>
                                </div>
								<div class="card-body">
                                     <?php if(!empty($Module)): foreach($Module as $vals): if($vals->sub=="1"){ continue;}?>
                                                 <div class="checkbox">
        
                                                    <?php
                                                    $state=""; 
                                                    if (!empty(get_user_rights($val->type_id,$vals->module_id))) {
                                                    if (get_user_rights($val->type_id,$vals->module_id)=="X") { $state="checked";}
                                                    }
                                                    ?>
                                                    <input onclick="Check('<?=$val->type_id?>','<?=$vals->module_id?>')"  type="checkbox" id="checkbox_<?=$val->user_type_id?>_<?=$vals->module_id?>" <?=$state?>>
                                                    <label for="checkbox_<?=$val->type_id?>_<?=$vals->module_id?>"><?=$vals->name?></label>

                                                </div>
                                      <?php endforeach; endif; ?>
                                </div>
                            </div>
                        </div>
                       <?php endforeach; endif; ?>
                     </div><!-- Row -->


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
  <script type="text/javascript">
            
            function Check(user_type_id,module_id) {
            //   alert(user_type_id+'::::::::::'+module_id);
              $.ajax({
                  url: '<?=base_url('UserRight/Verify/')?>',
                  type: 'POST',
                  dataType: 'text',
                  data: {user_type_id: user_type_id,module_id:module_id},
              })
              .done(function(data) {
                  console.log("success");
                  // alert(data);
                //   console.log(data);
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

</body>

</html>
