<?php
if ( (isset($_SESSION['is_logged'])) AND ($_SESSION['is_logged'] == 1)) {
	$username = $_SESSION['user_name'];
	$role_id = getUserRoleID($_SESSION['user_id']);
}
if($_SESSION['role_id']<>1){
	die("Access denied");
}
if(isset($_GET['user_id'])){
	$user_id = $_GET['user_id'];
}else{
	$user_id = $_SESSION['user_id'];
}

	$message= "";
if(isset($_POST['update'])){

$user_name = $_POST['user_name'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_role_id = $_POST['user_role_id'];
/* update logged in user data  */	
DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'users',array(
			'user_name' => $user_name,
			'first_name' => $firstname,
			'last_name' => $lastname,
			'user_email' => $email,
			'role_id' => $user_role_id,
			'password' => $password ), "user_id =%s", $user_id );
DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."user_module_access WHERE user_id='".$user_id."'");			
	for($i=0, $iMaxSize=count($_POST['module_id']); $i<$iMaxSize; $i++){
		$insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'user_module_access', 
								array(			
										'user_id'		=> $user_id,
										'module_id'		=> $_POST['module_id'][$i] 
									));
	}
$message = "Successfully Updated";
 
echo '<script type="text/javascript">
<!--
window.location = "?route=modules/system/user_management"
//-->
</script>';
} else {

/* Retrive logged in user data */

$sql_user = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."users WHERE user_id ='".$user_id."'";
$user_info = DB::queryFirstRow($sql_user);
	$user_name = $user_info['user_name'];
	$firstname = $user_info['first_name'];
	$lastname = $user_info['last_name'];
	$email = $user_info['user_email'];
	$password = $user_info['password'];
	$user_role_id = $user_info['role_id'];
}

?>

<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
         
       <br>
<p class=" text-info"><?php echo date("Y-m-d h:i:sa"); ?> </p>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" > 
          <div class="panel panel-info">
		  <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $firstname." ".$lastname; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="images/user_thumb.png" class="img-circle"> </div>
         
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>User ID:</td>
                        <td><?php echo $user_id; ?>
						</td>
                      </tr>		  
                      <tr>
                        <td>User Name:</td>
                        <td><input type="text" required value = "<?php echo $user_name; ?>" name="user_name"></td>
                      </tr>
					  <tr>
                        <td>Password:</td>
                        <td><input type="password" required value = "<?php echo $password; ?>" name="password"></td>
                      </tr>
                      <tr>
                        <td>First Name</td>
                        <td><input type="text" required value = "<?php echo $firstname; ?>" name="firstname"></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Last Name</td>
                        <td><input type="text" required value = "<?php echo $lastname; ?>" name="lastname"></td>
                      </tr>                       
                      <tr>
                        <td>Email</td>
                        <td><input type="email" required value = "<?php echo $email; ?>" name="email"></td>
                      </tr>                      
                    <tr>
                        <td>User Role</td>
                        <td>
						<select class="form-control" name="user_role_id">
							<option value="2" <?php if($user_role_id==2) echo "SELECTED"; ?> >Sub-User</option>
							<option value="1" <?php if($user_role_id==1) echo "SELECTED"; ?>>Super Admin</option>
						</select>
						<small>*Super Admin can access User and Company management</small>
                      </tr>  
                      <tr>
                        <td>Accessible Modules</td>
                <td>
				
				<?php
				$module_ids[] = array();
				$sql = "SELECT m.`user_id`,m.`module_id`
FROM
    sa_test_user_module_access m
    INNER JOIN sa_test_user_modules um 
        ON (m.`module_id` = um.`module_id`)
      WHERE m.`user_id`='".$user_id."'";
	  $modules = DB::query($sql);
				//print_r($modules);
				foreach ($modules as $module){
					$module_ids[] = $module['module_id'];
				}
				
				?>
				
				<select class="form-control select2" name="module_id[]" multiple="multiple" data-placeholder="Assign multiple modules">
                  <?php 
				  
				  $sql ="SELECT module_id, category_title, module_title
FROM
    `sa_test_user_modules`
    INNER JOIN `sa_test_module_category` 
        ON (`sa_test_user_modules`.`category_id` = `sa_test_module_category`.`category_id`)";
		$res = DB::query($sql);
		foreach($res as $row){
		?>
		<option  value="<?php echo $row['module_id']; ?>" <?php if(in_array($row['module_id'],$module_ids)) echo "SELECTED"; ?> ><?php echo $row['category_title']." - ".$row['module_title']; ?></option> 
		<?php } ?>
                </select>
				<small>*Assign modules by category groups</small>
              </td>
                      </tr>   
					  <tr>
					  <td></td>
					  <td><input type="submit" class='btn btn-primary btn-sm' name="update" value="Update">
					  <font color="red"><?php echo $message;?> </font>
					  </td>
					  </tr>
                     
                    </tbody>
                  </table>
                              
                </div>
              </div>
            </div>
                <!--  <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div> -->
            </form>
          </div>
        </div>
      </div>
    </div>

