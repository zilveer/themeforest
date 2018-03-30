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
		<?php
			if( !(bbp_is_single_user_profile() || bbp_get_user_replies_created()) ){
				global $smof_data, $post;
				if( isset($smof_data['wd_forum_layout']) ){
					$_layout_config = explode("-",$smof_data['wd_forum_layout']);
				}else{
					$_layout_config = array(1,1,0);
				}
				$_left_sidebar = (int)$_layout_config[0];
				$_right_sidebar = (int)$_layout_config[2];
				$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );					
			}
			else{
				$_left_sidebar = 0;
				$_right_sidebar = 0;
				$_main_class = "col-sm-24";					
			}
			
			$has_breadcrumb = true;
			$has_page_title = true;
			if( $has_breadcrumb || $has_page_title ){
				global $smof_data;
				$style = '';
				if( isset($smof_data['wd_bg_breadcrumbs']) && $smof_data['wd_bg_breadcrumbs'] != '' )
					$style = 'style="background: url('.$smof_data['wd_bg_breadcrumbs'].')"';
				echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.$style.'>';
					if( $has_page_title )
						echo '<h1 class="heading-title page-title">'.get_the_title().'</h1>';
					if( $has_breadcrumb )
						wd_bbpress_show_breadcrumbs();
				echo '</div></div>';
			}
		?>
		
		<div id="container" class="page-template forum-template <?php wd_page_layout_class(); ?>">
			<div id="content" class="container" role="main">
			
				<div id="main">
					
				<?php if( $_left_sidebar ): ?>
						<div id="left-sidebar" class="col-sm-6 hidden-xs">
							<div class="left-sidebar-content">
								<?php if ( is_active_sidebar( 'forum-widget-area-left' ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( 'forum-widget-area-left' ); ?>
										</ul>
								<?php endif; ?>
							</div>
						</div><!-- end left sidebar -->		
					<?php wp_reset_query();?>
				<?php endif;?>	
					
					
					<div id="container-main" class="<?php echo $_main_class;?>">
						<div class="main-content">
							
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
						<?php if ( is_active_sidebar( 'forum-widget-area-right' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'forum-widget-area-right' ); ?>
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