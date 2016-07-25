      <header class="main-header">
<nav class="navbar navbar-default" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
      <a class="navbar-brand" href="<?php echo SITE_ROOT; ?>">Asia Traders</a>
    </div>

    <!--  Collect the nav links, forms, and other content for toggling -->

  <!-- Clients Menu -->
<div style="height: 1px;" aria-expanded="false" id="navbar" class="navbar-collapse collapse"> 
	<ul class="nav navbar-nav">
		<?php
		$category_id='';
		$count=0;
		$sql = "SELECT * 
FROM
    `sa_test_user_module_access` ma
    JOIN `sa_test_user_modules` m
        ON (ma.`module_id` = m.`module_id`)
     JOIN `sa_test_module_category` mc 
        ON (mc.`category_id` = m.`category_id`)
       WHERE ma.`user_id`='".$_SESSION['user_id']."'";
	   $res = DB::Query($sql);
	   foreach($res as $row){
		   $count++;
		?>
		<?php if($row['category_id']<>$category_id){ 
		if (intval($count)!=1)
			{
			echo '</ul></li>';
			}//end if
		?>
		<li class="dropdown">
          <a href="<?php echo $row['category_path']; ?>" class="dropdown-toggle" data-toggle="dropdown"><span class="<?php echo $row['category_class']; ?>"></span> <?php echo $row['category_title']; ?> <span class="caret"></span></a> 
          <ul class="dropdown-menu" role="menu">
		  <?php } ?>
			<li><a href="<?php echo SITE_ROOT; ?>?route=<?php echo $row['module_path'].$row['module_file']; ?>"><?php echo $row['module_title']; ?></a></li> 
			<li class="divider"></li>  	
          
	   <?php 
	   $category_id = $row['category_id'];
	   } ?>
	   </ul>
	</ul>
 <!-- Setting Menu -->
      <ul class="nav navbar-nav navbar-right">  
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Settings <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo SITE_ROOT; ?>?route=modules/system/user_profile"><span class='glyphicon glyphicon-user'></span> User Profile</a></li> 
			<li class="divider"></li>  

					<?php if($_SESSION['role_id']==1){ ?>
					<li><a href="<?php echo SITE_ROOT; ?>?route=modules/system/user_management"><span class='glyphicon glyphicon-user'></span>&nbsp; Manage Users</a></li> 
					<li class="divider"></li> 					
			<li><a href="<?php echo SITE_ROOT; ?>?route=modules/gl/setup/company/company_info"><span class='glyphicon glyphicon-cog'></span>&nbsp; Company Setup</a></li> 
					<li class="divider"></li> 
					<?php } ?>
				<!--<li><a href="<?php echo SITE_ROOT; ?>?route=modules/system/app_management"><span class='glyphicon glyphicon-cog'></span>&nbsp;Application Setup</a></li> 
					<li class="divider"></li> -->
            <li><a href="<?php echo SITE_ROOT; ?>?logout=1" ><span class="glyphicon glyphicon-off"></span> Logout</a></li>
          </ul>
        </li>
      </ul>
	</div>
</nav>
      </header>

      <!-- =============================================== -->