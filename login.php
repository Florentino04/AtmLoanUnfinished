<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
<html lang="en">
<?php session_start();?>
<?php include('./header.php');?>
<?php include('./db_connect.php');

if(isset($_SESSION['login_id']))
header("location:index.php?page=home");?>
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar"  style="background-image:url(assets/images/background/login-register.jpg);">
  <div class="login-box card">
    <div class="card-body">
      <form class="form-horizontal form-material" id="login-form">
        <a href="javascript:void(0)" class="text-center db"><img src="assets/images/logo-icon.png" alt="Home" /><br/><img src="assets/images/logo-text.png" alt="Home" /></a>  
        
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="username" id="username" required="" placeholder="Username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password" id="password" required="" placeholder="Password">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">Log In</button>
          </div>
        </div>
      </form>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="register2.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
          </div>
        </div>
      
      <script>
        $('#login-form').submit(function(e){
          e.preventDefault()
          $('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
          if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
          $.ajax({
            url:'ajax.php?action=login',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
              console.log(err)
          $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

            },
            success:function(resp){
              if(resp == 1){
                location.href ='index.php?page=home';
              }else if(resp == 2){
                location.href ='voting.php';
              }else{
                $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
              }
            }
          })
        })
      </script> 

    </div>
  </div>
</section>
  
  
</body>
</html>