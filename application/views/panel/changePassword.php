<?php


// if($dataRegister == "TRUE"){	

// 	$password = set_value("");
// 	$passwordRetry = set_value("");
// 	echo "<script>alert('کلمه عبور تغییر پیدا کرد لطفا دوباره وارد شوید');</script>";
// 	redirect(base_url().'index.php/acms/logout','refresh');
	
// }elseif($dataRegister == "FALSE" ){
	
// 	$password = set_value('password','');
// 	$passwordRetry = set_value('passwordRetry','');
// 	echo "<script>alert('".$error."');</script>";
	
// }


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.:<?=$pageTitle;?>:.</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=acms_css_url();?>bootstrap-theme.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>rtl.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>font-awesome.min.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>AdminLTE.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>blue.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>alertify.rtl.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b> تغییر کلمه عبور</b></a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">کاربر گرامی لطفا برای اولین ورود کلمه عبور خود را تعیین نمایید </p>

    <form action="<?php echo base_url();?>Acms/changePassword" method="post">
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" id="password" tabindex="1"	maxlength="16" placeholder="رمز عبور">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password') ?>
      </div>
      <div class="form-group has-feedback">
        <input name="passwordRetry" type="password" class="form-control" tabindex="2" maxlength="16" placeholder="تکرار رمز عبور">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <?php echo form_error('passwordRetry') ?>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block btn-flat">تغییر رمز عبور</button>
        </div>
      </div>
    </form>
    <div class="social-auth-links text-center">
      <p></p>
    </div>
</div>
<script src="<?=acms_js_url();?>jquery.min.js"></script>
<script src="<?=acms_js_url();?>bootstrap.min.js"></script>
<script src="<?=acms_js_url();?>icheck.min.js"></script>
<script src="<?=acms_js_url();?>alertify.min.js"></script>
<?php
if($resultMessage != null){
    if($resultMessage['result'] == "Success"){
        echo "<style>.alertify .ajs-header{background-color:#D1E231}</style>";
    }elseif($resultMessage['result'] == "Alert"){
        echo "<style>.alertify .ajs-header{background-color:#FFC0CB}</style>";
    }elseif($resultMessage['result'] == "Access"){
        echo "<style>.alertify .ajs-header{background-color:#FBCEB1}</style>";
    }
?>
    <script>
         alertify.alert('<?=$resultMessage['group'];?>','<?=$resultMessage['message'];?>').set('onok', function(closeEvent){ 
             <?php
             if($resultMessage['url'] != null ){
             ?>
              window.location.href = '<?=$resultMessage['url'];?>';
             <?php
             }
             ?>        
         }); 
    </script>
<?php 
}
?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

