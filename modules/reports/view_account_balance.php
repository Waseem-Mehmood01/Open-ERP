<?php
$group_id = '';
$sql = 'SELECT * 
FROM
    `sa_test_coa_groups`
    JOIN `sa_test_coa` 
        ON (`sa_test_coa_groups`.`group_id` = `sa_test_coa`.`account_group`) ORDER BY account_code';
if(isset($_POST['filter_by'])){
$group_id = $_POST['filter_by'];
if($group_id<>''){
	$sql = 'SELECT * 
FROM
    `sa_test_coa_groups`
    JOIN `sa_test_coa` 
        ON (`sa_test_coa_groups`.`group_id` = `sa_test_coa`.`account_group`) where `sa_test_coa_groups`.`group_id` = "'.$group_id.'"';
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
$tbl->addCell('Balance', '', 'header');
$tbl->addCell('Action', '', 'header');
$tbl->addTSection('tbody');

?>

<?php
$group_description = "";

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
$tbl->addCell(calculateAccountBalance($coa['account_id']));
$tbl->addCell("<a href='?route=modules/reports/view_account_detail&account_id=".$coa['account_id']."'>Detail</a>");
$group_description = $coa['group_description'];
}
			  

?>
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Reports
            <small>View Account Balance.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="active">Account Balance</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Reports</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
			  <form method="POST" action="" name="frmFilter" id="frmFilter">
			  Filter By: <select name="filter_by" id="filter_by"><option value="">All Groups</option>
			  <?php
				$res = DB::query("SELECT cg.`group_id`,cg.`group_description` FROM sa_test_coa_groups cg");
				foreach($res as $row){
					echo "<option value='".$row['group_id']."'";
					if($row['group_id']==$group_id) echo " SELECTED ";
					echo ">".$row['group_description']."</option>";
				}
			  ?>
			  </select>
			  </form>
            </div>
            <div class="box-body">
			
				<?php  echo $tbl->display(); ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
            
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->
<script>
$(document).ready(function(){
	$("#filter_by").on("change",function(){
		$("#frmFilter").submit();
	});
});
</script>		 