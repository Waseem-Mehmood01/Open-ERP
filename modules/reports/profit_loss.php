<?php
 $table = "";
  $from = "";
 $to = "";
 if(isset($_POST['submit'])){
	 $from = $_POST['fromDate'];
	 $to = $_POST['toDate'];
	$sql = "SELECT SUM(total_amount) AS total_amount FROM sa_test_sale s WHERE s.`order_date` BETWEEN '".$from."' AND '".$to."' AND s.`is_return`=0";
		$income = DB::queryFirstField($sql);
		$sql = "SELECT SUM(total_amount) AS total_amount FROM sa_test_purchase s WHERE s.`order_date` BETWEEN '".$from."' AND '".$to."' AND s.`is_return`=0";
		$purchase = DB::queryFirstField($sql);
		$sql="SELECT SUM(e.`voucher_total`) AS total_amount FROM sa_test_voucher_expense e WHERE DATE(e.`voucher_date`) BETWEEN '".$from."' AND '".$to."' AND e.`active`=1";
		$other_exp=DB::queryFirstField($sql);
		//print_r($data);
		$table="<table class='table table-bordered table-striped' style='max-width:400px'>
					<tr><th> Income/Expense </th>
					<th> Net Balance </th>
					</tr>";
		$table .="<tr>";
		$table .="<td> <b>Income </b></td>";
		$table .="<td>&nbsp;</td>";
		$table .="</tr>";
		$table .="<tr>";
		$table .="<td>Total Sale</td>";
		$table .="<td> ".$income."</td>";
		$table .="</tr>";
		$table .="<tr>";
		$table .="<td>&nbsp;&nbsp;&nbsp;<b>Gross Profit</b></td>";
		$table .="<td style='border-top: 2px solid black;'> ".$income."</td>";
		$table .="</tr>";
		$table .="<tr>";
		$table .="<td> <b>Expenses </b></td>";
		$table .="<td>&nbsp;</td>";
		$table .="</tr>";
		$table .="<tr>";
		$table .="<td>Total Purchase</td>";
		$table .="<td> ".$purchase."</td>";
		$table .="</tr>";
		$table .="<tr>";
		$table .="<td>Other Expenses</td>";
		$table .="<td> ".$other_exp."</td>";
		$table .="</tr>";
				$table .="<tr>";
		$netExp = $purchase+$other_exp;
		$table .="<td>&nbsp;&nbsp;&nbsp;<b>Net Expense</b></td>";
		$table .="<td style='border-top: 2px solid black;'> ".$netExp."</td>";
		$table .="</tr>";
		$table .="<tr>";
		$net = $income - $netExp;
		$table .="<td><b>Net Profit (Loss)</b></td>";
		$table .="<td style='border-top: 2px solid black;'><b> ".$net."</b></td>";
		$table .="</tr>";
		$table .="</table>";
 }

 

 ?>
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Report
            <small>Profit & Loss.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            
            <li class="active">Profit & Loss Reporting</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Profit & Loss Reporting</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
			<form method="POST" action="">
					<div class="row">
					<div class="col-md-10 form-inline">
						<div class="col-md-3">
							<label>From: </label><input type="text" name="fromDate" value="<?php echo $from; ?>" class="form-control date-picker">
						</div>
						<div class="col-md-3">
							<label>To: </label><input type="text" name="toDate" value="<?php echo $to; ?>" class="form-control date-picker">
						</div>
						<div class="col-md-3">
							<label>&nbsp;</label><input type="submit" name="submit" value="Process Now" class="btn btn-default">
						</div>
					</div>
				</div>
			</form>	
		
		<center>
			<?php echo $table; ?>
		</center>
            </div><!-- /.box-body -->
            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->