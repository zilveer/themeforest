<?php

global $exclude;
$exclude=array();

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
        
            if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 Views";
    }   
    return $count.' Views'; 
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Add view counter to each page

add_filter ('the_content', 'view_counter');
function view_counter($content) {
  if(is_single() && !is_page()) {
      setPostViews(get_the_ID());
  }
   return $content;
}

// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views','2035Themes-fm');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}

// add widget to sidebar

class PopularPostsWidget extends WP_Widget
{
  function PopularPostsWidget()
  {
    $widget_ops = array('classname' => 'PopularPostsWidget', 'description' => 'Displays a list of the most viewed content.' );
    $this->WP_Widget('PopularPostsWidget', '[ CUSTOM ] Most Popular Post ', $widget_ops);
      }
 


    function form( $instance ) {

    $defaults = array(
            'title' => 'Most Popular',
            'max' => '3',
            'slider' => '',
      );
        $instance = wp_parse_args( (array) $instance, $defaults );?>


        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __('Title:','theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php echo __('Number of posts/pages to show:','theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" />
        </p>
        
         <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['slider'], 'on'); ?> id="<?php echo $this->get_field_id('slider'); ?>" name="<?php echo $this->get_field_name('slider'); ?>" /> 
            <label for="<?php echo $this->get_field_id('slider'); ?>"><?php echo __('Show in Slider', 'theme2035'); ?></label>
        </p>


        <?php
 }
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['max'] = $new_instance['max'];
    $instance['exclude'] = $new_instance['exclude'];
    $instance['showviews'] = $new_instance['showviews'];
    $instance['reset'] = $new_instance['reset'];
    $instance['slider'] = $new_instance['slider'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 $exclude=array();
  echo $before_widget;


  $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
  $max = empty($instance['max']) ? ' ' : apply_filters('widget_title', $instance['max']);
  $showviews = empty($instance['showviews']) ? ' ' : apply_filters('widget_title', $instance['showviews']);
  $exclude = empty($instance['exclude']) ? ' ' : apply_filters('widget_title', $instance['exclude']);
  $reset = empty($instance['reset']) ? ' ' : apply_filters('widget_title', $instance['reset']);
  $slider = empty($instance['slider']) ? ' ' : apply_filters('widget_title', $instance['slider']);
     if (!empty($title))
      echo $before_title . $title . $after_title;      
 
    // WIDGET CODE GOES HERE        
?>

    <?php if($slider == "on" ){ ?>
    <div class="flexslider slider-post-widget marginb20">
      <ul class="slides">
    <?php } else { ?>
      <div class="recent-post-custom">
      <?php } ?>

<?php setPostViews(get_the_ID());
$ex=explode(",",$exclude);
query_posts(array('meta_key'=> 'post_views_count','posts_per_page'=>$max,'ignore_sticky_posts'    => 1,'orderby'=>'meta_value_num','order'=>'DESC','post_type' => array('post'), 'post__not_in' =>$ex)); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); 
if ($reset=="Yes") { 
$id=get_the_ID();
update_post_meta($id, 'post_views_count','0');
}
else {
$reset="No";
}

?>

              <?php if($slider == "on" ){



$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-slider-3-grid' );
              $image = $image[0];
          
              if($image == ""){

                $image = IMAGES."/slider-no-image-3.jpg"; 

              }



               ?>
            
              
              <li class="slide-block home-slider-3-grid">
                <img class="img-responsive" src="<?php echo esc_attr($image);?>" />
                <div class="slider-content">
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <date><?php echo $post_date = the_time('F j'); ?></date>
                </div>
              </li>
            
              <?php } else { ?>

                <div class="recent-post-box marginb20 clearfix">
                  <div class="recent-post-image"> 
                    <?php if (has_post_thumbnail() ){ the_post_thumbnail('thumbnail'); } else { echo '<img src="'.IMAGES.'/slider-no-image-3.jpg">'; } ?> 
                  </div>
                  <div class="recent-post-title-cont"> 
                    <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                    <div class="time"><?php echo esc_attr($post_date = the_time('F j')); ?></div>
                  </div>
                </div>

              <?php } ?>
          

<?php endwhile; endif; wp_reset_query(); ?>
        <?php if($slider == "on" ){ ?>
          </ul>
          </div>
          <?php } else { ?>
          </div>
          <?php } ?>
<?php 

// END WIDGET CODE

    echo $after_widget;  
}
}
add_action( 'widgets_init', create_function('', 'return register_widget("PopularPostsWidget");') );

?>