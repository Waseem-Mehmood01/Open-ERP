<?php
//print_r($_GET);
//echo "<br/>";
//print_r($_POST);
$voucher_desc = "";
$voucher_ref = "";
$voucher_date = "";
if(isset($_GET['purchase_id'])) {
	$purchase_id = $_GET['purchase_id'];
}
if($purchase_id > 0) {
	$sql = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."purchase WHERE purchase_id=".$purchase_id;
	$voucher = DB::queryFirstRow($sql);
}


?><!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          	Purchase
            <small>Detail</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Purchase</a></li>
            <li class="active">Detail</li>
          </ol>
        </section>
        <!-- Main content -->
        <section >
          <!-- title row -->
          <div class="box">
    
<div class="box-body">

          <div class="row info">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> &nbsp;<?php echo $_SESSION['company_name']; ?>
                
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row ">
            <div class="col-sm-8  "> 
			 <b>Party Name:</b> <?php echo $voucher['mill_name']; ?><br/>
                <strong>Party Address :</strong>
                <BR/>
                <p><?php echo $voucher['mill_address']; ?></p>
            </div><!-- /.col -->
			<div class="col-sm-4  ">
              <b>Purchase ID: </b> <?php echo $purchase_id; ?></b><br/>
              <b>Purchase Order Ref#:</b> <?php echo $voucher['ref_no']; ?><br/>
              <b>Vehicle No.:</b> <?php echo $voucher['vehicle_no']; ?><br/>
              <b>Purchase Order Date:</b> <?php echo getDateTime($voucher['order_date'],"dLong"); ?><br/>
			 
            </div><!-- /.col -->
			 
          </div><!-- /.row -->
          
          
            
            <div class="box-header with-border">
              <h3 class="box-title">Add Sale Order Details</h3>
 
              </div>


      	<div class='row'>
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							
							<th><label>Creditor</label></th>
							<th><label>Weight</label></th>
							<th><label>Bags</label></th>
							<th><label>Rate</label></th>
							<th><label>Sub Total</label></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = 'SELECT * FROM '.DB_PREFIX.$_SESSION['co_prefix'].'purchase_detail WHERE purchase_id="'.$purchase_id.'"';
$voucher_expense = DB::query($sql);
foreach($voucher_expense as $list_voucher_expense) { 
					?>
						<tr>
							
							<td><?php echo $list_voucher_expense['customer_name']; ?></td>
							
							<td><?php echo $list_voucher_expense['weight'].'&nbsp;'.$list_voucher_expense['unit']; ?></td>
							
							<td><?php echo $list_voucher_expense['bags']; ?></td>
							<td><?php echo $list_voucher_expense['rate']; ?></td>
							<td><?php echo $list_voucher_expense['total_amount']; ?></td>
                  
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
      		</div>
      	</div>
      	<div class='row'>
  
			<div class='col-xs-8 col-sm-offset-10 col-md-offset-10 col-lg-offset-10 col-sm-2 col-md-2 col-lg-2'>
			<div class="form-group">
						<label>Total Amount: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input type="text" class="form-control" name="subTotal" id="subTotal" placeholder="Total Amount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"readonly="true" value="<?php echo $voucher['total_amount'] ?>">
						</div>
			</div>
			<a href="?route=modules/purchase/edit_purchase&purchase_id=<?php echo $purchase_id; ?>" class="btn btn-lg btn-success">Edit</a>
			</div>
		
</div><!-- /.box-body -->
            <div class="box-footer">
             <small> Explanation text for Sale Order details</small>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
		  
     	 </section><!-- /.content -->      
		 
		 