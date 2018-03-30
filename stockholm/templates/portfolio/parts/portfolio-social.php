<?php
global $qode_options;

//check social share style
$social_type = 'circle';
if(isset($qode_options['portfolio_social_share_type'])  && $qode_options['portfolio_social_share_type'] != "") {
	$social_type = $qode_options['portfolio_social_share_type'];
}
?>

<?php if(isset($qode_options['enable_social_share'])  && $qode_options['enable_social_share'] == "yes") { ?>
	<div class="portfolio_social_holder">
		<?php echo do_shortcode('[social_share_list list_type=' . $social_type . ']'); ?>
	</div> <!-- close div.portfolio_social_holder -->
<?php } ?>