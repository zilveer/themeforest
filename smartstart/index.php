<?php get_header(); ?>

<?php $has_sidebar = ss_framework_check_page_layout(); ?>

<?php $page_title = ss_framework_get_custom_field( 'ss_page_title', get_option('page_for_posts') ) ? ss_framework_get_custom_field( 'ss_page_title', get_option('page_for_posts') ) : get_the_title( get_option('page_for_posts') ); ?>

<section id="content" class="clearfix <?php echo ss_framework_check_sidebar_position(); ?>">

	<div class="container">

		<header class="page-header">

			<h1 class="page-title"><?php echo $page_title ?></h1>

			<?php if( ss_framework_get_custom_field('ss_page_description') ): ?>

				<hr />

				<h2 class="page-description"><?php echo ss_framework_get_custom_field('ss_page_description'); ?></h2>

			<?php endif; ?>

			<?php if( ss_framework_get_custom_field('ss_page_subdescription') ): ?>

				<hr />

				<h2 class="page-subdescription"><?php echo ss_framework_get_custom_field('ss_page_subdescription'); ?></h2>

			<?php endif; ?>

		</header><!-- end .page-header -->
		
		<?php if( $has_sidebar ): ?>

			<section id="main">

		<?php endif; ?>
		
	
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

					<?php get_template_part( 'content', get_post_format() ); ?>

				</article><!-- end .hentry -->

			<?php endwhile; ?>

			<?php echo ss_framework_pagination(); ?>

		<?php else: ?>
		
			<article id="post-0" class="post no-results not-found">
		
				<h3><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for...', 'ss_framework' ); ?></h3>

			</article><!-- end .hentry -->

		<?php endif; ?>
		
		
		<?php if( $has_sidebar ): ?>

			</section><!-- end #main -->

			<?php get_sidebar(); ?>

		<?php endif; ?>
		
	</div><!-- end .container -->
	
</section><!-- end #content -->

<?php get_footer(); ?>