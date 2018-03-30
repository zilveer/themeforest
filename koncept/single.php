<?php
/**
 * The Template for displaying all single posts.
 */
get_header(); ?>

	<?php if ( have_posts() ) the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard clearfix' ); ?>>

		<div class="post-content clearfix">

			<header class="post-header">

				<h1><?php the_title(); ?></h1>
				<a href="<?php echo get_permalink(); ?>"><time class="post-time" datetime="<?php the_time( 'c' ); ?>"><?php the_time( __( 'jS \o\f F Y', 'krown' ) ); ?></time></a>

			</header>

			<section class="post-text">

				<?php 

					the_content();
					wp_link_pages( array(
						'before' => '<p class="wp-link-pages"><span>' . __( 'Pages:', 'krown' ) . '</span>'
						)
					);

					krown_share_buttons( $post->ID );

				?>

			</section>

			<?php if( comments_open() )
				comments_template( '', true ); ?>

		</div>

	</div>

	<nav class="post-nav">

		<?php 

		$prev_post = get_adjacent_post( false, '', false );
		$next_post = get_adjacent_post( false, '', true );

		if ( ! empty( $prev_post ) ) : ?>
			<a class="btn-prev" href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo krown_svg( 'arrow_left' ); ?></a>
		<?php else : ?>
			<a class="btn-prev" style="opacity: 0 !important"><?php echo krown_svg( 'arrow_left' ); ?></a>
		<?php endif; ?>

		<a class="btn-close" href="<?php echo get_permalink( get_option( 'krown_blog_page' ) ); ?>"><?php _e( 'Back to all posts', 'krown' ); echo krown_svg( 'close' ); ?></a>

		<?php if ( ! empty( $next_post ) ) : ?>
			<a class="btn-next" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo krown_svg( 'arrow_right' ); ?></a>
		<?php else : ?>
			<a class="btn-next" style="opacity: 0 !important"><?php echo krown_svg( 'arrow_right' ); ?></a>
		<?php endif; ?>

	</nav>

<?php get_footer(); ?>