<?php
$text='"Are you sure to put this sale to return?"';
$text2='"Are you sure to want delete this sale entry?"';
if(isset($_GET['is_return'])){
	$is_return=$_GET['is_return'];
	$sale_id = $_GET['sale_id'];
	$ref_no = $_GET['ref_no'];
	if($is_return==1){
		$update = DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'sale',array(
								'is_return' => '1'), "sale_id =%s", $sale_id );
		$update = DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'journal_vouchers',array(
								'active' => '0'), "voucher_ref_no =%s", $ref_no );					
	}
}
if(isset($_GET['is_approved'])){
	$sale_id = $_GET['sale_id'];
	$is_approved = $_GET['is_approved'];
	if($is_approved==1){
		$update = DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'sale',array(
								'is_approved' => '1'), "sale_id =%s", $sale_id );						
	}
	else if($is_approved==0){
		$update = DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'sale',array(
								'is_approved' => '0'), "sale_id =%s", $sale_id );						
	} 
	else {
		
	}
}
if(isset($_GET['delete'])){
	if(isset($_GET['sale_id'])){
		$sale_id = $_GET['sale_id'];
		DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale WHERE sale_id='".$sale_id."'");
		DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale_detail WHERE sale_id='".$sale_id."'");
		//get ref_no
		$ref_no = DB::queryFirstField("SELECT ref_no FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale WHERE sale_id='".$sale_id."'");
		// get voucher id
		$voucher_id = DB::queryFirstField("SELECT voucher_id FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_vouchers WHERE voucher_ref_no='".$ref_no."'");
		//delete previous voucher
		DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_vouchers WHERE voucher_id='".$voucher_id."'");
		DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_voucher_details WHERE voucher_id='".$voucher_id."'");
	}
}
?>


<?php
//Draft Expense Voucher
$tbl = new HTML_Table('', 'table table-hover table-striped table-bordered data-table');
$tbl->addTSection('thead');
$tbl->addRow();
$tbl->addCell('Sale ID', '', 'header');
$tbl->addCell('Debtor', '', 'header');
$tbl->addCell('Vehicle #', '', 'header');
$tbl->addCell('Mill Name', '', 'header');
$tbl->addCell('Mill Address', '', 'header');
$tbl->addCell('Order Date', '', 'header');
$tbl->addCell('Amount', '', 'header');
$tbl->addCell('Payment Received', '', 'header');
$tbl->addCell('Actions', '', 'header');
$tbl->addTSection('tbody');
?>

<?php

$sql = 'SELECT s.*, sd.`customer_name`
FROM
    sa_test_sale_detail sd
    INNER JOIN sa_test_sale s 
        ON (sd.`sale_id` = s.`sale_id`)
        WHERE s.`is_return`=0 AND s.`is_approved`=0
        GROUP BY s.`sale_id` ORDER BY s.`sale_id` ASC';
$voucher_expense = DB::query($sql);
foreach($voucher_expense as $list_voucher_expense) {	
$tbl->addRow();
$tbl->addCell($list_voucher_expense['sale_id']);
$tbl->addCell($list_voucher_expense['customer_name']);
$tbl->addCell($list_voucher_expense['vehicle_no']);
$tbl->addCell($list_voucher_expense['mill_name']);
$tbl->addCell($list_voucher_expense['mill_address']);
$tbl->addCell($list_voucher_expense['order_date']);
$tbl->addCell($list_voucher_expense['total_amount']);
if($list_voucher_expense['payment_received']==1){
$tbl->addCell("<span style='color:green;'>Yes<span>");	
} else {
	$tbl->addCell("<span style='color:red;'>NO<span>");	
}

$tbl->addCell("<a class='pull btn btn-warning btn-xs' href ='?route=modules/sales/view_sale&sale_id=".$list_voucher_expense['sale_id']."&is_approved=1'>Pending&nbsp;<span class='glyphicon glyphicon-alert'></span></a>&nbsp;
<a class='pull btn btn-default btn-xs' href ='?route=modules/sales/view_sale_detail&sale_id=".$list_voucher_expense['sale_id']."'>Detail&nbsp;<span class='glyphicon glyphicon-edit'></span></a>&nbsp;
<a class='pull btn btn-primary btn-xs' href ='?route=modules/sales/view_sale&sale_id=".$list_voucher_expense['sale_id']."&is_return=1&ref_no=".$list_voucher_expense['ref_no']."' onclick='return confirm(".$text.");'>Push Return&nbsp;<span class='glyphicon glyphicon-edit'></span></a> 
<a class='pull btn btn-danger btn-xs' href ='?route=modules/sales/view_sale&sale_id=".$list_voucher_expense['sale_id']."&delete=1' onclick='return confirm(".$text2.");'>Delete&nbsp;<span class='glyphicon glyphicon-trash'></span></a> ");
}
			  

?>



 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Sale Orders
            <small>List of All Sale .</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List OF All Sale</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">All pending orders</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
				<?php  echo $tbl->display(); ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
             
            </div>
          </div><!-- /.box -->
		</section> 
<?php
//Draft Expense Voucher
$tbl = new HTML_Table('', 'table table-hover table-striped table-bordered data-table');
$tbl->addTSection('thead');
$tbl->addRow();
$tbl->addCell('Sale ID', '', 'header');
$tbl->addCell('Debtor', '', 'header');
$tbl->addCell('Vehicle #', '', 'header');
$tbl->addCell('Mill Name', '', 'header');
$tbl->addCell('Mill Address', '', 'header');
$tbl->addCell('Order Date', '', 'header');
$tbl->addCell('Amount', '', 'header');
$tbl->addCell('Payment Received', '', 'header');
$tbl->addCell('Actions', '', 'header');
$tbl->addTSection('tbody');
?>

<?php
$sql = 'SELECT s.*, sd.`customer_name`
FROM
    sa_test_sale_detail sd
    INNER JOIN sa_test_sale s 
        ON (sd.`sale_id` = s.`sale_id`)
        WHERE s.`is_return`=0 AND s.`is_approved`=1
        GROUP BY s.`sale_id` ORDER BY s.`sale_id` ASC';
$voucher_expense = DB::query($sql);
foreach($voucher_expense as $list_voucher_expense) {	
$tbl->addRow();
$tbl->addCell($list_voucher_expense['sale_id']);
$tbl->addCell($list_voucher_expense['customer_name']);
$tbl->addCell($list_voucher_expense['vehicle_no']);
$tbl->addCell($list_voucher_expense['mill_name']);
$tbl->addCell($list_voucher_expense['mill_address']);
$tbl->addCell($list_voucher_expense['order_date']);
$tbl->addCell($list_voucher_expense['total_amount']);
if($list_voucher_expense['payment_received']==1){
$tbl->addCell("<span style='color:green;'>Yes<span>");	
} else {
	$tbl->addCell("<span style='color:red;'>NO<span>");	
}
$tbl->addCell("<a class='pull btn btn-success btn-xs' href ='?route=modules/sales/view_sale&sale_id=".$list_voucher_expense['sale_id']."&is_approved=0'>Approved&nbsp;<span class='glyphicon glyphicon-ok'></span></a>&nbsp;
<a class='pull btn btn-default btn-xs' href ='?route=modules/sales/view_sale_detail&sale_id=".$list_voucher_expense['sale_id']."'>Detail&nbsp;<span class='glyphicon glyphicon-edit'></span></a>&nbsp;
<a class='pull btn btn-primary btn-xs' href ='?route=modules/sales/view_sale&sale_id=".$list_voucher_expense['sale_id']."&is_return=1&ref_no=".$list_voucher_expense['ref_no']."' onclick='return confirm(".$text.");'>Push Return&nbsp;<span class='glyphicon glyphicon-edit'></span></a> 
<a class='pull btn btn-danger btn-xs' href ='?route=modules/sales/view_sale&sale_id=".$list_voucher_expense['sale_id']."&delete=1' onclick='return confirm(".$text2.");'>Delete&nbsp;<span class='glyphicon glyphicon-trash'></span></a> ");
}
			  

?>		
        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">All approved orders</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
				<?php  echo $tbl->display(); ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
             
            </div>
          </div><!-- /.box -->
		</section> 
