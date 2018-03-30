<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Trizzy
 */
?>

</div><!-- #content -->

<div id="footer">
    <!-- 960 Container -->
    <div class="container">
        <?php 
        $footer_layout = ot_get_option('pp_footer_widgets','4,4,4,4');
        $footer_layout_array = explode(',', $footer_layout); 
        $x = 0;
        $sidbarnames = array('Footer 1st Column','Footer 2nd Column','Footer 3rd Column','Footer 4th Column');
            
        foreach ($footer_layout_array as $value) {
            $x++;
             ?>
             <div class="<?php echo esc_attr(trizzy_number_to_width($value)); ?> columns">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidbarnames[$x-1])) : endif; ?>
            </div>
        <?php } ?>


   
</div>
<!-- Container / End -->

</div>
<!-- Footer / End -->
<!-- Footer Bottom / Start -->
<div id="footer-bottom">

    <!-- Container -->
    <div class="container">

        <div class="eight columns"><?php $copyrights = ot_get_option('pp_copyrights' );
        if (function_exists('icl_register_string')) {
            icl_register_string('Copyrights in footer','copyfooter', $copyrights);
            echo icl_t('Copyrights in footer','copyfooter', $copyrights);
        } else {
          echo $copyrights;
      } ?></div>
      <div class="eight columns">
        <?php /* get the slider array */
                $payment_icons = ot_get_option( 'pp_payment_icons', array() );
                if ( !empty( $payment_icons ) ) {
                    echo ' <ul class="payment-icons">';
                    foreach( $payment_icons as $icon ) {
                        if(!empty($icon['url'])){
                            echo '<li><a href="' . esc_url($icon['url']) . '">';
                                if(!empty($icon['upload'])) {
                                    echo '<img src="'.$icon['upload'].'" alt="" />';
                                } else {
                                    echo '<img src="'.get_template_directory_uri().'/images/'.$icon['icons_service'].'.png" alt="" />';
                                }
                            echo '</a></li>';
                        } else {
                            echo '<li>';
                                if(!empty($icon['upload'])){
                                    echo '<img src="'.$icon['upload'].'" alt="" />';
                                } else {
                                    echo '<img src="'.get_template_directory_uri().'/images/'.$icon['icons_service'].'.png" alt="" />';
                                }
                            echo '</li>';
                        }
                    }
                    echo '</ul>';
                }
                ?>
     </div>

</div>
<!-- Container / End -->
<!-- Back To Top Button -->
<div id="backtotop_trizzy"><a href="#"></a></div>
</div>
<!-- Footer Bottom / Start -->

</div>

<?php if ( is_page_template( 'template-contact.php' ) ) { ?>
<script type="text/javascript">
(function($){
    $(document).ready(function(){
        $('#googlemaps').gMap({
            maptype: '<?php echo ot_get_option('pp_contact_maptype','ROADMAP') ?>',
            scrollwheel: false,
            zoom: <?php echo ot_get_option('pp_contact_zoom',13) ?>,
            markers: [
                <?php $markers = ot_get_option('pp_contact_map');
                if(!empty($markers)) {
                    foreach ($markers as $marker) { ?>
                    {
                        address: '<?php echo $marker['address']; ?>', // Your Adress Here
                        html: '<strong style="font-size: 14px;"><?php echo $marker['title']; ?></strong></br><?php echo $marker['content']; ?>',
                        popup: true,
                    },
                    <?php }
                } ?>
                    ],
                });
    });
})(this.jQuery);
</script>
<?php } //eof is_page_template ?>
<?php wp_footer(); ?>

</body>
</html>
