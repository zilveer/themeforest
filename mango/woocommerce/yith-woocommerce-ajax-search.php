<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Yithemes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly

wp_enqueue_script('yith_wcas_jquery-autocomplete' );
wp_enqueue_script('yith_wcas_frontend' );

global $con_class, $mango_settings,$search_button_class;
?>

<div class="yith-ajaxsearchform-container <?php echo esc_attr($con_class) ?>">
    <form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
        <div class="input-group">
            <input type="search"
                   value="<?php echo get_search_query() ?>"
                   name="s"
                   id="yith-s"
                   class="yith-s form-control"
                   placeholder="<?php echo esc_attr($mango_settings[ 'search_field_placeholder' ]); ?>"
                   data-loader-icon="<?php echo str_replace( '"', '', apply_filters('yith_wcas_ajax_search_icon', '') ) ?>"
                   data-min-chars="<?php echo esc_attr(get_option('yith_wcas_min_chars')); ?>" />
            <span class="input-group-btn">
                <button id="yith-searchsubmit" class="btn<?php echo esc_attr($search_button_class) ?>" type="submit"><i class="fa fa-search"></i></button>
            </span>
            <input type="hidden" name="post_type" value="product" />
            <?php $lang_code = explode ( '-', get_bloginfo ( "language" ) ); ?>
            <input type="hidden" name="lang" value="<?php echo esc_attr($lang_code[ 0 ]); ?>"/>
        </div>
    </form>
</div>