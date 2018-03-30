<?php

class SWPF_Flickr_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'SWPF_Flickr_Widget', // Base ID  
                'Sellya Flickr', // Name  
                array(
                    'description' => __('This widget will show your flickr image.','sellya')
                )
                
        );
    }
    public function form($instance){ 
        $defaults = array(
            'title' => 'SWPF Flickr', 
            'showphoto' => 5, 
            'size' => 's',
            'display' => 'random',
            'layout' => 'x',
            'source' => 'user',
            'id' => '7392841@N04'
            );
         $instance = wp_parse_args((array) $instance, $defaults);
         $instance['display'];
        ?>
    
        <p>  
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'sellya'); ?></label>  
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:216px;" />  
        </p> 
       <table style="width:100%"> 
            <tr>
                <td colspan="2"><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID:','sellya'); ?></label><input id="<?php echo $this->get_field_id('id'); ?>" class="widefat"  name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $instance['id']; ?>"  style="width:214px;" /></td>
            </tr>
            <tr>
                <td colspan="2"><label for="<?php echo $this->get_field_id('showphoto'); ?>"><?php _e('Number of Photos:','sellya'); ?></label><input id="<?php echo $this->get_field_id('showphoto'); ?>" class="widefat"  name="<?php echo $this->get_field_name('showphoto'); ?>" value="<?php echo $instance['showphoto']; ?>" style="width:214px;"  /></td>
            </tr>
             <tr>
                <td>
                 <label for="<?php echo $this->get_field_id('Display'); ?>"><?php _e('Display :', 'sellya'); ?></label>
                 <td>
                     <select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
			<option <?php if($instance['display']=='latest') echo 'selected="selected"'; ?> value="latest">Latest</option>
			<option <?php if($instance['display']=='random') echo 'selected="selected"'; ?> value="random" >Random</option>
                    </select>
                </td>
            </tr>
            <?php /*
            <tr>
                <td><label for="<?php echo $this->get_field_id('source'); ?>"><?php _e('Source :', 'swpf'); ?></label>
                </td>
                <td>
                     <select id="<?php echo $this->get_field_id('source'); ?>" name="<?php echo $this->get_field_name('source'); ?>">
			<option <?php if($instance['source']=='user') echo 'selected="selected"'; ?> value="user">User</option>
			<option <?php if($instance['source']=='group') echo 'selected="selected"'; ?> value="group" >Group</option>
                    </select>
                </td>
            </tr>
            <tr>*/?>
                <td>
                    <label for="<?php echo $this->get_field_id('Size'); ?>"><?php _e('Size :', 'sellya'); ?></label></td>
                <td>
                    <select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
			<option <?php if($instance['size']=='s') echo 'selected="selected"'; ?> value="s">Square</option>
			<option <?php if($instance['size']=='t') echo 'selected="selected"'; ?> value="t" >Thumbnail</option>
                        <option <?php if($instance['size']=='m') echo 'selected="selected"';?> value="m" >Mid-size</option>
                    </select>
                </td>
            </tr>
           
        </table> 
        <?php
    }
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['showphoto'] = strip_tags($new_instance['showphoto']);
        $instance['display'] = strip_tags($new_instance['display']);
        $instance['size'] = strip_tags($new_instance['size']);
        $instance['layout'] = strip_tags($new_instance['layout']);
       // $instance['source'] = strip_tags($new_instance['source']);
        $instance['id'] = strip_tags($new_instance['id']);
        return $instance;
    }
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
         $showphoto=$instance['showphoto'];
         $display=$instance['display'];
         $size=$instance['size'];
         $layout=$instance['layout'];
        // $source=$instance['source'];
         $id=$instance['id'];
         extract($args, EXTR_SKIP);
            echo $before_widget;
   
   		$source = 'user'; //source = 'group' does not seem to be worked. That's why $source assigned with 'user'
?>
 <style type="text/css">

.swpf_flickr {
    float: left;
    margin: 0 0 30px;
    width: 100%;
       
}
.swpf_flickr a{
       float: left;
        list-style: none outside none;
        margin-right: 2.8%;
}

.swpf_flickr img {
   <?php
    if($size=='s'):
      echo "width: 45px;  height: 45px;";
    elseif($size=='t'):
       echo "width: 97px;  height: 75px;";
     elseif($size=='m'):
       echo "width: 199px;  height: 149px;";
    endif;
   ?>
}
.swpf_flickr img {
      margin-bottom: 5px!important;
       
}


            </style>
        <?php 
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
            
            
               	echo '<div class="swpf_flickr">';
                    echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$showphoto.'&amp;display='. $display.'&amp;size='.$size.'&amp;layout='.$layout.'&amp;source='. $source.'&amp;'. $source.'='. $id .'"></script>'; 
		echo '</div>';
            echo $after_widget;
         
    }

}
add_action('widgets_init', create_function('', 'register_widget( "SWPF_Flickr_Widget" );'));
?>