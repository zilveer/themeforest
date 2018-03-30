<?php
#
# additional elements before sidebar
#
global $rt_sidebar_location; 
?>


<?php if($rt_sidebar_location[1] != "full"):?>
	<!-- section .sidebar -->  
	<section class="sidebar <?php echo $rt_sidebar_location[1];?> <?php echo apply_filters("floating_sidebars","")?> "> 
	
	<?php
		//get project details  
		do_action( "get_project_details");

		//get post navigation
		do_action( "get_post_navigation"); 

		//load the widgets
		do_action( "rt_load_widgets"); 		
	?>

	</section><!-- / end section .sidebar -->  
<?php endif;?>