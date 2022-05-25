<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$pageTitle;?></title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <link rel="stylesheet" href="<?=acms_css_url();?>bootstrap-theme.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>rtl.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>font-awesome.min.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>AdminLTE.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>blue.css">
  <link rel="stylesheet" href="<?=acms_css_url();?>alertify.rtl.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url();?>"><b>ورود به سایت</b></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">جهت ورود به کنترل پنل اطلاعات ورود خود را وارد نمایید</p>
    <form action="<?=base_url();?>Acms" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="ایمیل" autocomplete="off" id="username" name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('username') ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="رمز عبور" autocomplete="off" id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password') ?>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" id="admin" name="submit" value="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
          <p class="text-danger text-center"><?=$error;?></p>
        </div>
      </div>
    </form>

  </div>
</div><!-- /.login-box -->
<input type="hidden" value=<?=base_url();?> id="base_url" />
<script src="<?=acms_js_url();?>jquery.min.js"></script>
<script src="<?=acms_js_url();?>bootstrap.min.js"></script>
<script src="<?=acms_js_url();?>alertify.min.js"></script>
<script src="<?=acms_js_url();?>modules/admin.js"></script>
</body>
</html>
