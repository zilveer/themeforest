<?php
/**
 * Main page page
 *
 * Template Name: Default Template (for Page Builder)
 *
 * @package BuildPress
 */

get_header();

get_template_part( 'part-main-title' );
get_template_part( 'part-breadcrumbs' );

?>
<div class="master-container">
	<div <?php post_class( 'container' ); ?> role="main">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
			?>

				<!-- Solve Microformats error -->
				<span class="hidden  entry-title"><?php the_title(); ?></span>
				<span class="hidden  vcard  author">
					<span class="fn"><?php the_author(); ?></span>
				</span>
				<time datetime="<?php the_time( 'c' ); ?>" class="hidden  published"><?php echo get_the_date(); ?></time>
				<time class="hidden  updated"><?php the_modified_date(); ?></time>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			<?php
			endwhile;
		endif;
		?>

	</div><!-- /container -->
</div>

<?php get_footer(); ?>