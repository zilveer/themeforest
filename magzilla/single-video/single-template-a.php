<?php
global $ft_option;
global $post_layout;
global $source_name;
global $source_url;
global $related_css;
global $fave_container;
global $fave_sidebar;
global $stick_sidebar;
global $single_sidebar_pos;
global $post_layout;
global $css_classes;
global $css_classes_2;
?>

<div class="row">
		
	<div class="<?php echo $css_classes; ?>">
		<main class="site-main" role="main">
			<article <?php post_class('post'); ?>>
				<header class="entry-header">
					<h1 itemprop="headline" class="entry-title"><?php the_title(); ?></h1>
					<?php get_template_part ('single-video/post', 'author'); ?>
					
					<?php if( $ft_option['single_video_social_top'] != 0 ) { ?>
						<?php get_template_part ('single/post', 'sharing-buttons'); ?>
					<?php } ?>
				</header><!-- entry-header -->
				
				<div class="entry-content" itemprop="articleBody">
					
					<?php get_template_part('single-video/video');?>

					<?php the_content(); ?>
                    
				</div><!-- entry-content -->
				
				<footer class="entry-footer">
					
					<?php get_template_part ('single/post', 'pagination'); ?>

					<?php if( $ft_option['single_video_social_bottom'] != 0 ) { ?>
						<?php get_template_part ('single/post', 'sharing-buttons'); ?>
					<?php } ?>

				</footer><!-- entry-footer -->

				<?php if( $ft_option['single_video_nav_arrows'] != 0 ) { ?>
					<?php get_template_part('single-video/post', 'navigation'); ?>
				<?php } ?>

			</article>

			<?php if( $ft_option['single_video_tags'] != 0 ) { ?>
				<?php get_template_part('single-video/post', 'tags');  ?>
			<?php } ?>

			<?php if( $ft_option['video_single_author'] != 0 ) { ?>
				<?php get_template_part('single/post', 'about-the-author'); ?>
			<?php } ?>

			<?php if( $ft_option['video_single_related'] != 0 ) { ?>
				<?php get_template_part('single-video/related', 'posts'); ?>
			<?php } ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>

		</main>
	</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->

	<?php if( $single_sidebar_pos != "none" ) { ?>
	<div class="<?php echo $css_classes_2.' '.$stick_sidebar; ?>">
		<?php get_sidebar(); ?>
	</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
	<?php } ?>
</div><!-- .row -->