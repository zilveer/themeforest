<?php
	global $block, $page_builder_id, $get_meta;
	
    wp_enqueue_script( 'tie-cycle' );

	$cat_id = $block['id'];
	$title = '';
	if( !empty($block['title']) )
		$title = $block['title'];

	$args = array(
		'cat'					 => $cat_id,
		'no_found_rows'          => true,
		'ignore_sticky_posts'	 => true
	);
		
	if( !empty($block['number']) )	
		$args[ 'posts_per_page' ] = $block['number'];

	if( !empty($block['offset']) )	
		$args[ 'offset' ] =  $block['offset'];

		
	$cat_query = new WP_Query( $args ); 
?>
		<section class="cat-box scroll-box tie-cat-<?php echo $cat_id ?>">
		
		<?php if ( !empty( $title ) ) : ?>
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $cat_id ); ?>"><?php if( function_exists('icl_t') ) echo icl_t( THEME_NAME , 'wpml-'.$page_builder_id.'-'.$block['boxid'] , $title); else echo $title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div>
		<?php endif; ?>
		
			<div class="cat-box-content">
				<?php if($cat_query->have_posts()): ?>
				<div id="slideshow<?php echo $cat_id ?>" class="group_items-box">
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>
					<div <?php tie_post_class('scroll-item'); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'tie-medium' ); ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<p class="post-meta">
							<?php if( !empty( $get_meta[ 'box_meta_score'][0] )) tie_get_score(); ?>
							<?php if( !empty( $get_meta[ 'box_meta_date' ][0] )) tie_get_time() ; ?>
						</p>
					</div>
				<?php endwhile;?>
				<div class="clear"></div>
				</div>
				<div id="nav<?php echo $cat_id ?>" class="scroll-nav"></div>
					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section>
		<div class="clear"></div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var vids = jQuery("#slideshow<?php echo $cat_id ?> .scroll-item");
		for(var i = 0; i < vids.length; i+=3) {
		  vids.slice(i, i+3).wrapAll('<div class="group_items"></div>');
		}
		jQuery(function() {
			jQuery('#slideshow<?php echo $cat_id ?>').cycle({
				fx:     'scrollHorz',
				timeout: 3000,
				pager:  '#nav<?php echo $cat_id ?>',
				slideExpr: '.group_items',
				speed: 300,
				slideResize: false,
				pause: true
			});
		});
  });
</script>
<?php wp_reset_query(); ?>