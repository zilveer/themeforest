<?php 
global $mk_settings;

$layout = $mk_settings['archive-layout'];
$loop_style = $mk_settings['archive-loop-style'];
$portfolio_loop_style = !empty($mk_settings['portfolio-archive-loop-style']) ? $mk_settings['portfolio-archive-loop-style'] : 'grid';

if(empty($layout)) {
	$layout = 'right';
}


get_header(); ?>
<div id="theme-page" class="page-master-holder">
  	<div class="background-img background-img--page"></div>
	<div class="mk-main-wrapper-holder">
		<div class="theme-page-wrapper mk-main-wrapper <?php echo $layout; ?>-layout mk-grid vc_row-fluid">
			<div class="theme-content" itemprop="mainContentOfPage">
				<?php
				if ( isset( $_REQUEST['portfolio_category'] ) ) {
					echo do_shortcode( '[mk_portfolio style="'.$portfolio_loop_style.'" column="4" height="350" pagination_style="1"]' );
				} else {
					echo do_shortcode( '[mk_blog style="'.$loop_style.'" image_height="320" pagination_style="1"]' );
				}
	?>	
			</div>
		<?php if($layout != 'full') get_sidebar(); ?>	
		<div class="clearboth"></div>	
		</div>
		<div class="clearboth"></div>
	</div>	
</div>
<?php get_footer(); ?>