<?php
if(isset($_GET['del'])){
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql = "DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."users WHERE user_id=".$id;
		$acc =  DB::query($sql);
		DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."user_module_access WHERE user_id='".$id."'");
		echo '<script type="text/javascript">
<!--
window.location = "?route=modules/system/user_management"
//-->
</script>';
	}
}
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3>Users<a href="?route=modules/system/add_user" class=" pull-right btn btn-sm btn-primary"> <span class="glyphicon glyphicon-plus"></span> &nbsp;Add New User</a> </h3> </div>
  <div class="panel-body">

<table class="table table-striped table-bordered">
	<tr>
	<th>User Name</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Role ID</th>
	<th>Actions</th>
	</tr>

<?php
$sql = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."users";
$get_users = DB::query($sql);
foreach($get_users as $user) { 
echo "<tr>";
echo "<td>".$user['user_name']."</td>";
echo "<td>".$user['first_name']."</td>";
echo "<td>".$user['last_name']."</td>";
echo "<td>".$user['user_email']."</td>";
echo "<td>".$user['role_id']."</td>";
echo "<td><a class='btn btn-primary btn-sm' href ='?route=modules/system/edit_profile&user_id=".$user['user_id']."'>Edit&nbsp;<span class='glyphicon glyphicon-new-window'></span></a>";
if($user['user_id']<>$_SESSION['user_id'])
echo "<a class='btn btn-danger btn-sm' href ='?route=modules/system/user_management&del=1&id=".$user['user_id']."'>Delete&nbsp;<span class='glyphicon glyphicon-trash'></span></a>
			   </td>";
echo "</tr>";		   
}
			  // echo $tbl->display();
?>
</table>
 </div>
</div>
