<?php
if(isset($_GET['del'])){
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql = "DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."customers WHERE customer_id=".$id;
		$acc =  DB::query($sql);
		echo '<script type="text/javascript">
<!--
window.location = "?route=modules/customers/customer_management"
//-->
</script>';
	}
}
?>
<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><h3>Customers<a href="?route=modules/customers/add_customer" class=" pull-right btn btn-sm btn-primary"> <span class="glyphicon glyphicon-plus"></span> &nbsp;Add New Customer</a> </h3> </div>
  <div class="panel-body">
<?php
$tbl = new HTML_Table('', 'table table-striped table-bordered');
$tbl->addRow();
$tbl->addCell('Customer Name', '', 'header');
$tbl->addCell('Mobile', '', 'header');
$tbl->addCell('Phone', '', 'header');
$tbl->addCell('Email', '', 'header');
$tbl->addCell('Address', '', 'header');
$tbl->addCell('Actions', '', 'header');
?>

<?php
$sql = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."customers";
$get_users = DB::query($sql);
foreach($get_users as $user) { 
$tbl->addRow();
$tbl->addCell($user['name']);
$tbl->addCell($user['mob']);
$tbl->addCell($user['phone']);
$tbl->addCell($user['email']);
$tbl->addCell($user['address']);
$tbl->addCell("<a class='btn btn-primary btn-sm' href ='?route=modules/customers/edit_customer&customer_id=".$user['customer_id']."'>Edit&nbsp;<span class='glyphicon glyphicon-new-window'></span></a>&nbsp;<a class='btn btn-danger btn-sm' href ='?route=modules/customers/customer_management&del=1&id=".$user['customer_id']."'>Delete&nbsp;<span class='glyphicon glyphicon-trash'></span></a>
			   ");
		   
}
			   echo $tbl->display();
?>
 </div>
</div>
