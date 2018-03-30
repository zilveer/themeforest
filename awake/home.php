<?php
/**
 * Home Template
 *
 * @package Mysitemyway
 * @subpackage Template
 */

get_header(); 

$post_obj = $wp_query->get_queried_object();
?>

<?php if ( ( mysite_get_setting( 'frontpage_blog' ) ) || ( !empty( $post_obj->ID ) && get_option('page_for_posts') == $post_obj->ID ) ) : ?>
	<?php get_template_part( 'loop', 'index' ); ?>
	
<?php endif; ?>

<?php mysite_after_page_content(); ?>

		<div class="clearboth"></div>
	</div><!-- #main_inner -->
</div><!-- #main -->

<?php get_footer(); ?>