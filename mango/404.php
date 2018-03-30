<?php
/**
 * 404 template
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage mango
 * @since Mango 1.0
 */
 
global $mango_settings;
get_header ();
$containerClass = mango_main_container_class();
?>
        <div class="<?php echo esc_attr($containerClass); ?> main">
            <div class="row">
               <div class="error-content">
                    <h1 class="error-title"><?php echo force_balance_tags($mango_settings['mango_404_title']); ?> <span>
                        <?php echo force_balance_tags($mango_settings['mango_404_subtitle']);?></span></h1>
                    <p><?php echo htmlspecialchars_decode( esc_textarea($mango_settings['mango_404_content'])); ?></p>
                </div><!-- End .404-content -->
                <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
            </div><!-- End .row -->
        </div><!-- End .container -->
        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->
    </section><!-- End #content -->
<?php get_footer () ?>