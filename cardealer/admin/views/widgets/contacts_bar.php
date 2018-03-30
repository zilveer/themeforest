<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct access allowed' );
} ?>
<div class="widget widget_contacts">

	<?php if ( ! empty( $instance['title'] ) ): ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php endif; ?>

	<ul class="contacts-list">

		<?php if ( ! empty( $instance['address'] ) ): ?>
			<li class="icon-warehouse">
				<?php echo $instance['address']; ?>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $instance['fax'] ) OR ! empty( $instance['phone'] ) ): ?>
			<li class="icon-phone">
				<?php echo $instance['phone']; ?>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $instance['fax'] ) ): ?>
			<li class="icon-print-3">
				<?php echo $instance['fax']; ?>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $instance['email'] ) ): ?>
			<li class="icon-email">
				<a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $instance['twitter'] ) || ! empty( $instance['facebook'] ) || ! empty( $instance['show_rss'] ) ): ?>

			<li>
				<ul class="social-icons">
					<?php if ( ! empty( $instance['twitter'] ) ) : ?>
						<li class="twitter">

                            <a target="_blank" title="twitter" href="http://twitter.com/<?php echo $instance['twitter']; ?>">
                                <i class="icon-twitter-3"></i>
                            </a>
						</li>
					<?php endif; ?>

					<?php if ( ! empty( $instance['facebook'] ) ) : ?>
						<li class="facebook">
                            <a target="_blank" title="facebook" href="http://facebook.com/<?php echo $instance['facebook']; ?>">
                                <i class="icon-facebook"></i>
                            </a>
						</li>
					<?php endif; ?>

					<?php if ( $instance['show_rss'] ) : ?>
						<li class="rss">
                            <a title="rss" href="<?php bloginfo( 'rss2_url' ); ?>">
                                <i class="icon-rss"></i>
                            </a>
                        </li>
					<?php endif; ?>
				</ul>
				<!--/ .social-icons-->
			</li>

		<?php endif; ?>

	</ul>
	<!--/ .contacts-list-->

</div><!--/ .widget-->