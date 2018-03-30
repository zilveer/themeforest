<?php
/**
 *	Template Name: Portfolio Template
 */	
 
get_header(); ?>
	<?php
		global $page_datas;
	?>
	<div class="slideshow-wrapper main-slideshow <?php wd_page_layout_class(); ?>">
		<div class="slideshow-sub-wrapper">
			<?php show_page_slider(); ?>
		</div>
	</div>
	<?php do_action('wd_after_main_slideshow'); ?>
	
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
	
	<div id="container" class="archive-page archive-portfolio">
		<div id="content" class="" role="main">
			<div id="main">
			
				<div id="container-main" class="col-sm-24">
					<div class="main-content ">
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content-post">
								<?php the_content(); ?>
							</div>
							<footer class="entry-meta">
								<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="edit-link">', '</span>' ); ?>
							</footer>
						</article>					
					</div>
				</div>
				
			</div>
		</div>			
	</div><!-- #container -->
<?php get_footer(); ?>