<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */

 get_header();


	if ( have_posts() )
		the_post();
		
		if (is_tax(TB_GALLERY_TAX)) {
			st_before_content('sixteen');
		} else {
			st_before_content($columns='');
		}
		
?>

			<h1 <?php if (is_tax(TB_GALLERY_TAX)) echo 'class="tb-gallery-margin"'; ?>>
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: %s', 'grace' ), get_the_date() ); ?>
				<?php $archive = 'archive'; ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: %s', 'grace' ), get_the_date('F Y') ); ?>
				<?php $archive = 'archive'; ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: %s', 'grace' ), get_the_date('Y') ); ?>
				<?php $archive = 'archive'; ?>
<?php elseif ( is_post_type_archive(TB_PRIEST_CPT) ) : ?>
				<?php echo __( 'Priests', 'grace' ); ?>
				<?php $archive = 'priests'; ?>
<?php elseif ( is_post_type_archive(TB_CHURCH_CPT) ) : ?>
				<?php echo __( 'Churches', 'grace' ); ?>
				<?php $archive = 'churches'; ?>
<?php elseif ( is_post_type_archive(TB_EVENT_CPT) ) : ?>
				<?php echo __( 'Events', 'grace' ); ?>
				<?php $archive = 'events'; ?>
<?php elseif ( is_tax(TB_EVENT_TAX) ) : ?>
				<?php single_term_title(); ?>
				<?php $archive = 'event_categories'; ?>
<?php elseif ( is_post_type_archive(TB_SERMON_CPT) ) : ?>
				<?php echo __( 'Sermons', 'grace' ); ?>
				<?php $archive = 'sermons'; ?>
<?php elseif ( is_tax(TB_SERMON_TAX_TOPIC) || is_tax(TB_SERMON_TAX_SCRIPTURE) || is_tax(TB_SERMON_TAX_OCCASION) ) : ?>
				<?php single_term_title(); ?>
				<?php $archive = 'sermons'; ?>
<?php elseif ( is_post_type_archive(TB_GALLERY_CPT) ) : ?>
				<?php echo __( 'Galleries', 'grace' ); ?>
				<?php $archive = 'galleries'; ?>
<?php elseif ( is_tax(TB_GALLERY_TAX) ) : ?>
				<?php single_term_title(); ?>
				<?php $archive = 'galleries'; ?>
<?php else : ?>
				<?php echo __( 'Blog Archives', 'grace' ); ?>
				<?php $archive = 'archive'; ?>
<?php endif; ?>
			</h1>

<?php

	rewind_posts();
	
	get_template_part( 'loop', $archive );
	st_after_content();

	if ($archive != 'galleries') {
		get_sidebar();
	}
	
	get_footer();
?>