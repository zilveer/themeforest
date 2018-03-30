<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/01/16
 * Time: 7:20 PM
 */
global $post;
$agent_display_option = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );
$prop_agent_display = get_post_meta( get_the_ID(), 'fave_agents', true );
$enable_contact_form_7_prop_detail = houzez_option('enable_contact_form_7_prop_detail');
$contact_form_agent_bottom = houzez_option('contact_form_agent_bottom');
$enableDisable_agent_forms = houzez_option('agent_forms');

$prop_agent_email = '';

if( $prop_agent_display != '-1' && $agent_display_option == 'agent_info' ) {

    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_agents', true );
    $prop_agent_fax = get_post_meta( $prop_agent_id, 'fave_agent_fax', true );
    $prop_agent_skype = get_post_meta( $prop_agent_id, 'fave_agent_skype', true );

    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_agents', true );
    $prop_agent_mobile = get_post_meta( $prop_agent_id, 'fave_agent_mobile', true );
    $prop_agent_phone = get_post_meta( $prop_agent_id, 'fave_agent_office_num', true );
    $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agent_email', true );
    $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);
    $prop_agent = get_the_title( $prop_agent_id );
    $thumb_id = get_post_thumbnail_id( $prop_agent_id );
    $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail', true );
    $prop_agent_photo_url = $thumb_url_array[0];
    $prop_agent_permalink = get_post_permalink( $prop_agent_id );

    $fave_author_facebook = get_post_meta( $prop_agent_id, 'fave_agent_facebook', true );
    $fave_author_twitter = get_post_meta( $prop_agent_id, 'fave_agent_twitter', true );
    $fave_author_linkedin = get_post_meta( $prop_agent_id, 'fave_agent_linkedin', true );
    $fave_author_googleplus = get_post_meta( $prop_agent_id, 'fave_agent_googleplus', true );
    $fave_author_youtube = get_post_meta( $prop_agent_id, 'fave_agent_youtube', true );

} elseif( $agent_display_option == 'author_info' ) {

    $author_id = $post->post_author;
    $prop_agent_skype = get_the_author_meta( 'fave_author_skype', $author_id );
    $fave_author_facebook = get_the_author_meta( 'fave_author_facebook', $author_id );
    $fave_author_twitter = get_the_author_meta( 'fave_author_twitter', $author_id );
    $fave_author_linkedin = get_the_author_meta( 'fave_author_linkedin', $author_id );
    $fave_author_googleplus = get_the_author_meta( 'fave_author_googleplus', $author_id );
    $fave_author_youtube = get_the_author_meta( 'fave_author_youtube', $author_id );

    $prop_agent = get_the_author();
    $prop_agent_permalink = get_author_posts_url( get_the_author_meta( 'ID' ) );
    $prop_agent_mobile = get_the_author_meta( 'fave_author_mobile' );
    $prop_agent_phone = get_the_author_meta( 'fave_author_phone' );
    $agent_num_call = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);
    $prop_agent_photo_url = get_the_author_meta( 'fave_author_custom_picture' );
    $prop_agent_email = get_the_author_meta( 'email' );
}
if( empty( $prop_agent_photo_url )) {
    $prop_agent_photo_url = get_template_directory_uri().'/images/profile-avatar.png';
}
$agent_email = is_email( $prop_agent_email );

if( $enableDisable_agent_forms != 0 && $agent_display_option != 'none') {
?>
    <div id="agent_bottom" class="detail-contact detail-block">
        <div class="detail-title">
            <h2 class="title-left"><?php esc_html_e( 'Contact info', 'houzez' ); ?></h2>
            <div class="title-right"><strong><a href="<?php echo esc_url($prop_agent_permalink); ?>"><?php esc_html_e( 'View my listing', 'houzez' ); ?></a></strong></div>
        </div>
        <div class="media agent-media">
            <div class="media-left">
                <a href="<?php echo esc_url($prop_agent_permalink); ?>">
                    <img src="<?php echo esc_url( $prop_agent_photo_url ); ?>" alt="<?php echo esc_attr( $prop_agent ); ?>" width="75" height="75">
                </a>
            </div>
            <div class="media-body">
                <dl>
                    <dt><?php esc_html_e( 'CONTACT AGENT', 'houzez' ); ?></dt>
                    <?php if( !empty( $prop_agent ) ) { ?>
                        <dd><i class="fa fa-user"></i> <?php echo esc_attr( $prop_agent ); ?></dd>
                    <?php } ?>
                    <dd>
                        <?php if( !empty( $prop_agent_phone ) ) { ?>
                            <span><i class="fa fa-phone"></i> <?php echo esc_attr( $prop_agent_phone );?></span>
                        <?php } ?>

                        <?php if( !empty( $prop_agent_mobile ) ) { ?>
                            <span><i class="fa fa-mobile"></i> <?php echo esc_attr( $prop_agent_mobile );?></span>
                        <?php } ?>

                        <?php if( !empty( $prop_agent_skype ) ) { ?>
                            <span><a href="skype:<?php echo esc_attr( $prop_agent_skype ); ?>?call"><i class="fa fa-skype"></i>  <?php echo esc_attr( $prop_agent_skype ); ?></a></span>
                        <?php } ?>

                    </dd>
                    <dd>
                        <?php if( !empty( $fave_author_facebook ) ) { ?>
                            <span><a class="btn-facebook" target="_blank" href="<?php echo esc_url( $fave_author_facebook ); ?>"><i class="fa fa-facebook-square"></i> <span>Facebook</span></a></span>
                        <?php } ?>

                        <?php if( !empty( $fave_author_twitter ) ) { ?>
                            <span><a class="btn-twitter" target="_blank" href="<?php echo esc_url( $fave_author_twitter ); ?>"><i class="fa fa-twitter-square"></i> <span>Twitter</span></a></span>
                        <?php } ?>

                        <?php if( !empty( $fave_author_linkedin ) ) { ?>
                            <span><a class="btn-linkedin" target="_blank" href="<?php echo esc_url( $fave_author_linkedin ); ?>"><i class="fa fa-linkedin-square"></i> <span>Linkedin</span></a></span>
                        <?php } ?>

                        <?php if( !empty( $fave_author_googleplus ) ) { ?>
                            <span><a class="btn-google-plus" target="_blank" href="<?php echo esc_url( $fave_author_googleplus ); ?>"><i class="fa fa-google-plus-square"></i> <span>Google Plus</span></a></span>
                        <?php } ?>

                        <?php if( !empty( $fave_author_youtube ) ) { ?>
                            <span><a class="btn-youtube" target="_blank" href="<?php echo esc_url( $fave_author_youtube ); ?>"><i class="fa fa-youtube-square"></i> <span>Youtube</span></a></span>
                        <?php } ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="detail-title-inner">
            <h4 class="title-inner"><?php esc_html_e( 'Inquire about this property', 'houzez' ); ?></h4>
        </div>
        <?php
        if( $enable_contact_form_7_prop_detail != 1 ) {
            if ($agent_email) { ?>
                <form method="post" action="#">
                    <input type="hidden" name="target_email" value="<?php echo antispambot($agent_email); ?>">
                    <input type="hidden" name="agent_contact_form_ajax"
                           value="<?php echo wp_create_nonce('agent-contact-form-nonce'); ?>"/>
                    <input type="hidden" name="property_permalink"
                           value="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
                    <input type="hidden" name="property_title"
                           value="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
                    <input type="hidden" name="action" value="houzez_agent_send_message">

                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" name="name"
                                       placeholder="<?php esc_html_e('Your Name', 'houzez'); ?>" type="text">
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" name="phone"
                                       placeholder="<?php esc_html_e('Phone', 'houzez'); ?>" type="text">
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" name="email"
                                       placeholder="<?php esc_html_e('Email', 'houzez'); ?>" type="email">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5"
                                          placeholder="<?php esc_html_e('Message', 'houzez'); ?>"><?php esc_html_e("Hello, I'm interested in", "houzez"); ?> [<?php echo get_the_title(); ?>]</textarea>
                            </div>
                        </div>
                    </div>
                    <button
                        class="agent_contact_form btn btn-orange"><?php esc_html_e('Request info', 'houzez'); ?></button>
                    <div class="form_messages"></div>
                </form>
            <?php }
        } else {
            if( !empty($contact_form_agent_bottom) ) {
                echo do_shortcode($contact_form_agent_bottom);
            }
        }?>

    </div>
<?php } ?>