<?php

//init variables
$id 				= get_the_ID();
$portfolio_template = 'small-images';

//is portfolio template set for current portfolio?
if(get_post_meta(get_the_ID(), "edgt_choose-portfolio-single-view", true) != "") {
	$portfolio_template = get_post_meta(get_the_ID(), "edgt_choose-portfolio-single-view", true);
} elseif($edgt_options['portfolio_style'] !== '') {
	//get default portfolio template if set in theme's options
	$portfolio_template = $edgt_options['portfolio_style'];
}
?>

<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php if(get_post_meta($id, "edgt_page_scroll_amount_for_sticky", true)) { ?>
				<script>
				var page_scroll_amount_for_sticky = <?php echo esc_attr(get_post_meta($id, "edgt_page_scroll_amount_for_sticky", true)); ?>;
				</script>
			<?php } ?>

			<?php get_template_part( 'title' ); ?>
			<?php get_template_part('slider'); ?>

			<?php

			//is current portfolio template full width?
			if($portfolio_template !== 'full-width-custom') {
				//load general portfolio structure which will load proper template
				get_template_part('templates/portfolio/portfolio-structure');
			} else {
				//load custom full width template that doesn't have anything in common with other
				get_template_part('templates/portfolio/portfolio', $portfolio_template);
			}
			?>
		<?php endwhile; ?>
	<?php endif; ?>	
<?php get_footer(); ?>	