<?php
add_action('widgets_init', 'ad_300_300_load_widgets');
function ad_300_300_load_widgets(){
    register_widget('Ad_300_300_Widget');
}

class Ad_300_300_Widget extends WP_Widget {

function Ad_300_300_Widget(){
    $widget_ops = array('classname' => 'ad_300_300', 'description' => 'Add 300x300 ads.');
    $control_ops = array('id_base' => 'ad_300_300-widget');
    $this->WP_Widget('ad_300_300-widget', theme_name . ' - 300x300 Ads', $widget_ops, $control_ops);
}

function widget($args, $instance){

    extract($args);
    $title  = apply_filters('widget_title', $instance['title'] );
    $img    = $instance['img'];
    $link   = $instance['link'];
    $code   = $instance['code'];
    $no_bg  = $instance['no_bg'];

    if( !$no_bg ){
        echo $before_widget;
        if($title) {
            echo $before_title.$title.$after_title;
        }
    }
?>
<div <?php if( $no_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="<?php if( $no_bg ) echo 'widget no-bg '; ?>ads300">
<?php
    $ads = array(1);
    foreach($ads as $ad_count):
?>
<?php if($code != '') { ?>
<div class="ads-content">
<?php echo $code; ?>
</div>

<?php } else { ?>

<div class="ads-content">
    <span class="hold">
        <a href="<?php echo $link ?>">
            <img src="<?php echo $img ?>" alt="" />
        </a>
    </span>
</div>
<?php } ?>
<?php endforeach; ?>
</div>
<?php
    if( !$no_bg ){
        echo $after_widget;
    }
}

    function update( $new_instance, $old_instance ){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['img'] = $new_instance['img'];
        $instance['code'] = $new_instance['code'];
        $instance['link'] = $new_instance['link'];
        $instance['no_bg']= $new_instance['no_bg'];
        return $instance;
    }

    function form( $instance ){

        $defaults = array('title' =>__( 'Ads 300 x 300' , 'bd') ,'link'=>'#','img'=> get_template_directory_uri()."/images/adv300-250.png");
        $instance = wp_parse_args((array) $instance, $defaults);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'no_bg' ); ?>">Transparent Background : </label>
            <input id="<?php echo $this->get_field_id( 'no_bg' ); ?>" name="<?php echo $this->get_field_name( 'no_bg' ); ?>" value="true" <?php if( $instance['no_bg'] ) echo 'checked="checked"'; ?> type="checkbox" />
        </p>

        <p><strong>Ad 1</strong></p>
        <p>
            <label for="<?php echo $this->get_field_id('img'); ?>">Image Ad Link:</label>
            <input class="widefat"  style="width: 216px;" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" value="<?php echo $instance['img']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>">Ad Link:</label>
            <input class="widefat"  style="width: 216px;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $instance['link']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'code' ); ?>">Or Ads code:</label>
            <textarea id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>" class="widefat" ><?php echo $instance['code']; ?></textarea>
        </p>
    <?php
    }

}