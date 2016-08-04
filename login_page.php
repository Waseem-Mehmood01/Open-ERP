
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Asia</b>Traders</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg" style="color:red;" id="msg"></p>
        <form action="" method="post" name="frmLogin" id="frmLogin">
          <div class="form-group has-feedback">
            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="User Name" required="required"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"required="required"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <input style="font-style: italic; font-size: large; font-weight: bold;" type="button" name="log_in" id="log_in" class="btn btn-primary btn-block btn-flat" value="Log In"/>
            </div><!-- /.col -->
          </div>
        </form>




      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
<div style="background-color: #FFF; max-width: 222px; padding: 6px; position: fixed; bottom: 0px; right: 0px;">Developed By:<a href="http://waseem.webberbiz.com/" target="_BLANK"> Waseem Mehmood</a></div>
   
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
				if(($.trim(user)!='')&&($.trim(password)!='')){
						attempLogin();
						$('#msg').html(" ");
				} else {
					$('#msg').html("Please enter User ID and Password");
				}
				
			});
			
			$('input').keydown(function(e) {
			  if (e.which == 13) {
				user = $('#user_name').val();
				password = $('#password').val();
				if(($.trim(user)!='')&&($.trim(password)!='')){
						attempLogin();
						$('#msg').html(" ");
				} else {
					$('#msg').html("Please Enter User ID and Password");
				}
			  }
			});

	});
	function attempLogin(){
			user = $('#user_name').val();
			password = $('#password').val();
				$.ajax({  
						type: "POST",  
						url: "ajax_helpers/ajax_check_login.php",  
						data: "user="+user+"&password="+password, 
						beforeSend: function(){
								$('#log_in').attr( "value", "Loging In.." );
								$('#log_in').addClass( "disabled");
								},					
						success: function(data){  
							if(data==1){
								$(location).attr('href','index.php');
							}else{
								$('#msg').html("Invalid User ID or Password");
								$('#log_in').attr( "value", "Log In" );
								$('#log_in').removeClass( "disabled");
							}
						}
					});
	}
	</script>
 