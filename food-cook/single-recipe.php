<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
	die ( 'You do not have sufficient permissions to access this page!' );
endif;

/**
* Single Custom Post Template
*
* This template is the default page template. It is used to display content when someone is viewing a
* singular view of a post ('post' post_type).
* @link http://codex.wordpress.org/Post_Types#Post
*
* @package WooFramework
* @subpackage Template
*/
global $woo_options; ?>

<?php get_header(); ?>

	<!-- #content Starts -->
	<?php woo_content_before(); ?>

	<div id="content" class="col-full">

		<div id="main-sidebar-container">    

			<!-- #main Starts -->
			<?php woo_main_before(); ?>

			<div id="main" class="col-left post single-recipe" itemscope itemtype="http://schema.org/Recipe"> 
			
			<?php 
				$get_permalink = get_permalink( get_the_ID() );
				echo '<meta itemprop="url" content="'.$get_permalink.'">';
			 ?>

			<?php
				$recipe_images 	= get_post_meta( get_the_id(), 'RECIPE_META_more_images_recipe' );
				$embed_code_top = get_post_meta( get_the_id(), 'RECIPE_META_video_embed_top', true );
				$images_count 	= count( $recipe_images );

				if( $images_count > 0 ) {

					echo "<section class='slider'><div id='slider' class='featured-slider'>";

					foreach($recipe_images as $image) {
						echo wp_get_attachment_image($image, 'full', false, array( 'class' => 'photo' ));
					} 

					echo "</div></section>";
					df_meta_image();

				} else if(!empty($embed_code_top)) {

					echo "<div class='single-img-box'>";
					echo $embed_code_top;
					echo "</div>";
					df_meta_image();

			 	} else {

					get_the_image( array(
						'post_id' 		=> get_the_ID(),
						'order'   		=> array( 'featured', 'default' ),
						'featured'  	=> true,
						'default' 		=> esc_url( get_template_directory_uri() . '/includes/assets/images/image.jpg' ),
						'size'			=> 'full',
						'link_to_post'  => false,
						'before'        => '<div class="single-img-box photo">',
						'after'         => '</div>'
					) );

				} 
			?>
				
				<?php while (have_posts()) : the_post(); ?>
	
				<h1 class="title fn" itemprop="name" ><?php the_title(); ?></h1>
				
				<?php df_postmeta_recipe(); ?>

				<?php df_taxonomies_info(); ?>	

				<div class="content-left-first boxinc entry-content" itemprop="description">	


						<?php the_content(); ?>
					

				</div>

				<?php endwhile; ?>
				
				<div class="content-right-first info-right ">	
					
					<?php df_rating_info(); ?>
				
				</div><!-- end of info-right div -->

				<?php df_extra_share_recipe(); ?>

				<?php df_recipe_tabs(); ?>

				<?php df_below_content_social_recipe(); ?>
 
				<?php df_cook_info_recipe(); ?>

				<?php df_related_recipe(); ?>
			</div><!-- /#main -->

			<?php woo_main_after(); ?>

			<?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->         

        <?php dahz_get_sidebar( 'secondary' ); ?>

	</div><!-- /#content -->

	<?php woo_content_after(); ?>

<?php get_footer(); ?>