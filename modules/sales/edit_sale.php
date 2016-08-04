<?php
$payment_received = 0;
if(isset($_GET['sale_id'])){
	$sale_id =$_GET['sale_id']; 
}
else if(isset($_POST['sale_id'])){
	$sale_id =$_POST['sale_id']; 
}
else {
	$sale_id='';
}
if (isset($_POST['save'])){
	/****** INSERT SALE ***/
	if(isset($_POST['payment_received'])){
		$payment_received = $_POST['payment_received'];
	}
	DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'sale',array(
			'vehicle_no' 	 		=> $_POST['vehicle_no'],
										'mill_name' 			=>  $_POST['mill_name'],
										'order_date'			=>  getDateTime($_POST['order_date'],"mySQL"),
										'mill_address'			=>  $_POST['mill_address'],
										'total_amount'			=> $_POST['subTotal'],
										'payment_received'		=> $payment_received,
										'created_on'			=> $now ), "sale_id =%s", $sale_id );
//Delete all previous sale detail										
DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale_detail WHERE sale_id='".$sale_id."'");
//get ref_no
$ref_no = DB::queryFirstField("SELECT ref_no FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale WHERE sale_id='".$sale_id."'");
// get voucher id
$voucher_id = DB::queryFirstField("SELECT voucher_id FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_vouchers WHERE voucher_ref_no='".$ref_no."'");
//delete previous voucher
DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_vouchers WHERE voucher_id='".$voucher_id."'");
DB::query("DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."journal_voucher_details WHERE voucher_id='".$voucher_id."'");
/** Update JV **/
	DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'journal_vouchers', 
								array(				
										'voucher_date'			=> getDateTime($_POST['order_date'],"mySQL")
									) , "voucher_id =%s", $voucher_id);
	for($i=0, $iMaxSize=count($_POST['rows']); $i<$iMaxSize; $i++){
		$insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'sale_detail', 
								array(			
										'sale_id'			=> $sale_id,
										'customer_name'		=> $_POST['customer'][$i],
										'weight'			=> $_POST['weight'][$i],
										'unit'				=> $_POST['unit'][$i],
										'bags'				=> $_POST['bags'][$i],
										'rate'				=> $_POST['rate'][$i],
										'total_amount'		=> $_POST['total'][$i] 
									));
		/****** Create JV ***/

		
				$debitAccount = DB::queryFirstField("SELECT c.`account_id` FROM ".DB_PREFIX.$_SESSION['co_prefix']."coa c WHERE c.`account_desc_short` LIKE '".$_POST['customer'][$i]."'");					
				$insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'journal_voucher_details', 
								array(			
										'voucher_id'		=> $voucher_id,
										'account_id'		=> $debitAccount,
										'debit_amount'			=> $_POST['subTotal'],
										'credit_amount'				=> '',
										'entry_description'				=> 'Sale entry',
										'created_on'			=> $now
									));
										
	}
	
	
		//update stock
			
		echo '<script>window.location.replace("'.SITE_ROOT.'?route=modules/sales/view_sale");</script>';	
}
//Retrive values 

if($sale_id <>''){
$sale = DB::queryFirstRow("SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale WHERE sale_id='".$sale_id."'");	
} else {
	die("Sale ID not found");
}



?><!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          	Sales
            <small>Create New Sale Order</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Sales</a></li>
            <li class="active">Add New Sale Order</li>
          </ol>
        </section>
        <!-- Main content -->
        <section >
          <!-- title row -->
          <div class="box">
             <div class="box-header with-border">
              <h3 class="box-title">Create New Sale Order</h3><small><?php echo "&nbsp;Stock <b>".calculateStock()."</b> Bags"; ?></small>
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
			 <b>Mill Name:</b><input class="form-control" required="required" name="mill_name" id="mill_name" value="<?php echo $sale['mill_name']; ?>" /><br/>
                <strong>Mill Address :</strong>
                <input class="form-control" required="required" name="mill_address" id="mill_address" value="<?php echo $sale['mill_address']; ?>" />
            </div><!-- /.col -->
			<div class="col-sm-6">
              <b>Vehicle No:</b> <input class="form-control" required="required" name="vehicle_no" id="vehicle_no" value="<?php echo $sale['vehicle_no']; ?>" /><br/>
              <b>Sale Order Date:</b><input  name="order_date" type="text"  required="required" class="form-control date-picker" value="<?php echo $sale['order_date']; ?>">
			 
            </div><!-- /.col -->
			<div class="col-sm-6">
              <b>Payment Recieved:</b> <input class="flat-red" name="payment_received" value="1"
				<?php if($sale['payment_received']==1) echo "CHECKED"; ?>
			   type="checkbox">
			 
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
							<th><label>Debtor</label></th>
							<th><label>Weight</label></th>
							<th><label>Unit</label></th>
							<th><label>Bags</label></th>
							<th><label>Weight per Bag</label></th>
							<th><label>Rate</label></th>
							<th><label>Sub Total</label></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i = 1;
						$sub=0;
						$sql = "SELECT * FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale_detail WHERE sale_id='".$sale_id."'";
						$result_sale = DB::query($sql);
						foreach($result_sale as $sale_detail){
						
					?>
						<tr>
							<td><input class="case" type="checkbox"/></td>
							<td><select class="form-control select2" name="customer[]" id="customer_<?php echo $i; ?>" placeholder="Customer" />
							<option value="">Select Account</option>
								<?php
									$sql = "SELECT c.`account_id`,c.`account_desc_short`, cg.`balance_sheet_side`, cg.`group_status`
FROM
    sa_test_coa c
    JOIN sa_test_coa_groups cg 
        ON (c.`account_group` = cg.`group_id`)";
									$res = DB::query($sql);
									foreach($res as $row){
											echo "<option value ='".$row['account_desc_short']."'";
											if($row['account_desc_short'] == $sale_detail['customer_name']){
												echo " SELECTED ";
											}
											echo ">".$row['account_desc_short']."</option>";
									} ?>
							</select>
							</td>
							<input type="hidden" name="rows[]"/>
							<td><input class="form-control changesNo <?php 
							if($sale_detail['unit']=='KG') {
								echo " KGWeight";
							}else{
								echo " MWeight";
							} ?>"  
							value="<?php echo $sale_detail['weight']; ?>" name="weight[]" id="weight_<?php echo $i; ?>" type="text" placeholder="Weight"  /></td>
							<td><select class="form-control changesNo" name="unit[]" id="unit_<?php echo $i; ?>"><option value="KG" <?php if($sale_detail['unit']=='KG') echo "SELECTED"; ?>>KG</option>
							<option value="Maunds" <?php if($sale_detail['unit']=='Maunds') echo "SELECTED"; ?>>Maunds</option></select></td>
							<td><input  value="<?php echo $sale_detail['bags']; ?>" class="form-control bags changesNo" name="bags[]" id="bags_<?php echo $i; ?>" type="number" placeholder="Quantity" style="width: 100px;"/></td>
							<?php
							$totalW = 0;
							if($sale_detail['unit']=='KG'){
								$totalW = $sale_detail['weight']/$sale_detail['bags'];
							} else {
								$totalW = $sale_detail['weight'] * 40 /$sale_detail['bags'];
							}
							?>
							<td><input class="form-control total_weight" value="<?php echo $totalW; ?>" name="total_weight[]" id="total_weight_1" type="text" placeholder="0.0" readonly="true" style="width: 100px;"/></td>
							<td><input  value="<?php echo $sale_detail['rate']; ?>" class="form-control changesNo" name="rate[]" id="rate_<?php echo $i; ?>" type="number" placeholder="Rate" autocomplete="off" /></td>
							<?php $sub = $sale_detail['weight']*$sale_detail['rate']; ?>
							<td><input type="number" name="total[]" value="<?php echo $sub; ?>" id="total_<?php echo $i; ?>" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly="true"/></td>
                  
						</tr>
						
						<?php $i++;
						} ?>
						
						

						
					</tbody>
				</table>
      		</div>
      	</div>
		<div class='col-xs-6 col-xs-offset-4 pull-left'>
			<p><b>Total Weight:</b> <span id="MWeight" style="font-size: large;">0</span> Maunds : <span id="KGWeight" style="font-size: large;">0</span> KG <b> = </b><span id="total_weight" style="font-size: large;">0</span> KG <b>&nbsp;&nbsp;&nbsp;Total Bags: </b><span id="Bags" style="font-size: large;">0</span></p>
		</div>
      	<div class='row'>
      		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
      			<button class="btn btn-danger delete" type="button">- Delete</button>
      			<button class="btn btn-success addmore" type="button">+ Add More</button>
      		</div>
			<div class='col-xs-8 col-sm-offset-10 col-md-offset-10 col-lg-offset-10 col-sm-2 col-md-2 col-lg-2'>
			<div class="form-group">
						<label>Total Amount: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input type="text" class="form-control" name="subTotal" id="subTotal" placeholder="Total Amount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="<?php echo $sale['total_amount']; ?>" readonly="true">
						</div>
			</div>
			<b> Avg Rate: </b><span id="avg_rate" style="font-size: large;">0.0</span>
			<button type="submit" class="btn btn-success btn-lg pull-right" name="save" value="Save">Save &nbsp; <i class="glyphicon glyphicon-floppy-disk"></i></button>
			</div>

</form>			
</div><!-- /.box-body -->
            <div class="box-footer">
             <small> Explanation text for Sale Order details</small>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
		  
     	 </section><!-- /.content -->      
		 
		<script>
		 $(document).ready(function() {
			 calculateTotal();
	calculateKGWeight();
	calculateMWeight();
	calculateBags();
	calculateSTWeight();
	calculateAvgRate();
var i=$('table tr').length;
$(".addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><select class="form-control select'+i+'" name="customer[]" id="customer_id_'+i+'" required placeholder="Customer">';
	html += '<option value="">Select Account</option>';
	html += '<?php $sql = "select * from sa_test_coa where account_status='Active'";?>';
	html += '<?php $res = DB::query($sql); ?>';
	html += '<?php foreach($res as $row){ ?>';
	html += '<option value ="<?php echo $row['account_desc_short']; ?>"> <?php echo $row['account_desc_short']; ?></option>';
	html += '<?php } ?>';
	html += '</select></td>';
	html += '<input type="hidden" name="rows[]"/>';
	html += '<td><input class="form-control changesNo" name="weight[]" id="weight_'+i+'" type="text" placeholder="Weight" /></td>';
	html += '<td><select class="form-control changesNo" name="unit[]" id="unit_'+i+'"><option value="KG">KG</option><option value="Maunds">Maunds</option></select></td>';
	html += '<td><input class="form-control bags changesNo" name="bags[]" id="bags_'+i+'" type="number" placeholder="Quantity" style="width: 100px;" /></td>';
	html += '<td><input class="form-control total_weight" name="total_weight[]" id="total_weight_'+i+'" type="text" placeholder="0.0" readonly="true" style="width: 100px;"/></td>';
	html += '<td><input class="form-control changesNo" name="rate[]" id="rate_'+i+'" type="number" placeholder="Rate"></td>';
	html += '<td><input type="text" name="total[]" id="total_'+i+'" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly="true"></td>';
	html += '</tr>';
	$('table').append(html);
	$('#customer_id_'+i).select2();
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
	calculateKGWeight();
	calculateMWeight();
	calculateBags();
	calculateSTWeight();
	calculateAvgRate();
});

//price change
$(document).on('change keyup blur','.changesNo',function(){
	id_arr = $(this).attr('id');
	id = id_arr.split("_");
	weight = $('#weight_'+id[1]).val();
	rate = $('#rate_'+id[1]).val();
	unit= $('#unit_'+id[1]+' option:selected').val();
	bags = $('#bags_'+id[1]).val();
	if(unit=='KG') {
		BagWeight = parseFloat(weight) / parseFloat(bags); 
		weight=weight/40;
		$('#weight_'+id[1]).addClass('KGWeight');
		$('#weight_'+id[1]).removeClass('MWeight');	
	} else {
		$('#weight_'+id[1]).addClass('MWeight');
		$('#weight_'+id[1]).removeClass('KGWeight');
		BagWeight = parseFloat(weight)*40 / parseFloat(bags); 
	}
	sub_total = parseFloat(weight)*parseFloat(rate);
	sub_total = parseFloat(sub_total).toFixed(2);
	if( weight!='' && rate !='' ) $('#total_'+id[1]).val( sub_total );
	BagWeight = parseFloat(BagWeight).toFixed(2);
	if(weight!='' && bags!='') $('#total_weight_'+id[1]).val( BagWeight+' KG' );
	calculateTotal();
	calculateKGWeight();
	calculateMWeight();
	calculateBags();
	calculateSTWeight();
	calculateAvgRate();

});
//total price calculation 
function calculateTotal(){
	subTotal = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	$('#subTotal').val( subTotal );
	
}
function calculateKGWeight(){
	total = 0; 
	$('.KGWeight').each(function(){
		if($(this).val() != '' ) total += parseFloat( $(this).val() );
	});
	$('#KGWeight').html( total );
}
function calculateMWeight(){
	total = 0; 
	$('.MWeight').each(function(){
		if($(this).val() != '' ) total += parseFloat( $(this).val() );
	});
	$('#MWeight').html( total );
}
function calculateBags(){
	total = 0; 
	$('.bags').each(function(){
		if($(this).val() != '' ) total += parseFloat( $(this).val() );
	});
	$('#Bags').html( total );
}
function calculateSTWeight(){
	KGtotal = 0;
	MTotal = 0;
	total = 0;
	$('.KGWeight').each(function(){
		if($(this).val() != '' ) KGtotal += parseFloat( $(this).val() );
	});
	$('.MWeight').each(function(){
		if($(this).val() != '' ) MTotal += parseFloat( $(this).val() );
	});
	MTotal = parseInt(MTotal)*40;
	total = parseInt(KGtotal) + parseInt(MTotal);
	$('#total_weight').html( total );
}
function calculateAvgRate(){
	total=0;
	w = $("#total_weight").html();
	t = $("#subTotal").val();
	avg = parseFloat(parseFloat(t) / parseFloat(w) * 40).toFixed(2);
	$("#avg_rate").html(avg);
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