<?php
if(isset($_POST['account_id'])){
	$account_id = $_POST['account_id'];
} else if (isset($_GET['account_id'])){
	$account_id = $_GET['account_id'];
} else {
	$account_id = '';
}
if($account_id==''){
	die('Whoops..! Something wrong');
}


$sql ="SELECT j.`voucher_date`,jv.`credit_amount`,jv.`debit_amount` 
FROM
    sa_test_journal_voucher_details jv
    INNER JOIN sa_test_journal_vouchers j 
        ON (jv.`voucher_id` = j.`voucher_id`)
        WHERE jv.`account_id`='".$account_id."' 
        AND j.`active`=1";	

?>
<?php

		$table="<table class='table table-bordered table-striped data-table'>
					<thead><tr><th>#</th>
					<th> Transaction Date </th>
					<th> Debits </th>
					<th> Credits </th>
					</tr></thead>";
?>

<?php

$get_coa = DB::query($sql);
$i=1;
$table .="<tbody>";
foreach($get_coa as $coa) { 
$table .="<tr>";
		$table .="<td> ".$i."</td>";
		$table .="<td> ".getDateTime($coa['voucher_date'],'dtLong')."</td>";
		$table .="<td class='debit'> ".$coa['debit_amount']."</td>";
		$table .="<td class='credit'> ".$coa['credit_amount']."</td>";
		$table .="</tr>";
$i++;
}
		$table .="</tbody>";
		$table .="<tfoot><tr>";
		$table .="<td><b></b></td>";
		$table .="<td><b>Total</b></td>";
		$table .="<td id='debit_total'><b>0.00 </b></td>";	
		$table .="<td id='credit_total'><b>0.00 </b></td>";
		$table .="</tr></tfoot>";

		$table .="</table>";
?>
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Reports
            <small>View Account Detail.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="active">Account Balance Detail</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><span>Transaction Detail </span><?php
				$acccount_name = DB::queryFirstField("SELECT c.`account_desc_short` FROM sa_test_coa c WHERE c.`account_id`='".$account_id."'");
				echo '<span style="font-style: oblique; font-size: larger;">'.$acccount_name."</span>";
				echo "<small> Total Balance </small>( ".calculateAccountBalance($account_id)." )";
			  ?></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
			
				<?php  echo $table; ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->
<script>
$(document).ready(function(){
calculateTotal();
	$('input[type=text]').keyup(function () {
	calculateTotal();
	
	});
});

function calculateTotal(){
	sumDebit=0;
	sumCredit=0;
	$(".debit").each(function() {sumDebit += parseInt($(this).html()); });
	$(".credit").each(function() { sumCredit += parseInt($(this).html()); });
	$("#debit_total").html('<b>'+sumDebit+'</b>');
	$("#credit_total").html('<b>'+sumCredit+'</b>');
}

</script>		 