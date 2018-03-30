<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

	get_header();
	global $allaround_data;
	if ( $allaround_data['sidebar-blog'] == 1 )  {$sidebar_class = '';} else {$sidebar_class = 'no-sidebar';}
?>
	<div class="clear"></div><!--clear -->	
	<?php allaround_breadcrumbs(); ?>
	<div class="content_wrapper <?php echo $sidebar_class; ?>">
		<div class="content">
			<?php
				echo do_shortcode('[aa_title themecolor="yes"]' . get_the_title() . '[/aa_title]');
				if( have_posts() ) { the_post();
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
			?>
			<div class="real_content">
				<div class="blog_content">
				<div class="blog_post blog_post_page<?php echo $has_thumbail; ?>">
					<div class="blog_post_wrapper">
						<h3><?php the_title(); ?></h3>

						<div class="blog_post_main_content">
							<div class="author_date_comments">
								<span class="author"><?php the_author_meta( 'nickname' ); ?></span>
								<span class="date"><?php the_date(); ?></span>
								<span class="comments"><?php comments_number( '0 ' . __('comments', 'allaround'), '1 ' . __('comment', 'allaround'), '% ' . __('comments', 'allaround') ); ?></span>
								</div><!-- author_date_comments -->
							<?php if ( has_post_thumbnail() ) : ?>
							<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large'); ?>	
							<a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto"><?php the_post_thumbnail('blog-full', array('class' => 'blog_post_image')); ?></a>
							<div class="date_bubble_holder">
								<div class="date customColorBg">
									<span><?php echo get_the_date('d'); ?><span><?php echo get_the_date('M'); ?></span></span></div><!-- date -->
								<div class="comments customColorBg">
									<a href="#"><?php echo get_comments_number(); ?></a></div><!-- comments -->
								</div><!-- date_bubble_holder -->
							<?php endif; ?>
							<?php if ( $allaround_data['blog-excerpt'] == 1 ) : ?>
								<span class="blog_post_text large"><?php echo get_the_excerpt(); ?></span>
							<?php endif; ?>
							<div class="blog_post_text">
								<?php the_content(); ?>
								<?php posts_nav_link(); ?>
								<div class="link-pages"><?php wp_link_pages(); ?></div>
								<div class="single-category"><?php _e('In Category : ', 'allaround'); the_category(', '); ?></div>
								<div class="single-tags"><?php the_tags('Tagged as : ', ', ', ''); ?></div>
							</div><!-- blog_post_text -->
							<?php if ( $allaround_data['blog-author'] == 1 ) : ?>
							<div class="about_the_author">
								<div class="about_the_author_image">
									<?php echo get_avatar(get_the_author_meta( 'email' ), 148); ?>
									</div><!-- about_the_author_image -->
								<div class="text_block">
									<span class="header_text"><?php _e('About The Author', 'allaround'); ?></span>
									<span class="name"><?php the_author_meta( 'nickname' ); ?></span>
									<span><?php the_author_meta( 'description' ); ?></span>
									</div><!-- text_block -->
									<div class="clear"></div><!-- clear -->
								</div><!-- about_the_author -->
							<?php endif; ?>
				</div></div></div></div>
			<div class="clear"></div><!--clear -->
			<?php if ( $allaround_data['blog-related'] == 1 ) echo do_shortcode('<div class="all_around_related">[aa_title]' . __('Related Posts', 'allaround') . '[/aa_title][aa_blog type="5" rows="1" category="' . implode(",",  wp_get_post_categories( get_the_ID() ) ) . '" order="rand" pagination="no" related="yes"]</div><div class="clear"></div>'); ?>
<div class="clear"></div><!--clear -->
			<?php comments_template(); ?>
			</div><!-- real_content -->
			<?php
				if ( $allaround_data['sidebar-blog'] !== 0 ) {
					echo '<!------- SIDEBAR ---------><div class="sidebar_wrapper margin-left48">';
					dynamic_sidebar( 'sidebar-blog' );
					echo '</div>';
				}
			?>
			<div class="clear"></div><!--clear -->
		<?php
			}
		?>
		</div><!-- content -->

	<div class="divider padding-top48"></div>	
	</div><!-- content_wrapper -->
<?php get_footer(); ?>