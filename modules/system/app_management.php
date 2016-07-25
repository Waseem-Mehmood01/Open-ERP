 <?php
 if(isset($_POST['saveSale'])){
	 @extract($_POST);
	 DB::update("sa_test_app_management",array(
						'debit_account' 	=> $debit_account,
						'credit_account'	=> $credit_account
						),"module=%s", "Sales");
	echo "<script>alert('Apply successfuly');</script>";					
 }
 
 if(isset($_POST['savePurchase'])){
	 @extract($_POST);
	  DB::update("sa_test_app_management",array(
						'debit_account' 	=> $debit_account,
						'credit_account'	=> $credit_account
						),"module=%s", "Purchase");
	echo "<script>alert('Apply successfuly');</script>";
 }
 ?>
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Application Management
            <small>All application's debits,credits and accounts management.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            
            <li class="active">Application Management</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Apply default values</h3><small> These settings have impact on reporting.</small>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
		<div class='row'>
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							
							<th><label>Module</label></th>
							<th><label>Debit account</label></th>
							<th><label>Credit account</label></th>
							<th><label>Action</label></th>
							
						</tr>
					</thead>
					<tbody>
						<tr>
						<form name="frmSale" method="POST" action="">
							<td>
							<h4>Sales</h4>
							</td>
							<td>
							<?php
							$debitAccount = DB::queryFirstField("SELECT debit_account FROM sa_test_app_management WHERE module='Sales'");
							$creditAccount = DB::queryFirstField("SELECT credit_account FROM sa_test_app_management WHERE module='Sales'");
							?>
							<select class="form-control" name="debit_account" required>
								<option value="">Select Account</option>
								<?php
									$sql = "select * from sa_test_coa where account_status='Active'";
									$res = DB::query($sql);
									foreach($res as $row){
											echo "<option value ='".$row['account_id']."' ";
												if($debitAccount==$row['account_id']) echo "SELECTED";
											echo ">".$row['account_desc_short']."</option>";
									} ?>
							</select></td>
							<td><select class="form-control" name="credit_account" required>
								<option value="">Select Account</option>
								<?php
									$sql = "select * from sa_test_coa where account_status='Active'";
									$res = DB::query($sql);
									foreach($res as $row){
											echo "<option value ='".$row['account_id']."' ";
												if($creditAccount==$row['account_id']) echo "SELECTED";
											echo ">".$row['account_desc_short']."</option>";
									} ?>
							</select></td>
							<td><input type="submit" class="btn btn-success" name="saveSale" value="Apply" /></td>
						</form>
						</tr>
						<tr>
						<form name="frmPurchase" method="POST" action="">
							<td>
							<h4>Purchase</h4>
							</td>
							<td>
							<?php
							$debitAccount = DB::queryFirstField("SELECT debit_account FROM sa_test_app_management WHERE module='Purchase'");
							$creditAccount = DB::queryFirstField("SELECT credit_account FROM sa_test_app_management WHERE module='Purchase'");
							?>
							<select class="form-control" name="debit_account" required>
								<option value="">Select Account</option>
								<?php
									$sql = "select * from sa_test_coa where account_status='Active'";
									$res = DB::query($sql);
									foreach($res as $row){
											echo "<option value ='".$row['account_id']."' ";
												if($debitAccount==$row['account_id']) echo "SELECTED";
											echo ">".$row['account_desc_short']."</option>";
									} ?>
							</select></td>
							<td><select class="form-control" name="credit_account" required>
								<option value="">Select Account</option>
								<?php
									$sql = "select * from sa_test_coa where account_status='Active'";
									$res = DB::query($sql);
									foreach($res as $row){
											echo "<option value ='".$row['account_id']."' ";
												if($creditAccount==$row['account_id']) echo "SELECTED";
											echo ">".$row['account_desc_short']."</option>";
									} ?>
							</select></td>
							<td><input type="submit" class="btn btn-success" name="savePurchase" value="Apply" /></td>
						</form>
						</tr>
						
					</tbody>
				</table>
      		</div>
      	</div>
            </div><!-- /.box-body -->
            <div class="box-footer">
             <small> Please do not make changes to these unless you are really sure what you are doing. making changes here have system wide impact</small>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->