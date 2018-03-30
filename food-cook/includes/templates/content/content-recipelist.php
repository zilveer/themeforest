<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

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

$terms 				= get_the_terms( $post->ID, 'cuisine' );
$output_cat_recipe 	= '';

if ( $terms && ! is_wp_error( $terms ) ) :
	$output_cat_recipe = get_the_term_list( $post->ID, 'cuisine', __('In ', 'woothemes'), ', ', '') . ' | '; 
endif;
 
$page_link_args = apply_filters( 'woothemes_pagelinks_args', array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) );
 
woo_post_before(); ?>

<div <?php post_class(); ?>>

	<?php //woo_post_inside_before();	?>
	 
	<div class="recipe-list-item rec-drop" id="post-<?php the_ID(); ?>">

		<?php get_the_image( array(
		'order'   		=> array( 'featured', 'default' ),
		'featured'  	=> true,
		'default' 		=> esc_url( get_template_directory_uri() . '/includes/assets/images/image.jpg' ),
		'size'			=> 'list-thumb',
		'link_to_post'  => false,
		'before'        => '<div class="th-recipe-list">',
		'after'         => '</div>'
		) ); ?>


		<div class="recipe-info-list">

			<h2 class="recipe-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
			<?php if ($woo_options['woo_rating_recipe'] == 'true') : ?>

				<div class="box-info-list">

					<div class="rating">

						<?php woo_fnc_the_recipe_rating( $post->ID ); ?>

					</div>	
						<span><?php echo woo_fnc_get_avg_rating( $post->ID ); ?>  <?php _e('of 5','woothemes'); ?></span>
					
						<?php

						$cook_time  = woo_fnc_convert_to_hours( get_post_meta( $post->ID, 'RECIPE_META_cook_time', true ) ); 												
						$yield 		= get_post_meta( $post->ID, 'RECIPE_META_yield', true ); 	
						
						if( !empty( $cook_time ) ) : ?>

						<span class="value"> <em class="icon-time"></em>   <?php echo $cook_time; ?> <?php _e('Minutes', 'woothemes'); ?> </span>

						<?php endif;

						if( !empty( $yield ) ) : ?>

							<span class="value"><em class="icon-food"></em>   <?php echo $yield; ?>  </span>

						<?php endif; ?> 
				</div>

			<?php endif; ?>	

			<p><?php echo woo_fnc_word_trim( get_the_excerpt() , 30, '...' ); ?></p>

			<div class="line-gold"></div>

			<p class="get-recipe"><a href="<?php the_permalink(); ?>" ><?php _e('Get Recipe', 'woothemes'); ?></a></p>

			<div class="post-meta">	
				<span class="small" itemprop="datePublished">
					<?php _e( 'on ', 'woothemes' ); ?>
				</span> 

				<?php echo do_shortcode( '[post_date after=" |"]' ); ?>	

				<?php echo $output_cat_recipe; ?>
				
				<span class="small"><?php _e( 'By', 'woothemes' ); ?> </span> 

				<?php echo do_shortcode( '[post_author_posts_link after=" | "]' ).do_shortcode( '[post_comments]' ). do_shortcode( '[post_edit]' ); ?>
			</div>
		</div><!-- /.recipe-info-list -->
	</div><!-- /.recipe-list-item -->
</div><!-- /.post -->
<?php
	//woo_post_after();
		$comm = '';
	
	if( isset($woo_options[ 'woo_comments' ]) ) { $comm = $woo_options[ 'woo_comments' ]; }
	if ( ( $comm == 'recipe' || $comm == 'both' ) && is_single() ) { comments_template(); }
	 
?>