<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> 
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">

			<?php
			$permition = $this->session->userdata('permit');


			$needed_home = $this->session->userdata('homepagePermit');
			if ($permition>=$needed_home)
			{
			?>
				<li class="nav-item">

					<a href="<?php echo base_url() ?>rf/rfController/home_c" 
				    id="<?php  if( $_SESSION['page_name']=='home'){echo 'selected';}else{echo "not selected";} ?>" > HOME </a>
				</li>

			
			<?php
			}


			$needed_stock = $this->session->userdata('stockpagePermit');
			if ($permition>=$needed_stock)
			{
			?>
				<li class="nav-item">

					<a href="<?php echo base_url() ?>rf/rfController/stock_pg_controller" 
				    id="<?php  if( $_SESSION['page_name']=='stock'){echo 'selected';}else{echo "not selected";} ?>" > STOCK </a>
				</li>
			<?php
			}


			$needed_out_stock = $this->session->userdata('out_stockpagePermit');
			if ($permition>=$needed_out_stock)
			{
			?>
				<li class="nav-item">

					<a href="<?php echo base_url() ?>rf/rfController/out_stock_pg_controller" 
				    id="<?php  if( $_SESSION['page_name']=='out_stock'){echo 'selected';}else{echo "not selected";} ?>" > OUT STOCK </a>
				</li>
			<?php
			}

			$needed_in_stock = $this->session->userdata('in_stockpagePermit');
			if ($permition>=$needed_in_stock)
			{
			?>
				<li class="nav-item">

					<a href="<?php echo base_url() ?>rf/rfController/in_stock_pg_controller" 
					id="<?php  if( $_SESSION['page_name']=='in_stock'){echo 'selected';}else{echo "not selected";} ?>" > IN STOCK </a>
				</li>
			
			<?php
			}


			$needed_product = $this->session->userdata('productpagePermit');
			if ($permition>=$needed_product)
			{
			?>
				<li class="nav-item">

					<a href="<?php echo base_url() ?>rf/rfController/product_pg_controller" 
					id="<?php  if( $_SESSION['page_name']=='product'){echo 'selected';}else{echo "not selected";} ?>" > ITEMS </a>
				</li>

			<?php
			}

			$needed_admin = $this->session->userdata('userpagePermit');
			if ($permition>=$needed_admin)
			{ 
			?>
				<li class="nav-item"><a href="<?php echo base_url() ?>rf/rfController/user_pg_controller"  
					id="<?php if( $_SESSION['page_name']=='user'){echo 'selected';}else{echo "not selected";} ?>" > USERS </a>
				</li>

			<?php  
			}  

			  

			$needed_count_in_stock = $this->session->userdata('count_in_stockpagePermit');
			if ($permition>=$needed_count_in_stock)
			{ 
			?>
				<br><li class="nav-item"><a href="<?php echo base_url() ?>rf/rfController/out_status_pg_controller"  
					id="<?php if( $_SESSION['page_name']=='out_status'){echo 'selected';}else{echo "not selected";} ?>" > GENERAL REPORT </a>
				</li> 
				

			<?php  
			}  

			$needed_count_out_stock = $this->session->userdata('count_out_stockpagePermit');
			if ($permition>=$needed_count_out_stock)
			{ 
			?>
				<li class="nav-item"><a href="<?php echo base_url() ?>rf/rfController/count_in_stock_pg_controller"  
					id="<?php if( $_SESSION['page_name']=='count_in_stock'){echo 'selected';}else{echo "not selected";} ?>" > IN STOCK REPORT</a>
				</li>
	
			<?php  
			} 



			$needed_out_status = $this->session->userdata('out_statuspagePermit');
			if ($permition>=$needed_out_status)
			{ 
			?>

				<li class="nav-item"><a href="<?php echo base_url() ?>rf/rfController/count_out_stock_pg_controller"  
					id="<?php if( $_SESSION['page_name']=='count_out_stock'){echo 'selected';}else{echo "not selected";} ?>" > OUT STOCK REPORT</a>
				</li> 

			<?php  
			}


			$needed_out_status = $this->session->userdata('out_statuspagePermit');
			if ($permition>=$needed_out_status)
			{ 
			?>

				<li class="nav-item"><a href="<?php echo base_url() ?>rf/rfController/user_report_pg_controller"  
					id="<?php if( $_SESSION['page_name']=='user_report_page'){echo 'selected';}else{echo "not selected";} ?>" > USER REPORT</a>
				</li> 
				
			<?php  
			}

			$needed_out_status = $this->session->userdata('out_statuspagePermit');
			if ($permition>=$needed_out_status)
			{ 
			?>

				<li class="nav-item"><a href="<?php echo base_url() ?>rf/rfController/refugee_report_pg_controller"  
					id="<?php if( $_SESSION['page_name']=='refugee_report_page'){echo 'selected';}else{echo "not selected";} ?>" > REFUGEE REPORT</a>
				</li> 
				
			<?php  
			}



			?>

			</ul>

		</div>
	</div>

</nav>

	

