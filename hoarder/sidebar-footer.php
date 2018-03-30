<!-- BEGIN .footer-col-1 -->
<div class="footer-col-1">

    <?php 
        if( is_active_sidebar( 'footer-column' ) ) {
            dynamic_sidebar( 'footer-column' ); 
        }
    ?>
    
<!-- END .footer-col-1 -->
</div>

<!-- BEGIN .footer-col-2 -->
<div class="footer-col-2">

    <?php 
        if( is_active_sidebar( 'footer-column-2' ) ) {
            dynamic_sidebar( 'footer-column-2' ); 
        }
    ?>

<!-- END .footer-col-2 -->
</div>

<!-- BEGIN .footer-col-3 -->
<div class="footer-col-3">

    <?php 
        if( is_active_sidebar( 'footer-column-3' ) ) {
            dynamic_sidebar( 'footer-column-3' ); 
        }
    ?>

<!-- END .footer-col-3 -->
</div>