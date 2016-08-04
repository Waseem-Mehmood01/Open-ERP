<?php
if(isset($_POST['voucher_id'])){
	$voucher_id = $_POST['voucher_id'];
}
else if(isset($_GET['voucher_id'])){
	$voucher_id = $_GET['voucher_id'];
}
else {
	$voucher_id='';
}
if($voucher_id=='') die("Whoops..! Something went wrong");

if (isset($_POST['save'])){
	//print_r($_POST);
	$insert = DB::Update(DB_PREFIX.$_SESSION['co_prefix'].'journal_vouchers', 
								array(				
										'voucher_date'			=>  getDateTime($_POST['voucher_date'],"mySQL"),
										'voucher description'	=>  $_POST['voucher_description'],
										'debits_total'			=> $_POST['debitTotal'],
										'credits_total'			=> $_POST['debitTotal'],
										'last_modified_on'			=> $now
									), "voucher_id = %s",$voucher_id);
	//Delete all previous detail										
	DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_voucher_details WHERE voucher_id='".$voucher_id."'");
	for($i=0, $iMaxSize=count($_POST['rows']); $i<$iMaxSize; $i++){
		//echo $_POST['customer'][$i];
		$insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'journal_voucher_details', 
								array(			
										'voucher_id'		=> $voucher_id,
										'account_id'		=> $_POST['account_id'][$i],
										'debit_amount'			=> $_POST['debit_amount'][$i],
										'credit_amount'				=> $_POST['credit_amount'][$i],
										'created_on'			=> $now
									));
								
					
		
	}
echo '<script>window.location.replace("'.SITE_ROOT.'?route=modules/gl/transactions/journal_vouchers/view_journal_vouchers");</script>';		
}
$sql = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_vouchers jv WHERE jv.`voucher_id` = '".$voucher_id."'";
$jv = DB::queryFirstRow($sql);
?><!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          	Edit Journal Entry
            <small>Edit Journal Voucher</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Journal Voucher</a></li>
            <li class="active">Edit Journal Voucher</li>
          </ol>
        </section>
        <!-- Main content -->
        <section >
          <!-- title row -->
          <div class="box">
             <div class="box-header with-border">
              <h3 class="box-title">Edit Journal Entry</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
<div class="box-body">

  <form method="POST" action="" role="form">
          <!-- info row -->
          <div class="row ">
            <div class="col-sm-6"> 

              <b>Journal Voucher Date:</b><input  name="voucher_date" type="text"  required="required" class="form-control date-picker" value="<?php echo getDateTime($jv['voucher_date'],'dOnly'); ?>">
			 
            </div><!-- /.col -->
			<div class="col-sm-6"> 

              <b>Memo:</b><input  name="voucher_description" type="text" class="form-control" value="<?php echo $jv['voucher description']; ?>">
			 
            </div><!-- /.col -->
			 
          </div><!-- /.row -->
          
          


   
            <div class="box-header with-border">
              <h3 class="box-title">Details</h3>

            </div>


      	<div class='row'>
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
							<th><label>Account</label></th>
							<th><label>Debits</label></th>
							<th><label>Credits</label></th>
							
							
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_voucher_details j WHERE j.`voucher_id` = '".$voucher_id."'";
					$res = DB::Query($sql);
					foreach($res as $jv_detail){
					?>
						<tr>
							<td><input class="case" type="checkbox"/></td>
							<td><select class="form-control" name="account_id[]" id="account_id_1" required>
								<option value="">Select Account</option>
								<?php
									$sql = "select * from ".DB_PREFIX.$_SESSION['co_prefix']."coa where account_status='Active'";
									$res = DB::query($sql);
									foreach($res as $row){
											echo "<option value ='".$row['account_id']."' ";
											if($row['account_id'] == $jv_detail['account_id']) echo "SELECTED";
											echo " >".$row['account_desc_short']."</option>";
									} ?>
							</select>
							</td>
							<input type="hidden" name="rows[]"/>
							<td><input class="form-control debits changesNo" name="debit_amount[]" id="debit_amount_1" type="text" placeholder="Amount"autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="<?php echo $jv_detail['debit_amount']; ?>" /></td>
							<td><input class="form-control credits changesNo" name="credit_amount[]" id="credit_amount_1" type="text" placeholder="Amount"autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="<?php echo $jv_detail['credit_amount']; ?>" /></td>
							
						</tr>
					<?php } ?>	
					</tbody>
				</table>
      		</div>
      	</div>
      	<div class='row'>
      		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
      			<button class="btn btn-danger delete" type="button">- Delete</button>
      			<button class="btn btn-success addmore" type="button">+ Add More</button>
      		</div>
			<div class='col-md-6 col-md-offset-8'>
			<div class="form-group col-xs-3">
						<label>Debits Total: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input type="text" class="form-control" name="debitTotal" id="debitTotal" placeholder="Debit Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly="true">
						</div>
			</div>
			<div class="form-group col-xs-3">
						<label>Credits Total: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input type="text" class="form-control" name="creditTotal" id="creditTotal" placeholder="Debit Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly="true">
						</div>
			</div>
			
			</div>
			<div class='col-md-6 col-md-offset-5'>
			<button type="submit" class="btn btn-success btn-lg pull-right disabled" name="save" id="save" value="Save">Save Voucher&nbsp; <i class="glyphicon glyphicon-floppy-disk"></i></button>
			</div>

</form>			
</div><!-- /.box-body -->
            <div class="box-footer">
             <small> Explanation text for Journal Voucher details</small>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
		  
     	 </section><!-- /.content -->      
		 
		 		 <script>
		 $(document).ready(function() {
			 calculateDebitTotal();
	calculateCreditTotal();
	enableSubmit();
var i=$('table tr').length;
$(".addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><select class="form-control" name="account_id[]" id="account_id_'+i+'" required>';
	html += '<option value="">Select Account</option>';
	html += '<?php $sql = "select * from sa_test_coa where account_status='Active'";?>';
	html += '<?php $res = DB::query($sql); ?>';
	html += '<?php foreach($res as $row){ ?>';
	html += '<option value ="<?php echo $row['account_id']; ?>"> <?php echo $row['account_desc_short']; ?></option>';
	html += '<?php } ?>';
	html += '</select></td>';
	html += '<input type="hidden" name="rows[]"/>';
	html += '<td><input class="form-control debits changesNo" name="debit_amount[]" id="debit_amount_'+i+'" type="text" placeholder="Amount"autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" /></td>';
	html += '<td><input class="form-control credits changesNo" name="credit_amount[]" id="credit_amount_'+i+'" type="text" placeholder="Amount"autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" /></td>';

	html += '</tr>';
	$('table').append(html);
	i++;
});

});	

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
	calculateTotal();
});

//price change
$(document).on('change keyup blur click','.changesNo',function(){	
	calculateDebitTotal();
	calculateCreditTotal();
	enableSubmit();
});
//total price calculation 
function calculateDebitTotal(){
	subTotal = 0 ; total = 0; 
	$('.debits').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	$('#debitTotal').val( subTotal );
	
}
function calculateCreditTotal(){
	subTotal = 0 ; total = 0; 
	$('.credits').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	$('#creditTotal').val( subTotal );
	
}
function enableSubmit(){
	d = $("#debitTotal").val();
	c = $("#creditTotal").val();
	if(d==c){
		$("#save").removeClass("disabled");
	} else {
		$("#save").addClass("disabled");
	}
}
//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}


		 </script>