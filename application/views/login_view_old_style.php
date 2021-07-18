<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Audit Archiving Utility</title>
    <!-- Favicon-->
    <link rel="icon"  href="<?php echo base_url();?>/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link  href="<?php echo base_url();?>vendors/new-login/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link  href="<?php echo base_url();?>/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link  href="<?php echo base_url();?>/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
	<link rel="stylesheet" href="<?=base_url()?>vendors/new-login/css/style.css">

</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">

            <a href="javascript:void(0);">Audit Archiving<b> Utility</b></a>
            <!-- <small>Admin BootStrap Based - Material Design</small> -->
        </div>
        <div class="card">
            <div class="body">
            <?php if (validation_errors()) {
        echo '<div style="display: block;" role="alert" class="alert alert-danger alert-dismissible">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
            Oh snap! Invalid Email Password Combination. </div>';
        } else {} ?>
        <?php echo form_open('Verifylogin'); ?>

                <form >
                <br />
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <br >
                  <br >
                  <br >
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>

              
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
	<script type="text/javascript" src="<?=base_url()?>vendors/new-login/js/jquery.js"></script>

    <!-- Bootstrap Core Js -->
	<script type="text/javascript" src="<?=base_url()?>vendors/new-login/js/bootstrap.js"></script>


    <!-- Waves Effect Plugin Js -->
    <script  href="<?php echo base_url();?>/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url();?>/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
	<script type="text/javascript" src="<?=base_url()?>vendors/new-login/js/admin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>vendors/new-login/js/sign-in.js"></script>

</body>

</html>
