<?php 
/************************************************************************
* Standard Post Template w No Sidebar
*************************************************************************/
global $wbc907_data;

?>
	<div class="page-content clearfix">

		<?php 

			if(have_posts()) : while(have_posts()) : the_post();

					the_content();

				endwhile;

			endif;
		?>

	</div><!-- ./page-content -->