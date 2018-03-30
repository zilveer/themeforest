<?php
global $theme_options;
?>
	

<?php if ( class_exists('RevSlider') ) { ?>
	<?php putRevSlider( $theme_options['rev_slider'] ); ?>
<?php } ?>