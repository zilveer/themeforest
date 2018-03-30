<?php
/**
 * User: cb-theme
 * Date: 11.10.13
 * Time: 13:25
 * cb-theme Admin Slider Page
 */


add_action( 'wp_ajax_nopriv_save_cb_slider', 'save_cb_slider' );
add_action( 'wp_ajax_save_cb_slider', 'save_cb_slider' );


function save_cb_slider() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';

    update_option('cb5_slide_home', esc_attr($data['cb5_slide_home']));
    update_option('cb5_s_text', esc_attr($data['cb5_s_text']));
    update_option('cb5_cat', esc_attr($data['cb5_cat']));
    update_option('cb5_rev_slider_name', esc_attr($data['cb5_rev_slider_name']));
    update_option('cb5_s_link', esc_attr($data['cb5_s_link']));
    update_option('cb5_s_resize', esc_attr($data['cb5_s_resize']));
    update_option('cb5_s_auto', esc_attr($data['cb5_s_auto']));
    update_option('cb5_s_delay', esc_attr($data['cb5_s_delay']));
    update_option('cb5_s_ani_time', esc_attr($data['cb5_s_ani_time']));
    update_option('cb5_s_easing', esc_attr($data['cb5_s_easing']));

    update_option('cb5_full_slider', esc_attr($data['cb5_full_slider']));
    update_option('cb5_full_slider_where', esc_attr($data['cb5_full_slider_where']));
    update_option('cb5_full_slider_style', esc_attr($data['cb5_full_slider_style']));
    update_option('cb5_full_slider_bar', esc_attr($data['cb5_full_slider_bar']));
    update_option('cb5_full_slider_thumbs', esc_attr($data['cb5_full_slider_thumbs']));
    update_option('cb5_full_slider_nav', esc_attr($data['cb5_full_slider_nav']));
    update_option('cb5_full_slider_interval', esc_attr($data['cb5_full_slider_interval']));
    update_option('cb5_full_slider_effect', esc_attr($data['cb5_full_slider_effect']));
    update_option('cb5_full_slider_t_speed', esc_attr($data['cb5_full_slider_t_speed']));
    update_option('cb5_full_slider_page', esc_attr($data['cb5_full_slider_page']));


    die($response);
}
function show_cb_slider_page(){
    ?>

        <h3>Sliders</h3>
        <div class="tab_desc">General settings for the sliders in the theme. Can be overriden in some elements</div>
        
    <form method="post" class="cb-admin-form">

    <div class="sliders">
            <div class="pd5" style="border-top:none;">
            <?php echo generate_hint('Settings for the global slider. You can override this option in the page header settings.'); ?>
                <?php generate_select(__('Slider Type', 'cb-modello'), get_option('cb5_slide_type'), array(
                    array('revo', __('Revolution Slider', 'cb-modello'))), 'cb5_slide_type','slide_type'); ?>

            </div>

            <div class="pd5">
                <?php generate_select(__('Show Slider', 'cb-modello'), get_option('cb5_slide_home'), array(
                    array('home', __('only in homepage', 'cb-modello')),
                    array('yes', __('everywhere', 'cb-modello')),
                    array('no', __('disable slider', 'cb-modello'))), 'cb5_slide_home');?>

            </div>

            <style>.hide_slider {
                    display: none;
                }</style>
            <script>
                var ht = "";
                jQuery("select#slide_type").change(function () {
                    jQuery("select#slide_type option:selected").each(function () {
                        ht = jQuery(this).val();
                    });
                    jQuery(".hide_slider").hide();
                    jQuery("." + ht).show();
                }).change();

                jQuery(document).ready(function () {
                    var htt = "<?php echo get_option('cb5_slide_type');?>";
                    jQuery("." + htt).show();
                });

            </script>
            <?php /*REVOLUTION SLIDER*/ ?>
            <div class="revo hide_slider">
                <?php if (in_array('revslider/revslider.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?>
                    <div class="pd5"><label><?php _e('Slider Name', 'cb-modello'); ?></label>
                    <select name="cb5_rev_slider_name">
                        <?php  $slider = new RevSlider();
                        $arrSliders = $slider->getArrSliders();
                        foreach ($arrSliders as $slider):
                            $stitle = $slider->getTitle();
                            $salias = $slider->getAlias();
                            if (get_option('cb5_rev_slider_name') == $salias) $curest = ' selected '; else $curest = '';
                            echo '<option value=' . $salias . ' ' . $curest . '>' . $stitle . '</option>';
                        endforeach;
                        ?>
                    </select>
                    </div><?php } ?>
<div class="pd5">
                <label class="info w100"><?php _e('You can configure Revolution Slider by', 'cb-modello'); ?><b> <a
                        href="admin.php?page=revslider">clicking here</a></b></label>
</div><div class="cl"></div>
            </div>
            <?php /*REVOLUTION SLIDER END*/ ?>


            <?php /*ANYTHING SLIDER*/?>
            <div class="any hide_slider">
                <div class="pd5 hide">
                    <?php generate_select(__('Show post content above image', 'cb-modello'), get_option('cb5_s_text'), array(
                        array('no', __('no', 'cb-modello')),
                        array('yes', __('yes', 'cb-modello'))), 'cb5_s_text');?>
                    <?php _e('Show post content above image', 'cb-modello'); ?>
                </div>

                <div class="pd5">
           		 <?php echo generate_hint('Will generate slides from posts in the category'); ?>
                    <label><?php _e('Slider category', 'cb-modello'); ?></label>
                    <?php wp_dropdown_categories('show_count=1&hierarchical=1&hide_empty=0&name=cb5_cat&selected=' . get_option('cb5_cat')); ?>
                </div>
<div class="pd5">
                <label class="info"><?php _e('Optional Settings', 'cb-modello'); ?></label>
                <div class="cl"></div>
</div>
                <div class="pd5 hide">
                    <?php generate_select(__('Link slides to posts', 'cb-modello'), get_option('cb5_s_link') , array(
                        array('no', __('no', 'cb-modello')),
                        array('yes', __('yes', 'cb-modello'))), 'cb5_s_link');?>
                </div>

                <div class="pd5 hide">
                    <?php generate_select(__('Resize Contents', 'cb-modello'), get_option('cb5_s_resize') , array(
                        array('true', __('true', 'cb-modello')),
                        array('false', __('false', 'cb-modello'))), 'cb5_s_resize');?>
                </div>

                <div class="pd5">
                    <?php generate_select(__('Autoplay', 'cb-modello'), get_option('cb5_s_auto') , array(
                        array('true', __('true', 'cb-modello')),
                        array('false', __('false', 'cb-modello'))), 'cb5_s_auto');?>
                </div>

                <div class="pd5">
            <?php echo generate_hint('Pause between slides'); ?>
            <label for="cb5_s_delay"><?php _e('Delay in ms', 'cb-modello'); ?></label>
                    <input type="text" name="cb5_s_delay" id="cb5_s_delay" value="<?php echo get_option('cb5_s_delay'); ?>"/></div>

                <div class="pd5">
                <label for="cb5_s_ani_time"><?php _e('Animation time', 'cb-modello'); ?></label>
                    <input type="text" name="cb5_s_ani_time" id="cb5_s_ani_time" value="<?php get_option('cb5_s_ani_time'); ?>"/></div>

                <div class="pd5">
                    <?php generate_select(__('Easing Effect', 'cb-modello'), get_option('cb5_s_easing') , array(
                        array('swing', __('swing', 'cb-modello')),
                        array('linear', __('linear', 'cb-modello')),
                        array('easeInQuad', __('easeInQuad', 'cb-modello')),
                        array('easeOutQuad', __('easeOutQuad', 'cb-modello')),
                        array('easeInOutQuad', __('easeInOutQuad', 'cb-modello')),
                        array('easeInCubic', __('easeInCubic', 'cb-modello')),
                        array('easeOutCubic', __('easeOutCubic', 'cb-modello')),
                        array('easeInOutCubic', __('easeInOutCubic', 'cb-modello')),
                        array('easeInSine', __('easeInSine', 'cb-modello')),
                        array('easeOutSine', __('easeOutSine', 'cb-modello')),
                        array('easeInOutSine', __('easeInOutSine', 'cb-modello')),
                        array('easeInExpo', __('easeInExpo', 'cb-modello')),
                        array('easeOutExpo', __('easeOutExpo', 'cb-modello')),
                        array('easeInOutExpo', __('easeInOutExpo', 'cb-modello')),
                        array('easeInQuint', __('easeInQuint', 'cb-modello')),
                        array('easeOutQuint', __('easeOutQuint', 'cb-modello')),
                        array('easeInOutQuint', __('easeInOutQuint', 'cb-modello')),
                        array('easeInCirc', __('easeInCirc', 'cb-modello')),
                        array('easeOutCirc', __('easeOutCirc', 'cb-modello')),
                        array('easeInOutCirc', __('easeInOutCirc', 'cb-modello')),
                        array('easeInElastic', __('easeInElastic', 'cb-modello')),
                        array('easeOutElastic', __('easeOutElastic', 'cb-modello')),
                        array('easeInOutElastic', __('easeInOutElastic', 'cb-modello')),
                        array('easeInBack', __('easeInBack', 'cb-modello')),
                        array('easeOutBack', __('easeOutBack', 'cb-modello')),
                        array('easeInOutBack', __('easeInOutBack', 'cb-modello')),
                        array('easeInBounce', __('easeInBounce', 'cb-modello')),
                        array('easeOutBounce', __('easeOutBounce', 'cb-modello')),
                        array('easeInOutBounce', __('easeInOutBounce', 'cb-modello')),
                        array('easeInQuad', __('easeInQuad', 'cb-modello')),
                        array('easeInQuad', __('easeInQuad', 'cb-modello')),
                        array('easeInQuad', __('easeInQuad', 'cb-modello')),
                        array('easeInQuad', __('easeInQuad', 'cb-modello')),
                        array('easeInQuad', __('easeInQuad', 'cb-modello')),
                        array('easeInQuad', __('easeInQuad', 'cb-modello')),
                        array('easeInQuad', __('easeInQuad', 'cb-modello'))), 'cb5_s_easing');?>
                </div>


            <?php /*ANYTHING SLIDER END*/ ?>

           </div>
        </div>
<div class="pd5-reset">
        <h3><?php _e('Fullscreen Slider','cb-modello'); ?></h3>
        <div class="tab_desc pb0"><?php _e('General settings for the fullscreen slider','cb-modello'); ?></div>
</div>
        <div class="cl"></div>
        <!-- FULLSCREEN SLIDER SECTION START ##-->
        <div class="slider2">

            <div class="pd5" style="border-top:none;">
            
            <?php echo generate_hint('If you are using fullscreen slider do not set custom slider in page header settings'); ?>
                <?php generate_select(__('Show Fullscreen Slider', 'cb-modello'), get_option('cb5_full_slider') , array(
                    array('no', __('no', 'cb-modello')),
                    array('yes', __('false', 'cb-modello'))), 'cb5_full_slider');?>
            </div>
            <div class="pd5">
                <?php generate_select(__('Show Slider on', 'cb-modello'), get_option('cb5_full_slider_where') , array(
                    array('home', __('only in homepage', 'cb-modello')),
                    array('yes', __('everywhere', 'cb-modello'))), 'cb5_full_slider_where');?>
            </div>

            <div class="pd5">
                <?php generate_select(__('Show controls', 'cb-modello'), get_option('cb5_full_slider_style') , array(
                    array('0', __('no', 'cb-modello')),
                    array('1', __('yes', 'cb-modello'))), 'cb5_full_slider_style');?>
            </div>

            <div class="pd5">
                <?php generate_select(__('Show Progress Bar', 'cb-modello'), get_option('cb5_full_slider_bar') , array(
                    array('0', __('no', 'cb-modello')),
                    array('1', __('yes', 'cb-modello'))), 'cb5_full_slider_bar');?>
            </div>

            <div class="pd5">
                <?php generate_select(__('Show Thumbnails', 'cb-modello'), get_option('cb5_full_slider_thumbs') , array(
                    array('0', __('no', 'cb-modello')),
                    array('1', __('yes', 'cb-modello'))), 'cb5_full_slider_thumbs');?>
            </div>

            <div class="pd5">
                <?php generate_select(__('Show Prev/Next Buttons', 'cb-modello'), get_option('cb5_full_slider_nav') , array(
                    array('0', __('no', 'cb-modello')),
                    array('1', __('yes', 'cb-modello'))), 'cb5_full_slider_nav');?>
            </div>

            <div class="pd5">
            <?php echo generate_hint('Pause between slides'); ?>
            <label for="cb5_full_slider_interval"><?php _e('Slides Interval','cb-modello'); ?></label>
                <input type="text" name="cb5_full_slider_interval" id="cb5_full_slider_interval" value="<?php echo get_option('cb5_full_slider_interval');?>"/></div>

            <div class="pd5" style="border-top:none;">
                <?php generate_select(__('Slider Effect', 'cb-modello'), get_option('cb5_full_slider_effect') , array(
                    array('0', __('None', 'cb-modello')),
                    array('1', __('Fade', 'cb-modello')),
                    array('2', __('Slide Top', 'cb-modello')),
                    array('3', __('Slide Right', 'cb-modello')),
                    array('4', __('Slide Bottom', 'cb-modello')),
                    array('5', __('Slide Left', 'cb-modello')),
                    array('6', __('Carousel Right', 'cb-modello')),
                    array('7', __('Carousel Left', 'cb-modello'))), 'cb5_full_slider_effect');?>
            </div>

            <div class="pd5"><label for="cb5_full_slider_t_speed"><?php _e('Effect Speed','cb-modello'); ?></label>
            <?php echo generate_hint('in ms'); ?>
                <input type="text" name="cb5_full_slider_t_speed" id="cb5_full_slider_t_speed" value="<?php echo get_option('cb5_full_slider_t_speed');?>"/> </div>

            <div class="pd5"><label for="cb5_full_slider_page"><?php _e('Images from','cb-modello'); ?></label>
                <?php wp_dropdown_pages('selected='.get_option('cb5_full_slider_page').'&name=cb5_full_slider_page');?>
            </div>
        </div>

        <!-- ## FULLSCREEN SLIDER SECTION END ##-->

        <input type="hidden" name="tab" class="cb-tab" value="cb-slider-page" />
        <input type="hidden" name="action" value="save_cb_slider" />
        <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

        <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="cb-save"></div>
    </form>
<?php
}