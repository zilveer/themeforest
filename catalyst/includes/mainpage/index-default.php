<?php 
if ( of_get_option ('section_a_status')) {
	include ( MTHEME_INCLUDES . "mainpage/three-steps.php" ); 
}
?>

<?php if ( of_get_option ('section_b_status') || of_get_option ('section_c_status') ) {	?>

	<div class="mainblock-2 clearfix">
	
		<?php
		if ( of_get_option ('section_b_status')) {
		?>
	
		<div class="main-message-wrap clearfix">
			<div class="main-message">
			<h2><?php echo of_get_option ('welcome_title'); ?></h2>
			<h3><?php echo of_get_option ('welcome_subtitle'); ?></h3>
			</div>
			<div class="main-button-wrap">
				<div class="main-button-text"><a href="<?php echo of_get_option ('button_link'); ?>"><?php echo stripslashes_deep( of_get_option ('button_text') ); ?></a></div>
			</div>
		</div>
		<?php
		}
		?>
		
		<?php
		if ( of_get_option ('section_c_status')) { 
			include ( MTHEME_INCLUDES . "mainpage/home-carousel.php" ); 
		}
		?>
	
	</div>

<?php }	?>
	
	<?php if ( of_get_option ('section_d_status') ) { ?>
	<div class="main-grid-block">
	<?php
	
		include ( MTHEME_INCLUDES . "mainpage/four-blocks.php" );
		include (MTHEME_INCLUDES . "mainpage/extra-blocks.php");
	?>
	</div>
	<?php } ?>
	

	<div class="clear"></div>

<?php if ( of_get_option ('section_e_status') ) { ?>
<div class="mainblock-4 clearfix">

	<ul id="quotes">
		<li>
			<div class="quotes-block">
				<blockquote><?php echo stripslashes_deep( of_get_option ('sf_quote') ); ?></blockquote>
			</div>
		</li>
	</ul> 
</div>
<?php 
} else {
echo '<div class="block-end"></div>';
}
?>