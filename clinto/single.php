<?php get_header(); ?>

<?php get_template_part( 'partials/primary-nav' ); ?>

<section class="container">

	<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

		<?php if ( has_post_thumbnail() ) : // the current post has a thumbnail

			//Get the Thumbnail URL
			$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slides', false, '' ); ?>

			<div class="row-fluid">
				<div class="span12 header" style="background-image:url(<?php echo $src[0] ?>); ">
					<div class="diamond"><?php spritz_short_posted_on(); ?></div>
				</div>
			</div>

		<?php else: ?>
			<div class="row-fluid">
				<div class="span12 "></div>
			</div>
		<?php endif; ?>

		<div class="row-fluid">
			<div class="offset2 span8 entry">

				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_content' ); ?>>

					<?php echo bootstrapwp_breadcrumbs(); ?>
					<hr class="sexy_line">

					<!-- Post Title -->
					<h1 class="post-title"><?php the_title(); ?></h1>
					<!-- /Post Title -->
					
					<p class="lead center"><?php echo get_the_excerpt() ?></p>

					<div class="tags"><?php if (is_sticky()) { echo '<i class="icon-pushpin sticky" title="Sticky"></i> ';}?><?php the_tags( '' );?></div>
					
					<?php if ( ot_get_option( 'author_box', true ) ) : ?>

						<div class="author-box">
							
							<hr class="sexy_line"/>

							<?php $popover = esc_attr( sprintf('<h2 class="vcard">%s<small>%s</small></h2>', get_the_author_meta( 'display_name' ), __( 'the author', 'spritz' ) ) ); ?>

							<a class="author-avatar " rel="author" href="<?php echo get_the_author_meta( 'user_url' ) ? get_the_author_meta( 'user_url' ) : '#' ?>"  data-placement="top" data-html="true" data-content="<?php echo $popover; ?>" data-trigger="hover"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?></a>

						</div>

					<?php endif; ?>

					<?php the_content(); // Dynamic Content ?>



					<?php comments_template( '', true ); // Remove if you don't want comments ?>

				</article>
				<!-- /Article -->

			</div>

		</div>

	<?php endwhile;  else: ?>

		<div class="row-fluid">
			<div class="offset2 span8 entry">
			
				<!-- Article -->
				<article>
					<h1><?php _e( 'Sorry, nothing to display.', 'spritz' ); ?></h1>
					<p><?php _e( 'You are looking for an empty page. We are sorry for the inconvenience.', 'spritz' ); ?></p>
					<p><a href="/"><?php _e( 'Return to home', 'spritz' ); ?></a></p>
				</article>
				<!-- /Article -->

			</div>

		</div>

	<?php endif; ?>

</section>

<?php get_footer(); ?>