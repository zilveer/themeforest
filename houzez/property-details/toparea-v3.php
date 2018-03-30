<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 4:16 PM
 */
global $post, $property_map, $property_streetView, $prop_agent_email;

$agent_display_option = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );
$prop_agent_display = get_post_meta( get_the_ID(), 'fave_agents', true );
$prop_agent_num = $agent_num_call = $prop_agent_email = '';

if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {
    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_agents', true );
    $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agent_email', true );

} elseif ( $agent_display_option == 'author_info' ) {
    $prop_agent_email = get_the_author_meta( 'email' );
}

?>
<section class="detail-top detail-top-grid no-margin hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php get_template_part( 'property-details/header', 'detail' ); ?>
            </div>
        </div>
    </div>
</section>