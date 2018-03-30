<?php

class SWPF_Tab_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'SWPF_Tab_Widget', // Base ID  
                'Sellya Tabs', // Name  
                array(
            'description' => __('Show Tab.', 'sellya')
                )
        );
    }

    public function form($instance) {
        $defaults = array(
            'title' => 'Sellya TABS',
            'sds_tab1_title' => 'Blog',
            'sds_tab2_title' => 'Archives',
            'sds_tab3_title' => 'Comments',
            'sds_tab4_title' => 'Tags',
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $sds_tab1 = esc_attr($instance['sds_tab1_title']);
        $sds_tab2 = esc_attr($instance['sds_tab2_title']);
        $sds_tab3 = esc_attr($instance['sds_tab3_title']);
        $sds_tab4 = esc_attr($instance['sds_tab4_title']);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'swpf') ?></label><BR/>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%; height:30px" />
        </p>


        <p>
            <label for="<?php echo $this->get_field_id('sds_tab1_title'); ?>"><?php _e('Tab One Title:', 'swpf') ?></label>
            <input type="text" id="<?php echo $this->get_field_id('sds_tab1_title'); ?>" name="<?php echo $this->get_field_name('sds_tab1_title'); ?>" value="<?php echo $sds_tab1; ?>" style="width:100%; height:30px" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sds_tab2_title'); ?>"><?php _e('Tab Two Title', 'swpf') ?></label>
            <input type="text" id="<?php echo $this->get_field_id('sds_tab2_title'); ?>" name="<?php echo $this->get_field_name('sds_tab2_title'); ?>" value="<?php echo $sds_tab2; ?>" style="width:100%; height:30px" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sds_tab3_title'); ?>"><?php _e('Tab Three Title:', 'swpf') ?></label>
            <input type="text" id="<?php echo $this->get_field_id('sds_tab3_title'); ?>" name="<?php echo $this->get_field_name('sds_tab3_title'); ?>" value="<?php echo $sds_tab3; ?>" style="width:100%; height:30px" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sds_tab4_title'); ?>"><?php _e('Tab Four Title:', 'swpf') ?></label>
            <input type="text" id="<?php echo $this->get_field_id('sds_tab4_title'); ?>" name="<?php echo $this->get_field_name('sds_tab4_title'); ?>" value="<?php echo $sds_tab4; ?>" style="width:100%; height:30px" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['sds_tab1_title'] = strip_tags($new_instance['sds_tab1_title']);
        $instance['sds_tab2_title'] = strip_tags($new_instance['sds_tab2_title']);
        $instance['sds_tab3_title'] = strip_tags($new_instance['sds_tab3_title']);
        $instance['sds_tab4_title'] = strip_tags($new_instance['sds_tab4_title']);
        return $instance;
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $sds_tab1 = $instance['sds_tab1_title'];
        $sds_tab2 = $instance['sds_tab2_title'];
        $sds_tab3 = $instance['sds_tab3_title'];
        $sds_tab4 = $instance['sds_tab4_title'];
        extract($args, EXTR_SKIP);
        echo $before_widget;
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        };
        ?>
        <div id="tab">
            <ul class="nav">
                <li class="nav-one"><a href="#r_blog" class="current"><?php echo $sds_tab1; ?></a></li>
                <li class="nav-two"><a href="#archive"><?php echo $sds_tab2; ?></a></li>
                <li class="nav-three"><a href="#comment"><?php echo $sds_tab3; ?></a></li>
                <li class="nav-four last"><a href="#tag"><?php echo $sds_tab4; ?></a></li>
            </ul>
            
                <div id="r_blog">
                    <?php
                    global $wpdb;
                    $query = new WP_Query('posts_per_page=5&post_status=publish&ignore_sticky_posts=1&order=DESC');
                    while ($query->have_posts()) : $query->the_post();
                        $image_id = get_post_thumbnail_id(get_the_ID());
                        $image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
                        ?>
                        <div class="third">

							<?php if(!empty($image_id)):?>
                            <img src="<?php echo  $image_url[0]; ?>" width="43" height="43" alt="" />
                            
                            <?php 
							else:
								the_post_thumbnail(array(43,43));
							
							endif;
							?>
                            <div class="tab_right">
                                <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span><br>
                                <small><a href="<?php the_permalink(); ?>"><i class="icon-calendar"></i>&nbsp;<?php echo get_the_date(); ?></a></small>
                            </div>
                        </div>

                    <?php endwhile;
                    ?>
                </div>

                <div id="archive">
                        <?php
                        
                        global $wpdb;

$archive= $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month , YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date DESC");
foreach($archive as $month) :
   
?>
	<p><i class="icon-calendar"></i>&nbsp;<a href="<?php echo home_url() ?>/?m=<?php echo $month->year; ?><?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>"><?php echo date("F", mktime(0, 0, 0, $month->month, 1, $month->year)).' '.$month->year .' ('.$month->post_count.')';?></a></p>

<?php
endforeach;

?>

                </div>

                <div id="comment">
        <?php
        $result = $wpdb->get_results("SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE $wpdb->posts.post_type = 'post' and comment_approved = '1' ORDER BY comment_date_gmt DESC LIMIT 5");
        foreach ($result as $values):
            ?>
                        <div class="third">
                        <?php echo get_avatar($values, '46'); ?>
                            <div class="tab_right">
                            
                                <span><a href="<?php echo get_permalink($values->ID); ?>#li-comment-<?php echo $values->comment_ID; ?>" title="<?php echo strip_tags($values->comment_author); ?><?php echo $values->post_title; ?>"><?php echo strip_tags($values->com_excerpt); ?></a></span><br>
                                <small><i class="icon-time"></i>&nbsp;<a href="<?php echo get_permalink($values->ID); ?>#li-comment-<?php echo $values->comment_ID; ?>"><?php echo date(get_option('date_format').' '.get_option('time_format'),strtotime($values->comment_date_gmt)); ?></a></small>
                            </div>         
                            
                        </div>



        <?php endforeach; ?>
                </div>
                <div id="tag">
                    <?php // $tags=wp_tag_cloud('smallest=10&largest=10&number=0&format=array'); 
					
						$args = array('hide_empty'=>false);
						
						$tags = get_terms('post_tag',$args);
						
					
					
                        foreach($tags as $tag){
                            echo "<a href='".get_term_link($tag->slug,'post_tag')."'>$tag->name</a>";
                        }
                    ?>
                </div>

        </div>
        <?php
        echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'register_widget( "SWPF_Tab_Widget" );'));
?>