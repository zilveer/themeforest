<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce, $post, $product, $venedor_settings, $venedor_woo_version;
$displaytypenumber = 0;

if ($venedor_settings['product-addcart']) :

if (function_exists('wcva_return_displaytype_number'))
    $displaytypenumber = wcva_return_displaytype_number($product,$post);

$goahead = 1;

if(isset($_SERVER['HTTP_USER_AGENT'])){
    $agent = $_SERVER['HTTP_USER_AGENT'];
}
if ((preg_match('/(?i)msie [5-8]/', $agent)) || strpos($agent, 'Trident/7.0; rv:11.0') !== false) {
    $goahead = 0;
}

if (($goahead == 1) && ($displaytypenumber > 0)) : ?>

<?php
$woo_version =  wcva_get_woo_version_number();
$_coloredvariables = get_post_meta( $post->ID, '_coloredvariables', true );

/*
 * load default dropdown select
 * @param - $name
 * @param - $options
 */
function wcva_load_dropdown_select($name,$options,$selected_value) {
    wcva_load_radio_select($name,$options,$selected_value,$hidden=true);
    ?> <select id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo sanitize_title( $name ); ?>">
        <option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option>
        <?php


        // Get terms if this is a taxonomy - ordered
        if ( taxonomy_exists( sanitize_title( $name ) ) ) {

            $orderby = wc_attribute_orderby( sanitize_title( $name ) );

            switch ( $orderby ) {
                case 'name' :
                    $args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
                    break;
                case 'id' :
                    $args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false, 'hide_empty' => false );
                    break;
                case 'menu_order' :
                    $args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
                    break;
            }

            $terms = get_terms( sanitize_title( $name ), $args );

            foreach ( $terms as $term ) {
                if ( ! in_array( $term->slug, $options ) )
                    continue;

                echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
            }
        } else {

            foreach ( $options as $option ) {
                echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
            }

        }

        ?>
    </select>

<?php }

/*
 * Load radio select
 * since 1.0.2
 */
function wcva_load_radio_select($name,$options,$selected_value,$hidden=null) { ?>
    <fieldset style="<?php if (isset($hidden)) { echo 'display:none;';} ?>">

        <?php
        if ( is_array( $options ) ) {


            if ( taxonomy_exists( sanitize_title( $name ) ) ) {

                $terms = get_terms( sanitize_title($name), array('menu_order' => 'ASC') );

                foreach ( $terms as $term ) {
                    if ( ! in_array( $term->slug, $options ) ) continue;
                    echo '<label for="attribute_'.sanitize_title($name).'_'.sanitize_title($term->slug).'"><input type="radio" class="wcva_attribute_radio" value="' . strtolower($term->slug) . '" ' . checked( strtolower ($selected_value), strtolower ($term->slug), false ) . '  id="attribute_'.sanitize_title($name).'_'.sanitize_title($term->slug).'" name="attribute_'. sanitize_title($name).'"> ' . apply_filters( 'woocommerce_variation_option_name', $term->name ).'</label><br />';
                }
            } else {
                foreach ( $options as $option )
                    echo '<label for="attribute_'.sanitize_title($name).'_'.sanitize_title($option).'"><input type="radio" class="wcva_attribute_radio" value="' .esc_attr( sanitize_title( $option ) ) . '" ' . checked( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . ' id="attribute_'.sanitize_title($name).'_'.sanitize_title($option).'" name="attribute_'. sanitize_title($name).'"> ' . apply_filters( 'woocommerce_variation_option_name', $option ) . '</label><br />';
            }
        }
        ?>
    </fieldset>
<?php


}
/*
 * Load colored select
 * since 1.0.0
 */
function wcva_load_colored_select($name,$options,$_coloredvariables,$newvalues,$selected_value) {
    ?>
    <fieldset>

        <?php
        if ( is_array( $options ) ) {



            if ( taxonomy_exists( sanitize_title( $name ) ) ) {

                $terms = get_terms( sanitize_title($name), array('menu_order' => 'ASC') );

                foreach ( $terms as $term ) {
                    if ( ! in_array( $term->slug, $options ) ) continue; {
                        wcva_display_image_select_block($selected_value,$name,$term->slug,$_coloredvariables,$newvalues);
                    }
                }
            } else {
                foreach ( $options as $option ) {
                    wcva_display_image_select_block($selected_value,$name,$option,$_coloredvariables,$newvalues);
                }
            }
        }
        ?>
    </fieldset>
<?php

}

/*
 * Get Image display
 * since 1.0.2
 */
function wcva_display_image_select_block($selected_value,$name,$option,$_coloredvariables,$newvalues){

    $globalthumbnail_id = '';
    $globaldisplay_type = 'Color';
    $globalcolor        =  'grey';


    foreach ($newvalues as $newvalue):
        if (isset($newvalue->name) && (strtolower($newvalue->name) == strtolower($option))) :

            $globalthumbnail_id 	= absint( get_woocommerce_term_meta( $newvalue->term_id, 'thumbnail_id', true ) );
            $globaldisplay_type 	= get_woocommerce_term_meta($newvalue->term_id, 'display_type', true );
            $globalcolor 	    = get_woocommerce_term_meta($newvalue->term_id, 'color', true );
        endif;
    endforeach;

    if ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option]['image']))) {
        $thumb_id = $_coloredvariables[$name]['values'][$option]['image']; $url = wp_get_attachment_thumb_url( $thumb_id );
    } elseif (isset($globalthumbnail_id)) {
        $thumb_id=$globalthumbnail_id; $url = wp_get_attachment_thumb_url( $globalthumbnail_id );
    }

    if ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option]['type']))) {
        $attrdisplaytype = $_coloredvariables[$name]['values'][$option]['type'];
    } elseif (isset($globaldisplay_type)) {
        $attrdisplaytype = $globaldisplay_type;
    }

    if ((isset($_coloredvariables[$name]['values'])) && (isset($_coloredvariables[$name]['values'][$option]['color']))) {
        $attrcolor = $_coloredvariables[$name]['values'][$option]['color'];
    } elseif (isset($globalcolor)) {
        $attrcolor = $globalcolor;
    }


    ?>
    <label class="wcvaswatches" style="display:inline;" for="attribute_<?php echo  sanitize_title($name); ?>_<?php echo  sanitize_title($option); ?>">
        <input type="radio" class="wcva_attribute_radio" value="<?php echo esc_attr( sanitize_title( $option ) ); ?>" <?php echo checked( sanitize_title( $selected_value ), sanitize_title( $option ), false ); ?> id="attribute_<?php echo  sanitize_title($name); ?>_<?php echo  sanitize_title($option); ?>" name="attribute_<?php echo  sanitize_title($name); ?>">
        <?php
        if (isset($_coloredvariables[$name]['size'])) {
            $thumbsize   = $_coloredvariables[$name]['size'];
            $displaytype = $_coloredvariables[$name]['displaytype'];
        } else {
            $thumbsize   = 'small';
            $displaytype = 'square';
        }
        $imageheight = wcva_get_image_height($thumbsize); $imagewidth = wcva_get_image_width($thumbsize);




        switch($attrdisplaytype) {
            case "Color":
                ?>
                <a  title="<?php echo $option; ?>" class="<?php if ($displaytype == "round") { echo 'wcvaround'; } ?>" style="display: inline-block; background-color:<?php if (isset($attrcolor)) { echo $attrcolor; } else { echo '#ffffff'; } ?>; width:<?php echo $imagewidth;?>px; height:<?php echo $imageheight;?>px; "></a>
                <?php
                break;
            case "Image":
                ?>
                <a title="<?php echo $option; ?>" class="<?php if ($displaytype == "round") { echo 'wcvaround'; } ?>" style="display: inline-block; width:<?php echo $imagewidth;?>px; height:<?php echo $imageheight;?>px; " ><img src="<?php if (isset($url)) { echo $url; } ?>" class="<?php if ($displaytype == "round") { echo 'wcvaround'; } ?>" style="width:<?php echo $imagewidth;?>px; height:<?php echo $imageheight;?>px; "></a>
                <?php
                break;
        }


        ?>
    </label>
<?php }

/*
 * Get Image Height
 * since 1.0.0
 */
function wcva_get_image_height($thumbsize) {
    $height=32;
    switch($thumbsize) {

        case "small":
            $height=32;
            break;


        case "extrasmall":
            $height=22;
            break;

        case "medium":
            $height=40;
            break;

        case "big":
            $height=60;
            break;

        case "extrabig":
            $height=90;
            break;

        default :
            $height=32;
            break;

    }
    return $height;
}

/*
 * Get Image Width
 * since 1.0.0
 */
function wcva_get_image_width($thumbsize) {
    $width=32;

    switch($thumbsize) {

        case "small":
            $width=32;
            break;

        case "extrasmall":
            $width=22;
            break;

        case "medium":
            $width=40;
            break;

        case "big":
            $width=60;
            break;

        case "extrabig":
            $width=90;
            break;

        default :
            $width=32;
            break;
    }

    return $width;
}
?>

<?php
$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<script type="text/javascript">
    var product_variations_<?php echo $post->ID; ?> = <?php echo json_encode( $available_variations ) ?>;
</script>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $post->ID ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
    <?php else : ?>
        <table class="variations" cellspacing="0">
            <tbody>
            <?php $loop = 0; foreach ( $attributes as $attribute_name => $options ) : $loop++;
                if (isset( $_coloredvariables[$attribute_name]['display_type'])) {
                    $attribute_display_type  = $_coloredvariables[$attribute_name]['display_type'];
                }
                $taxonomies = array($attribute_name);
                $args = array(
                    'hide_empty' => 0
                );
                $newvalues = get_terms( $taxonomies, $args);
                if (isset($_coloredvariables[$attribute_name]['label'])) {
                    $labeltext=$_coloredvariables[$attribute_name]['label'];
                } else {


                    if ($woo_version <2.1) {
                        $labeltext=$woocommerce->attribute_label( $attribute_name );
                    } else {
                        $labeltext=wc_attribute_label( $attribute_name );
                    }


                }
                ?>
                <tr>
                    <td class="label"><label for="<?php echo sanitize_title($attribute_name); ?>"><?php if (isset($labeltext) && ($labeltext != '')) { echo $labeltext; } else { echo wc_attribute_label( $attribute_name ); } ?></label></td>
                    <td class="value">
                        <?php if (version_compare($venedor_woo_version, '2.4', '<')) : ?>
                            <?php

                            if ( is_array( $options ) ) {

                                if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) {
                                    $selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ];
                                } elseif ( isset( $selected_attributes[ sanitize_title( $attribute_name ) ] ) ) {
                                    $selected_value = $selected_attributes[ sanitize_title( $attribute_name ) ];
                                } else {
                                    $selected_value = '';
                                }
                            }


                            if (isset($attribute_display_type) && ($attribute_display_type  == "colororimage"))	{
                                wcva_load_colored_select($attribute_name,$options,$_coloredvariables,$newvalues,$selected_value);
                                if ( sizeof($attributes) == $loop )
                                    echo '<br /><a class="reset_variations reset_variations_color" href="#reset">' . __( 'Clear selection', 'venedor' ) . '</a>';
                            } elseif (isset($attribute_display_type) && ($attribute_display_type  == "radio"))  {
                                wcva_load_radio_select($attribute_name,$options,$selected_value);
                                if ( sizeof($attributes) == $loop )
                                    echo '<br /><a class="reset_variations reset_variations_radio" href="#reset">' . __( 'Clear selection', 'venedor' ) . '</a>';
                            } else {
                                wcva_load_dropdown_select($attribute_name,$options,$selected_value);
                                if ( sizeof($attributes) == $loop )
                                    echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'venedor' ) . '</a>';
                            }
                            ?>
                        <?php else : ?>
                            <?php
                            $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
                            wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
                            echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . __( 'Clear selection', 'woocommerce' ) . '</a>' : '';
                            ?>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach;?>
            </tbody>
        </table>

        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

        <div class="single_variation_wrap"<?php if (version_compare($venedor_woo_version, '2.5', '<')) : ?> style="display:none;"<?php endif ?>>
            <?php
            /**
             * woocommerce_before_single_variation Hook.
             */
            do_action( 'woocommerce_before_single_variation' );
            if (version_compare($venedor_woo_version, '2.4', '<')) : ?>
            ?>

            <div class="single_variation"></div>

            <div class="variations_button">
                <?php woocommerce_quantity_input(); ?>
                <button type="submit" class="single_add_to_cart_button button alt">
                    <?php

                    if ($woo_version <2.1) {
                        echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $product->product_type);
                    } else {
                        echo $product->single_add_to_cart_text();
                    }

                    ?>
                </button>
            </div>

            <input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
            <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
            <input type="hidden" name="variation_id" value="" />

            <?php
            else :
                /**
                 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
                 * @since 2.4.0
                 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                 */
                do_action( 'woocommerce_single_variation' );
            endif;

            /**
             * woocommerce_after_single_variation Hook.
             */
            do_action( 'woocommerce_after_single_variation' ); ?>
        </div>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    <?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' );

?>

<?php else : ?>

<?php
    $attribute_keys = array_keys( $attributes );
    do_action( 'woocommerce_before_add_to_cart_form' );
?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $post->ID ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
    <?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php $loop = 0; foreach ( $attributes as $attribute_name => $options ) : $loop++; ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title($attribute_name); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
                        <?php if (version_compare($venedor_woo_version, '2.4', '<')) : ?>
                            <select id="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" name="attribute_<?php echo sanitize_title( $attribute_name ); ?>" data-attribute_name="attribute_<?php echo sanitize_title( $attribute_name ); ?>">
							<option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option>
							<?php
								if ( is_array( $options ) ) {

									if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) {
										$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ];
									} elseif ( isset( $selected_attributes[ sanitize_title( $attribute_name ) ] ) ) {
										$selected_value = $selected_attributes[ sanitize_title( $attribute_name ) ];
									} else {
										$selected_value = '';
									}

									// Get terms if this is a taxonomy - ordered
                                    if ( taxonomy_exists( $attribute_name ) ) {

                                        $terms = wc_get_product_terms( $post->ID, $attribute_name, array( 'fields' => 'all' ) );

										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) ) {
												continue;
											}
											echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
										}

									} else {

										foreach ( $options as $option ) {
											echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
										}

									}
								}
							?>
						</select> <?php
							if ( sizeof( $attributes ) === $loop ) {
								echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';
							}
						?>
                        <?php else : ?>
                            <?php
                            $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
                            wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
                            echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
                            ?>
                        <?php endif; ?>
                        </td>
					</tr>
		        <?php endforeach;?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap"<?php if (version_compare($venedor_woo_version, '2.5', '<')) : ?> style="display:none;"<?php endif ?>>
			<?php
            /**
             * woocommerce_before_single_variation Hook
             */
            do_action( 'woocommerce_before_single_variation' ); ?>
            <?php if (version_compare($venedor_woo_version, '2.4', '<')) : ?>
                <div class="single_variation"></div>

                <div class="variations_button">
                    <?php woocommerce_quantity_input(); ?>
                    <button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
                </div>

                <input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
                <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
                <input type="hidden" name="variation_id" class="variation_id" value="" />
            <?php else : ?>
                <?php
                /**
                 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
                 * @since 2.4.0
                 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                 */
                do_action( 'woocommerce_single_variation' );
                ?>
            <?php endif; ?>
			<?php
            /**
             * woocommerce_after_single_variation Hook
             */
            do_action( 'woocommerce_after_single_variation' ); ?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif;
endif; ?>