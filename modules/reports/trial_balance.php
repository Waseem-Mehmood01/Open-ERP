 <?php
 $table = "";
 $from = "";
 $to = "";
 $debtors = 0;
 $credtors = 0;
 if(isset($_POST['submit'])){
	 $from = $_POST['fromDate'];
	 $to = $_POST['toDate'];
			/*$sql2="SELECT SUM(total_amount) FROM ".DB_PREFIX.$_SESSION['co_prefix']."purchase WHERE order_date BETWEEN STR_TO_DATE('".$from."', '%Y-%m-%d') AND STR_TO_DATE('".$to."', '%Y-%m-%d') AND is_return=0";
			$credtors = DB::queryFirstField($sql2);
			$sql2="SELECT SUM(total_amount) FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale WHERE order_date BETWEEN STR_TO_DATE('".$from."', '%Y-%m-%d') AND STR_TO_DATE('".$to."', '%Y-%m-%d') AND is_return=0";
			$debtors = DB::queryFirstField($sql2);*/
			
	$sql = "SELECT ca.`account_id`,DATE(j.`voucher_date`), ca.`account_desc_short`, SUM(jv.`debit_amount`) AS debit_amount, SUM(jv.`credit_amount`) AS credit_amount  
FROM
    sa_test_journal_voucher_details jv
     JOIN sa_test_coa ca
        ON (jv.`account_id` = ca.`account_id`)
     JOIN sa_test_journal_vouchers j
	ON (jv.`voucher_id`=j.`voucher_id`)
	WHERE DATE(j.`voucher_date`) BETWEEN '".$from."' AND '".$to."'
	AND j.`active`=1
        GROUP BY jv.`account_id`
         ORDER BY jv.`account_id` ASC
         
	 ";
		$data = DB::query($sql);
		//print_r($data);
		$table="<table class='table table-bordered table-striped' style='max-width:700px;'>
					<tr><th> Account Title </th>
					<th> Debits </th>
					<th> Credits </th>
					</tr>";
		/*$table .="<tr>";
		$table .="<td>Debtors/Sale Total</td>";
		$table .="<td class='debit'>$debtors</td>";
		$table .="<td class='credit'>0.00</td>";
		$table .="</tr>";
			$table .="<tr>";
		$table .="<td>Creditors/Purchase Total</td>";
		$table .="<td class='debit'>0.00</td>";
		$table .="<td class='credit'>$credtors</td>"; 
		$table .="</tr>";			*/
		foreach($data as $row){			
		$table .="<tr>";
		$table .="<td> ".$row['account_desc_short']."</td>";
		$table .="<td class='debit'> ".$row['debit_amount']."</td>";
		$table .="<td class='credit'> ".$row['credit_amount']."</td>";
		$table .="</tr>";
		}

		
		$table .="<tr>";
		$table .="<td><b>Total</b></td>";
		$table .="<td id='debit_total'><b> </b></td><input type='hidden' value='' name='debitT' id='debitT'>";
		
		$table .="<td id='credit_total'><b> </b></td><input type='hidden' value='' name='creditT' id='creditT'>";
		$table .="</tr>";
		$table .="<tr>";
		$table .="<td><b>Balance</b></td>";
		$table .="<td colspan='2' id='balance'><b></b></td>";
		$table .="</tr>";
		$table .="</table>";
 }

 

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
		
		
			<center><?php echo $table; ?></center>	
            </div><!-- /.box-body -->

            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->
<script>
$(document).ready(function(){
	sumDebit=0;
	sumCredit=0;
	$(".debit").each(function() {sumDebit += parseInt($(this).html()); });
	$(".credit").each(function() { sumCredit += parseInt($(this).html()); });
	$("#debit_total").html('<b>'+sumDebit+'</b>');
	$("#credit_total").html('<b>'+sumCredit+'</b>');
	$("#debitT").val(sumDebit);
	$("#creditT").val(sumCredit);
	debitT = parseInt($("#debitT").val());
	creditT = parseInt($("#creditT").val());
	balance = debitT - creditT;
	$("#balance").html('<center><b>'+debitT+' - '+creditT+' = '+balance+'</b></center>');
});
</script>	