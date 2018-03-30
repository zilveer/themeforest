<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php $gallery = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'gallery', true ); ?>
    <?php if ( ! empty( $gallery ) && is_array( $gallery ) ) : ?>
        <div class="property-detail-section" id="property-detail-section-gallery">

            <div class="property-detail-gallery-wrapper">

                <div class="property-detail-gallery-labels">
                    <?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>
                    <?php $is_featured = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
                    <?php $is_reduced = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>

                    <?php if ( $is_featured && $is_reduced ) : ?>
                        <span class="property-badge"><?php echo __( 'Featured', 'realia' ); ?> / <?php echo __( 'Reduced', 'realia' ); ?></span>
                    <?php elseif ( $is_featured ) : ?>
                        <span class="property-badge"><?php echo __( 'Featured', 'realia' ); ?></span>
                    <?php elseif ( $is_reduced ) : ?>
                        <span class="property-badge"><?php echo __( 'Reduced', 'realia' ); ?></span>
                    <?php endif; ?>

                    <?php if ( $is_sticky ) : ?>
                        <span class="property-badge property-badge-sticky"><?php echo __( 'TOP', 'realia' ); ?></span>
                    <?php endif; ?>
                </div>

                <div class="property-detail-gallery">

                    <?php $index = 0; ?>
                    <?php foreach ( $gallery as $id => $src ) : ?>
                        <?php $img = wp_get_attachment_image_src( $id, 'large' ); ?>
                        <?php $src = $img[0]; ?>
                        <a href="<?php echo esc_url( $src ); ?>" rel="property-gallery" data-item-id="<?php echo esc_attr( $index++ ); ?>">
                            <span class="item-image" data-background-image="<?php echo esc_url( $src ); ?>"></span><!-- /.item-image -->
                        </a>
                    <?php endforeach; ?>
                </div><!-- /.property-detail-gallery -->

                <div class="property-detail-gallery-preview" data-count="<?php echo count( $gallery ) ?>">
                    <div class="property-detail-gallery-preview-inner">
                        <?php $index = 0; ?>
                        <?php foreach ( $gallery as $id => $src ) : ?>
                            <div data-item-id="<?php echo esc_attr( $index++ ); ?>">
                                <?php $img = wp_get_attachment_image_src( $id, 'thumbnail' ); ?>
                                <?php $img_src = $img[0]; ?>
                                <img src="<?php echo $img_src; ?>" alt="">
                            </div>
                        <?php endforeach; ?>
                    </div><!-- /.property-detail-gallery-preview-inner -->
                </div><!-- /.property-detail-gallery-preview -->
            </div><!-- /.property-detail-gallery-wrapper -->
        </div><!-- /.property-detail-section -->
    <?php endif; ?>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title property-title">', '</h1>' );
		else :
			the_title( sprintf( '<h2 class="entry-title property-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="property-content">
			<div class="property-overview">
                <h2><?php echo __( 'Property Overview', 'realia' ); ?></h2>
				<ul>
					<?php $price = Realia_Price::get_property_price(); ?>
					<?php if ( ! empty( $price ) ) : ?>
						<li><span><?php echo __( 'Price', 'realia' )?></span> <strong><?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?></strong></strong></li>
					<?php endif; ?>

					<?php $id = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'id', true ); ?>
					<?php if ( ! empty( $id ) ) : ?>
						<li><span><?php echo __( 'ID', 'realia' ); ?></span><strong><?php echo esc_attr( $id ); ?></strong></li>
					<?php endif; ?>

					<?php $year_built = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'year_built', true ); ?>
					<?php if ( ! empty( $year_built ) ) : ?>
						<li><span><?php echo __( 'Year built', 'realia' ); ?></span><strong><?php echo esc_attr( $year_built ); ?></strong></li>
					<?php endif; ?>

					<?php $type = Realia_Query::get_property_type_name(); ?>
					<?php if ( ! empty( $type ) ) : ?>
						<li><span><?php echo __( 'Type', 'realia' ); ?></span><strong><?php echo esc_attr( $type ); ?></strong></li>
					<?php endif; ?>

					<?php $sold = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sold', true ); ?>
					<li><span><?php echo __( 'Sold', 'realia' ); ?></span><strong>
						<?php if ( ! empty( $sold ) ) : ?>
							<?php echo __( 'Yes', 'realia' ); ?>
						<?php else : ?>
							<?php echo __( 'No', 'realia' ); ?>
						<?php endif; ?>
					</strong></li>

					<?php $contract = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'contract', true ); ?>

					<?php if ( ! empty( $contract ) ) : ?>
						<li>
                            <span><?php echo __( 'Contract', 'realia' ); ?></span>
                            <strong>
    							<?php if ( REALIA_CONTRACT_RENT == $contract ) : ?>
    								<?php echo __( 'Rent', 'realia' ); ?>
    							<?php elseif ( REALIA_CONTRACT_SALE == $contract ) : ?>
    								<?php echo __( 'Sale', 'realia' ); ?>
    							<?php endif; ?>
						    </strong>
                        </li>
					<?php endif; ?>

					<?php $status = Realia_Query::get_property_status_name(); ?>
					<?php if ( ! empty( $status ) ) : ?>
						<li><span><?php echo __( 'Status', 'realia' ); ?></span><strong><?php echo esc_attr( $status ); ?></strong></li>
					<?php endif; ?>

	                <?php $location = Realia_Query::get_property_location_name(); ?>
					<?php if ( ! empty( $location ) ) : ?>
						<li><span><?php echo __( 'Location', 'realia' ); ?></span><strong><?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?></strong></li>
					<?php endif; ?>

					<?php $home_area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
					<?php if ( ! empty( $home_area ) ) : ?>
						<li><span><?php echo __( 'Home area', 'realia' ); ?></span><strong><?php echo esc_attr( $home_area ); ?>
							<?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></strong></li>
					<?php endif; ?>

					<?php $lot_dimensions = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'lot_dimensions', true ); ?>
					<?php if ( ! empty( $lot_dimensions ) ) : ?>
						<li><span><?php echo __( 'Lot dimensions', 'realia' ); ?></span><strong><?php echo esc_attr( $lot_dimensions ); ?>
							<?php echo get_theme_mod( 'realia_measurement_distance_unit', 'ft' ); ?></strong></li>
					<?php endif; ?>

					<?php $lot_area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'lot_area', true ); ?>
					<?php if ( ! empty( $lot_area ) ) : ?>
						<li><span><?php echo __( 'Lot area', 'realia' ); ?></span><strong><?php echo esc_attr( $lot_area ); ?>
							<?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?></strong></li>
					<?php endif; ?>

	                <?php $material = Realia_Query::get_property_material_name(); ?>
	                <?php if ( ! empty( $material ) ) : ?>
	                    <li><span><?php echo __( 'Material', 'realia' ); ?></span><strong><?php echo wp_kses( $material, wp_kses_allowed_html( 'post' ) ); ?></strong></li>
	                <?php endif; ?>

	                <?php $rooms = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true ); ?>
	                <?php if ( ! empty( $rooms ) ) : ?>
	                    <li><span><?php echo __( 'Rooms', 'realia' ); ?></span><strong><?php echo esc_attr( $rooms ); ?></strong></li>
	                <?php endif; ?>

					<?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
					<?php if ( ! empty( $beds ) ) : ?>
						<li><span><?php echo __( 'Beds', 'realia' ); ?></span><strong><?php echo esc_attr( $beds ); ?></strong></li>
					<?php endif; ?>

	                <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
	                <?php if ( ! empty( $baths ) ) : ?>
	                    <li><span><?php echo __( 'Baths', 'realia' ); ?></span><strong><?php echo esc_attr( $baths ); ?></strong></li>
	                <?php endif; ?>

					<?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>
					<?php if ( ! empty( $garages ) ) : ?>
						<li><span><?php echo __( 'Garages', 'realia' ); ?></span><strong><?php echo esc_attr( $garages ); ?></strong></li>
					<?php endif; ?>
				</ul>
			</div><!-- /.property-overview -->

			<div class="property-description">
                <h2><?php echo __( 'Description', 'realia' ); ?></h2>

				<?php the_content( sprintf( __( 'Continue reading %s', 'realia' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) ); ?>
			</div><!-- /.property-description -->

	        <?php $amenities = get_categories( array(
				'taxonomy' 		=> 'amenities',
				'hide_empty' 	=> false,
			) ); ?>

	        <?php $hide = get_theme_mod( 'realia_general_hide_unassigned_amenities', false ); ?>
	        <?php if ( ! empty( $amenities ) ) : ?>
	            <div class="property-amenities">
                    <h2><?php echo __( 'Amenities', 'realia' ); ?></h2>

	                <ul>
	                    <?php foreach ( $amenities as $amenity ) : ?>
	                        <?php $has_term = has_term( $amenity->term_id, 'amenities' ); ?>

	                        <?php if ( ! $hide || ( $hide  && $has_term ) ) : ?>
	                            <li <?php if ( $has_term ) : ?>class="yes"<?php else : ?>class="no"<?php endif; ?>><?php echo esc_html( $amenity->name ); ?></strong></li>
	                        <?php endif; ?>
	                    <?php endforeach; ?>
	                </ul>
	            </div><!-- /.property-amenities -->
	        <?php endif; ?>

			<!-- FLOOR PLANS -->
			<?php $images = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'plans', true ); ?>

			<?php if ( ! empty( $images ) ) : ?>
				<div class="property-floor-plans">
                    <h2><?php echo __( 'Floor Plans', 'realia' ); ?></h2>

					<?php foreach ( $images as $id => $url ) : ?>
		                <a href="<?php echo esc_url( $url ); ?>" rel="property-plans">
		                    <?php echo wp_get_attachment_image( $id, 'thumbnail' ); ?>
		                </a>
	                <?php endforeach; ?>
				</div><!-- /.property-floor-plans -->
			<?php endif; ?>

			<!-- VIDEO -->
			<?php $video = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'video', true ); ?>
			<?php if ( ! empty( $video ) ) : ?>
				<h2 class='section-title'><?php echo __( 'Video', 'properta' ); ?></h2>
				<div class="property-video">
					<div class="video-embed-wrapper">
						<?php echo apply_filters( 'the_content', '[embed width="1280" height="720"]' . esc_attr( $video ) . '[/embed]' ); ?>
					</div>
				</div>
			<?php endif; ?>

	        <!-- VALUATION -->
            <?php $valuation = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'valuation_group', true ); ?>

			<?php if ( ! empty( $valuation ) && is_array( $valuation ) ) : ?>
			    <div class="property-valuation">
                    <h2><?php echo __( 'Land Valuation', 'realia' ); ?></h2>

			        <?php foreach ( $valuation as $group ) : ?>
			            <div class="property-valuation-item">
			                <dt><?php echo esc_attr( $group[ REALIA_PROPERTY_PREFIX . 'valuation_key' ] ); ?></dt>
			                <dd>
			                    <div class="bar-valuation"
			                         style="width: <?php echo esc_attr( $group[ REALIA_PROPERTY_PREFIX . 'valuation_value' ] ); ?>%"
			                         data-percentage="<?php echo esc_attr( $group[ REALIA_PROPERTY_PREFIX . 'valuation_value' ] ); ?>">
			                    </div>
			                </dd>
			                <span class="percentage-valuation"><?php echo esc_attr( $group[ REALIA_PROPERTY_PREFIX . 'valuation_value' ] ); ?> %</span>
			            </div><!-- /.property-valuation-item -->
			        <?php endforeach; ?>
			    </div><!-- /.property-valuation -->
			<?php endif; ?>

	        <!-- PUBLIC FACILITIES -->
	        <?php $facilities = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'public_facilities_group', true ); ?>

	        <?php if ( ! empty( $facilities ) && is_array( $facilities ) ) : ?>
	            <div class="property-public-facilities">
                    <h2><?php echo __( 'Public Facilities', 'realia' ); ?></h2>

	                <?php foreach ( $facilities as $facility ) : ?>
	                    <div class="property-public-facility-wrapper">
	                        <div class="property-public-facility">
	                            <div class="property-public-facility-title">
	                                <span><?php echo esc_attr( $facility[ REALIA_PROPERTY_PREFIX . 'public_facilities_key' ] ); ?></span>
	                            </div><!-- /.property-public-facility-title -->

	                            <div class="property-public-facility-info">
	                                <?php echo esc_attr( $facility[ REALIA_PROPERTY_PREFIX . 'public_facilities_value' ] ); ?>
	                            </div><!-- /.property-public-facility-info -->
	                        </div><!-- /.property-public-facility -->
	                    </div><!-- /.property-public-facility-wrapper -->
	                <?php endforeach; ?>
	            </div><!-- /.property-public-facilities -->
	        <?php endif; ?>

	        <!-- MAP LOCATION -->
	        <?php $map_location = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'map_location', true ); ?>

	        <?php if ( ! empty( $map_location ) && 2 == count( $map_location ) ) : ?>
	            <!-- MAP -->
	            <div class="property-map-position">
                    <h2><?php echo __( 'Location', 'realia' ); ?></h2>

	                <div class="map" id="simple-map" style="height: 300px"
	                     data-latitude="<?php echo esc_attr( $map_location['latitude'] ); ?>"
	                     data-longitude="<?php echo esc_attr( $map_location['longitude'] ); ?>"
	                     data-zoom="15"
	                    >
	                </div><!-- /.map -->
	            </div><!-- /.map-position -->
	        <?php endif; ?>
		</div><!-- /.property-content -->

		<!-- SUBPROPERTIES -->
		<?php $post = get_post(); ?>
		<?php $author_id = $post->post_author; ?>
		<?php $subproperties = Realia_Post_Type_Property::get_properties( $author_id, "publish", get_the_ID() ); ?>

		<?php if ( is_array( $subproperties ) && ! empty( $subproperties ) ) : ?>
			<div class="subproperties">
				<h2><?php echo __( 'Subproperties', 'realia' ); ?></h2>

				<div class="row">
					<?php foreach ( $subproperties as $subproperty ): ?>
						<div class="col-md-4 col-sm-6">
							<div class="property-box-wrapper">
								<?php echo Realia_Template_Loader::load( 'properties/box', array( 'property' => $subproperty ) ); ?>
							</div>
						</div><!-- /.col-sm-4 -->
					<?php endforeach; ?>
				</div><!-- /.row -->
			</div><!-- /.subproperties -->
		<?php endif?>

        <!-- SIMILAR PROPERTIES -->
        <?php Realia_Query::loop_properties_similar(); ?>

        <?php if ( have_posts() ) : ?>
            <div class="similar-properties">
                <h2><?php echo __( 'Similar properties', 'realia' ); ?></h2>

	            <div class="type-box item-per-row-3">
		            <div class="properties-row">
			            <?php $index = 0; ?>
		                <?php while ( have_posts() ) : the_post(); ?>
		                    <div class="property-container">
		                        <?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
		                    </div>

			                <?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
		                        </div><div class="properties-row">
			                <?php endif; ?>
			                <?php $index++; ?>
		                <?php endwhile; ?>
		            </div>
	            </div>
            </div><!-- /.similar-properties -->

        <?php endif?>

        <?php wp_reset_query(); ?>

        <?php wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'realia' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'realia' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <?php comments_template( '', true ); ?>
        <?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
