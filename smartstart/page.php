<?php get_header(); ?>

<?php $has_sidebar = ss_framework_check_page_layout(); ?>

<?php $page_title = ss_framework_get_custom_field('ss_page_title') ? ss_framework_get_custom_field('ss_page_title') : get_the_title(); ?>

<section id="content" class="clearfix <?php echo ss_framework_check_sidebar_position(); ?>">

	<div class="container">

		<?php if ( !is_front_page() && ss_framework_get_custom_field('ss_disable_page_header') != '1' ): ?>

			<header class="page-header clearfix">

				<h1 class="page-title"><?php echo $page_title ?></h1>

				<?php if( ss_framework_get_custom_field('ss_page_description') ): ?>

					<hr />

					<h2 class="page-description"><?php echo ss_framework_get_custom_field('ss_page_description'); ?></h2>

				<?php endif; ?>

				<?php if( ss_framework_get_custom_field('ss_page_subdescription') ): ?>

					<hr />

					<h2 class="page-subdescription"><?php echo ss_framework_get_custom_field('ss_page_subdescription'); ?></h2>

				<?php endif; ?>

				<?php do_action('ss_framework_portfolio_filter'); ?>

			</header><!-- end .page-header -->

		<?php endif; ?>
		

		<?php if( $has_sidebar ): ?>

			<section id="main">

		<?php endif; ?>
		

		<?php if (have_posts()) while ( have_posts() ): the_post(); ?>

			<?php the_content(); ?>
			
			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'ss_framework' ), 'after' => '' ) ); ?>
			
			<p><?php edit_post_link( __( 'Edit', 'ss_framework' ), '', '' ); ?></p>

		<?php endwhile; ?>
		

		<?php if( $has_sidebar ): ?>

			</section><!-- end #main -->

			<?php get_sidebar(); ?>

		<?php endif; ?>
		
	</div><!-- end .container -->
	
</section><!-- end #content -->

<?php get_footer(); ?>