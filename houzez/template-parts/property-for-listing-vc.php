<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/02/16
 * Time: 12:36 AM
 */
global $post, $prop_images;
$post_meta_data     = get_post_custom($post->ID);
$prop_images        = get_post_meta( get_the_ID(), 'fave_property_images', false );
$prop_address       = get_post_meta( get_the_ID(), 'fave_property_map_address', true );
$prop_featured      = get_post_meta( get_the_ID(), 'fave_featured', true );
$agent_display_option = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );
$prop_agent_display = get_post_meta( get_the_ID(), 'fave_agents', true );

$prop_agent_num = $agent_num_call = $prop_agent = $prop_agent_link = '';
if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {
    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_agents', true );
    $prop_agent_num = get_post_meta( $prop_agent_id, 'fave_agent_mobile', true );
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
}
?>
<div id="ID-<?php the_ID(); ?>" class="item-wrap">
    <div class="property-item item-grid">
        <div class="figure-block">
            <figure class="item-thumb">
                <?php get_template_part( 'template-parts/featured-property' ); ?>

                <div class="label-wrap label-right hide-on-list">
                    <?php get_template_part('template-parts/listing', 'status' ); ?>
                </div>

                <div class="price hide-on-list">
                    <?php echo houzez_listing_price_v1(); ?>
                </div>
                <a class="hover-effect" href="<?php the_permalink() ?>">
                    <?php
                    if( has_post_thumbnail( ) ) {
                        the_post_thumbnail( 'houzez-property-thumb-image' );
                    }else{
                        houzez_image_placeholder( 'houzez-property-thumb-image' );
                    }
                    ?>
                </a>
                <figcaption class="thumb-caption cap-actions clearfix">
                    <div class="pull-right">
                        <?php get_template_part( 'template-parts/share', 'favourite' ); ?>
                    </div>
                </figcaption>
            </figure>
        </div>
        <div class="item-body">

            <div class="body-left">
                <div class="info-row">

                    <?php
                    echo '<h3 class="property-title"><a href="'.esc_url( get_permalink() ).'">'. esc_attr( get_the_title() ). '</a></h3>';

                    if( !empty( $prop_address )) {
                        echo '<address class="property-address">'.esc_attr( $prop_address ).'</address>';
                    }
                    ?>
                </div>
                <div class="table-list full-width info-row">
                    <div class="cell">
                        <div class="info-row amenities">
                            <?php echo houzez_listing_meta_v1(); ?>
                            <p><?php echo houzez_taxonomy_simple('property_type'); ?></p>
                        </div>
                    </div>
                    <div class="cell">
                        <div class="phone">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary"> <?php esc_html_e( 'Details', 'houzez' ); ?> <i class="fa fa-angle-right fa-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="item-foot date hide-on-list">
        <div class="item-foot-left">
            <?php if( !empty( $prop_agent ) ) { ?>
                <p><i class="fa fa-user"></i> <a href="<?php echo esc_url($prop_agent_link); ?>"><?php echo esc_attr( $prop_agent ); ?></a></p>
            <?php } ?>
        </div>
        <div class="item-foot-right">
            <p><i class="fa fa-calendar"></i><?php printf( __( '%s ago', 'houzez' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></p>
        </div>
    </div>
</div>
