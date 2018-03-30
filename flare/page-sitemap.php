<?php
/**
 * Template Name: Page: Sitemap
 *
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>
	<?php the_post(); ?>
	<?php get_template_part( 'precontent' ); ?>
	
	<div id="content" class="<?php echo btp_content_get_class(); ?>">
		<div id="content-inner">
			<?php if ( btp_elements_get( 'breadcrumbs' ) ): ?>
				<?php btp_breadcrumbs_render( btp_breadcrumbs_get() ); ?>
			<?php endif; ?>			
			<article id="post-<?php the_ID(); ?>" <?php post_class( ); ?>>
				<div class="entry-content">
					<div class="grid">
						<div class="c-one-fourth">
							<h2><?php _e( 'Pages', 'btp_theme' ); ?></h2>
			    			<ul>
								<?php wp_list_pages( 'title_li=' ); ?>
							</ul>
						</div>
						<div class="c-one-fourth">
							<h2><?php _e( 'Site Feeds', 'btp_theme' ); ?></h2>  
						    <ul>  
						        <li><a href="feed:<?php bloginfo( 'rss2_url' ); ?>"><?php _e( 'Main RSS Feed', 'btp_theme' ); ?></a></li>  
						        <li><a href="feed:<?php bloginfo( 'comments_rss2_url' ); ?>"><?php _e( 'Comment RSS Feed', 'btp_theme' ); ?></a></li>  
						    </ul>
						</div>
					</div><!-- .grid -->
					
					<?php echo do_shortcode( '[divider_top]' ); ?>
					
					<?php if ( get_option( 'page_for_posts') ): ?>
						<h2><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></a></h2>
					<?php else: ?>
						<h2><?php _e( 'Blog', 'btp_theme' ); ?></h2>
					<?php endif; ?>
					
					<div class="grid">
						<div class="c-one-fourth">
							<h3><?php _e( 'Latest 20 Posts', 'btp_theme' ); ?></h3>
							<ul>
			    				<?php wp_get_archives( 'type=postbypost&limit=20' ); ?>
			    			</ul>										
						</div>
						<div class="c-one-fourth">
							<h3><?php _e( 'Category Archives', 'btp_theme' ); ?></h3>
							<ul>
								<?php wp_list_categories( 'title_li=' ); ?>
							</ul>	
						</div>
						<div class="c-one-fourth">
							<h3><?php _e( 'Tag Archives', 'btp_theme' ); ?></h3>
							<?php wp_tag_cloud(); ?>
						</div>
						<div class="c-one-fourth">
							<h3><?php _e( 'Monthly Archives', 'btp_theme' ); ?></h3>
							<ul>
								<?php wp_get_archives(); ?>
							</ul>	
						</div>
					</div><!-- .grid -->
					
					<?php if ( post_type_exists( 'btp_work' ) ): ?>	
						<?php echo do_shortcode( '[divider_top]' ); ?>						
						<h2><a href="<?php echo get_post_type_archive_link( 'btp_work' ); ?>"><?php _e( 'Works', 'btp_theme' ); ?></a></h2>
						
						<div class="grid">							
							<div class="c-one-fourth">
								<h3><?php _e( 'Latest 20 Works', 'btp_theme' ); ?></h3>
								<ul>
									<?php
										add_filter( 'getarchives_where' , 'btp_work_get_archives_where_filter' , 10 , 2 );
										wp_get_archives( 'type=postbypost&limit=20' );
										remove_filter('getarchives_where' , 'btp_work_get_archives_where_filter' , 10 );
									?>
				    			</ul>	
							</div>
							<?php if( taxonomy_exists( 'btp_work_category' ) ): ?>
								<div class="c-one-fourth">
									<h3><?php _e( 'Category Archives', 'btp_theme' ); ?></h3>
									<ul>
										<?php wp_list_categories( 'title_li=&taxonomy=btp_work_category' ); ?>
									</ul>	
								</div>
							<?php endif; ?>
							<?php if( taxonomy_exists( 'btp_work_tag' ) ): ?>	
								<div class="c-one-fourth">
									<h3><?php _e( 'Tag Archives', 'btp_theme' ); ?></h3>
									<?php wp_tag_cloud( 'taxonomy=btp_work_tag' ); ?>
								</div>
							<?php endif; ?>
						</div><!-- .grid -->
					<?php endif; ?>	
					
					<div class="entry-utility">		
						<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
					
				</div><!-- .entry-content -->
			</article>			
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->

<?php get_footer(); ?>