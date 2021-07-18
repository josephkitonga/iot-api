<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Site favicon -->
	<link rel="shortcut icon" href="<?=base_url()?>assets/favicon.ico">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700" rel="stylesheet">
	<!-- Icon Font -->
	<link rel="stylesheet" href="<?=base_url()?>vendors/new-login/fonts/ionicons/css/ionicons.css">
	<!-- Text Font -->
	<link rel="stylesheet" href="<?=base_url()?>vendors/new-login/fonts/font.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url()?>vendors/new-login/css/bootstrap.css">
	<!-- Normal style CSS -->
	<link rel="stylesheet" href="<?=base_url()?>vendors/new-login/css/style.css">
	<!-- Normal media CSS -->
	<link rel="stylesheet" href="<?=base_url()?>vendors/new-login/css/media.css">
</head>
<body>	
	<main class="cd-main">
		<section class="cd-section index visible ">
			<div class="cd-content style1" style="padding: 68px 15px 20px;">
			<!-- <img src="images/google.svg"> -->
				<div class="login-box ">
						
					<img class="google-btn" src="<?=base_url()?>assets/logo.png" style="display: inline-block; vertical-align: middle; margin-left: 274px;margin-top: 50px;">
			
					<h1 class="title"><?php  $theDate = date("H"); if($theDate < 12)  echo "Good morning to you"; else if($theDate < 18)  echo "Good afternoon to you"; else echo "Good evening to you";  ?></h1>
					<!-- <h3 class="subtitle">Have a great journey ahead!</h3> -->
					<!-- <h3></h3> -->
					<!-- <br> -->
					<h3 class="subtitle" style="margin-top: 50px;">PKF Eastern Africa <strong>Audit Archiving Utility</strong> </h3>

					<div class="login-form-box">
					<?php if ($this->session->flashdata()) { ?>
									<?php $alert = empty($this->session->flashdata('err')) ? 'alert-success' : 'alert-danger' ?>
									<div class="alert <?=$alert?>" role="alert">
										<?= $this->session->flashdata('message'); ?>
										<?= $this->session->flashdata('err'); ?>
									</div>
               				   <?php } ?>
						<div class="login-form-slider">
							<!-- login slide start -->
							<div class="login-slide slide login-style1">
							<form action="<?=base_url('Login/VerifyLogin')?>" method="POST">
									<div class="form-group">
										<label class="label">Email</label>
										<!-- <input type="text" class="form-control"> -->
										<input class="form-control" name="email" placeholder="Email" type="email">
									</div>
									<div class="form-group">
										<label class="label">Password</label>
										<!-- <input type="password" class="form-control" value="1234567891"> -->
										<input class="form-control" name="password" placeholder="Password" type="password">
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="customCheck1">
											<label class="custom-control-label" for="customCheck1">Remember me</label>
										</div>
									</div>
									<div class="form-group">
										<input type="submit" class="submit" value="Sign In">
									</div>
								</form>
								<!-- <div class="sign-up-txt">
									Don't have an account? <a href="javascript:;" class="sign-up-click">Sign Up</a>
								</div>
								<div class="forgot-txt">
									<a href="javascript:;" class="forgot-password-click">Forgot Password</a>
								</div> -->
								<div class="login-with">
									<!-- <h3>Login with social</h3> -->
									<ul class="social-login-btn">
										<li class="facebook-btn"><a href="https://bit.ly/2MeyqRI"><i class="ion-social-facebook"></i></a></li>
										<li class="twitter-btn"><a href="https://twitter.com/pkfea"><i class="ion-social-twitter"></i></a></li>
										<li class="linkedin-btn"><a href="https://www.linkedin.com/company/pkf-east-africa"><img src="<?=base_url()?>assets/linkedin.png"></a></li>
									</ul>
								</div>
							</div>
							<!-- login slide end -->
							<!-- signup slide start -->
							<div class="signup-slide slide login-style1">
								<div class="d-flex height-100-percentage">
									<div class="align-self-center width-100-percentage">
										<form>
											<div class="form-group">
												<label class="label">Name</label>
												<input type="text" class="form-control">
											</div>
											<div class="form-group">
												<label class="label">Email</label>
												<input type="email" class="form-control">
											</div>
											<div class="form-group">
												<label class="label">Password</label>
												<input type="password" class="form-control">
											</div>
											<div class="form-group">
												<label class="label">Confirm Password</label>
												<input type="password" class="form-control">
											</div>
											<div class="form-group padding-top-15px">
												<input type="submit" class="submit" value="Sign Up">
											</div>
										</form>
										<div class="sign-up-txt">
											if you have an account? <a href="javascript:;" class="login-click">login</a>
										</div>
									</div>
								</div>
							</div>
							<!-- signup slide end -->
							<!-- forgot password slide start -->
							<div class="forgot-password-slide slide login-style1">
								<div class="d-flex height-100-percentage">
									<div class="align-self-center width-100-percentage">
										<form>
											<div class="form-group">
												<label class="label">Enter your email address to reset your password</label>
												<input type="email" class="form-control">
											</div>
											<div class="form-group">
												<input type="submit" class="submit" value="Submit">
											</div>
										</form>
										<div class="sign-up-txt">
											if you remember your password? <a href="javascript:;" class="login-click">login</a>
										</div>
									</div>
								</div>
							</div>
							<!-- forgot password slide end -->
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<div id="cd-loading-bar" data-scale="1"></div>
	<!-- JS File -->
	<script src="<?=base_url()?>vendors/new-login/js/modernizr.js"></script>
	<script type="text/javascript" src="<?=base_url()?>vendors/new-login/js/jquery.js"></script>
	<script type="text/javascript" src="<?=base_url()?>vendors/new-login/js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>vendors/new-login/js/bootstrap.js"></script>
	<script src="<?=base_url()?>vendors/new-login/js/velocity.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>vendors/new-login/js/script.js"></script>
</body>
</html>
