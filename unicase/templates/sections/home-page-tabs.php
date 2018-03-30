<?php
/**
 * Home Page Tabs
 *
 * @author 		Transvelo
 * @package 	Unicase/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tabsID = uniqid();
?>
<!-- ============================================== HOME TABS ============================================== -->
<div class="home-tabs" role="tabpanel">

    <div class="nav-tabs-wrapper">
        <ul class="nav nav-tabs" role="tablist">
        	<?php foreach( $tabs as $key => $tab ) : ?>
                <?php if( !empty( $tab['shortcode'] ) ) : ?>
            <li role="presentation" <?php if( $key == 0 ){ echo 'class="active"'; } ?>><a href="#<?php echo esc_attr( $tabsID . '-' .$tab['shortcode'] );?>" aria-controls="<?php echo esc_attr( $tabsID . '-' .$tab['shortcode'] );?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'unicase_homepage_tab_title_'. $key , $tab['title'] ); ?></a></li>
                <?php endif; ?>
        	<?php endforeach; ?>
        </ul><!-- /.nav-tabs -->
    </div><!-- /.nav-tabs-wrapper -->

    <div class="tab-content">
    	<?php foreach( $tabs as $key => $tab ) : ?>
                <?php if( !empty( $tab['shortcode'] ) ) : ?>
        <div role="tabpanel" class="tab-pane <?php if( $key == 0 ) { echo esc_attr( 'active' ); } ?>" id="<?php echo esc_attr( $tabsID . '-' .$tab['shortcode'] ); ?>">

            <?php echo do_shortcode( '[' . $tab['shortcode'] . ' per_page="'.intval( $product_items ).'" columns="'.intval( $product_columns ).'"]' ); ?>

        </div><!-- /.tab-pane -->

            <?php endif; ?>

    	<?php endforeach; ?>

    </div><!-- /.tab-content -->

</div><!-- /.home-tabs -->

<!-- ============================================== HOME TABS : END ============================================== -->
