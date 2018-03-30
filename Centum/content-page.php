
<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Centum
 */
?>
<!--  Page Title -->

	<!-- 960 Container Start -->
	<div class="container page-title-container">
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
	<?php

	$sidebar_side = get_post_meta($post->ID, 'incr_sidebar_layout', true); ?>
	
<!-- Blog Posts
	================================================== -->
	<?php if($sidebar_side != 'full-width') { 
		if($sidebar_side == "left-sidebar") { $sbclass = "left-sb"; } else { $sbclass = ''; } ?>
	<div <?php post_class('post twelve columns tooltips '.$sbclass); ?>  id="post-<?php the_ID(); ?>" >
	<?php } else {  ?>
		<div <?php post_class('post sixteen columns tooltips'); ?> id="post-<?php the_ID(); ?>" >
	<?php } ?>
		<?php while (have_posts()) : the_post(); ?>
		<!-- Post -->
		
			<?php the_content() ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'centum' ),
					'after'  => '</div>',
				) );
			?>
			<footer class="entry-footer">
				<?php edit_post_link( __( 'Edit', 'centum' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-footer -->
		
		<!-- Post -->
	<?php endwhile; // End the loop. Whew.  ?>
	<?php
	if(ot_get_option('centum_page_comments','on') == 'off') {
		if ( comments_open() || '0' != get_comments_number() ) { comments_template('', true); }
	}
	?>
	</div> <!-- eof eleven column -->


