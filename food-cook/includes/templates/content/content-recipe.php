<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
    die ( 'You do not have sufficient permissions to access this page!' );
endif;

/**
 * Default Content Template
 *
 * This template is the default content template. It is used to display the content of a
 * template file, when no more specific content-*.php file is available.
 *
 * @package WooFramework
 * @subpackage Template
 */

/**
 * Settings for this template file.
 *
 * This is where the specify the HTML tags for the title.
 * These options can be filtered via a child theme.
 *
 * @link http://codex.wordpress.org/Plugin_API#Filters
 */
global $woo_options;
 
if ( ! is_single() ) :
	 $title_before = '<h1 class="title"><a href="' . get_permalink( get_the_ID() ) . '" rel="bookmark" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';
	 $title_after  = '</a></h1>';
endif;

$page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages : ', 'woothemes' ), 'after' => '</div>' ) );
 
woo_post_before(); ?>

<div <?php post_class('recipe-grid-item rec-drop entry-summary entry-content updated hentry'); ?> id="post-<?php the_ID(); ?>">

	<div class="th-recipe">
		
		<a href="<?php the_permalink(); ?>">

		 	<div class="snipit">
		    				
				 <ul class="recipe-info-page">
	    				<li>
	    					<div class="fork"> <em class="fa fa-cutlery"></em></div>
		    			</li>
				
					 <?php
						$yield 		= get_post_meta( get_the_id(), 'RECIPE_META_yield', true ); 	
						$servings 	= get_post_meta( get_the_id(), 'RECIPE_META_servings', true );									
						$cook_time 	= woo_fnc_convert_to_hours( get_post_meta( get_the_id(), 'RECIPE_META_cook_time', true ) ); 
				 
						if( !empty( $yield ) ) : 
					?>
						<li>
							<?php _e('Yield : ','woothemes'); ?>
							<span class="value"><?php echo $yield; ?> </span>
						</li>
					<?php 
						
						endif; 
				 
						if( !empty( $servings ) ) : 
					?>
						<li>
							<?php _e('Servings :','woothemes'); ?> 
							<span class="value"><?php echo $servings; ?></span>
						</li>
					<?php 

						endif; 
				 
						if( !empty( $cook_time ) ) : 
					?>
						<li>
							<?php _e('Cook Time :','woothemes'); ?> 
							<span class="value"><?php echo $cook_time; _e(' Min', 'woothemes');?> </span>
						</li>
					<?php 
						endif; 
					?>
				</ul>
			</div>
		</a>
		<?php 
		// get_the_image( array(
		// 		'order'   		=> array( 'featured', 'default' ),
		// 		'featured'  	=> true,
		// 		'default' 		=> esc_url( get_template_directory_uri() . '/includes/assets/images/image.jpg' ),
		// 		'size'			=> 'recipe-listing',
		// 		'link_to_post'  => false
		// 	  ) ); 
		if ( has_post_thumbnail() ) {
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'recipe-listing' );
			echo '<img src="' . $large_image_url[0] . '" title="' . the_title_attribute( 'echo=0' ) . '">';
		} else {
			$attachment_url = get_template_directory_uri() . '/includes/assets/images/image.jpg';
			echo '<img src="' . $attachment_url . '" title="' . the_title_attribute( 'echo=0' ) . '">';
		}
		?>
	</div>

	<div class="recipe-info">

		<h3 class="entry-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php echo woo_fnc_word_trim( get_the_title(), 8, '...' ); ?></a></h3>
	
		<?php if ( $woo_options['woo_rating_recipe'] == 'true' ) : ?>
			<div class="rating">
				<?php woo_fnc_the_recipe_rating( get_the_id() ); ?>
			</div>	
		<?php endif; ?>
	
	</div>

</div><!-- end of post div -->
 