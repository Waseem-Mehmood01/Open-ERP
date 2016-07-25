<?php
if(isset($_GET['delete'])){
	if(isset($_GET['account_id'])){
		$sql = "DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."coa WHERE account_id='".$_GET['account_id']."'";
		$del = DB::query($sql);
		echo '<script>window.location.replace("'.SITE_ROOT.'?route=modules/gl/setup/coa/list_coa");</script>';
	}
	
}
?>
<?php

$tbl = new HTML_Table('', 'table table-striped table-bordered');
$tbl->addTSection('thead');
$tbl->addRow();
$tbl->addCell('Group Description', '', 'header');
$tbl->addCell('Account Code', '', 'header');
$tbl->addCell('Account Name', '', 'header');


$tbl->addCell('Actions', '', 'header');
$tbl->addTSection('tbody');

?>

<?php
$group_description = "";
$text = '"Are you sure to want delete this account?"';
$sql = 'SELECT * 
FROM
    `sa_test_coa_groups`
    JOIN `sa_test_coa` 
        ON (`sa_test_coa_groups`.`group_id` = `sa_test_coa`.`account_group`) ORDER BY account_code';
$get_coa = DB::query($sql);
foreach($get_coa as $coa) { 
$tbl->addRow();
if($coa['group_description']<>$group_description){
	$tbl->addCell("<b>".$coa['group_description']."</b>");
} else {
	$tbl->addCell("&nbsp;");
}

$tbl->addCell($coa['account_code']);
$tbl->addCell($coa['account_desc_short']);


$tbl->addCell("<a class='pull btn btn-primary btn-xs' href ='".$_SERVER['PHP_SELF']."?route=modules/gl/setup/coa/edit_coa&account_id=".$coa['account_id']."'>Edit Account&nbsp;&nbsp;<span class='glyphicon glyphicon-edit'></span></a>
<a class='pull btn btn-danger btn-xs' href ='?route=modules/gl/setup/coa/list_coa&account_id=".$coa['account_id']."&delete=1' onclick='return confirm(".$text.");'>Delete Account&nbsp;&nbsp;<span class='glyphicon glyphicon-trash'></span></a>");

$group_description = $coa['group_description'];
}
			  

?>
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Chart of Account
            <small>list of major chart of accounts .</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">General Ledger</a></li>
            <li class="active">List Accounts</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Level 1 Accounts</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
			<a href="?route=modules/gl/setup/coa/add_coa" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add New COA</a>
				<?php  echo $tbl->display(); ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
             <small> Please do not make changes to these unless you are really sure what you are doing. making changes here have system wide impact</small>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->