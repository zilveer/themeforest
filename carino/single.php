<?php 
 /**
* 
* The template for displaying all single posts.
* 
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
get_header(); 

$van_page_type = van_page_type(); 
?>
<?php van_breadcrumb(); ?>

<div id="main-content" class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">

	<div id="single-outer">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', get_post_format() );  ?>

					<?php 
						if ( van_meta_conditions( 'van_authorbox', 'author_box', false )  ) {
							get_template_part( 'templates/author-info' );
						}
						
					 ?>

					<?php 
						if ( van_meta_conditions( 'van_relatedpost', 'related_posts', false )  ) {
							get_template_part( 'templates/related-articles' ); 
						}
					?>
					
			<?php endwhile; ?>

		<?php endif; ?>

		<?php comments_template( '', true ); ?>

	</div><!-- #single-outer -->

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>