<?php
/**
*Template Name: Sitemap
*
* @author : VanThemes ( http://www.vanthemes.com )
* @license : GNU General Public License version 2.0
*/

get_header(); 
$van_page_type = van_page_type(); 
?>

<?php van_breadcrumb(); ?>

<div id="main-content"  class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?> error404">

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
							 
							<div id="sitemap-container">

								<div class="sitemap">
									<h2><?php _e('Pages','van'); ?></h2>

									<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
								
								</div> <!-- .sitemap-inner -->

								<div class="sitemap">
									<h2><?php _e('Categories','van'); ?></h2>

									<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>

								</div> <!-- .sitemap-inner -->

								<div class="sitemap">

									<h2><?php _e('Tags','van'); ?></h2>

									<ul id="sitemap-tags">
										<?php $tags = get_tags();
										if ($tags) {
											foreach ($tags as $tag) {
												echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . $tag->name . '</a></li> ';
											}
										} ?>
									</ul>

								</div> <!-- .sitemap-inner -->

								<div class="sitemap">

									<h2><?php _e('Authors','van'); ?></h2>

									<ul id="sitemap-authors" ><?php wp_list_authors('optioncount=1&exclude_admin=0'); ?></ul>
								
								</div> <!-- .sitemap-inner -->

								<div class="clear"></div>
							</div> <!-- #sitemap container -->

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

<?php get_footer(); ?>