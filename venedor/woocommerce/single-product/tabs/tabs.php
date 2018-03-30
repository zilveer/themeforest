<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $venedor_settings;

$review_index = 0;

$custom_tab_title1 = get_post_meta(get_the_id(), 'custom_tab_title1', true);
$custom_tab_content1 = get_post_meta(get_the_id(), 'custom_tab_content1', true);
$custom_tab_title2 = get_post_meta(get_the_id(), 'custom_tab_title2', true);
$custom_tab_content2 = get_post_meta(get_the_id(), 'custom_tab_content2', true);

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs" id="product-tab">
		<ul class="resp-tabs-list">
			<?php $i = 0; foreach ( $tabs as $key => $tab ) : ?>

				<li aria-controls="tab-<?php echo $key ?>">
					<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
				</li>
                
                <?php if ($key == 'reviews') $review_index = $i; ?>

			<?php $i++; endforeach; ?>

            <?php if ($custom_tab_title1 && $custom_tab_content1) : ?>
                <li aria-controls="tab-custom1">
                    <?php _e($custom_tab_title1) ?>
                </li>
            <?php $i++; endif; ?>

            <?php if ($custom_tab_title2 && $custom_tab_content2) : ?>
                <li aria-controls="tab-custom2">
                    <?php _e($custom_tab_title2) ?>
                </li>
            <?php $i++; endif; ?>

		</ul>
        <div class="resp-tabs-container">
		    <?php foreach ( $tabs as $key => $tab ) : ?>
                
                <div id="tab-<?php echo $key ?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>
			    
		    <?php endforeach; ?>

            <?php if ($custom_tab_title1 && $custom_tab_content1) : ?>
                <div id="tab-custom1">
                    <?php echo do_shortcode(__($custom_tab_content1)) ?>
                </div>
            <?php endif; ?>

            <?php if ($custom_tab_title2 && $custom_tab_content2) : ?>
                <div id="tab-custom2">
                    <?php echo do_shortcode(__($custom_tab_content2)) ?>
                </div>
            <?php endif; ?>

        </div>
	</div>
    
    <script type="text/javascript">
        jQuery(function($) {
            $('.woocommerce-tabs').easyResponsiveTabs({
                type: '<?php echo $venedor_settings['product-tabs'] ?>', //Types: default, vertical, accordion           
                width: 'auto', //auto or any width like 600px
                fit: true,   // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
                activate: function(event) { // Callback function if tab is switched
                    
                }
            });
            <?php if ($venedor_settings['product-tabs'] == 'vertical') : ?>
            setTimeout(function() {
                $('.woocommerce-tabs .resp-tabs-container').css({'min-height': 54 * <?php echo $i ?>});
            }, 200);
            <?php endif; ?>
            
            // go to reviews, write a review
            $('#goto-reviews, #goto-review-form').click(function() {
                if ($("h2[aria-controls=tab_item-<?php echo $review_index ?>]").length && $("h2[aria-controls=tab_item-<?php echo $review_index ?>]").next().css('display') == 'none')
                    $("h2[aria-controls=tab_item-<?php echo $review_index ?>]").click();
                else if ($("li[aria-controls=tab_item-<?php echo $review_index ?>]").length && $("li[aria-controls=tab_item-<?php echo $review_index ?>]").next().css('display') == 'none')
                    $("li[aria-controls=tab_item-<?php echo $review_index ?>]").click();
            });
            $('#goto-review-form').click(function() {
                if ($('#review_form_wrapper').css('display') == 'none')
                    $(".show-review-form").click();
            });
            // Open review form lightbox if accessed via anchor
            if ( window.location.hash == '#review-form' || window.location.hash == '#reviews' ) {
                setTimeout(function() {
                    if ($("h2[aria-controls=tab_item-<?php echo $review_index ?>]").next().css('display') == 'none')
                        $("h2[aria-controls=tab_item-<?php echo $review_index ?>]").click();
                    if ( window.location.hash == '#review-form' )
                        $(".show-review-form").click();
                }, 200);
            }
        });
    </script>

<?php endif; ?>