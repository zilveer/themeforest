<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package smartfood
 */

get_header(); 

$terms = get_terms( 'menu_category' );

?>

<section id="page-content" <?php tdp_attr( 'content' ); ?>>
	
	<div class="container">
		<div class="row clearfix">

			<?php if(tdp_option('food_menu_page_layout') == 'sidebar_left') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    <?php dynamic_sidebar( 'food_sidebar' ); ?>
                </div>

            <?php endif; ?>

			<section id="blog-posts" class="<?php echo tdp_get_blog_layout_class();?>">

				<?php

				// now run a query for each category
				foreach( $terms as $term ) {
				 
				    // Define the query
				    $args = array(
				        'post_type' => 'wprm_menu',
				        'menu_category' => $term->slug,
				        'posts_per_page' => -1
				    );
				    $query = new WP_Query( $args );
				    
					echo '<div class="menu-box">
							<div class="menu-box-border">
								<div class="title">'.$term->name.'</div>
								<div class="restaurant">'.term_description( $term->term_id, 'menu_category' ).'</div>
							</div>
						</div>';

				    while ( $query->have_posts() ) : $query->the_post();

				    	do_action( 'wprm_menu_content_start' );

						get_template_part( 'templates/wprm/single', 'item' );

						do_action( 'wprm_menu_content_end' );

				    endwhile;

				    wp_reset_postdata();
				     
				}

				?>

			</section><!-- .entry -->

			<?php if(tdp_option('food_menu_page_layout') == 'sidebar_right') : ?>

                <div class="col-md-3 col-sm-12 col-xs-12 column sidebar" id="sidebar">
                    <?php dynamic_sidebar( 'food_sidebar' ); ?>
                </div>

            <?php endif; ?>

		</div>
	</div> <!-- end container -->
</section> <!-- end page content -->

<?php get_footer(); ?>
