<?php
/*
*	Template Name: Contact Template
*/
get_header(); ?>
	<?php 
		global $page_datas;
	?>

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

		<div class="top-page <?php wd_page_layout_class(); ?>">
			<div class="wd_map"><?php echo do_shortcode(get_post_meta( get_the_ID(), 'google_map', true )); ?></div>
		</div>
		<div class="slideshow-wrapper main-slideshow <?php wd_page_layout_class(); ?>">
			<div class="slideshow-sub-wrapper <?php //echo strcmp($page_datas['page_layout'],'wide') == 0 ? "wide-wrapper" : "span24"; ?>">
				<?php
					
					$_layout_config = explode("-",$page_datas['page_column']);
					$_left_sidebar = (int)$_layout_config[0];
					$_right_sidebar = (int)$_layout_config[2];
					$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );		
				?>
			</div>
		</div>
		
		<div id="container" class="page-template default-template">
			<div id="content" class="container" role="main">
				
				<div id="main">
				<?php if( $_left_sidebar && !wp_is_mobile() ): ?>
						<div id="left-sidebar" class="col-sm-6 hidden-xs">
							<div class="left-sidebar-content">
								<?php
									if ( is_active_sidebar( $page_datas['left_sidebar'] ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( $page_datas['left_sidebar'] ); ?>
										</ul>
								<?php endif; ?>
							</div>
						</div><!-- end left sidebar -->		
					<?php wp_reset_query();?>
				<?php endif;?>	

					<div id="container-main" class="<?php echo $_main_class;?>">
						<div class="main-content">
							
							
							<?php if( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 ):?>
								<!--<h1 class="heading-title page-title"><?php //the_title();?></h1>-->
							<?php endif;?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-content-post">
									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wpdance' ), 'after' => '</div>' ) ); ?>
								</div><!-- .entry-content -->
								<footer class="entry-meta">
									<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="edit-link">', '</span>' ); ?>
								</footer><!-- .entry-meta -->
							</article><!-- #post -->					
						</div>
					</div><!-- end content -->
					
				<?php if( $_right_sidebar ): ?>
					<div id="right-sidebar" class="col-sm-6">
						<div class="right-sidebar-content">
						<?php
							if ( is_active_sidebar( $page_datas['right_sidebar'] ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( $page_datas['right_sidebar'] ); ?>
								</ul>
						<?php endif; ?>
						</div>
					</div><!-- end right sidebar -->
					<?php wp_reset_query();?>
				<?php endif;?>	
					
				</div>	
				
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>