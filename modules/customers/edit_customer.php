<?php
if(isset($_GET['customer_id'])){
	$customer_id = $_GET['customer_id'];
}
else{
	die('Customer ID missing');
}
	$message= "";
if(isset($_POST['update'])){
@extract($_POST);
/* update logged in user data  */	
DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'customers',array(
			'name' => $name,
			'mob' => $mob,
			'phone' => $phone,
			'email' => $email,
			'address' => $address), "customer_id =%s", $customer_id );
$message = "Successfully Updated";
 
echo '<script type="text/javascript">
<!--
window.location = "?route=modules/customers/customer_management"
//-->
</script>';
} else {

/* Retrive customers data */

$sql_user = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."customers WHERE customer_id ='".$customer_id."'";
$user_info = DB::queryFirstRow($sql_user);
	
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
              <h3 class="panel-title">Edit Customer</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                
         
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
 	  
                      <tr>
                        <td>Customer Name:</td>
                        <td><input type="text" required value = "<?php echo $user_info['name']; ?>" name="name"></td>
                      </tr>
					  <tr>
                        <td>Mobile:</td>
                        <td><input type="text" value = "<?php echo $user_info['mob']; ?>" name="mob"></td>
                      </tr> 
                      <tr>
                        <td>Phone</td>
                        <td><input type="text"  value="<?php echo $user_info['phone']; ?>" name="phone"></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Email</td>
                        <td><input type="email" value = "<?php echo $user_info['email']; ?>" name="email"></td>
                      </tr>                       
                      <tr>
                        <td>Address</td>
                        <td><textarea name="address"><?php echo $user_info['address']; ?></textarea></td>
                      </tr>   
					                     
                           
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

