<?php
add_action('widgets_init', 'ad_125_125_load_widgets');
function ad_125_125_load_widgets(){
	register_widget('Ad_125_125_Widget');
}

class Ad_125_125_Widget extends WP_Widget {
	
function Ad_125_125_Widget(){
    $widget_ops = array('classname' => 'ad_125_125', 'description' => 'Add 125x125 ads.');
    $control_ops = array('id_base' => 'ad_125_125-widget');
    $this->WP_Widget('ad_125_125-widget', theme_name . ' - 125x125 Ads', $widget_ops, $control_ops);
}
	
function widget($args, $instance){

    extract($args);
    $title = apply_filters('widget_title', $instance['title'] );

    $ad_125_img_1 = $instance['ad_125_img_'.$ad_count];
    $ad_125_link_1 = $instance['ad_125_link_'.$ad_count];
    $ad_125_code_1 = $instance['ad_125_code_'.$ad_count];
    $ad_125_img_2 = $instance['ad_125_img_'.$ad_count];
    $ad_125_link_2 = $instance['ad_125_link_'.$ad_count];
    $ad_125_code_2 = $instance['ad_125_code_'.$ad_count];
    $ad_125_img_3 = $instance['ad_125_img_'.$ad_count];
    $ad_125_link_3 = $instance['ad_125_link_'.$ad_count];
    $ad_125_code_3 = $instance['ad_125_code_'.$ad_count];
    $ad_125_img_4 = $instance['ad_125_img_'.$ad_count];
    $ad_125_link_4 = $instance['ad_125_link_'.$ad_count];
    $ad_125_code_4 = $instance['ad_125_code_'.$ad_count];

    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
?>
<div class="ads125">
<?php
$ads = array(1, 2, 3, 4);
foreach($ads as $ad_count):
?>

<?php if($instance['ad_125_code_'.$ad_count]) { ?>
<div class="ads-content">
<?php echo $instance['ad_125_code_'.$ad_count]; ?>
</div>
<?php } else { ?>
<div class="ads-content">
<span class="hold">
<a href="<?php echo $instance['ad_125_link_'.$ad_count]; ?>">
<img src="<?php echo $instance['ad_125_img_'.$ad_count]; ?>" alt=""  />
</a>
</span>
</div>
<?php } ?>
<?php endforeach; ?>
</div>
<?php
    echo $after_widget;
}
	
function update( $new_instance, $old_instance ){
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['ad_125_img_1'] = $new_instance['ad_125_img_1'];
    $instance['ad_125_link_1'] = $new_instance['ad_125_link_1'];
    $instance['ad_125_code_1'] = $new_instance['ad_125_code_1'];
    $instance['ad_125_img_2'] = $new_instance['ad_125_img_2'];
    $instance['ad_125_link_2'] = $new_instance['ad_125_link_2'];
    $instance['ad_125_code_2'] = $new_instance['ad_125_code_2'];
    $instance['ad_125_img_3'] = $new_instance['ad_125_img_3'];
    $instance['ad_125_link_3'] = $new_instance['ad_125_link_3'];
    $instance['ad_125_code_3'] = $new_instance['ad_125_code_3'];
    $instance['ad_125_img_4'] = $new_instance['ad_125_img_4'];
    $instance['ad_125_link_4'] = $new_instance['ad_125_link_4'];
    $instance['ad_125_code_4'] = $new_instance['ad_125_code_4'];
    return $instance;
}

function form( $instance ){

    $defaults = array('title' =>__( 'Ads 125' , 'bd') ,'ad_125_link_1'=>'#','ad_125_link_2'=>'#','ad_125_link_3'=>'#','ad_125_link_4'=>'#','ad_125_img_1'=> get_template_directory_uri()."/images/adv125.png",'ad_125_img_2'=> get_template_directory_uri()."/images/adv125.png",'ad_125_img_3'=> get_template_directory_uri()."/images/adv125.png",'ad_125_img_4'=> get_template_directory_uri()."/images/adv125.png" );
    $instance = wp_parse_args((array) $instance, $defaults);

    ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
        <input style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p><strong>Ad 1</strong></p>
    <p>
        <label for="<?php echo $this->get_field_id('ad_125_img_1'); ?>">Image Ad Link:</label>
        <input  style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_img_1'); ?>" name="<?php echo $this->get_field_name('ad_125_img_1'); ?>" value="<?php echo $instance['ad_125_img_1']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('ad_125_link_1'); ?>">Ad Link:</label>
        <input  style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_link_1'); ?>" name="<?php echo $this->get_field_name('ad_125_link_1'); ?>" value="<?php echo $instance['ad_125_link_1']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'ad_125_code_1' ); ?>">Or Ads code:</label>
        <textarea id="<?php echo $this->get_field_id( 'ad_125_code_1' ); ?>" name="<?php echo $this->get_field_name( 'ad_125_code_1' ); ?>" class="widefat" ><?php echo $instance['ad_125_code_1']; ?></textarea>
    </p>

    <p><strong>Ad 2</strong></p>
    <p>
        <label for="<?php echo $this->get_field_id('ad_125_img_2'); ?>">Image Ad Link:</label>
        <input  style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_img_2'); ?>" name="<?php echo $this->get_field_name('ad_125_img_2'); ?>" value="<?php echo $instance['ad_125_img_2']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('ad_125_link_2'); ?>">Ad Link:</label>
        <input  style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_link_2'); ?>" name="<?php echo $this->get_field_name('ad_125_link_2'); ?>" value="<?php echo $instance['ad_125_link_2']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'ad_125_code_2' ); ?>">Or Ads code:</label>
        <textarea id="<?php echo $this->get_field_id( 'ad_125_code_2' ); ?>" name="<?php echo $this->get_field_name( 'ad_125_code_2' ); ?>" class="widefat" ><?php echo $instance['ad_125_code_2']; ?></textarea>
    </p>

    <p><strong>Ad 3</strong></p>
    <p>
        <label for="<?php echo $this->get_field_id('ad_125_img_3'); ?>">Image Ad Link:</label>
        <input  style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_img_3'); ?>" name="<?php echo $this->get_field_name('ad_125_img_3'); ?>" value="<?php echo $instance['ad_125_img_3']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('ad_125_link_3'); ?>">Ad Link:</label>
        <input  style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_link_3'); ?>" name="<?php echo $this->get_field_name('ad_125_link_3'); ?>" value="<?php echo $instance['ad_125_link_3']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'ad_125_code_3' ); ?>">Or Ads code:</label>
        <textarea id="<?php echo $this->get_field_id( 'ad_125_code_3' ); ?>" name="<?php echo $this->get_field_name( 'ad_125_code_3' ); ?>" class="widefat" ><?php echo $instance['ad_125_code_3']; ?></textarea>
    </p>

    <p><strong>Ad 4</strong></p>
    <p>
        <label for="<?php echo $this->get_field_id('ad_125_img_4'); ?>">Image Ad Link:</label>
        <input  style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_img_4'); ?>" name="<?php echo $this->get_field_name('ad_125_img_4'); ?>" value="<?php echo $instance['ad_125_img_4']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('ad_125_link_4'); ?>">Ad Link:</label>
        <input  style="width: 216px;" id="<?php echo $this->get_field_id('ad_125_link_4'); ?>" name="<?php echo $this->get_field_name('ad_125_link_4'); ?>" value="<?php echo $instance['ad_125_link_4']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'ad_125_code_4' ); ?>">Or Ads code:</label>
        <textarea id="<?php echo $this->get_field_id( 'ad_125_code_4' ); ?>" name="<?php echo $this->get_field_name( 'ad_125_code_4' ); ?>" class="widefat" ><?php echo $instance['ad_125_code_4']; ?></textarea>
    </p>
<?php
}

}