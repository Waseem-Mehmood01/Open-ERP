 <?php

 ?>
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Report
            <small>Trial Balance.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            
            <li class="active">Trial Balance Reporting</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Trial Balance Reporting</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
					<div class="row">
					<div class="col-md-10 form-inline">
						<div class="col-md-3">
							<label>From: </label><input type="text" name="fromDate" class="form-control date-picker">
						</div>
						<div class="col-md-3">
							<label>To: </label><input type="text" name="toDate" class="form-control date-picker">
						</div>
						<div class="col-md-3">
							<label>&nbsp;</label><input type="submit" name="submit" value="Process Now" class="btn btn-default">
						</div>
					</div>
				</div>
            </div><!-- /.box-body -->
            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->