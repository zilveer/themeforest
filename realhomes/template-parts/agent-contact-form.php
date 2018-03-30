<?php
if ( is_singular( 'agent' ) ) {
    global $post;
    $agent_email = get_post_meta( $post->ID, 'REAL_HOMES_agent_email', true );
} else if ( is_author() ){
    global $current_author;
    $agent_email = $current_author->user_email;
}

$agent_email = is_email( $agent_email );

if( $agent_email ) {
    ?>
    <hr/>
    <h5><?php _e('Send a Message', 'framework'); ?></h5>
    <form id="agent-single-form" class="" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>">

        <div class="row-fluid">
            <div class="span6">
                <input type="text" name="name" id="name" placeholder="<?php _e('Name', 'framework'); ?>" class="required" title="<?php _e('* Please provide your name', 'framework'); ?>">
            </div>

            <div class="span6">
                <input type="text" name="email" id="email" placeholder="<?php _e('Email', 'framework'); ?>" class="email required" title="<?php _e('* Please provide valid email address', 'framework'); ?>">
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <textarea  name="message" id="comment" class="required" placeholder="<?php _e('Message', 'framework'); ?>" title="<?php _e('* Please provide your message', 'framework'); ?>"></textarea>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12 agent-recaptcha">
                <?php
                /* Display recaptcha if enabled and configured from theme options */
                get_template_part('recaptcha/custom-recaptcha');
                ?>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('agent_message_nonce'); ?>"/>
                <input type="hidden" name="target" value="<?php echo antispambot( $agent_email ); ?>">
                <input type="hidden" name="action" value="send_message_to_agent" />
                <input type="submit" id="submit-button" value="<?php _e('Send Message','framework'); ?>"  name="submit" class="real-btn">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="ajax-loader" alt="Loading...">
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div id="error-container"></div>
                <div id="message-container">&nbsp;</div>
            </div>
        </div>

    </form>
    <?php
}