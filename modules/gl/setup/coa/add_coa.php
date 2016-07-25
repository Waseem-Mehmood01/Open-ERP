<?php
$group_id="";
$parent_account_id = "";
$account_type = "activity_account";
$account_code = "";
$account_desc_short = "";
$account_desc_long = "";
$code_exists = 0;
$desc_exists = 0;

if(isset($_POST['end'])){
	@extract($_POST);
$new_account =	add_coa(  		
					$account_code
					, $account_group
					, $account_desc_short
					, $account_desc_long
					, $parent_account_id
					, $account_type
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
              <h3 class="box-title">Add New Account Wizard</h3>
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
					if ($group_id == $group['group_id'] ) {
					echo 'selected = "selected"';
					}?>  value="<?php echo $group['group_id']; ?>" >
<?php echo $group['group_code']." - ".$group['group_description']; ?>
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
		
		<button type="submit" class='btn btn-success btn-lg pull-right' name="end" value="Next">Save&nbsp; <i class="fa fa-chevron-circle-right"></i></button>
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
