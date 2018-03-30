<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 3:24 PM
 * Since v1.4.0
 */
global $post, $prop_images, $current_page_template;
$post_meta_data     = get_post_custom($post->ID);
$prop_images        = get_post_meta( get_the_ID(), 'fave_property_images', false );
$prop_address       = get_post_meta( get_the_ID(), 'fave_property_map_address', true );
$prop_featured      = get_post_meta( get_the_ID(), 'fave_featured', true );
$agent_display_option = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );
$prop_agent_display = get_post_meta( get_the_ID(), 'fave_agents', true );
$infobox_trigger = '';

$prop_agent_num = $agent_num_call = $prop_agent = $prop_agent_link = '';
if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {
    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_agents', true );
    $prop_agent_num = get_post_meta( $prop_agent_id, 'fave_agent_mobile', true );
    $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agent_email', true );
    $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_num);
    if( $prop_agent_id ) {
        $prop_agent = get_the_title( $prop_agent_id );
        $prop_agent_link = get_permalink($prop_agent_id);
    }

} elseif( $agent_display_option == 'author_info' ) {
    $prop_agent = get_the_author();
    $prop_agent_link = get_author_posts_url( get_the_author_meta( 'ID' ) );
    $prop_agent_num = get_the_author_meta( 'fave_author_mobile' );
    $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_num);
    $prop_agent_email = get_the_author_meta( 'email' );
}
?>

<div id="ID-<?php the_ID(); ?>" class="item-wrap">
    <div class="property-item-v2 item-grid">
        <div class="figure-block">
            <figure class="item-thumb">

                <?php get_template_part( 'template-parts/featured-property' ); ?>

                <div class="label-wrap label-right">
                    <?php get_template_part('template-parts/listing', 'status' ); ?>
                </div>
                <a href="<?php the_permalink() ?>">
                    <?php
                    if( has_post_thumbnail( $post->ID ) ) {
                        the_post_thumbnail( 'houzez-property-thumb-image-v2' );
                    }else{
                        houzez_image_placeholder( 'houzez-property-thumb-image-v2' );
                    }
                    ?>
                </a>
                <div class="item-price-block hide-on-list">
                    <?php echo houzez_listing_price_v1(); ?>
                </div>
                <?php get_template_part( 'template-parts/share', 'favourite' ); ?>
            </figure>
        </div>
        <div class="item-body">
            <div class="item-body-top">
                <div class="item-title">
                    <?php
                    echo '<h2 class="property-title"><a href="'.esc_url( get_permalink() ).'">'. esc_attr( get_the_title() ). '</a></h2>';

                    if( !empty( $prop_address )) {
                        echo '<address class="property-location">'.esc_attr( $prop_address ).'</address>';
                    }
                    ?>
                </div>
                <div class="item-price-block hide-on-grid">
                    <?php echo houzez_listing_price_v1(); ?>
                </div>
            </div>
            <div class="item-body-bottom">

                <?php echo houzez_listing_meta_v3(); ?>

                <ul class="item-date">
                    <?php if( !empty( $prop_agent ) ) { ?>
                        <li class="prop-user-agent"><i class="fa fa-user"></i> <a href="<?php echo esc_url($prop_agent_link); ?>"><?php echo esc_attr( $prop_agent ); ?></a></li>
                    <?php } ?>
                    <li class="prop-date"><i class="fa fa-calendar"></i><?php printf( __( '%s ago', 'houzez' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>