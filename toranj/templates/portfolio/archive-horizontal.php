<?php
/**
 *  Archive Horizontal template page for portfolio
 * 
 * @package Toranj
 * @author owwwlab
 */
 
?>

<!-- Page main wrapper -->
<div id="main-content" class="dark-template">
	<div class="page-wrapper">
		
		<!-- Sidebar -->
		<div class="page-side ajax-element">
			<div class="inner-wrapper vcenter-wrapper">
				<div class="side-content vcenter">
					<div class="title">
						<span class="second-part"><?php echo ot_get_option('portfolio_title_1'); ?></span>
						<span><?php echo ot_get_option('portfolio_title_2'); ?></span>
					</div>
					
					<?php echo ot_get_option('portfolio_side_content'); ?>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->

		<!-- Main Content -->
		<div class="page-main ajax-element">
			<!-- Portflio wrapper -->	
			<div class="ajax-folio vertical-folio">
				
				<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

				<?php 

				$owlabpfl_meta = get_post_meta( $id ); 
				$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
	            // [0] => url
	            // [1] => width
	            // [2] => height
	            // [3] => boolean: true if $url is a resized image, false if it is the original.
	            $owlab_load = "i";
	            if(!empty($owlabpfl_meta["owlabpfl_use_video"]) && $owlabpfl_meta["owlabpfl_use_video"][0]=='on'){
	            	$owlab_load = "v";
	            }
				?>

				<!-- Portflio Item -->		
				<div class="vf-item<?php if($owlab_load == "i"){echo " set-bg";}?> tj-hover-3<?php if (ot_get_option('portfolio_horizontal_animate') == "on"): ?> inview-animate inview-fadeleft<?php endif; ?>">
					<a href="<?php the_permalink(); ?>" class="ajax-portfolio">
						<?php if($owlab_load =="v"): ?>
							<?php owlab_video_background($owlabpfl_meta, $thumb_url[0]) ?>
						<?php else: ?>
							<?php owlab_lazy_image($thumb_url,get_the_title()); ?>
						<?php endif; ?>
						

						<!-- Item Overlay -->	
						<div class="tj-overlay vcenter-wrapper">
							<div class="overlay-texts vcenter">
								<h3 class="title"><?php the_title(); ?></h3>
								<h4 class="subtitle"><?php echo array_key_exists('owlabpfl_short_des', $owlabpfl_meta) ? $owlabpfl_meta['owlabpfl_short_des'][0] : ''; ?></h4>
							</div>
						</div>
						<!-- /Item Overlay -->	
					</a>
				</div>
				<!-- /Portflio Item -->	
				<?php endwhile; else: ?>
					<?php _e('No items found.','toranj'); ?>
				<?php endif; ?>
				
			</div>
			<!-- /Portflio wrapper -->	
		</div>
		<!-- /Main Content -->

		
		<!--Ajax folio-->
		<div id="ajax-folio-loader">
			<!-- loading css3 -->
			<div id="followingBallsG">
				<div id="followingBallsG_1" class="followingBallsG">
				</div>
				<div id="followingBallsG_2" class="followingBallsG">
				</div>
				<div id="followingBallsG_3" class="followingBallsG">
				</div>
				<div id="followingBallsG_4" class="followingBallsG">
				</div>
			</div>
		</div>
		<div id="ajax-folio-item"></div>
		<!--Ajax folio-->
	</div>
</div>
<!-- /Page main wrapper -->


