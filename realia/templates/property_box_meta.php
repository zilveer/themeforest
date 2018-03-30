<div class="property-box-meta">
    <?php $home_area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
    <?php if ( ! empty( $home_area ) ) : ?>
        <span class="property-box-meta-item property-box-meta-item-area">
            <i class="pp pp-normal-cursor-scale-up"></i> <?php echo esc_attr( $home_area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?>
        </span><!-- /.property-box-meta-item -->
    <?php endif; ?>

    <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
    <?php if ( ! empty( $beds ) ) : ?>
        <span class="property-box-meta-item property-box-meta-item-beds">
            <i class="pp pp-normal-bed"></i> <?php echo esc_attr( $beds ); ?>
        </span><!-- /.property-box-meta-item -->
    <?php endif; ?>

    <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
    <?php if ( ! empty( $baths ) ) : ?>
        <span class="property-box-meta-item property-box-meta-item-baths">
            <i class="pp pp-normal-shower"></i> <?php echo esc_attr( $baths ); ?>
        </span><!-- /.property-box-meta-item -->
    <?php endif; ?>
</div><!-- /.property-box-meta -->
