<?php

/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
   
get_header(); ?>

<?php get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content with-sb buddypress clearfix">

	<!-- If it is a buddypress member profile -->
	<?php if ( bp_displayed_user_id () ) { ?>

		<div class="cover">

			<div id="item-header" class="cover-image-container" role="complementary">
				<div class="item-list-tabs-bg">
					<?php bp_get_template_part( 'members/single/member-header' ) ?>
				</div>
			</div>

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul class="nav nav-pills">
						<?php bp_get_displayed_user_nav(); ?>
						<?php do_action( 'bp_member_options_nav' ); ?>
					</ul>
				</div>
			</div>

		</div>

	<!-- Not a member profile, but a group -->
	<?php } else if ( bp_is_group() ) {
	?>
	<?php if (bp_has_groups()) : while (bp_groups()) : bp_the_group(); ?>

		<div class="cover">

			<div id="item-header" class="cover-image-container" role="complementary">
				<div class="item-list-tabs-bg">
					<?php bp_get_template_part( 'groups/single/group-header' ) ?>
				</div>
			</div>

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul class="nav nav-pills">
						<?php bp_get_options_nav(); ?>
						<?php do_action( 'bp_group_options_nav' ); ?>
					</ul>
				</div>
			</div>

		</div>

	<?php endwhile; endif; } ?>

	<!-- Main -->
	<main class="main col-xs-12 col-sm-12 col-md-12 col-lg-8 col-bg-8" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<div <?php post_class(); ?> >

			<div class="post-wrap buddypress">

				<?php if ( ! ( bp_displayed_user_id () || bp_is_group() )  ) : ?>

					<header class="page-header buddypress">
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					</header>

					<div class="timeline"></div>

				<?php endif; ?>

				<?php the_content(); ?>
				
			</div>

		</div>
	<?php endwhile; ?>
	</main>

	<!-- Sidebar BuddyPress -->
	<?php if ( is_active_sidebar( 'sidebar-bp' ) ) : ?>

	<aside class="sidebar widget-area col-xs-12 col-sm-12 col-md-12 col-lg-4 col-bg-4" id="widget-area" role="complementary">

		<div class="masonry">
		     <?php if ( is_active_sidebar( 'sidebar-bp' ) ) : ?>
			        <?php dynamic_sidebar( 'sidebar-bp' ); ?>
		     <?php endif; ?>
		</div>

	</aside>

	<?php endif; ?>

</div>

<?php get_footer(); ?>
