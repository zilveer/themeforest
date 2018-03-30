<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Kratong
 */
?>

	<br class="clear"/>
	<div id="footer">
		<div id="copyright">
				<?php
					/**
					 * Get footer text
					 */
	
					$pp_footer_text = get_option('pp_footer_text');
	
					if(empty($pp_footer_text))
					{
						$pp_footer_text = 'Copyright © 2010 <a href="http://themeforest.net/user/peerapong">Peerapong Pulpipatnan</a>. Remove this once after purchase from the ThemeForest.net';
					}
					
					echo stripslashes(html_entity_decode($pp_footer_text));
				?>
			</div>
	</div>
	
	</div>
	
<?php
		/**
    	*	Setup Google Analyric Code
    	**/
    	include (TEMPLATEPATH . "/google-analytic.php");
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
