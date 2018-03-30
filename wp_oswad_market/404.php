<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage RoeDok
 * @since WD_Responsive
 */	
get_header(); ?>

		<?php 
		$has_breadcrumb = true;
		if( $has_breadcrumb ){
			global $smof_data;
			$style = '';
			if( isset($smof_data['wd_bg_breadcrumbs']) && $smof_data['wd_bg_breadcrumbs'] != '' )
				$style = 'style="background: url('.$smof_data['wd_bg_breadcrumbs'].')"';
			echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.$style.'>';
				wd_show_breadcrumbs();
			echo '</div></div>';
		}
		?>
		<div id="container" class="page-container container-404">
			<div id="content" class="container" role="main">		
				<div id="container-main" class="col-sm-18">
					<div class="main-content">
						
						<div class="entry-content">
							<div class="bg-404"></div>
							<div class="alert alert-info">
								<p><?php 
										_e( 'You may have stumbled here by accident or the post you are looking for is no longer here.', 'wpdance');
										_e('Please try one of the following:', 'wpdance' ); 
									?></p>
								<ul class="listing-style listing-style-3">
									<li><?php _e('Hit the "back" button on your browser.','wpdance')?></li>
									<li><?php _e('Return to the Usability.','wpdance')?></li>
									<li><?php _e('Use the navigation menu at the top of the page','wpdance')?></li>
								</ul>
							</div>
						</div>
					</div>
				</div><!-- end content -->
				
				<div id="right-sidebar" class="col-sm-6">
					<div class="right-sidebar-content">
					<?php
						if ( is_active_sidebar( 'primary-widget-area-right' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'primary-widget-area-right' ); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end right sidebar -->
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>
