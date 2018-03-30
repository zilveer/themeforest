<?php

/**

 * The Sidebar containing the primary and secondary widget areas.

 *

 * @package WordPress

 * @subpackage wpbootstrap

 * @since wpbootstrap 0.1

 */

?>

<ul class="unstyled sidebar">

<?php

	/* When we call the dynamic_sidebar() function, it'll spit out

	 * the widgets for that widget area. If it instead returns false,

	 * then the sidebar simply doesn't exist, so we'll hard-code in

	 * some default sidebar stuff just in case.

	 */


?>
	



			<li>

				<h3><?php _e( 'Archives', 'homeshop' ); ?></h3>

				<p>

					<ul>

						<?php wp_get_archives( 'type=monthly' ); ?>

				</ul>

				</p>

			</li>



			<li>

				<h3><?php _e( 'Meta', 'homeshop' ); ?></h3>

				<p>

					<ul>

					<?php wp_register(); ?>

					<li><?php wp_loginout(); ?></li>

					<?php wp_meta(); ?>

				</ul>

				</p>

			</li>



	



</ul>

