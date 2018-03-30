<?php
/*
*	Template Name: Sitemap Template
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
				<div class="col-main col-sm-24" id="main">
					<div class="main-content">
								
						<div class="sitemap-content entry-content">
							
							<?php the_content();?>
									<!--Page-->
									<div class="col-sm-8">  
										<h3 class="heading-title"><?php _e( 'Pages', 'wpdance' ); ?></h3>
										<ul class='sitemap-archive'>
											<?php wp_list_pages( 'depth=0&sort_column=menu_order&title_li=' ); ?>
										</ul>
									</div>
					
									<!--Categories-->
									<div class="col-sm-8">
										<h3 class="heading-title"><?php _e('Categories', 'wpdance'); ?></h3>
										<ul class='sitemap-archive'>
											<?php 
											wp_reset_query();	
											wp_list_categories('title_li=&show_count=true'); ?>
										</ul>
									</div>
									
									<!--Posts per category-->
									<div class="col-sm-8">
										<h3 class="heading-title"><?php _e( 'Posts per category', 'wpdance' ); ?></h3>
										<?php
								
											$cats = get_categories();
											wp_reset_query();
											foreach ( $cats as $cat ) {
												query_posts( 'cat=' . $cat->cat_ID );
										?>

										<h3><?php echo $cat->cat_name; ?></h3>
										<ul class='sitemap-archive'>
											<?php while ( have_posts() ) { the_post(); ?>
											 <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php _e( 'Comments', 'wpdance' ); ?> (<?php echo $post->comment_count; ?>)</li>
											 <?php }  ?>
										</ul>
										<?php } ?>
									</div>			
						</div>
					</div>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>