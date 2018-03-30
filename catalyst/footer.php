<?php
/*
* Catalyst Footer
*/

?>
</div>

<?php if ( of_get_option ('footer_widget_status') ) { ?>

<div id="footer-container" class="clearfix">
	<div id="footer">
		
		<?php if ( function_exists('dynamic_sidebar') ) { 
			echo '<div class="footer-column">';
			dynamic_sidebar("Footer Single Column 1");  } 
			echo '</div>';
		?>
		<?php if ( function_exists('dynamic_sidebar') ) { 
			echo '<div class="footer-column">';
			dynamic_sidebar("Footer Single Column 2");  } 
			echo '</div>';
		?>
		<?php if ( function_exists('dynamic_sidebar') ) { 
			echo '<div class="footer-double-column">';
			dynamic_sidebar("Footer Double Column");  } 
			echo '</div>';
		?>
		<?php if ( function_exists('dynamic_sidebar') ) { 
			echo '<div class="footer-column">';
			dynamic_sidebar("Footer Single Column 3");  } 
			echo '</div>';
		?>
		<?php if ( function_exists('dynamic_sidebar') ) { 
			echo '<div class="footer-column">';
			dynamic_sidebar("Footer Single Column 4");  } 
			echo '</div>';
		?>
	</div>	
</div>
<?php } ?>
<div id="copyright">
Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved
</div>
</div>
<?php
echo of_get_option ('footer_scripts' );
wp_footer();
?>
<?php
global $mtheme_twitter_username,$mtheme_twitter_feed_qty;
if($mtheme_twitter_username<>"") {
?>

<?php
}
?>
<?php if ( get_option('cufon_status'))  { ?>
<script type="text/javascript"> Cufon.now(); </script>
<?php } ?>
</body>
</html>
