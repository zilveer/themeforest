<?php
/* Template Name: Pagebuilder + page title */


get_header();


td_global::$current_template = 'page-title-sidebar';
//set the template id, used to get the template specific settings
$template_id = 'page';


$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)

//get theme panel variable for page comments side wide
$td_enable_or_disable_page_comments = td_util::get_option('tds_disable_comments_pages');


//read the custom single post settings - this setting overids all of them
$td_page = get_post_meta($post->ID, 'td_page', true);
if (!empty($td_page['td_sidebar_position'])) {
	$loop_sidebar_position = $td_page['td_sidebar_position'];
}


/**
 * detect the page builder
 */
$td_use_page_builder = td_global::is_page_builder_content();




if ($td_use_page_builder) {

	// the page is rendered using the page builder template (no sidebars)
	if (have_posts()) { ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<div class="td-container">
				<div class="td-container-border">
					<div class="td-page-header td-container">
						<div class="td-crumb-container">
							<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
						</div>
						<h1 class="entry-title td-page-title">
							<span><?php the_title() ?></span>
						</h1>
					</div>
					<?php the_content(); ?>
				</div>
			</div>
			<?php
			if($td_enable_or_disable_page_comments == 'show_comments') {
				?>
				<div class="td-container td-comment-section">
					<div class="td-container-border">
						<div class="td-pb-row">
							<div class="td-pb-span12">
								<?php comments_template('', true); ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		<?php endwhile; ?>
	<?php }
} else {

	//no page builder detected, we load a default page template with sidebar / no sidebar
	?>
	<div class="td-container">
		<div class="td-container-border">
			<div class="td-pb-row">
				<?php
				switch ($loop_sidebar_position) {
					default:
						?>
						<div class="td-pb-span8 td-main-content" role="main">
							<div class="td-ss-main-content">
								<?php
								if (have_posts()) {
								while ( have_posts() ) : the_post();
								?>
								<div class="td-page-header td-pb-padding-side">
									<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
									<h1 class="entry-title td-page-title">
										<span><?php the_title() ?></span>
									</h1>
								</div>
								<div class="td-pb-padding-side td-page-content">
									<?php
									the_content();
									endwhile;//end loop

									}
									?>
								</div>
								<?php
								if($td_enable_or_disable_page_comments == 'show_comments') {
									comments_template('', true);
								}?>
							</div>
						</div>
						<div class="td-pb-span4 td-main-sidebar" role="complementary">
							<div class="td-ss-main-sidebar">
								<?php get_sidebar(); ?>
							</div>
						</div>
						<?php
						break;

					case 'sidebar_left':
						?>
						<div class="td-pb-span8 td-main-content td-sidebar-left-content" role="main">
							<div class="td-ss-main-content">
								<?php

								if (have_posts()) {
								while ( have_posts() ) : the_post();
								?>
								<div class="td-page-header td-pb-padding-side">
									<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
									<h1 class="entry-title td-page-title">
										<span><?php the_title() ?></span>
									</h1>
								</div>
								<div class="td-pb-padding-side td-page-content">
									<?php
									the_content();
									endwhile; //end loop
									}
									?>
								</div>
								<?php
								if($td_enable_or_disable_page_comments == 'show_comments') {
									comments_template('', true);
								}?>
							</div>
						</div>
						<div class="td-pb-span4 td-main-sidebar" role="complementary">
							<div class="td-ss-main-sidebar">
								<?php get_sidebar(); ?>
							</div>
						</div>
						<?php
						break;

					case 'no_sidebar':
						?>
						<div class="td-pb-span12 td-main-content" role="main">

							<?php
							if (have_posts()) {
							while ( have_posts() ) : the_post();
							?>
							<div class="td-page-header td-pb-padding-side">
								<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
								<h1 class="entry-title td-page-title">
									<?php /*<a itemprop="url" href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title_attribute() ?>"><?php the_title() ?></a>*/?>
									<span><?php the_title() ?></span>
								</h1>
							</div>
							<div class="td-pb-padding-side td-page-content">
								<?php
								the_content();
								endwhile; //end loop
								}
								?>
							</div>
							<?php
							if($td_enable_or_disable_page_comments == 'show_comments') {
								comments_template('', true);
							}?>
						</div>
						<?php
						break;
				}
				?>
			</div> <!-- /.td-pb-row -->
		</div>
	</div> <!-- /.td-container -->

<?php
}




get_footer();