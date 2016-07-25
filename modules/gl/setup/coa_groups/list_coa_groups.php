<?php
if(isset($_GET['delete'])){
	if(isset($_GET['group_id'])){
		$sql = "DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."coa_groups WHERE group_id='".$_GET['group_id']."'";
		$del = DB::query($sql);
		$sql = "DELETE FROM ".DB_PREFIX.$_SESSION['co_prefix']."coa WHERE account_group='".$_GET['group_id']."'";
		$del = DB::query($sql);
		echo '<script>window.location.replace("'.SITE_ROOT.'?route=modules/gl/setup/coa_groups/list_coa_groups");</script>';
	}
	
}
?>
<?php
$tbl = new HTML_Table('', 'table table-striped table-bordered');
$tbl->addRow();
$tbl->addCell('Sr. No', '', 'header');
$tbl->addCell('Group Code', '', 'header');
$tbl->addCell('Group Description', '', 'header');


$tbl->addCell('Actions', '', 'header');
?>

<?php
$i=1;
$text = '"Alert! Sub-groups will also be deleted"';
$sql = 'SELECT * FROM '.DB_PREFIX.$_SESSION['co_prefix'].'coa_groups ORDER by group_code';
$get_coa = DB::query($sql);
foreach($get_coa as $coa) { 
$tbl->addRow();
$tbl->addCell($i);
$tbl->addCell($coa['group_code']);
$tbl->addCell($coa['group_description']);


$tbl->addCell("<a class='pull btn btn-primary btn-xs' href ='".$_SERVER['PHP_SELF']."?route=modules/gl/setup/coa_groups/edit_coa_group&group_id=".$coa['group_id']."'>Edit Group&nbsp;&nbsp;<span class='glyphicon glyphicon-edit'></span></a>
<a class='pull btn btn-danger btn-xs' href ='?route=modules/gl/setup/coa_groups/list_coa_groups&group_id=".$coa['group_id']."&delete=1' onclick='return confirm(".$text.");'>Delete Group&nbsp;&nbsp;<span class='glyphicon glyphicon-trash'></span></a>
			   ");
			   $i++;
}
			  

?>
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Chart of Account Groups 
            <small>list of major chart of account groups .</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">General Ledger</a></li>
            <li class="active">List Account Groups</li>
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
			<a href="?route=modules/gl/setup/coa_groups/add_coa_group" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Group</a>
				<?php  echo $tbl->display(); ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
             <small> Please do not make changes to these unless you are really sure what you are doing. making changes here have system wide impact</small>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
     	 </section><!-- /.content -->