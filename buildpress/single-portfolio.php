<?php
/**
 * Single post page
 *
 * @package BuildPress
 */

get_header();

get_template_part( 'part-main-title' );
get_template_part( 'part-breadcrumbs' );

?>
<div class="master-container">
	<div class="container">
		<div class="row">
			<main class="col-xs-12" role="main">

				<?php
					while ( have_posts() ) :
						the_post();
				?>

				<article <?php post_class( 'post-inner' ); ?>>
				<?php if ( 'generic-title' === get_theme_mod( 'projects_title_mode', 'generic-title' ) ) : ?>
					<h2 class="hentry__title"><?php echo get_the_title(); ?></h1>
				<?php endif; ?>

					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="project__meta-data">
								<?php
									$project_meta_fields = array(
										'construction_date' => array(
											'icon'  => 'fa-calendar',
											'label' => __( 'Construction Date', 'buildpress_wp' ),
										),
										'location' => array(
											'icon'  => 'fa-map-marker',
											'label' => __( 'Location', 'buildpress_wp' ),
										),
										'surface_area' => array(
											'icon'  => 'fa-arrows-alt',
											'label' => __( 'Surface Area', 'buildpress_wp' ),
										),
										'contracting_investor' => array(
											'icon'  => 'fa-user',
											'label' => __( 'Contracting Investor', 'buildpress_wp' ),
										),
										'value' => array(
											'icon'  => 'fa-usd',
											'label' => __( 'Value', 'buildpress_wp' ),
										),
									);

									if ( get_field( 'category' ) ) {
										$project_meta_fields[ 'category' ] = array(
											'icon'  => 'fa-th-list',
											'label' => __( 'Category', 'buildpress_wp' ),
											'value' => implode( ', ', buildpress_get_custom_categories( get_the_ID(), 'portfolio_category' ) ),
										);
									}

									foreach ( $project_meta_fields as $field => $data ) {
										if ( array_key_exists( 'value', $data ) && trim( $data['value'] ) ) {
											// leave as it is, but this has to be here
										}
										else if ( trim( get_field( $field ) ) ) {
											$project_meta_fields[$field]['value'] = trim( get_field( $field ) );
										}
										else {
											unset( $project_meta_fields[$field] );
										}
									}

									// add additional fields
									while ( have_rows( 'additional_fields' ) ) {
										the_row();
										$project_meta_fields[] = array(
											'icon'  => get_sub_field( 'icon', null ),
											'label' => get_sub_field( 'name' ),
											'value' => get_sub_field( 'value' ),
										);
									}
								?>
								<ul class="list-unstyled">
								<?php
									foreach ( $project_meta_fields as $data ) {
										if ( isset( $data['icon'] ) && ! empty( $data['icon'] ) ) {
											printf( '<li><span class="project__meta-icon"><i class="fa  %1$s"></i></span> %2$s: <strong>%3$s</strong></li>', $data['icon'], $data['label'], $data['value'] );
										}
										else {
											printf( '<li>%1$s: <strong>%2$s</strong></li>', $data['label'], $data['value'] );
										}
									}
								?>
								</ul>
							</div>
							<div class="hentry__content  project__content">
								<?php the_content(); ?>
							</div>
							<nav class="project__navigation  visible-md  visible-lg">
								<ul class="list-unstyled">
									<li>
										<?php buildpress_get_next_prev_project_link( true, '<i class="fa fa-caret-left"></i> ' . get_theme_mod( 'prev_project_btn', 'Previous Project' ) ); ?>
									</li><li>
										<?php buildpress_get_next_prev_project_link( false, get_theme_mod( 'next_project_btn', 'Next Project' ) . ' <i class="fa fa-caret-right"></i>' ); ?>
									</li>
								</ul>
							</nav>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="project__gallery">
							<?php
								$gallery = '';
								while ( have_rows( 'project_gallery' ) ) {
									the_row();

									$image = get_sub_field( 'project_image' );

									$gallery .= wp_get_attachment_link( absint( $image ), 'project-gallery' );
								}
								echo strip_tags( apply_filters( 'the_content', $gallery ), '<a><img>' );
							?>
							</div>
							<nav class="project__navigation  hidden-md  hidden-lg">
								<ul class="list-unstyled">
									<li>
										<?php buildpress_get_next_prev_project_link( true, '<i class="fa fa-caret-left"></i> ' . get_theme_mod( 'prev_project_btn', 'Previous Project' ) ); ?>
									</li><li>
										<?php buildpress_get_next_prev_project_link( false, get_theme_mod( 'next_project_btn', 'Next Project' ) . ' <i class="fa fa-caret-right"></i>' ); ?>
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<?php if ( strlen( get_the_title() ) < 1 ) : ?>
						<a href="<?php the_permalink(); ?>"><?php _e( 'Link to this post' , 'buildpress_wp'); ?></a>
					<?php endif; ?>
					<div class="clearfix"></div>
				</article>

				<?php
					endwhile;
				?>
			</main>

		</div>
	</div>
</div>

<?php get_footer(); ?>