<?php
/**
 *  Archive Minimal template page for gallery
 * 
 * @package Toranj
 * @author owwwlab
 */
 
?>


<!-- page main wrapper -->
<div id="main-content">
	
	<!-- Page sidebar -->
	<div class="page-side">
		<div class="inner-wrapper vcenter-wrapper">
			<div class="side-content vcenter">

				<!-- Page title -->
				<h1 class="title">
					<span class="second-part"><?php echo ot_get_option('gallery_title_1'); ?></span>
					<span><?php echo ot_get_option('gallery_title_2'); ?></span>
				</h1>
				<!-- /Page title -->

				<div class="hidden-sm hidden-xs">
					<?php echo ot_get_option('gallery_side_content'); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page sidebar -->

	<!-- Page main content -->
	<div class="page-main gallery-minimal bg-dark-2">
		<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

			<?php 
			$owlabgal_meta = get_post_meta( $id ); 
			$img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			?>
			
			<!--Gallery item-->
			<div class="gallery-item">
				<?php owlab_lazy_image($img_url,get_the_title()); ?>
			</div>	
			<!--Gallery item-->
			
		<?php endwhile; else: ?>
			<?php _e('No items found.','toranj'); ?>
		<?php endif; ?>

		

	</div>
	<!-- /Page main content -->
	
</div>
<!-- /page main wrapper -->
<?php do_action('owlab_after_content'); ?>