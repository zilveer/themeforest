<?php
/*
*	Template Name: Archive Template
*/
get_header(); ?>

<?php global $page_datas;?>
		<div class="slideshow-wrapper main-slideshow <?php wd_page_layout_class(); ?>">
			<div class="slideshow-sub-wrapper <?php //echo strcmp($page_datas['page_layout'],'wide') == 0 ? "wide-wrapper" : "span24"; ?>">
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
		<div id="container" class="page-template default-template">
			<div id="content" class="container" role="main">	
				<div class="col-main col-sm-24">
					<div class="main-content" id="main">

						<div class="archive-content entry-content">													
						<?php the_content();?>
							<div class="col-sm-12">
								<h3 class="heading-title"><?php _e('The Latest 30 Posts', 'wpdance'); ?></h3>
								<ul class="sitemap-archive">
									<?php query_posts( 'posts_per_page=30' ); ?>
									<?php while ( have_posts() ) { the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php the_time('Y.m.d'); ?> - <?php _e( 'Comments', 'wpdance' ); ?> (<?php echo $post->comment_count; ?>)</li>
									<?php } ?>            
								</ul><!-- Latest Posts -->
							</div>
							
							<div class="col-sm-6">
								<h3 class="heading-title"><?php _e('Categories', 'wpdance'); ?></h3>
								<ul class='sitemap-archive'>
									<?php wp_list_categories('title_li=&show_count=true'); ?>
								</ul>
							</div><!-- Categories -->
							
							<div class="col-sm-6">
								<h3 class="heading-title"><?php _e('Monthly Archives', 'wpdance'); ?></h3>
								<ul class='sitemap-archive'>
									<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
								</ul>
							</div><!-- Monthly Archives -->	
						</div>
					</div>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
