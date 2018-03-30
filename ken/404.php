<?php 
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Ken
 * @since Ken 1.0
 */

$layout = 'right';

get_header(); ?>
<div id="theme-page" class="page-master-holder">
  	<div class="background-img background-img--page"></div>
	<div class="mk-main-wrapper-holder">
		<div class="theme-page-wrapper mk-main-wrapper <?php echo $layout; ?>-layout mk-grid vc_row-fluid">
			<div class="theme-content" itemprop="mainContentOfPage">
				<h3><?php _e('Nothing Found', 'mk_framework'); ?></h3>
				<p><?php _e('Sorry, the post you are looking for is not available.', 'mk_framework'); ?></p>
				<?php get_search_form(); ?>
			</div>
		<?php if($layout != 'full') get_sidebar(); ?>	
		<div class="clearboth"></div>	
		</div>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>