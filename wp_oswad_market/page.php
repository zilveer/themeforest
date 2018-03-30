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
 * @subpackage Oswad Market
 * @since WD_Responsive
 */	
get_header(); 
?>
		<div class="slideshow-wrapper main-slideshow <?php wd_page_layout_class(); ?>">
			<div class="slideshow-sub-wrapper">
				<?php
					global $page_datas, $post;
					show_page_slider();
					$_layout_config = explode("-",$page_datas['page_column']);
					$_left_sidebar = (int)$_layout_config[0];
					$_right_sidebar = (int)$_layout_config[2];
					$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );			
				?>
			</div>
		</div>
		<?php do_action('wd_after_main_slideshow'); ?>
		
		<?php
		global $smof_data;
		$has_breadcrumb = (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0);
		$has_page_title = ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 );
		if( $has_breadcrumb || $has_page_title ){
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
		
		
		<div id="container" class="page-template default-template <?php wd_page_layout_class(); ?>">
			<div id="content" class="container" role="main">
			
				<div id="main">
					
				<?php if( $_left_sidebar ): ?>
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
							
							<?php
                            $_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
                            if( in_array( "woocommerce/woocommerce.php", $_actived ) ){
                                wc_print_notices();
                            }
                            ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-content-post">
									<?php 
									if( have_posts() ):
										the_post();
										the_content(); 
									endif;
									?>
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