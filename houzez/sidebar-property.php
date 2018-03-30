<?php
/**
 * Sidebar Property
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 4:28 PM
 */
global $post;
$agent_form = houzez_option('agent_contact_in_sidebar');
$agent_form_mobile = houzez_option('agent_contact_in_sidebar_mobile');
$mobile_hidden = '';
if( $agent_form_mobile != 1 ) {
    $mobile_hidden = 'hidden-sm hidden-xs';
}

if( isset( $_GET['agent_form']) && $_GET['agent_form'] == 'yes' ) {
    $agent_form = 1;
}
?>
<aside id="sidebar" class="sidebar-white">
    <?php
    if( is_singular('property') ) { 

        if( $agent_form != 0 ) {
        ?>

        <div class="widget widget-contact-agent <?php echo esc_attr( $mobile_hidden ); ?>">
            <div class="widget-body">
                <div class="form-small">
                    <?php get_template_part( 'property-details/agent', 'form' ); ?>
                </div>
            </div>
        </div>

        <?php } ?>

        <?php
        if( is_active_sidebar( 'single-property' ) ) {
            dynamic_sidebar( 'single-property' );
        }
    } else {
        if( is_active_sidebar( 'property-listing' ) ) {
            dynamic_sidebar( 'property-listing' );
        }
    }

    ?>
</aside>