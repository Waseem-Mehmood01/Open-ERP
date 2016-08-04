<?php
//print_r($_SESSION);
?>
<div class="content-wrapper" style="min-height: 260px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <?php echo $_SESSION['company_name']; ?>
            <small>
				
			</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
			<?php
			$date = date('Y-m-d');
			//echo get_purchase_price_avg('2016-06-14');
			$sql="SELECT SUM(total_amount) FROM ".DB_PREFIX.$_SESSION['co_prefix']."purchase WHERE order_date BETWEEN STR_TO_DATE('".date('Y')."-".date('m')."-1', '%Y-%m-%d') AND STR_TO_DATE('".date('Y')."-".date('m')."-".date('t')."', '%Y-%m-%d') AND is_return=0";
			$total_purchase = DB::queryFirstField($sql);
			$sql2="SELECT SUM(total_amount) FROM ".DB_PREFIX.$_SESSION['co_prefix']."sale WHERE order_date BETWEEN STR_TO_DATE('".date('Y')."-".date('m')."-1', '%Y-%m-%d') AND STR_TO_DATE('".date('Y')."-".date('m')."-".date('t')."', '%Y-%m-%d') AND is_return=0";
			$total_sale = DB::queryFirstField($sql2);
				
			?>
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
					  <div class="info-box">
						<span class="info-box-icon bg-red"><i class="glyphicon glyphicon-gift"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Total Sales</span>
						  <span class="info-box-number"><?php echo $total_sale; ?> Rs</span>of the month (<?php echo date('M'); ?>)
						</div><!-- /.info-box-content -->
					  </div><!-- /.info-box -->
					</div><!-- /.col -->
					
					<div class="col-md-3 col-sm-6 col-xs-12">
					  <div class="info-box">
						<span class="info-box-icon bg-green"><i class="glyphicon glyphicon-shopping-cart"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Purchases</span>
						  <span class="info-box-number"><?php echo $total_purchase; ?> Rs</span>of the month (<?php echo date('M'); ?>)
						</div><!-- /.info-box-content -->
					  </div><!-- /.info-box -->
					</div><!-- /.col -->
					
					<div class="col-md-3 col-sm-6 col-xs-12">
					  <div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-tasks"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Stock</span>
						  <span class="info-box-number"><?php echo calculateStock().'&nbsp;Bags'; ?></span>
						</div><!-- /.info-box-content -->
					  </div><!-- /.info-box -->
					</div><!-- /.col -->
					
					<div class="col-md-3 col-sm-6 col-xs-12">
					  <div class="info-box">
						<span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-stats"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Profit & Loss</span>
						  <span class="info-box-number"><?php echo calculatePLCurrentMonth(); ?> Rs</span>of the month (<?php echo date('M'); ?>)
						</div><!-- /.info-box-content -->
					
					</div><!-- /.col -->
					
					
                </div>
				
				
        <div class="col-md-12">
       
            <div class="box-header with-border">
              <h3 class="box-title">Average Price Rate Report</h3>
			</div><!-- /.box-header -->

              <div class="row">
                <div class="col-md-6" style="">
                  <p class="text-center">
                    <strong>Sales:&nbsp; <?php echo date('d M, Y', strtotime($date .' -6 day')); ?> - <?php echo date('d M, Y', strtotime($date .' 0 day')); ?></strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>

    
                <div class="col-md-6">
                  <p class="text-center">
                    <strong>Purchase:&nbsp; <?php echo date('d M, Y', strtotime($date .' -6 day')); ?> - <?php echo date('d M, Y', strtotime($date .' 0 day')); ?></strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="purchaseChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>

              </div>
              <!-- /.row -->
            <!-- ./box-body -->
            <div class="box-footer">

              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

        <!-- /.col -->
      </div>
	  
	  
            </div><!-- /.box-body -->
            <div class="box-footer">
             
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
</div>		

<script>
/** Chart JS **/

$(function () {

  'use strict';

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);

  var salesChartData = {
    labels: ["<?php echo date('D', strtotime($date .' -6 day')); ?>", "<?php echo date('D', strtotime($date .' -5 day')); ?>", "<?php echo date('D', strtotime($date .' -4 day')); ?>", "<?php echo date('D', strtotime($date .' -3 day')); ?>", "<?php echo date('D', strtotime($date .' -2 day')); ?>", "<?php echo date('D', strtotime($date .' -1 day')); ?>", "<?php echo date('D', strtotime($date .' 0 day')); ?>"],
    datasets: [
      {
        label: "Sales Goods",
        fillColor: "rgba(178, 82, 71,0.7)",
        strokeColor: "rgba(178, 82, 70,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [<?php echo get_sale_price_avg(date('Y-m-d', strtotime($date .' -6 day'))); ?>, <?php echo get_sale_price_avg(date('Y-m-d', strtotime($date .' -5 day'))); ?>, <?php echo get_sale_price_avg(date('Y-m-d', strtotime($date .' -4 day'))); ?>, <?php echo get_sale_price_avg(date('Y-m-d', strtotime($date .' -3 day'))); ?>, <?php echo get_sale_price_avg(date('Y-m-d', strtotime($date .' -2 day'))); ?>, <?php echo get_sale_price_avg(date('Y-m-d', strtotime($date .' -1 day'))); ?>, <?php echo get_sale_price_avg(date('Y-m-d', strtotime($date .' 0 day'))); ?>]
      }
    ]
  };

  var salesChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  
  /* SPARKLINE CHARTS
   * ----------------
   * Create a inline charts with spark line
   */
  //-----------------------
  //- MONTHLY Purchase CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var purchaseChartCanvas = $("#purchaseChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var purchaseChart = new Chart(purchaseChartCanvas);

  var purchaseChartData = {
    labels: ["<?php echo date('D', strtotime($date .' -6 day')); ?>", "<?php echo date('D', strtotime($date .' -5 day')); ?>", "<?php echo date('D', strtotime($date .' -4 day')); ?>", "<?php echo date('D', strtotime($date .' -3 day')); ?>", "<?php echo date('D', strtotime($date .' -2 day')); ?>", "<?php echo date('D', strtotime($date .' -1 day')); ?>", "<?php echo date('D', strtotime($date .' 0 day')); ?>"],
    datasets: [
      {
        label: "Purchase Goods",
        fillColor: "rgba(0, 130, 69,0.7)",
        strokeColor: "rgba(0, 130, 67,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [<?php echo get_purchase_price_avg(date('Y-m-d', strtotime($date .' -6 day'))); ?>, <?php echo get_purchase_price_avg(date('Y-m-d', strtotime($date .' -5 day'))); ?>, <?php echo get_purchase_price_avg(date('Y-m-d', strtotime($date .' -4 day'))); ?>, <?php echo get_purchase_price_avg(date('Y-m-d', strtotime($date .' -3 day'))); ?>, <?php echo get_purchase_price_avg(date('Y-m-d', strtotime($date .' -2 day'))); ?>, <?php echo get_purchase_price_avg(date('Y-m-d', strtotime($date .' -1 day'))); ?>, <?php echo get_purchase_price_avg(date('Y-m-d', strtotime($date .' 0 day'))); ?>]
      }
    ]
  };

  var purchaseChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  purchaseChart.Line(purchaseChartData, purchaseChartOptions);
  //-----------------
  //- SPARKLINE BAR -
  //-----------------
  $('.sparkbar').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'bar',
      height: $this.data('height') ? $this.data('height') : '30',
      barColor: $this.data('color')
    });
  });

  //-----------------
  //- SPARKLINE PIE -
  //-----------------
  $('.sparkpie').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'pie',
      height: $this.data('height') ? $this.data('height') : '90',
      sliceColors: $this.data('color')
    });
  });

  //------------------
  //- SPARKLINE LINE -
  //------------------
  $('.sparkline').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'line',
      height: $this.data('height') ? $this.data('height') : '90',
      width: '100%',
      lineColor: $this.data('linecolor'),
      fillColor: $this.data('fillcolor'),
      spotColor: $this.data('spotcolor')
    });
  });
});

</script>