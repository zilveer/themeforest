			<?php 

						
			//reset wordpress query in case we modified it
			wp_reset_query();
			
			?>
			

		
		</div><!-- end wrap_all -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 
	avia_option('analytics', false, true, true);
	wp_footer();
?>

</body>
</html>