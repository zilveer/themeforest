<?php
// =============================== Newsletetr widget ======================================
class TFuse_newsletter extends WP_Widget {

    function TFuse_newsletter() {
        $widget_ops = array('description' => '');
        parent::WP_Widget(false, __('TFuse - Newsletter', 'tfuse'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $newsletter_title = empty($instance['newsletter_title']) ? 'Newsletter' : esc_attr($instance['newsletter_title']);
        $rss = empty($instance['rss']) ? '' : esc_attr($instance['rss']);
        $text = apply_filters( 'widget_text', $instance['text'], $instance );
        ?>

        <div class="widget-container newsletter_subscription_box newsletterBox widget_newsletter">
            <?php if ($newsletter_title != '') { ?>
                <h4 class="widget_title"><?php echo tfuse_qtranslate($newsletter_title); ?></h4>
            <?php }
                if($text != ''){
                    echo '<p>'.$text.'</p>';
                }
            ?>
            <form action="#" method="post" class="newsletter_subscription_form">
                <input type="text" value="<?php _e('Enter your email address','tfuse'); ?>" name="newsletter" id="newsletter" class="newsletter_subscription_email inputField" onFocus="if (this.value == '<?php _e('Enter your email address','tfuse'); ?>') {this.value = '';}" onBlur="if (this.value == '') {this.value = '<?php _e('Enter your email address','tfuse'); ?>';}" />
                <input type="submit" value="<?php _e('Go',''); ?>" class="btn_submit newsletter_subscription_submit" />
                <div class="newsletter_subscription_ajax"><?php _e('Loading...','tfuse') ?></div>
                <div class="clear"></div><div class="newsletter_text"><?php if ($rss != '') { ?><a href="<?php echo tfuse_options('feedburner_url', get_bloginfo_rss('rss2_url')); ?>" class="link-news-rss"><?php _e('Also subscribe to ', 'tfuse'); ?> <span><?php _e('our RSS feed', 'tfuse'); ?></span></a><?php } ?></div>
                <div class="newsletter_subscription_messages before-text">
                    <div class="newsletter_subscription_message_success">
                        <?php _e('Thank you for your subscribtion.','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_wrong_email">
                        <?php _e('Your email format is wrong!','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_failed">
                        <?php _e("Sad, but we couldn't add you to our mailing list ATM.","tfuse") ?>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    function update($new_instance, $old_instance) {
        if ( current_user_can('unfiltered_html') )
            $instance['text'] =  $new_instance['text'];
        else
            $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('newsletter_title' => '', 'rss' => '', 'text' => ''));
        $newsletter_title = esc_attr($instance['newsletter_title']);
        $rss = esc_attr($instance['rss']);
        $text = format_to_edit($instance['text']);
        ?>
		
        <p>
            <label for="<?php echo $this->get_field_id('newsletter_title'); ?>"><?php _e('Title:', 'tfuse'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('newsletter_title'); ?>" value="<?php echo $newsletter_title; ?>" class="widefat" id="<?php echo $this->get_field_id('newsletter_title'); ?>" />
        </p>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
        <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('Activate RSS', 'tfuse'); ?>:</label>
            <?php if ($rss=='on') $checked = ' checked="checked" '; else $checked = ''; ?>
            <input <?php echo $checked; ?>  type="checkbox" name="<?php echo $this->get_field_name('rss'); ?>" class="checkbox" id="<?php echo $this->get_field_id('rss'); ?>" />
        </p>
    <?php
    }
}

register_widget('TFuse_newsletter');