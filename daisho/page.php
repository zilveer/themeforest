<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
	
			<header class="page-header">
				<?php //if ( get_the_title() ) { ?>
					<h1 class="page-title"><?php the_title(); ?></h1>
				<?php //} ?>
				<?php if ( ( $page_description = get_post_meta( $post->ID, 'flow_post_description', true ) ) && ! post_password_required() ) { ?>
					<div class="page-description"><?php echo $page_description; ?></div>
				<?php } ?>
			</header>
			
			<div class="site-content clearfix" role="main">
				<div class="content-area">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content' ); ?>>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'flowthemes' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</article>
				</div>
				<?php get_sidebar(); ?>
			</div>
			
		<?php comments_template(); ?>
		
	<?php endwhile; ?>
	
<?php get_footer(); ?>