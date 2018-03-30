<?php get_header(); ?>

<?php if( have_posts() ) { ?>

	<header class="page-header">
		<?php if( is_object( $wp_query->queried_object ) ) { ?>
			<?php if ( get_the_title( get_option( 'page_for_posts' ) ) ) { ?>
				<h1 class="page-title"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h1>
			<?php } ?>
			<?php if ( $page_description = get_post_meta( $wp_query->queried_object_id, 'flow_post_description', true ) ) { ?>
				<div class="page-description"><?php echo $page_description; ?></div>
			<?php } ?>
		<?php } ?>
	</header>

	<div class="site-content clearfix">
		<div class="content-area" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
	
	<?php flow_paging_nav(); ?>
	
<?php } else { ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php } ?>
	
<?php get_footer(); ?>