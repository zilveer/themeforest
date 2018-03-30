<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage centum
 * @since centum 1.0
 */
?>

<?php while (have_posts()) : the_post(); ?>
	<!--  Page Title -->

	<!-- 960 Container Start -->
	<div class="container">
		<div class="sixteen columns">
			<div id="page-title">
				<?php $bredcrumbs = ot_get_option('centum_breadcrumbs'); ?>
				<h1 <?php if($bredcrumbs == 'yes') echo 'class="has-breadcrumbs"';?>>
					<?php the_title(); ?>
					<?php $subtitle  = get_post_meta($post->ID, 'incr_subtitle', true);
					if ( $subtitle) {
						echo ' <span>/ '.$subtitle.'</span>';
					} ?>
				</h1>
				<?php if(ot_get_option('centum_breadcrumbs') == 'yes') echo dimox_breadcrumbs() ;?>
				<div id="bolded-line"></div>
			</div>
		</div>
	</div>
	<!-- 960 Container End -->

	<!-- Page Title End -->

	<!-- 960 Container -->
	<div class="container">

		<!-- Post -->

		<div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" >
			<div class="sixteen columns">
				<?php the_content() ?>
			</div>
		</div>
	<?php
	if(ot_get_option('centum_page_comments','on') == 'off') {
		if ( comments_open() || '0' != get_comments_number() ) {
			echo '<div class="sixteen columns">';
				comments_template('', true);
			echo '</div>';
		}
	} ?>
		<!-- Post -->
	<?php endwhile; // End the loop. Whew.  ?>




