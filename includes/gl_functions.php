<?php 
/********************** SALE FUNCTIONS ******************/
function sale_ref_exists($ref_no){
				$sql = "SELECT count(*) FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale  
				WHERE ref_no='".$ref_no."'" ;	
				$sale_exists = DB::queryFirstField($sql);
		if ($sale_exists == 0){
					return false;
					} else {
					return true;
					}
}


function create_new_sale($post){
	@extract($post);
$sale_exist = 0;								
if (sale_ref_exists($ref_no)){
	$sale_exist = 1;
}					
if($sale_exist == 0){
					$now= getDateTime(0,'mySQL');
					$insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'sale', 
								array(			
										'ref_no' 				=>  $ref_no,	
										'vehicle_no' 	 		=> $vehicle_no ,
										'mill_name' 			=>  $mill_name,
										'order_date'			=>  getDateTime($order_date,"mySQL"),
										'mill_address'			=>  $mill_address,
									));
					$new_sale_id =DB::insertId();
					if($new_sale_id) { 
					return $new_sale_id;
					} else {
					return 0;	
					}
	       }
}			
	
/********************** PURCHASE FUNCTIONS ******************/
function purchase_ref_exists($ref_no){
				$sql = "SELECT count(*) FROM ".DB_PREFIX.$_SESSION['co_prefix']."purchase  
				WHERE ref_no='".$ref_no."'" ;	
				$purchase_exists = DB::queryFirstField($sql);
		if ($purchase_exists == 0){
					return false;
					} else {
					return true;
					}
}


function create_new_purchase($post){
	@extract($post);
$purchase_exist = 0;								
if (purchase_ref_exists($ref_no)){
	$purchase_exist = 1;
}					
if($purchase_exist == 0){
					$now= getDateTime(0,'mySQL');
					$insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'purchase', 
								array(			
										'ref_no' 				=>  $ref_no,	
										'vehicle_no' 	 		=> $vehicle_no ,
										'mill_name' 			=>  $mill_name,
										'order_date'			=>  getDateTime($order_date,"mySQL"),
										'mill_address'			=>  $mill_address,
									));
					$new_purchase_id =DB::insertId();
					if($new_purchase_id) { 
					return $new_purchase_id;
					} else {
					return 0;	
					}
	       }
}			
	

/********************** EXPENSE VOUCHER FUNCTIONS ******************/

function create_new_expense_voucher(
							  $voucher_ref
							, $voucher_date							
							, $voucher_description
							, $voucher_paid_from_account
							 ) 
{
	if (expense_voucher_ref_exists($voucher_ref)){
		$voucher_exist = 1;
		
	}					
	if($voucher_exist<>1){
					$now= getDateTime(0,'mySQL');
					$insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'voucher_expense', 
								array(			
										'voucher_ref_no' 		=>  $voucher_ref,	
										'voucher_date' 	 		=>  $voucher_date,
										'voucher description' 	=>  $voucher_description,
										'petty_cash_account' 	=>  $voucher_paid_from_account,
										'created_on'			=>  $now,
										'created_by'			=>  $_SESSION['user_name'],
										'voucher_status'		=>	'Draft'
									));
					$new_voucher_id =DB::insertId();
					if($new_voucher_id) { 
					return $new_voucher_id;
					} else {
					return 0;	
					}
	       }
}		
/********************** JOURNAL VOUCHER DETAIL FUNCTIONS ******************/	
function journal_voucher_detail(
							  $voucher_id
							, $voucher_date
							, $account_id	
							, $entry_desc
							, $debit_amount
							, $credit_amount
							 ) 
{				
					$now= getDateTime(0,'mySQL');
					$insert = DB::Insert(DB_PREFIX.$_SESSION['co_prefix'].'journal_voucher_details', 
								array(			
										'voucher_id' 			=>  $voucher_id,	
										'voucher_date' 	 		=>  $voucher_date,
										'account_id' 			=>  $account_id,
										'entry_description' 	=>  $entry_desc,
										'debit_amount' 			=>  $debit_amount,	
										'credit_amount' 		=>  $credit_amount,										
										'created_on'			=>  $now,
										'created_by'			=>  $_SESSION['user_name'],
										'voucher_detail_status'	=>	'Draft'
									));
					$voucher_detail_id =DB::insertId();
					if($voucher_detail_id) { 
					return $voucher_detail_id;
					return $voucher_id;
					} else {
					return 0;	
					}
	       }
		   
/****************************UPDATE JOURNAL VOUCHER DETAIL FUNCTIONS****************************/		   
function update_journal_voucher_detail(
							  $voucher_id
							, $voucher_date
							, $account_id	
							, $entry_desc
							, $debit_amount
							, $credit_amount
							, $voucher_detail_id 
							 ) 
{				
					$now= getDateTime(0,'mySQL');
					$insert = DB::UPDATE(DB_PREFIX.$_SESSION['co_prefix'].'journal_voucher_details', 
								array(			
										'voucher_id' 			=>  $voucher_id,	
										'voucher_date' 	 		=>  $voucher_date,
										'account_id' 			=>  $account_id,
										'entry_description' 	=>  $entry_desc,
										'debit_amount' 			=>  $debit_amount,	
										'credit_amount' 		=>  $credit_amount,										
										'created_on'			=>  $now,
										'created_by'			=>  $_SESSION['user_name'],
										'voucher_detail_status'	=>	'Draft'
									)
									, "voucher_detail_id =%s", $voucher_detail_id 
									);
					$voucher_detail_id =DB::insertId();
					if($voucher_detail_id) { 
					return $voucher_detail_id;
					return $voucher_id;
					} else {
					return 0;	
					}
	       }
		   
function get_sale_price_avg($date){
	$sql="SELECT AVG(sd.`rate`)
FROM
    `".DB_PREFIX.$_SESSION['co_prefix']."sale_detail` sd
    INNER JOIN `".DB_PREFIX.$_SESSION['co_prefix']."sale` s 
        ON (sd.`sale_id` = s.`sale_id`) WHERE s.`order_date`='".$date."'";
	$avg = DB::queryFirstField($sql);
	if($avg!=''){
			return $avg;
	} else {
		return '0';
	}
	
	
}	

function get_purchase_price_avg($date){
	$sql="SELECT AVG(pd.`rate`)
FROM
    `".DB_PREFIX.$_SESSION['co_prefix']."purchase_detail` pd
    INNER JOIN `".DB_PREFIX.$_SESSION['co_prefix']."purchase` p 
        ON (pd.`purchase_id` = p.`purchase_id`) WHERE p.`order_date`='".$date."'";
	$avg = DB::queryFirstField($sql);
	if($avg!=''){
			return $avg;
	} else {
		return '0';
	}
	
	
}
function calculateStock(){
	$saleBag = DB::queryFirstField("SELECT SUM(bags) 
FROM
    `sa_test_sale_detail`
    JOIN `sa_test_sale` 
        ON (`sa_test_sale_detail`.`sale_id` = `sa_test_sale`.`sale_id`) WHERE is_return= 0");
	$purchaseBag = DB::queryFirstField("SELECT SUM(bags) 
FROM
    `sa_test_purchase_detail`
    JOIN `sa_test_purchase` 
        ON (`sa_test_purchase_detail`.`purchase_id` = `sa_test_purchase`.`purchase_id`) WHERE is_return= 0");
	$totalStock = $purchaseBag - $saleBag;
	if($totalStock<1){
		return '<span style="color:red">Null</span>';
	} else {
		return $totalStock;
	}
}
function calculateAccountBalance($account_id){
	$sql = "SELECT ca.`account_id`,DATE(j.`voucher_date`), ca.`account_desc_short`, SUM(jv.`debit_amount`) AS debit_amount, SUM(jv.`credit_amount`) AS credit_amount  
FROM
    sa_test_coa ca
     JOIN sa_test_journal_voucher_details jv 
        ON (jv.`account_id` = ca.`account_id`)
     JOIN sa_test_journal_vouchers j
	ON (jv.`voucher_id`=j.`voucher_id`)
	AND j.`active`=1
	AND ca.`account_id`=".$account_id."
        GROUP BY ca.`account_code`";
		$result = DB::queryFirstRow($sql);
		if(count($result)>0){
			$balance = $result['debit_amount']-$result['credit_amount'];
		} else {
			$balance = 0;
		}
		return $balance;
}
function calculatePLCurrentMonth(){
	$sql = "SELECT ca.`account_id`,DATE(j.`voucher_date`), ca.`account_desc_short`, SUM(jv.`debit_amount`) AS debit_amount, SUM(jv.`credit_amount`) AS credit_amount  
FROM
    sa_test_journal_voucher_details jv
     JOIN sa_test_coa ca
        ON (jv.`account_id` = ca.`account_id`)
     JOIN sa_test_journal_vouchers j
	ON (jv.`voucher_id`=j.`voucher_id`)
	WHERE DATE(j.`voucher_date`) BETWEEN STR_TO_DATE('".date('Y')."-".date('m')."-1', '%Y-%m-%d') AND STR_TO_DATE('".date('Y')."-".date('m')."-".date('t')."', '%Y-%m-%d') 
	AND j.`active`=1
        GROUP BY jv.`account_id`
         ORDER BY jv.`account_id` ASC";
		 $result = DB::queryFirstRow($sql);	
			$balance = $result['debit_amount']-$result['credit_amount'];
		return $balance;
		 
}	   
?>