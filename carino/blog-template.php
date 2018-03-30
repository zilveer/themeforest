<?php
/**
* 
* Template Name: Blog
* 
* @author : VanThemes ( http://www.vanthemes.com )
* @license : GNU General Public License version 2.0
*/
get_header(); 
$van_page_type = van_page_type(); 
?>

<?php van_breadcrumb(); ?>


<div id="main-content" class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">
	
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

		<?php 
			$meta        =  get_post_custom($post->ID);
			$page        = (get_query_var('paged')) ? get_query_var('paged') : get_query_var('page');
			$paged      = ( $page > 1 ) ? $page : 1;
			$posts_cat  = ( isset( $meta["van_blogcats"][0] ) ) ? "cat=" . $meta["van_blogcats"][0] . "&" : "";
			query_posts( $posts_cat . "post_status=publish&showposts=" . get_option('posts_per_page') . "&paged=" . $page);
			$tmp_max    = $wp_query->max_num_pages;
			
			if( isset( $meta["van_blogcats"][0]  ) ) {
				$tmp_cat	= $meta["van_blogcats"][0];
			}
		?>

		<div id="blog-template" >
			<?php if ( have_posts() ) : ?>

				<div id="posts-outer">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'partials/content', get_post_format() );  ?>

					<?php endwhile;?>

				</div><!-- #posts-outer -->

				<?php van_get_pagination(); ?>

			<?php else: ?>
				<?php get_template_part( 'partials/content', 'none' ); ?>
			<?php endif; ?>
		</div>

	</div> <!-- #single-outer -->

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>