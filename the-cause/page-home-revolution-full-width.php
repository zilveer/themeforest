<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Home - Revolution Full Width
*/

get_header('parallax-full');
?>
        
	<!-- Home -->
	<div id="home" class="noslider">
	
	<div class="left"><h2><?php echo get_option('tb_home_slogan', DEFAULT_HOME_SLOGAN); ?></h2></div>
	
	<?php
	$donatePageID = get_option('tb_page_donate');
	if ($donatePageID) {
	?>
	
	<div class="right">
		<?php $donateButtonText = get_option('tb_donate_button', DEFAULT_DONATE_BUTTON_TEXT); ?>
		<a href="<?php tb_write_link('tb_page_donate'); ?>" title="<?php echo $donateButtonText; ?>" class="bigButtonExtra roundButton right"><?php echo $donateButtonText; ?></a>
	</div>
	
	<?php } else {
	$donatePageURL = esc_url(get_option('tb_page_donate_external'));
	if ($donatePageURL) {
	?>
	
	<div class="right">
		<?php $donateButtonText = get_option('tb_donate_button', DEFAULT_DONATE_BUTTON_TEXT); ?>
		<a href="<?php echo $donatePageURL; ?>" title="<?php echo $donateButtonText; ?>" class="bigButtonExtra roundButton right"><?php echo $donateButtonText; ?></a>
	</div>
	
	<?php } } ?>
	
	<div class="clear"></div>
	
    </div>
    <!-- .Home -->
	
    <!-- INNER content -->
    <div id="innerHome"><div>
	
	<div id="sidebar">
	<?php dynamic_sidebar( 'Home' ); ?>
	</div>
	
	<div id="inner">
	
	<?php if ( is_active_sidebar(2) ) { ?>
	<div id="homeHighlights">
	<?php dynamic_sidebar( 'Highlights' ); ?>
	</div>
	<?php } ?>
	
	<?php
	$area1 = get_option('tb_home_area_1', 'latest');
	if ($area1 != 'none') {
		get_template_part('home', $area1);
	}
	
	?>
	
	<?php
	$area2 = get_option('tb_home_area_2', 'videos');
	if ($area2 != 'none') {
		get_template_part('home', $area2);
	}
	
	?>	
	
	<?php
	$area3 = get_option('tb_home_area_3', '');
	if ($area3 != 'none') {
		get_template_part('home', $area3);
	}
	
	?>	

	
	</div>

    </div></div>
	<!-- .INNER content -->

<?php
get_footer();
?>