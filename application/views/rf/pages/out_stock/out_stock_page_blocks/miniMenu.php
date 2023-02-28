<?php
	$mini_page_name = ''; 
	$mini_page_name = $this->session->userdata('mini_page_name'); 
?>



<!-- <nav class="miniMenu)">  -->
	<ul>
		<li>
			<a href="<?php echo base_url() ?>rf/out_stock/out_stockController/liquid_list_c" id="<?php  if( $mini_page_name=='Liquid'){echo 'selected';}else{echo "not selected";} ?>" > Liquid </a>
		</li>
		
		<li>
			<a href="<?php echo base_url() ?>rf/out_stock/out_stockController/solid_kilo_list_c"  id="<?php if( $mini_page_name=='Solid'){echo 'selected';}else{echo "not selected";} ?>" > Solid </a>
		</li>

		<li>
			<a href="<?php echo base_url() ?>rf/out_stock/out_stockController/singleItems_list_c"  id="<?php  if( $mini_page_name=='Unit'){echo 'selected';}else{echo "not selected";} ?>" > Unit </a>
		</li>
	</ul>
<!-- </nav> -->