<?php

/**
 * Portfolio loop template
 *
 * @package wpv
 * @subpackage health-center
 */

global $wp_query;

$li_style = '';

$main_id = uniqid();

if($scrollable)
	echo '<div class="scrollable-wrapper">';
?>

<section class="portfolios <?php if(!empty($sortable)) echo $engine ?> <?php echo $scrollable ? 'scroll-x' : 'normal row' ?> title-<?php echo $title ?> <?php echo $desc ? 'has-description' : 'no-description' ?> <?php if(!empty($class)) echo $class; ?>" id="<?php echo $main_id ?>">
	<?php
		if(!empty($sortable)) include locate_template('templates/portfolio/loop/sortable-header.php');
	?>
	<ul class="clearfix <?php echo $sortable ?> portfolio-items" data-columns="<?php echo $column ?>">
		<?php
			while(have_posts()): the_post();
				include locate_template('templates/portfolio/loop/item.php');
			endwhile;
		?>
	</ul>
	<?php if ($nopaging == 'false')	WpvTemplates::pagination($paging_preference); ?>
</section>
<?php if($scrollable) echo '</div>' ?>
