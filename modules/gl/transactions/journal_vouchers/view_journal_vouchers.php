<?php
//Draft Journal Vouchers
$tbl_draft = new HTML_Table('', 'table table-striped table-bordered');
$tbl_draft->addRow();
$tbl_draft->addCell('ID', '', 'header');
$tbl_draft->addCell('Date', '', 'header');

$tbl_draft->addCell('Description', '', 'header');
$tbl_draft->addCell('Debit', '', 'header');
$tbl_draft->addCell('Credit', '', 'header');

$tbl_draft->addCell('Actions', '', 'header');
?>

<?php
$sql = 'SELECT * FROM '.DB_PREFIX.$_SESSION['co_prefix'].'journal_vouchers  jv WHERE jv.`voucher description` NOT LIKE "Sale entry" AND jv.`voucher description` NOT LIKE "Purchase entry" ORDER BY jv.`voucher_id` DESC';
$draft_jvs = DB::query($sql);
foreach($draft_jvs as $draft_jv) { 
$tbl_draft->addRow();
$tbl_draft->addCell($draft_jv['voucher_id']);
$tbl_draft->addCell(getDateTime($draft_jv['voucher_date'],"dtLong"));

$tbl_draft->addCell($draft_jv['voucher description']);
$tbl_draft->addCell($draft_jv['debits_total']);
$tbl_draft->addCell($draft_jv['credits_total']);

$tbl_draft->addCell("<a class='pull btn btn-primary btn-xs' href ='".SITE_ROOT."?route=modules/gl/transactions/journal_vouchers/view_journal_vouchers_detail&voucher_id=".$draft_jv['voucher_id']."'>Detail&nbsp;&nbsp;<span class='glyphicon glyphicon-edit'></span></a> <a class='pull btn btn-danger btn-xs' href ='#'>Delete&nbsp;&nbsp;<span class='glyphicon glyphicon-trash'></span></a>");
}
			  

?>
<?php
//Journal Vouchers Pending Approvel
$tbl_pending = new HTML_Table('', 'table table-striped table-bordered');
$tbl_pending->addRow();
$tbl_pending->addCell('Voucher ID', '', 'header');
$tbl_pending->addCell('Ref #', '', 'header');
$tbl_pending->addCell('Voucher Description', '', 'header');
$tbl_pending->addCell('Total Amount', '', 'header');
$tbl_pending->addCell('Voucher Approved By', '', 'header');
$tbl_pending->addCell('Voucher Status', '', 'header');
$tbl_pending->addCell('Actions', '', 'header');
?>


 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          		Journal Vouchers (J.V.) 
            <small>List of Journal Entries.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo SITE_ROOT; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">General Ledger</a></li>
            <li class="active">List OF Journal Voucher</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

 <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Journal Entries</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
				<?php  echo $tbl_draft->display(); ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
             <p>All journal entries</p>
            </div>
          </div><!-- /First .box -->
		</section> 
