<?php
class TFuse_Widget_Tabs extends WP_Widget {

    function TFuse_Widget_Tabs()
    {
        $widget_ops = array('classname' => '', 'description' => __("Display popular and recent posts","tfuse"));
        $this->WP_Widget('tabs', __('TFuse - Tabs Posts','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $items = apply_filters( 'widget_items', $instance['items'], $instance, $this->id_base);
        $popular_posts  = tfuse_shortcode_posts(array(
                                'sort' => 'popular',
                                'items' => $items,
                                'image_post' => true,
                                'image_width' => 54,
                                'image_height' => 54,
                                'image_class' => 'thumbnail',
                                'date_format' => 'F j, Y',
                                'date_post' => true
                            ));

        $latest_posts = tfuse_shortcode_posts(array(
                                'sort' => 'recent',
                                'items' => $items,
                                'image_post' => true,
                                'image_width' => 54,
                                'image_height' => 54,
                                'image_class' => 'thumbnail',
                                'date_format' => 'F j, Y',
                                'date_post' => true,
                            ));
        $return_html = '';
        $default_image = '<img src="'.get_template_directory_uri().'/images/recent_post_img.jpg'.'" width="54" height="54">';

        $return_html .= '<div class="tf_sidebar_tabs tabs_framed">
            <ul class="nav nav-tabs" id="tabs">
                <li class="active"><a href="#about">'.__('Latest','tfuse').'</a></li>
                <li><a href="#team">'.__('Popular','tfuse').'</a></li>
            </ul>';

        $return_html .= '<div class="tab-content">
                <div class="tab-pane active" id="about">
                    <div class="widget_recent_posts clearfix">
                        <ul class="post_list recent_posts">';
                            foreach ($popular_posts as $post_val) {
                                if($post_val['post_img']!='') $img = $post_val['post_img'];
                                else $img = $default_image;
                                $return_html .= '<li class="clearfix">';
                                $return_html .= '<a href="' .$post_val['post_link']. '" >' .$img. $post_val['post_title'] .'</a>';
                                if(tfuse_options('date_time')){
								    $return_html .=' <div class="date">' . $post_val['post_date_post'] . '</div>';
                                }
                                $return_html .= '</li>';
                            }
        $return_html .= '</ul></div></div>
                <div class="tab-pane" id="team">
                    <div class="widget_popular_posts clearfix">
                        <ul class="post_list popular_posts">';
                            foreach ($latest_posts as $post_val) {
                                if($post_val['post_img']!='') $img = $post_val['post_img'];
                                else $img = $default_image;
                                $return_html .= '<li class="clearfix">';
                                $return_html .= '<a href="' .$post_val['post_link']. '" >' .$img. $post_val['post_title'] .'</a>';
                                if(tfuse_options('date_time')){
								    $return_html .=' <div class="date">' . $post_val['post_date_post'] . '</div>';
                                }
                                $return_html .= '</li>';
                            }
        $return_html .= '</ul></div></div></div>
        <script>
            jQuery("#tabs a").click(function (e) {
                e.preventDefault();
                jQuery(this).tab("show");
            })
        </script>
        </div>';

        echo $return_html;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['items'] = $new_instance['items'];
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'items' => '') );
        $items = $instance['items'];
        ?>

        <p><label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items:','tfuse'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></p>
        <?php
   }
}
register_widget('TFuse_Widget_Tabs');