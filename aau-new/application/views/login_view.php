<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Login</title>		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- Toggles CSS -->
		<link href="<?=base_url()?>vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
		
		<!-- Custom CSS -->
		<link href="<?=base_url()?>dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		
		<!-- HK Wrapper -->
		<div class="hk-wrapper">
			
			<!-- Main Content -->
			<div class="hk-pg-wrapper hk-auth-wrapper">
			
				<div class="container-fluid">
					<div class="row" style="background-color: #00BCD4;">
						<div class="col-xl-12 pa-0">

							<div class="auth-form-wrap pt-xl-0 pt-70">


								<div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">

								<div class="card" style="padding: 33px;">


								<img class="google-btn center" src="<?=base_url()?>assets/logo.png" style="display: block; margin-left: auto; margin-right: auto; width: 59%;">

								<h6 style="text-align: center;">PKF in Eastern Africa <strong>Audit Archiving Utility</strong> </h6>
								
								<a class="auth-brand text-center d-block mb-20" href="#">
										
									</a>
									<?php if ($this->session->flashdata()) { ?>
									<?php $alert = empty($this->session->flashdata('err')) ? 'alert-success' : 'alert-danger' ?>
									<div class="alert <?=$alert?>" role="alert">
										<?= $this->session->flashdata('message'); ?>
										<?= $this->session->flashdata('err'); ?>
									</div>
               				   <?php } ?>
								<!-- Form -->




								<form action="<?=base_url('Login/VerifyLogin')?>" method="POST">
																	<!-- <h1 class="display-4 text-center mb-10">Welcome Back :)</h1> -->
										<!-- <p class="text-center mb-30">Sign in to your account and enjoy unlimited perks.</p>  -->
										<div class="form-group">
											<input class="form-control" name="email" placeholder="Email" type="email">
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" name="password" placeholder="Password" type="password">
												<div class="input-group-append">
													<span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
												</div>
											</div>
										</div>
										
										<!-- <div class="custom-control custom-checkbox mb-25">
											<input class="custom-control-input" id="same-address" type="checkbox" checked>
											<label class="custom-control-label font-14" for="same-address">Keep me logged in</label>
										</div> -->
										<button class="btn btn-primary btn-block" type="submit">Login</button>
										<!-- <p class="font-14 text-center mt-15">Having trouble logging in?</p>
										<div class="option-sep">or</div>
										<div class="form-row">
											<div class="col-sm-6 mb-20"><button class="btn btn-indigo btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-facebook"></i> </span><span class="btn-text">Login with facebook</span></button></div>
											<div class="col-sm-6 mb-20"><button class="btn btn-sky btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-twitter"></i> </span><span class="btn-text">Login with Twitter</span></button></div>
										</div>
										<p class="text-center">Do have an account yet? <a href="#">Sign Up</a></p>
									 -->
									 </form>
								</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /HK Wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="<?=base_url()?>vendors/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="<?=base_url()?>vendors/popper.js/dist/umd/popper.min.js"></script>
		<script src="<?=base_url()?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?=base_url()?>dist/js/jquery.slimscroll.js"></script>
	
		<!-- Fancy Dropdown JS -->
		<script src="<?=base_url()?>dist/js/dropdown-bootstrap-extended.js"></script>
		
		<!-- FeatherIcons JavaScript -->
		<script src="<?=base_url()?>dist/js/feather.min.js"></script>
		
		<!-- Init JavaScript -->
		<script src="<?=base_url()?>dist/js/init.js"></script>
	</body>
</html>
