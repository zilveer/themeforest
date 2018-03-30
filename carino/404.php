<?php 
/**
* 
* The template for displaying 404 pages (Not Found).
* 
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

get_header();

$van_page_type = van_page_type(); 
?>

<?php van_breadcrumb(); ?>	

<div id="main-content" class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?> error404">
	
	<div id="single-outer">

		<article id="post-0" class="content post-inner post error404 no-results not-found">

			<div class="entry-container">

				<header id="entry-header">
					<h1 class="entry-title">
						<?php _e( 'Not Found', 'van' ); ?>
					</h1><!-- .entry-title -->
				</header>
				
				<p class="e-404">404</p>

				<div class="entry-content">

					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'van' ); ?></p>			
					<?php get_search_form(); ?>

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

				</div><!-- .entry-content -->

			</div>

		</article>

	</div><!-- #single-outer -->

</div><!-- #main-content -->

<?php get_footer(); ?>