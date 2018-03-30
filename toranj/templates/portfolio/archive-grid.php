<?php
/**
 *  Archive Grid template page for portfolio
 * 
 * @package Toranj
 * @author owwwlab
 */

?>

<!-- Page main wrapper -->
<div id="main-content" class="dark-template">
	<div class="page-wrapper">

		<?php if (ot_get_option("portfolio_grid_show_sidebar")== "on"): ?>
		<!-- Sidebar -->
		<div class="page-side ajax-element">
			<div class="inner-wrapper vcenter-wrapper">
				<div class="side-content vcenter">
					<h1 class="title">
						<span class="second-part"><?php echo ot_get_option('portfolio_title_1'); ?></span>
						<span><?php echo ot_get_option('portfolio_title_2'); ?></span>
					</h1>

					<?php if( ot_get_option('portfolio_grid_show_filters') == 'on' ): ?>
					<div class="grid-filters-wrapper">
						<a href="#" class="select-filter"><i class="fa fa-filter"></i> <?php ot_get_option('filter_title'); ?></a>
						<ul class="grid-filters">
						  	<li class="active"><a href="#" data-filter="*"><?php _e('All','toranj'); ?></a></li>
						  	
						  	<?php foreach ($owlabpfl_groups as $group): ?>
						  	<li><a href="#" data-filter=".<?php echo $group->slug; ?>"><?php echo $group->name; ?> - <?php echo $group->count ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>

					<?php echo wpautop( ot_get_option('portfolio_side_content') ); ?>


				</div>
			</div>
		</div>
		<!-- /Sidebar -->
		<?php endif; ?>
		
		<!-- Main Contents -->
		<div class="page-main ajax-element <?php if (ot_get_option("portfolio_grid_show_sidebar")!= "on"):  ?>no-side <?php endif; ?>">
			<!-- portfolio wrapper -->	
			<div class="grid-portfolio<?php if (ot_get_option('portfolio_grid_same_ratio') =="on") echo " same-ratio-items"; ?><?php if (ot_get_option('portfolio_grid_nopadding') =="on") echo" no-padding";?>"
				lg-cols="<?php echo ot_get_option('portfolio_grid_larg_screen_column_count',3); ?>" md-cols="<?php echo ot_get_option('portfolio_grid_medium_column_count',3); ?>" sm-cols="<?php echo ot_get_option('portfolio_grid_small_column_count',2); ?>"
				>
				
				<?php $sizer_defined=0; ?>
				
				<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

				<?php 
					$owlabpfl_meta = get_post_meta( $post->ID );
				 	$the_terms = get_the_terms( $post->ID, 'owlabpfl_group' ); 
				 	//d($the_terms);
				 	$this_terms =array();
				 	if (is_array($the_terms)){
					 	foreach($the_terms as $term){
					 		$this_terms[]= $term->slug;
					 	}
				 	}
				 	$group_terms = implode(' ', $this_terms);

				 	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb' );
		            // [0] => url
		            // [1] => width
		            // [2] => height
		            // [3] => boolean: true if $url is a resized image, false if it is the original.

				?>
				<!-- portfolio Item -->		
				<div class="gp-item <?php echo ot_get_option('portfolio_grid_hover','tj-hover-1'); ?> <?php echo $group_terms; ?> <?php if ( array_key_exists('owlabpfl_grid_sizer', $owlabpfl_meta) && $sizer_defined !=1 ): $sizer_defined == 1; ?> grid-sizer <?php endif;?>" 
					<?php if (!empty($owlabpfl_meta['owlabpfl_grid_ratio'][0])): ?>data-width-ratio='<?php echo intval($owlabpfl_meta['owlabpfl_grid_ratio'][0]); ?>'<?php endif; ?>>
					<a href="<?php the_permalink(); ?>" class="ajax-portfolio normal">
						
						<?php owlab_lazy_image($thumb_url,get_the_title()); ?>
						<!-- Item Overlay -->	
						<?php if (ot_get_option('portfolio_grid_hover')=='tj-hover-1'): ?>
						<div class="tj-overlay">
							<h3 class="title"><?php the_title(); ?></h3>
							<h4 class="subtitle"><?php echo array_key_exists('owlabpfl_short_des', $owlabpfl_meta) ? $owlabpfl_meta['owlabpfl_short_des'][0] : ''; ?></h4>
						</div>
						<?php else: ?>
						<div class="tj-overlay">
							<i class="fa fa-angle-right overlay-icon"></i>
							<div class="overlay-texts">
								<h3 class="title"><?php the_title(); ?></h3>
								<h4 class="subtitle"><?php echo array_key_exists('owlabpfl_short_des', $owlabpfl_meta) ? $owlabpfl_meta['owlabpfl_short_des'][0] : ''; ?></h4>
							</div>
						</div>
						<?php endif; ?>
						<!-- /Item Overlay -->	
					</a>
				</div>
				<!-- /portfolio Item -->

				<?php endwhile; else: ?>
					<?php _e('No items found.','toranj'); ?>
				<?php endif; ?>

			</div>
			<!-- /portfolio wrapper -->	
			<?php if( ot_get_option('portfolio_grid_show_filters') == 'on' && ot_get_option("portfolio_grid_show_sidebar")!= "on"): ?>
			<div class="fixed-filter">
				<a href="#" class="select-filter"><i class="fa fa-filter"></i> <?php echo ot_get_option('filter_title'); ?></a>
				<ul class="grid-filters">
				  	<li class="active"><a href="#" data-filter="*"><?php _e('All','toranj'); ?></a></li>
				  	
				  	<?php foreach ($owlabpfl_groups as $group): ?>
				  	<li><a href="#" data-filter=".<?php echo $group->slug; ?>"><?php echo $group->name; ?> - <?php echo $group->count ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		<!-- /Main Contents -->



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