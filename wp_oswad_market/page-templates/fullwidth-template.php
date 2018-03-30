<?php
/**
 *	Template Name: Fullwidth Template
 */	
get_header(); ?>
	<?php 
	$has_breadcrumb = (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0);
	$has_page_title = ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 );
	if( $has_breadcrumb || $has_page_title ){
		global $smof_data;
		$style = '';
		if( isset($smof_data['wd_bg_breadcrumbs']) && $smof_data['wd_bg_breadcrumbs'] != '' )
			$style = 'style="background: url('.$smof_data['wd_bg_breadcrumbs'].')"';
		echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.$style.'>';
			if( $has_page_title )
				echo '<h1 class="heading-title page-title">'.get_the_title().'</h1>';
			if( $has_breadcrumb )
				wd_show_breadcrumbs();
		echo '</div></div>';
	}
	?>
	<div id="container">
		<div id="content" class="container" role="main">	
			<div id="main" class="col-sm-24">
				<div class="main-content">
					<div class="slideshow-wrapper main-slideshow <?php wd_page_layout_class(); ?>">
						<div class="slideshow-sub-wrapper <?php //echo strcmp($page_datas['page_layout'],'wide') == 0 ? "wide-wrapper" : "span24"; ?>">
							<?php show_page_slider(); ?>
						</div>
					</div>
					<?php do_action('wd_after_main_slideshow'); ?>
					
					<div class="entry-content">
							<?php
							/* Run the loop to output the posts.
							 * If you want to overload this in a child theme then include a file
							 * called loop-index.php and that will be used instead.
							 */	
								if(have_posts()) : while(have_posts()) : the_post();
								?>
									<div class="page-item">
										
										<div><?php the_content(); ?></div>
									</div>
								<?php						
								endwhile;
								endif;	
							?>
					</div>	
				</div>
			</div>
		</div>	
	</div><!-- #container -->
<?php get_footer(); ?>