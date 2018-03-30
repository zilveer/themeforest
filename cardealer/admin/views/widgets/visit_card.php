<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct access allowed' );
} ?>
<div class="widget widget_contacts">

	<?php if ( ! empty( $instance['title'] ) ): ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php endif; ?>

	<ul class="our-contacts">

		<?php if ( ! empty( $instance['address'] ) ): ?>
			<li class="address">
				<b><?php _e( 'Address', 'cardealer' ) ?>:</b>

				<p><?php echo $instance['address']; ?></p>
			</li>
		<?php endif; ?>

		<li class="phone">
			<?php if ( ! empty( $instance['phone'] ) ): ?>
				<b><?php _e( 'Phone', 'cardealer' ) ?>:</b>&nbsp;<span><?php echo $instance['phone']; ?></span> <br/>
			<?php endif; ?>

			<?php if ( ! empty( $instance['fax'] ) ): ?>
				<b><?php _e( 'FAX', 'cardealer' ) ?>:</b>&nbsp;<span><?php echo $instance['fax']; ?></span> <br/>
			<?php endif; ?>

		</li>
		<li>
			<?php if ( ! empty( $instance['email'] ) ): ?>
				<b><?php _e( 'E-mail', 'cardealer' ) ?>: <a
						href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a></b>
			<?php endif; ?>
		</li>
		<li>
			<ul class="social-icons clearfix">
				<?php if ( ! empty( $instance['twitter'] ) ) : ?>
					<li class="twitter"><a target="_blank" title="twitter" href="<?php echo $instance['twitter']; ?>"><i class="icon-twitter-3"></i>Twitter</a>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $instance['facebook'] ) ) : ?>
					<li target="_blank" class="facebook"><a title="facebook"
					                                        href="<?php echo $instance['facebook']; ?>"><i class="icon-facebook"></i>Facebook</a>
					</li>
				<?php endif; ?>

				<?php if ( $instance['show_rss'] ) : ?>
					<li class="rss"><a title="rss" href="<?php bloginfo( 'rss2_url' ); ?>"><i class="icon-rss"></i>Rss</a></li>
				<?php endif; ?>

			</ul>
			<!--/ .social-icons-->
		</li>

	</ul>
	<!--/ .our-contacts-->

</div><!--/ .widget-->

