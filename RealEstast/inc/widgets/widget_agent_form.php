<?php
/**
 * Created by PhpStorm.
 * User: Ahn
 * Date: 3/13/14
 * Time: 3:12 PM
 */

class PGL_Widget_Agent_Form extends WP_Widget
{
    function __construct()
    {
        $widget_options = array(
            'classname' => 'agent-form',
            'description' => __('Agent contact form', PGL)
        );
        parent::__construct('agent_form', __('Agent contact form', PGL), $widget_options);
    }
    function form( $instance ) {
        $instance = wp_parse_args( $instance, array(
            'display_as' => 'button'
        ) );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('display_as');	?>"><?php _e('Display as', PGL)?></label>
            <select class="widefat" name="<?php echo $this->get_field_name('display_as');?>" id="<?php echo $this->get_field_name('display_as');?>">
                <option value="button"<?php echo $instance['display_as'] == 'button'? ' selected':''?>><?php _e('Button', PGL)?></option>
                <option value="form"<?php echo $instance['display_as'] == 'form'? ' selected':''?>><?php _e('Form', PGL)?></option>
            </select>
        </p>
    <?php
    }
    function widget($args, $instance){
        global $post;
        $agent_ids = get_post_meta($post->ID,'agent_id');
        $display = empty($instance['display_as'])?'button':$instance['display_as'];
        if($post->post_type != 'estate' || !$agent_ids){
            return false;
        }
        extract($args);
        echo $before_widget;
        ?>
        <?php if($display=='button'): ?>
        <button type="button" class="btn btn-block" data-toggle="collapse" data-target="#form-wrap">
            <?php _e('Contact agent', PGL);?>
        </button>
        <div id="form-wrap" class="collapse">
            <br />
        <?php endif;?>
            <form class="form" id="agent_contact" method="post">
                <fieldset>
                    <?php wp_nonce_field('handle_agent_form', 'nonce_agent_form')?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="contact-name" name="contact_name" placeholder="<?php _e('Name', PGL);?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" id="contact-email" name="contact_email" placeholder="<?php _e('Email', PGL);?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control" id="contact-phone" name="contact_phone" placeholder="<?php _e('Phone', PGL);?>"/>
                        </div>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm hidden-xs">
                        <input type="text" class="form-control" id="contact-url" name="contact_url"/>
                    </div>
                    <?php echo self::getAgentSelect($agent_ids)?>
                    <div class="form-group">
                        <textarea type="text" id="contact-message" class="form-control"  name="contact_message" rows="5" cols="40" placeholder="Your Message"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary"><?php _e('Send message', PGL)?></button>
                    </div>
                </fieldset>
            </form>
        <?php if($display=='button'): ?>
        </div>

        <?php endif;?>
<?php
        echo $after_widget;
    }
    function getAgentSelect($ids){
        if(is_array($ids)){
            if(count($ids)>1){
            $slText = __('Select agent', PGL);
            $html = <<<HTML
                <div class="form-group">
                    <select name="agent_email" class="form-control">
                        <option value="">{$slText}</option>
HTML;
            foreach($ids as $id){
                $agent = get_post($id);
                $agent_mail = get_post_meta( $agent->ID, 'agent_email', TRUE );
                $html .= '<option value="'.$agent_mail.'">'.$agent->post_title.'</option>';
            }
            $html .= <<<HTML
                    </select>
                </div>
HTML;

            return $html;
            }else{
                return '<input type="hidden" name="agent_email" value="'.get_post_meta( $ids[0], 'agent_email', TRUE ).'"/>';
            }
        }
        return '<input type="hidden" name="agent_email" value="'.bloginfo('admin_email').'"/>';
    }
}