<?php get_header(); ?>

<?php $has_sidebar = ss_framework_check_page_layout( $single_project = true ); ?>

<?php $page_title = ss_framework_get_custom_field( 'ss_page_title', of_get_option('ss_portfolio_parent') ) ? ss_framework_get_custom_field( 'ss_page_title', of_get_option('ss_portfolio_parent') ) : get_the_title( of_get_option('ss_portfolio_parent') ); ?>

<section id="content" class="clearfix <?php echo ss_framework_check_sidebar_position( $single_project = true ); ?>">

	<div class="container">

		<header class="page-header">

			<h1 class="page-title align-left"><?php echo $page_title; ?></h1>
			
			<a href="<?php echo get_permalink( of_get_option('ss_portfolio_parent') ); ?>" class="button no-bg medium align-right">
				<?php _e('All Projects', 'ss_framework'); ?> <img src="<?php echo SS_BASE_URL; ?>images/icon-grid.png" alt="" class="icon">
			</a>

			<hr />

			<h2 class="project-title"><?php the_title(); ?></h2>
			
			<?php 
				// Get links for next and previous project
				ob_start();

					next_post_link( '%link', '%title' );

					$next_post_link = ob_get_contents();
					$next_post_link = preg_match( '/(?<=href\=")[^"]+?(?=")/', $next_post_link, $next_post );

				ob_clean();

					previous_post_link( '%link', '%title' );

					$previous_post_link = ob_get_contents();
					$previous_post_link = preg_match( '/(?<=href\=")[^"]+?(?=")/', $previous_post_link, $prev_post );

				ob_end_clean();

			 ?>

			<ul class="portfolio-pagination">

				<?php if( isset( $next_post[0] ) ): ?>
					<li class="next"><a rel="next" href="<?php echo $next_post[0]; ?>" class="button medium no-bg"><span class="arrow left">&raquo;</span> <?php _e('Next', 'ss_framework'); ?></a></li>
				<?php endif; ?>

				<?php if( isset( $prev_post[0] ) ): ?>
					<li class="prev"><a rel="prev" href="<?php echo $prev_post[0]; ?>" class="button medium no-bg"><?php _e('Previous', 'ss_framework'); ?>  <span class="arrow">&raquo;</span></a></li>
				<?php endif; ?>

			</ul><!-- end .portfolio-pagination -->

		</header><!-- end .page-header -->

		<?php if( $has_sidebar ): ?>

			<section id="main">
				
				<?php echo ss_framework_single_project_slider( $post->ID ); ?>
		
			</section><!-- end #main -->

			<aside id="sidebar">

				<?php if ( have_posts() ) while ( have_posts() ): the_post(); ?>

					<?php the_content(); ?>
					
					<p><?php edit_post_link( __( 'Edit', 'ss_framework' ), '', '' ); ?></p>

				<?php endwhile; ?>
						
			</aside><!-- end #sidebar -->

		<?php endif; ?>

		<?php if( !$has_sidebar ): ?>
				
			<?php echo ss_framework_single_project_slider( $post->ID ); ?>

			<?php if ( have_posts() ) while ( have_posts() ): the_post(); ?>

				<?php the_content(); ?>
				
				<p><?php edit_post_link( __( 'Edit', 'ss_framework' ), '', '' ); ?></p>

			<?php endwhile; ?>
			
		<?php endif; ?>
		
	</div><!-- end .container -->

</section><!-- end #content -->

<?php get_footer(); ?>