
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Asia</b>Traders</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg" style="color:red;" id="msg"></p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="User Name" required="required"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"required="required"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="button" name="log_in" id="log_in" class="btn btn-primary btn-block btn-flat" value="Log In"/>
            </div><!-- /.col -->
          </div>
        </form>




      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
		<script>
	$(document).ready(function(){
		$('#log_in').click(function(){
			user = $('#user_name').val();
			password = $('#password').val();
				$.ajax({  
						type: "POST",  
						url: "ajax_helpers/ajax_check_login.php",  
						data: "user="+user+"&password="+password, 
						before: $('#log_in').attr( "value", "Loging In.." ),					
						success: function(data){  
							if(data==1){
								$(location).attr('href','index.php');
							}else{
								$('#msg').html("Invalid User ID or Password");
								$('#log_in').attr( "value", "Log In" );
							}
						}
					});
			});

	});
	</script>
  </body>
</html>