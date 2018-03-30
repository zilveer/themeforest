<?php
/**
 *  404 page
 * 
 * @package Toranj
 * @author owwwlab (Alireza Jahandideh & Ehsan Dalvand @owwwlab)
 */
?>

<?php get_header(); ?>

<!--Page main wrapper-->
<div id="main-content" class="abs dark-template"> 
	<div class="page-wrapper">
	
			<div class="vcenter-wrapper page404">
				<div class="vcenter">
					<div class="p404">
						<h1>404!</h1>
						<h2><?php _e("Page not found!",'toranj') ?></h2>
					</div>
					<div class="p404-home">
						<h2><a href="<?php echo home_url(); ?>"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;<?php _e("Go Back to Home","toranj"); ?></a></h2>
					</div>
				</div>
			</div>
			
	</div>
</div>
<!--/Page main wrapper-->

<?php get_footer(); ?>