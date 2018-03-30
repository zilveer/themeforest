<?php get_header(); ?>

<?php $has_sidebar = ss_framework_check_page_layout(); ?>

<section id="content" class="clearfix <?php echo ss_framework_check_sidebar_position(); ?>">

	<div class="container">

		<header class="page-header">

			<h1 class="page-title"><?php _e( 'Well this is somewhat embarrassing, isn&rsquo;t it?', 'ss_framework' ); ?></h1>

		</header><!-- end .page-header -->
		
		<?php if( $has_sidebar ): ?>

			<section id="main">

		<?php endif; ?>
	
		<article id="post-0" class="post error404 not-found">
	
			<h3><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for...', 'ss_framework' ); ?></h3>

		</article><!-- end .hentry -->
		
		<?php if( $has_sidebar ): ?>

			</section><!-- end #main -->

			<?php get_sidebar(); ?>

		<?php endif; ?>
		
	</div><!-- end .container -->
	
</section><!-- end #content -->

<?php get_footer(); ?>