<?php
/**
 *  Archive Horizontal template page for gallery
 * 
 * @package Toranj
 * @author owwwlab
 */
 
?>



<!-- Page main wrapper -->
<div id="main-content">
	<div class="page-wrapper regular-page">
		<div class="container">

			<div class="row">
				<div class="col-md-3">

					<!-- Page title -->
					<h2 class="section-title double-title">
						<span><?php echo ot_get_option('gallery_title_1'); ?></span><?php echo ot_get_option('gallery_title_2'); ?>
					</h2>
					<!-- /Page title -->
					<?php echo ot_get_option('gallery_side_content'); ?>
					
					<?php if( ot_get_option('gallery_grid_show_filters') == 'on' ): ?>
					<div class="grid-filters-wrapper">
						<a href="#" class="select-filter"><i class="fa fa-filter"></i> <?php ot_get_option('gallery_grid___filter_title'); ?></a>
						<ul class="grid-filters">
						  	<li class="active"><a href="#" data-filter="*"><?php _e('All','toranj'); ?></a></li>
						  	
						  	<?php foreach ($owlabgal_albums as $album): ?>
						  	<li><a href="#" data-filter=".<?php echo $album->slug; ?>"><?php echo $album->name; ?> - <?php echo $album->count ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>

					

				</div>
				<div class="col-md-9">

					<!-- Gallery wrapper -->	
					<div class="grid-portfolio tj-lightbox-gallery<?php if (ot_get_option('gallery_grid___same_ratio_thumbs') =="on") echo " same-ratio-items"; ?><?php if (ot_get_option('gallery_grid___remove_spaces_between_images') =="on") echo" no-padding";?>"lg-cols="<?php echo ot_get_option('gallery_grid___larg_screen_column_count',3); ?>" md-cols="<?php echo ot_get_option('gallery_grid___medium_screen_column_count',3); ?>" sm-cols="<?php echo ot_get_option('gallery_grid___small_column_count',2); ?>">
						
						<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

						<?php 
							$owlabgal_meta = get_post_meta( $post->ID );
						 	$the_terms = wp_get_post_terms( $post->ID, 'owlabgal_album', array('fileds' => 'all') ); 
						 	//d($the_terms);
						 	$this_terms =array();
						 	if (is_array($the_terms)){
							 	foreach($the_terms as $term){
							 		$this_terms[]= $term->slug;
							 	}
						 	}
						 	$album_terms = implode(' ', $this_terms);

						 	$item_overlay = owlab_get_gallery_overlay(ot_get_option("gallery_index_overlay_type"));
						 	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb' );
						 	// [0] => url
							// [1] => width
							// [2] => height
							// [3] => boolean: true if $url is a resized image, false if it is the original.

						 	$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						?>

						<!-- Gallery Item -->		
						<div class="gp-item <?php echo $item_overlay['parent_class'];?> <?php echo $album_terms; ?>" <?php if (!empty($owlabgal_meta['owlabgal_grid_ratio'][0])): ?>data-width-ratio="<?php echo intval($owlabgal_meta['owlabgal_grid_ratio'][0]); ?>"<?php endif; ?>> 
							<a href="<?php echo $img_url; ?>"  class="lightbox-gallery-item" title="<?php the_title(); ?><?php echo (array_key_exists('owlabgal_short_des', $owlabgal_meta) ) ? " | ".$owlabgal_meta['owlabgal_short_des'][0] : ''; ?>">
								<?php owlab_lazy_image($thumb_url,get_the_title()); ?>
								<!-- Item Overlay -->	
								<?php echo $item_overlay['markup']; ?>
								<!-- /Item Overlay -->	
							</a>
						</div>
						<!-- /Gallery Item -->

						<?php endwhile; else: ?>
							<?php _e('No items found.','toranj'); ?>
						<?php endif; ?>


					</div>
					<!-- /Gallery wrapper -->

				</div>	
			</div>

			

			<hr/>
			<a class="back-to-top" href="#"></a>

		</div>
	</div>
</div>
<!-- /Page main wrapper -->
<?php do_action('owlab_after_content'); ?>