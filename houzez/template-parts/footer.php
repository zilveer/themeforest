<?php 
if ( !is_active_sidebar( 'footer-sidebar-1' )
    && ! is_active_sidebar( 'footer-sidebar-2' )
    && ! is_active_sidebar( 'footer-sidebar-3' )
    && ! is_active_sidebar( 'footer-sidebar-4' ) )
    return;

$footer_cols = houzez_option('footer_cols');
if( $footer_cols == 'three_cols' ) {
    $f_3_classes = 'col-md-6 col-sm-12';
    $footer = 'footer footer-v2';
} else {
    $f_3_classes = 'col-md-3 col-sm-6';
    $footer = 'footer';
}
?>
<div class="<?php echo esc_attr( $footer ); ?>">
	<div class="container">
        <div class="row">

            <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) : ?>
                <div class="col-md-3 col-sm-6"> <?php dynamic_sidebar( 'footer-sidebar-1' ); ?> </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
                <div class="col-md-3 col-sm-6"> <?php dynamic_sidebar( 'footer-sidebar-2' ); ?> </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
                <div class="<?php echo esc_attr( $f_3_classes ); ?>"> <?php dynamic_sidebar( 'footer-sidebar-3' ); ?> </div>
            <?php endif; ?>

            <?php if( $footer_cols == 'four_cols' ) { ?>
            <?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
                <div class="col-md-3 col-sm-6"> <?php dynamic_sidebar( 'footer-sidebar-4' ); ?> </div>
            <?php endif; ?>
            <?php } ?>

        </div>
    </div>
</div>