<?php
/**
 * Property Top Area V1
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 2:44 PM
 */
global $post, $property_map, $property_streetView;

$agent_display_option = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );
$prop_agent_display = get_post_meta( get_the_ID(), 'fave_agents', true );
$prop_agent_num = $agent_num_call = $prop_agent_email = $gallery_view = $map_view = $street_view = '';

$enableDisable_agent_forms = houzez_option('agent_forms');

if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {
    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_agents', true );
    $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agent_email', true );

} elseif ( $agent_display_option == 'author_info' ) {
    $prop_agent_email = get_the_author_meta( 'email' );
}

$prop_default_active_tab = houzez_option('prop_default_active_tab');
if( $prop_default_active_tab == "image_gallery" ) {
    $gallery_view = 'in active';
} elseif( $prop_default_active_tab == "map_view" ) {
    $map_view = 'in active';
} elseif( $prop_default_active_tab == "street_view" ) {
    $street_view = 'in active';
} else {
    $gallery_view = 'in active';
}
?>
<section class="detail-top detail-top-grid">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php get_template_part( 'property-details/header', 'detail' );?>

                <?php if( has_post_thumbnail() ) { ?>
                <div class="detail-media">
                    <div class="tab-content">
                        <?php
                            $gallery_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(),'houzez-single-big-size' );
                        ?>
                        <div id="gallery" class="tab-pane fade <?php echo esc_attr( $gallery_view );?>" style="background-image: url(<?php echo $gallery_image_url?>)">
                            <a href="#" class="popup-trigger">
                            </a>
                            <?php if( !empty( $prop_agent_email ) && $enableDisable_agent_forms != 0 ) { ?>
                            <div class="form-small form-media">
                                <?php get_template_part( 'property-details/agent', 'form' ); ?>
                            </div>
                            <?php } ?>

                        </div>

                        <?php if( $property_map != 0 ) { ?>
                        <div id="singlePropertyMap" class="tab-pane fade <?php echo esc_attr( $map_view );?>">
                            <div class="mapPlaceholder">
                                <div class="loader-ripple">
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                         <?php wp_nonce_field('houzez_map_ajax_nonce', 'securityHouzezMap', true); ?>
                         <input type="hidden" name="prop_id" id="prop_id" value="<?php echo esc_attr($post->ID); ?>" />
                        <?php } ?>

                        <?php if( $property_streetView != 'hide' ) { ?>
                        <div id="street-map" class="tab-pane fade <?php echo esc_attr( $street_view );?>"></div>
                        <?php } ?>

                    </div>
                    <?php get_template_part( 'property-details/media', 'tabs' );?>
                </div>
                <?php } // End has post thumbnail ?>
            </div>
        </div>
    </div>
</section>
