
<?php
/**
 * Single post template
 *
 * @package wpv
 * @subpackage health-center
 */

if(!wpv_is_reduced_response()):
	get_header();
endif;

?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php if(!wpv_is_reduced_response()): ?>
	<div class="row page-wrapper">
<?php endif; //reduced ?>
		<?php WpvTemplates::left_sidebar() ?>

		<article <?php post_class('single-post-wrapper '.WpvTemplates::get_layout())?>>
			<?php
				global $wpv_has_header_sidebars;
				if( $wpv_has_header_sidebars)
					WpvTemplates::header_sidebars();
			?>
			<div class="page-content loop-wrapper clearfix full">
				<?php get_template_part('templates/post'); ?>
				<div class="clearboth">
					<?php comments_template(); ?>
				</div>
			</div>
		</article>

		<?php WpvTemplates::right_sidebar() ?>

		<?php if(wpv_get_optionb('show-related-posts') && is_singular('post')): ?>
			<?php
				$terms = array();
				$cats = get_the_category();
				foreach($cats as $cat) {
					$terms[] = $cat->term_id;
				}
			?>
			<div class="clearfix related-posts">
				<div class="grid-1-1">
					<?php echo apply_filters( 'wpv_related_posts_title', '<h2 class="related-content-title">'.wpv_get_option('related-posts-title').'</h3>' ) ?>
					<?php
						echo WPV_Blog::shortcode(array(
							'count' => 8,
							'column' => 4,
							'cat' => $terms,
							'layout' => 'scroll-x',
							'show_content' => true,
							'post__not_in' => get_the_ID(),
						));
					?>
				</div>
			</div>
		<?php endif ?>
<?php if(!wpv_is_reduced_response()): ?>
	</div>
<?php endif;
endwhile;

if(!wpv_is_reduced_response()) {
	get_footer();
} else {
	wpv_reduced_footer();
}
