<?php
/**
* 
* The template for displaying single page.
* 
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
get_header(); 

$van_page_type = van_page_type(); 
?>

<?php van_breadcrumb(); ?>

<div id="main-content"  class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">

	<div id="single-outer">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array('content','post-inner') ); ?>>
					
					<div class="entry-container">

						<header id="entry-header">
							<h1 class="entry-title">
								<?php the_title(); ?>
							</h1><!-- .entry-title -->
						</header>

						<div class="entry-content">

							 <?php the_content(); ?>
							 
							<?php wp_link_pages(array('before' => '<p><strong>'.__( 'Pages:','van').'</strong> ', 'after' => '</p>')); ?>										
						
							<?php edit_post_link( __( '(Edit)', 'van' ), '<span class="edit-post">', '</span>' ); ?>
				
						</div><!-- .entry-content -->
						
					</div><!-- .entry-container -->

				</article>

			<?php endwhile; ?>

		<?php endif;  ?>

		<?php comments_template( '', true ); ?>

	</div> <!-- #single-outer -->

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>