<?php
/**
 * After content wrap
 * Used in all templates
 */
?>
<?php
$container = apply_filters('kleo_main_container_class','container');
?>

			<?php
			/**
			 * After main content - action
			 */
			do_action('kleo_after_main_content');
			?>

			</div><!--end .content-wrap-->
		</div><!--end .main-->

		<?php
		/**
		 * After main content - action
		 */
		do_action('kleo_after_content');
		?>

	</div><!--end #main-container-->
</div>
<!--END MAIN SECTION-->