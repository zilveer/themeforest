<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/01/16
 * Time: 7:56 PM
 */
global $post;

$agent_display_option = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );
$prop_agent_display = get_post_meta( get_the_ID(), 'fave_agents', true );
$enable_contact_form_7_prop_detail = houzez_option('enable_contact_form_7_prop_detail');
$contact_form_agent_above_image = houzez_option('contact_form_agent_above_image');
$prop_agent_num = $agent_num_call = $prop_agent_email = '';

if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {
    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_agents', true );
    $prop_agent_phone = get_post_meta( $prop_agent_id, 'fave_agent_office_num', true );
    $prop_agent_mobile = get_post_meta( $prop_agent_id, 'fave_agent_mobile', true );
    $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agent_email', true );
    $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);
    $prop_agent = get_the_title( $prop_agent_id );
    $thumb_id = get_post_thumbnail_id( $prop_agent_id );
    $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail', true );
    $prop_agent_photo_url = $thumb_url_array[0];
    $prop_agent_permalink = get_post_permalink( $prop_agent_id );

} elseif ( $agent_display_option == 'author_info' ) {
    $prop_agent = get_the_author();
    $prop_agent_permalink = get_author_posts_url( get_the_author_meta( 'ID' ) );
    $prop_agent_phone = get_the_author_meta( 'fave_author_phone' );
    $prop_agent_mobile = get_the_author_meta( 'fave_author_mobile' );
    $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_num);
    $prop_agent_photo_url = get_the_author_meta( 'fave_author_custom_picture' );
    $prop_agent_email = get_the_author_meta( 'email' );
}
if( empty( $prop_agent_photo_url )) {
    $prop_agent_photo_url = get_template_directory_uri().'/images/profile-avatar.png';
}

$agent_email = is_email( $prop_agent_email );
?>
<div class="media agent-media">
    <div class="media-left">
        <a href="<?php echo esc_url($prop_agent_permalink); ?>">
            <img src="<?php echo esc_url( $prop_agent_photo_url ); ?>" alt="<?php echo esc_attr( $prop_agent ); ?>" width="75" height="75">
        </a>
    </div>
    <div class="media-body">
        <dl>
            <dt><?php esc_html_e('CONTACT AGENT', 'houzez' ); ?></dt>
            <?php if( !empty( $prop_agent ) ) { ?>
            <dd><i class="fa fa-user"></i> <?php echo esc_attr( $prop_agent ); ?></dd>
            <?php } ?>

            <?php if( !empty( $prop_agent_mobile ) ) { ?>
            <dd><i class="fa fa-phone"></i> <?php echo esc_attr( $prop_agent_mobile );?></dd>
            <?php } ?>
            <dd><a href="<?php echo esc_url($prop_agent_permalink); ?>" class="view"><?php esc_html_e('View my listing', 'houzez' ); ?></a></dd>
        </dl>

    </div>
</div>
<?php
if( $enable_contact_form_7_prop_detail != 0 ) {
    if( !empty($contact_form_agent_above_image) ) {
        echo do_shortcode($contact_form_agent_above_image);
    }
} else {
    if ($agent_email) { ?>
        <form method="post" action="#">
            <input type="hidden" name="target_email" value="<?php echo antispambot($agent_email); ?>">
            <input type="hidden" name="agent_contact_form_ajax"
                   value="<?php echo wp_create_nonce('agent-contact-form-nonce'); ?>"/>
            <input type="hidden" name="property_permalink" value="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
            <input type="hidden" name="property_title" value="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
            <input type="hidden" name="action" value="houzez_agent_send_message">

            <div class="form-group">
                <input class="form-control" name="name" type="text"
                       placeholder="<?php esc_html_e('Your Name', 'houzez'); ?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="phone" type="text"
                       placeholder="<?php esc_html_e('Phone', 'houzez'); ?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="email" type="email"
                       placeholder="<?php esc_html_e('Email', 'houzez'); ?>">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" rows="5"
                          placeholder="<?php esc_html_e('Description', 'houzez'); ?>"><?php esc_html_e("Hello, I'm interested in", "houzez"); ?>[<?php echo get_the_title(); ?>]</textarea>
            </div>
            <button class="agent_contact_form btn btn-orange btn-block"><?php esc_html_e('Request info', 'houzez'); ?></button>
            <div class="form_messages"></div>
        </form>
    <?php }
}?>