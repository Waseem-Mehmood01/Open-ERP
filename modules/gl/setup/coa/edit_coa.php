<?php
$group_id="";
$parent_account_id = "";
$account_type = "activity_account";
$account_code = "";
$account_desc_short = "";
$account_desc_long = "";
$code_exists = 0;
$desc_exists = 0;

$account_status="Active";
if(isset($_POST['account_id'])){
	$coa_id = $_POST['account_id'];
}
else if(isset($_GET['account_id'])){
	$coa_id = $_GET['account_id'];
} else {
	$coa_id = '';
}

/* Retrive logged in user data */
								$sql_coa = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."coa WHERE account_id ='".$coa_id."'";
								$coa_info = DB::queryFirstRow($sql_coa);
								$account_code= $coa_info['account_code'];
								$account_group = $coa_info['account_group'];
								$account_desc_short = $coa_info['account_desc_short'];
								$account_desc_long = $coa_info['account_desc_long'];
								$parent_account_id = $coa_info['parent_account_id'];
								$account_status = $coa_info['account_status'];
								
if(isset($_POST['update'])){
	@extract($_POST);
$update = update_coa($account_code,
					$account_group,
					$account_desc_short, 
					$account_desc_long,
					$parent_account_id,
					$account_status,
					$coa_id
					);
echo '<script>window.location.replace("'.SITE_ROOT.'?route=modules/gl/setup/coa/list_coa");</script>';					
}


?>

 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          	Add New Account
            <small>Add New Account to Chart of Accounts</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">General Ledger</a></li>
            <li class="active">Add New Account Wizard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Account Wizard (Review Information)</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
<div class="box-body">
     <div class="progress">
		<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
        <span class="sr-only">90% Complete  </span>
        </div>
      </div>
   
<form class="form-horizontal" role="form" method="POST" action="">
	<div class="form-group">
		<label class="col-md-3 col-sm-3 control-label">&nbsp;Account Group:
		</label>
        <div class="col-md-9 col-sm-9">
<input type="hidden" name="account_group" value="<?php echo $group_id; ?>" />
			 <select class="form-control" name="account_group" id="account_group" >
				<option value=""> -- Select --</option>
<?php 
	$groups_query = "SELECT group_id, group_code, group_description,balance_sheet_side from ";
	$groups_query .= DB_PREFIX.$_SESSION['co_prefix']."coa_groups";
	
	$groups = DB::query($groups_query);
	
			foreach ($groups as $group) {
?>					
				<option <?php 
					if ($account_group == $group['group_id'] ) {
					echo 'selected = "selected"';
					}?>  value="<?php echo $group['group_id']; ?>" >
<?php echo $group['group_code']." - ".$group['group_description']." - (".$group['balance_sheet_side'].")"; ?>
				</option>
			<?php }// end foreach loop ?>
			</select>
			<p class="help-block"> </p>
		</div>
	</div>

<input type="hidden" name="account_type" value="<?php echo $account_type; ?>" /> 
<div class="form-group  ">
	<label class="col-md-3 col-sm-3 control-label"> &nbsp;Account Type:</label>
		<div class="col-md-9 col-sm-9">
			<div class="col-md-4 col-sm-4">
 		   		<input   type="radio" <?php if($account_type == "consolidate_only") { echo 'checked="checked"';} ?> value="consolidate_only"   name="account_type" class="col-sm-2 line-blue"  />
            	<label>Consolidate Only</label>
           </div>
  			<div class="col-md-4 col-sm-4">
 		   		<input   type="radio" <?php if($account_type == "activity_account") { echo 'checked="checked"';} ?> value="activity_account" name="account_type" class="col-sm-2 line-blue"  />
            	<label>Activity Account</label>
           </div>         
		<p class="help-block"> </p>
	</div><!-- /.col -->
</div> <!-- /form-group -->
<div class="form-group ">
	<label class="col-md-3 col-sm-3 control-label">&nbsp;Account Code:</label>
		<div class="col-md-9 col-sm-9">
		<div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-book"></i>
          </div>
          <input required="reqired" type="text" name="account_code" class="masked form-control" placeholder="" value="<?php echo $account_code;?>"  pattern="[0-9]{4}"  maxlength="4" >
		  
          </div><!-- /.input group -->
                
		<p class="help-block">Make sure account code does not exist already & max length 4 </p>
	</div><!-- /.col -->
</div> <!-- /form-group --> 
<div class="form-group">
	<label class="col-md-3 col-sm-3 control-label">&nbsp;Short Description:</label>
		<div class="col-md-9 col-sm-9">
		<div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-tag"></i>
          </div>
          <input type="text" value="<?php echo $account_desc_short;?>" name="account_desc_short" class="form-control" required="required" />
          </div><!-- /.input group -->
                
		<p class="help-block">Account name also should be unique (Does not exist already)</p>
	</div><!-- /.col -->
</div> <!-- /form-group --> 
<div class="form-group ">
	<label class="col-md-3 col-sm-3 control-label"> &nbsp;Longer Description:</label>
		<div class="col-md-9 col-sm-9">
<textarea  name="account_desc_long" class="form-control textarea"  ><?php echo $account_desc_long;?></textarea>
                
		<p class="help-block"> </p>
	</div><!-- /.col -->
</div> <!-- /form-group --> 
        
<div class="form-group">
	<div class="col-sm-12">
		
		<button type="submit" class='btn btn-success btn-lg pull-right' name="update" value="Next">Update & Save&nbsp; <i class="fa fa-chevron-circle-right"></i></button>
	</div>	<!-- /.col -->
</div>		<!-- /form-group -->	   
</form>
            <!-- /Add Account Form  -->
             </div><!-- /.box-body -->
            <div class="box-footer">
             <small> Please do not make changes to these unless you are really sure what you are doing. making changes here have system wide impact</small>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->
