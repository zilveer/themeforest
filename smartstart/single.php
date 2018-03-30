<?php get_header(); ?>

<?php $has_sidebar = ss_framework_check_page_layout(); ?>

<?php $page_title = ss_framework_get_custom_field( 'ss_page_title', get_option('page_for_posts') ) ? ss_framework_get_custom_field( 'ss_page_title', get_option('page_for_posts') ) : get_the_title( get_option('page_for_posts') ); ?>

<section id="content" class="clearfix <?php echo ss_framework_check_sidebar_position(); ?>">

	<div class="container clearfix">

		<header class="page-header">

			<h1 class="page-title"><?php echo $page_title; ?></h1>

		</header><!-- end .page-header -->
		

		<?php if( $has_sidebar ): ?>

			<section id="main">

		<?php endif; ?>
		

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

				<?php get_template_part( 'content', get_post_format() ); ?>

			</article><!-- end .hentry -->
			
			<?php if ( comments_open() || '0' != get_comments_number() ) comments_template( '', true ); ?>

		<?php endwhile; ?>
		

		<?php if( $has_sidebar ): ?>

			</section><!-- end #main -->

			<?php get_sidebar(); ?>

		<?php endif; ?>
		
		
	</div><!-- end .container.clearfix -->
	
</section><!-- end #content -->

<?php get_footer(); ?>