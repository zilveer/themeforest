<?php get_header(); ?>
	
<?php
	$options = get_option('sf_pinpoint_options');
	$page_layout = $options['page_layout'];
	if (isset($_GET['layout'])) {
		$page_layout = $_GET['layout'];
	}
	
	$show_page_title = get_post_meta($post->ID, 'sf_page_title', true);
	$show_portfolio_filtering = get_post_meta($post->ID, 'sf_portfolio_filtering', true);
	$show_rss_icon = get_post_meta($post->ID, 'sf_rss_icon', true);
	$rss_feed_url = $options['rss_feed_url'];
	$top_spacing = get_post_meta($post->ID, 'sf_top_spacing', true);
	$spacing = "";
	if ($top_spacing) {
	$spacing = "top-spacing";
	} else {
	$spacing = "";
	}
	$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = strtolower(get_post_meta($post->ID, 'sf_left_sidebar', true));
	$right_sidebar = strtolower(get_post_meta($post->ID, 'sf_right_sidebar', true));
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar';
	} elseif ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar';
	} elseif ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
?>

<?php if ( !post_password_required() ) { ?>

<?php if ($show_page_title) { ?>	
	<?php if (($show_portfolio_filtering) || ($show_rss_icon)) { ?>
	<div class="page-heading with-filtering full-width clearfix">
	<?php } else { ?>
	<div class="page-heading full-width clearfix">
	<?php } ?>
		<?php if ($page_layout == "fullwidth") { ?>
		<div class="container">
		<div class="sixteen columns">
		<?php } ?>
		
		<h1><?php the_title(); ?></h1>
		<?php if ($show_portfolio_filtering) { ?>
		<div class="heading-controls">
			<div class="filter-wrap">
				<a href="#" class="select"><?php _e("Filter", "swiftframework");?></a>
				<ul id="portfolio-filter" class="filtering clearfix">
				<li class="all selected"><a data-filter="*" href="#"><?php _e("All", "swiftframework"); ?></a></li>
				<?php
					$tax_terms = get_category_list('portfolio-category', 1);
					foreach ($tax_terms as $tax_term) {
						$term_slug = strtolower(str_replace(' ', '-', $tax_term));
						echo '<li class=""><a href="#" title="View all ' . $tax_term . ' items" class="' . $term_slug . '" data-filter=".' . $term_slug . '">' . $tax_term . '</a></li>';
					}
				?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<?php if ($show_rss_icon) { ?>
		<a href="<?php echo $rss_feed_url; ?>" class="heading-rss-icon"><i class="icon-rss"></i></a>
		<?php } ?>
		
		<?php if ($page_layout == "fullwidth") { ?>
		</div>
		</div>
		<?php } ?>
	</div>
<?php } ?>

<?php if ($page_layout == "fullwidth") { ?>
<div class="container">
<div class="sixteen columns">
<?php } ?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
	<?php if (have_posts()) : the_post(); ?>

	<!-- OPEN article -->
	<?php if ($sidebar_config == "left-sidebar") { ?>
	<div <?php post_class('clearfix eleven columns omega '. $spacing); ?> id="<?php the_ID(); ?>">
	<?php } elseif ($sidebar_config == "right-sidebar") { ?>
	<div <?php post_class('clearfix eleven columns alpha '. $spacing); ?> id="<?php the_ID(); ?>">
	<?php } else { ?>
	<div <?php post_class('clearfix '. $spacing); ?> id="<?php the_ID(); ?>">
	<?php } ?>
	
		<?php if ($sidebar_config == "both-sidebars") { ?>
			
			<div class="page-content eight columns omega clearfix">
			
				<?php the_content(); ?>
				
			</div>
				
			<aside class="sidebar left-sidebar four columns alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
		
		<?php } else { ?>
		
		<div class="page-content clearfix">

			<?php the_content(); ?>
			
		</div>
		
		<?php } ?>	
	
	<!-- CLOSE article -->
	</div>

	<?php endif; ?>
	
	<?php if ($sidebar_config == "left-sidebar") { ?>
		
		<aside class="sidebar left-sidebar five columns alpha">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>

	<?php } else if ($sidebar_config == "right-sidebar") { ?>
		
		<aside class="sidebar right-sidebar five columns omega">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
		
	<?php } else if ($sidebar_config == "both-sidebars") { ?>

		
		<aside class="sidebar right-sidebar four columns omega">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
	
	<?php } ?>

</div>

<?php if ($page_layout == "fullwidth") { ?>
</div>
</div>
<?php } ?>

<?php } else { ?>

<?php if ($page_layout == "fullwidth") { ?>
<div class="container">
<div class="sixteen columns">
<?php } ?>
<div class="inner-page-wrap clearfix">

	<div id="password-protected">
		<form method="post" action="<?php echo home_url(); ?>/wp-login.php?action=postpass">
		<h1><i class="icon-lock"></i><?php _e("Protected", "swiftframework"); ?></h1>
		<p><?php _e("This page is password protected. Please enter the password below to view the page:", "swiftframework"); ?></p>
		<input type="password" size="20" id="password-box" name="post_password"/></label><br/>
		<input id="password-submit" class="sf-button accent roundedarrow" type="submit" value="Submit" name="Submit"/></p>
		</form>
	</div>
	
</div>

<?php if ($page_layout == "fullwidth") { ?>
</div>
</div>
<?php } ?>

<?php } ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>