<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */

$thb_page_id = get_the_ID();
$meta = thb_get_post_meta_all($thb_page_id);
extract($meta);

get_header(); ?>

<div class="wrapper">


	<?php thb_post_before(); ?>

		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php thb_post_start(); ?>

			<?php thb_get_template_part('part_single_head', array( 'meta' => $meta	) ); ?>

			<?php if( get_the_content() != '' ) : ?>
				<div class="thb-text">
					<?php the_content(); ?>
					<?php
						wp_link_pages(array(
							'pagelink' => '<span>%</span>',
							'before'   => '<div id="page-links"><p><span class="pages">'. __('Pages', 'thb_text_domain').'</span>',
							'after'    => '</p></div>'
						));
					?>
				</div>
			<?php endif; ?>

			<aside class="meta details">
				<p>
					<?php
						$tags = get_the_tags();
						$category = get_the_category();
					?>

					<?php if( !empty($category) ) : ?>
						<?php _e('Filed under', 'thb_text_domain'); ?> <?php the_category(', '); ?>.
					<?php endif; ?>
					<?php if( !empty($tags) ) : ?>
						<?php _e('Tagged', 'thb_text_domain'); ?> <?php the_tags('', ', '); ?>.
					<?php endif; ?>
				</p>
			</aside>

			<aside class="meta author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 ); ?>

				<h1><?php _e('The author', 'thb_text_domain'); ?></h1>
				<h2><?php the_author_posts_link(); ?></h2>

				<?php
					$author_description = get_the_author_meta('user_description');
					if( !empty($author_description) ) :
				?>
					<div class="thb-text">
						<?php echo thb_text_format($author_description, true); ?>
					</div>
				<?php endif; ?>
			</aside>

			<?php thb_pagination( array( 'type' => 'links' ) ); ?>

			<?php if( thb_show_comments() || thb_show_related() ) : ?>
				<section class="secondary">
				<?php if( thb_show_comments() ) : ?>
					<?php thb_comments( array('title_reply' => __('Leave a reply', 'thb_text_domain') )); ?>
				<?php endif; ?>

				<?php if( thb_show_related() ) : ?>
					<section class="related">
						<h3><?php _e('Related posts', 'thb_text_domain'); ?></h3>
						<?php thb_related(); ?>
					</section>
				<?php endif; ?>
				</section>
			<?php endif; ?>

			<?php thb_post_end(); ?>
		<?php endwhile; endif; ?>

	<?php thb_post_after(); ?>
</div>

<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
	<div class="thb-main-sidebar">
		<div class="thb-main-sidebar-wrapper">
			<?php thb_page_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>