<?php
$group_id='';
?>
<?php
if(isset($_POST['submit']))
{
 $group_code		= $_POST['group_code'];
 $group_description = $_POST['group_description'];
 $balance_sheet_side = '';
 $group_status	  = 'active';
 $account_type = 'balance_sheet';

	  $insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'coa_groups', array(		
			'group_code' 			=> $group_code,	
            'group_description' 	 => $group_description,
            'balance_sheet_group'   => 1,
            'balance_sheet_side'    => $balance_sheet_side,
            'pls_group' 			 => '',	 
            'pls_side' 			  => '',
            'statistics_only' 	   => 0,
            'group_status' 		  => $group_status
		
		)); 
 
	  echo '<script>window.location.replace("'.SITE_ROOT.'?route=modules/gl/setup/coa_groups/list_coa_groups");</script>';     		 
 }



?>
    
	
	<section class="content-header">
          <h1>
           Add Chart of Account Group
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i></a>General Ledger</li>
            <li><a href="#">Chart of Account Group</a></li>
            <li class="active">Add new Account Group</li>
          </ol>
        </section>
		 <!-- Main content -->
 <section class="content">
    
        <!-- general form elements -->
    <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Provide the required fields</h3>
				   <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form"class="form-horizontal" method="post" action="">
                  <div class="box-body">
                    <div class="form-group">
								<label class="col-md-3 col-sm-3 control-label">Group Code:</label>
								<div class="col-md-2 col-sm-9">
									 <input class="form-control" type="text" required name="group_code" id="group_code"
						   pattern="[0-9]{4}"  maxlength="4">
								
							 <p class="help-block">Must be length 4 and numbers only</p>
							</div>
								</div>
			    	
					
                    <div class="form-group">
						<label class="col-md-3 col-sm-3 control-label">Group/Heading Name:</label>
						<div class="col-md-5 col-sm-9">
						 <input class="form-control" type="text" required name="group_description" id="group_description">
						</div>
					</div>		

             


					
				</div><!-- /.box-body -->
                  <div class="box-footer">
					<div class="form-group">
					<div class="col-sm-3">
					</div>
					<div class="col-sm-9">
                    <input type="submit" class='btn btn-primary btn-lg ' name="submit" value="SAVE">
					
					</div>
					</div>
				 </div>
                </form>
    </div><!-- /.box -->


</section>
	