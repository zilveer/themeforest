<?php
/**
 * Staff staff meta
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get meta sections
$sections = wpex_staff_single_meta_sections();

// Make sure the meta should display
if ( ! empty( $sections ) ) : ?>

	<ul id="staff-single-meta" class="meta wpex-clr">

		<?php
		// Loop through meta sections
		foreach ( $sections as $section ) : ?>

			<?php if ( 'date' == $section ) : ?>

				<li class="meta-date"><span class="fa fa-clock-o" aria-hidden="true"></span><time class="updated" datetime="<?php the_date('Y-m-d');?>"<?php wpex_schema_markup( 'publish_date' ); ?>><?php echo get_the_date(); ?></time></li>

			<?php elseif ( 'author' == $section ) : ?>

				<li class="meta-author"><span class="fa fa-user" aria-hidden="true"></span><span class="vcard author"<?php wpex_schema_markup( 'author_name' ); ?>><?php the_author_posts_link(); ?></span></li>

			<?php elseif ( 'categories' == $section && $categories = wpex_get_list_post_terms( 'staff_category' ) ) : ?>

				<li class="meta-category"><span class="fa fa-folder-o" aria-hidden="true"></span><?php echo $categories; ?></li>

			<?php elseif ( 'comments' == $section && comments_open() && ! post_password_required() ): ?>

				<li class="meta-comments comment-scroll"><span class="fa fa-comment-o" aria-hidden="true"></span><?php comments_popup_link( esc_html__( '0 Comments', 'total' ), esc_html__( '1 Comment',  'total' ), esc_html__( '% Comments', 'total' ), 'comments-link' ); ?></li>
			
			<?php else : ?>

				<li class="meta-<?php echo esc_html( $section ); ?>"><?php get_template_part( 'partials/meta/'. $section ); ?></li>

			<?php endif; ?>

		<?php endforeach; ?>

	</ul><!-- #staff-single-meta -->

<?php endif; ?>