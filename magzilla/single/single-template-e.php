<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/11/15
 * Time: 2:02 PM
 */
global $ft_option;
global $single_sidebar_pos;
global $fave_sidebar;
global $fave_sticky_sidebar;
global $post_layout;
global $source_name;
global $source_url;
global $related_css;
global $fave_container;
global $css_classes;
global $css_classes_2;
global $related_css;
global $stick_sidebar;
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<main class="site-main wide-cover" role="main">
			<article class="post">
				<header class="entry-header">
					<h1 itemprop="headline" class="entry-title text-center"><?php the_title(); ?></h1>
					<?php get_template_part ('single/post', 'author-2'); ?>
					<?php if( isset( $ft_option['single_social_top'] ) && $ft_option['single_social_top'] != 0 ) { ?>
						<?php get_template_part ('single/post', 'sharing-buttons'); ?>
					<?php } ?>
				</header><!-- entry-header -->

				<div class="entry-content">
					<?php get_template_part('single/featured', 'image');?>
				</div>
			</article>
		</main>
	</div>
</div>

<div class="row">

	<div class="<?php echo esc_attr( $css_classes ); ?>">
		<main class="site-main" role="main">
			<article <?php post_class('post'); ?>>


				<div class="entry-content" itemprop="articleBody"><?php the_content(); ?></div><!-- entry-content -->

				<footer class="entry-footer">
					<?php get_template_part ('single/post', 'pagination'); ?>

					<?php if( isset( $ft_option['single_social_bottom'] ) && $ft_option['single_social_bottom'] != 0 ) { ?>
						<?php get_template_part ('single/post', 'sharing-buttons'); ?>
					<?php } ?>

					<?php echo fave_get_item_scope_meta(); ?>

				</footer><!-- entry-footer -->

				<?php if( isset( $ft_option['single_nav_arrows'] ) && $ft_option['single_nav_arrows'] != 0 ) { ?>
					<?php get_template_part('single/post', 'navigation'); ?>
				<?php } ?>

			</article>

			<?php if( isset( $ft_option['single_tags'] ) && $ft_option['single_tags'] != 0 ) { ?>
				<?php get_template_part('single/post', 'tags');  ?>
			<?php } ?>

			<?php if( isset( $ft_option['single_author'] ) && $ft_option['single_author'] != 0 ) { ?>
				<?php get_template_part('single/post', 'about-the-author'); ?>
			<?php } ?>


			<?php if( isset( $ft_option['single_related'] ) && $ft_option['single_related'] != 0 ) { ?>
				<?php get_template_part('single/related', 'posts'); ?>
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
		<div class="<?php echo esc_attr( $css_classes_2.' '.$stick_sidebar ); ?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
	<?php } ?>
</div><!-- .row -->