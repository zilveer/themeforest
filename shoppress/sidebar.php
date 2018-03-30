<?php require(gp_inc . 'options.php'); global $gp_settings; ?>


<?php if($gp_settings['layout'] != "fullwidth") { ?>


	<!-- BEGIN SIDEBAR -->
	
	<div id="sidebar">
				
		<?php if(is_active_sidebar($gp_settings['sidebar'])) { ?>


			<!-- BEGIN SELECTED WIDGETS -->
			
			<?php dynamic_sidebar($gp_settings['sidebar']); ?>
			
			<!-- END SELECTED WIDGETS -->
			
			
		<?php } ?>
		
	</div>
	
	<!-- END SIDEBAR -->
	

<?php } ?>