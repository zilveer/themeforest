

<ul class="unstyled sidebar">

			<li>

				<h3><?php _e( 'Archives', 'candidate' ); ?></h3>

				<p>

					<ul>

						<?php wp_get_archives( 'type=monthly' ); ?>

				</ul>

				</p>

			</li>



			<li>

				<h3><?php _e( 'Meta', 'candidate' ); ?></h3>

				<p>

					<ul>

					<?php wp_register(); ?>

					<li><?php wp_loginout(); ?></li>

					<?php wp_meta(); ?>

				</ul>

				</p>

			</li>



	



</ul>

