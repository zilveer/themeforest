<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<h1 class="page-header"><?php the_title(); ?></h1>

		<div class="row">
			<div class="col-sm-4">
				<div class="agency-header">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="agency-thumbnail">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</div>
					<?php endif; ?>

					<div class="agency-overview">
						<dl>
							<?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
							<?php if ( ! empty ( $email ) ) : ?>
								<dt class="email"><i class="pp pp-normal-mail"></i></dt>
								<dd>
									<a href="<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a>
								</dd>
							<?php endif; ?>

							<?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>
							<?php if ( ! empty ( $email ) ) : ?>
								<dt class="web"><i class="pp pp-normal-globe"></i></dt>
								<dd>
									<a href="<?php echo esc_attr( $web ); ?>"><?php echo esc_attr( $web ); ?></a>
								</dd>
							<?php endif; ?>

							<?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
							<?php if ( ! empty ( $email ) ) : ?>
								<dt class="phone"><i class="pp pp-normal-mobile-phone"></i></dt><dd><?php echo esc_attr( $phone ); ?></dd>
							<?php endif; ?>

							<?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>
							<?php if ( ! empty ( $address ) ) : ?>
								<dt class="address"><i class="pp pp-normal-pointer-pin"></i></dt><dd><?php echo wp_kses( nl2br($address), wp_kses_allowed_html( 'post' ) ); ?></dd>
							<?php endif; ?>
						</dl>
					</div><!-- /.agency-overview -->
				</div><!-- /.agency-header -->
			</div>

			<div class="col-sm-8">
				<?php the_content(); ?>
			</div>
		</div>
		<!-- Agency's location -->
		<?php $location = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'location', true ); ?>

		<?php if ( ! empty( $location ) && count( $location ) == 2) : ?>
			<h2 class="section-title"><?php echo __( 'Location', 'realia' ); ?></h2>

			<!-- MAP -->
			<div class="map-position">
				<div id="simple-map"
					 data-transparent-marker-image="<?php echo get_template_directory_uri(); ?>/assets/img/transparent-marker-image.png"
				     data-latitude="<?php echo esc_attr( $location['latitude'] ); ?>"
				     data-longitude="<?php echo esc_attr( $location['longitude'] ); ?>">
				</div><!-- /#map-property -->
			</div><!-- /.map-property -->
		<?php endif; ?>

		<!-- Agency's agents -->
		<?php Realia_Query::loop_agency_agents( get_the_ID(), -1 ); ?>

		<?php if ( have_posts() ) : ?>
			<h2 class="section-title"><?php echo __( 'Agents', 'realia' ); ?></h2>

			<div class="agency-agents type-box item-per-row-3">
				<div class="agents-row">
					<?php $index = 0; ?>
					<?php while( have_posts() ) : the_post(); ?>
						<div class="agents-container">
							<?php include Realia_Template_Loader::locate( 'agents/box' ); ?>
						</div>

						<?php if ( ( $index + 1 ) % 3 == 0 && 3 != 1 && Realia_Query::loop_has_next() ) : ?>
							</div><div class="agents-row">
						<?php endif; ?>

						<?php $index++; ?>
					<?php endwhile; ?>
				</div>
			</div><!-- /.agency-agents -->
		<?php endif;?>

		<?php wp_reset_query(); ?>

		<?php if ( comments_open() || get_comments_number() ): ?>
			<?php comments_template( '', true ); ?>
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
