<?php

/* Register Widgets */
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'id' => 'homepage-col1',
    'name'=>'Homepage Column 1',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
   'id' => 'homepage-col2',
    'name'=>'Homepage Column 2',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'id' => 'homepage-col3',
    'name'=>'Homepage Column 3',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));  
if ( function_exists('register_sidebar') )  
  register_sidebar(array(
    'id' => 'general-sidebar',
    'name'=>'General Sidebar',
    'before_widget' => '<div class="sidebar">',
    'after_widget' => '</div><div class="sidebar-bottom"></div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'id' => 'about-page',
    'name'=>'About Page',
    'before_widget' => '<div class="sidebar">',
    'after_widget' => '</div><div class="sidebar-bottom"></div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  )); 
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'id' => 'blog-sidebar',
    'name'=>'Blog Sidebar',
    'before_widget' => '<div class="sidebar">',
    'after_widget' => '</div><div class="sidebar-bottom"></div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'id' => 'bottom',
    'name'=>'bottom',
    'before_widget' => '<div class="footer-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
  
  
class PageBox_Widget extends WP_Widget {
  function PageBox_Widget() {
    $widgets_opt = array('description'=>'Display pages as small box in sidebar');
    parent::WP_Widget(false,$name= "Vulcan - Page to Box",$widgets_opt);
  }
  
  
  function form($instance) {
    global $post;
    
    $pageid         = isset($instance['pageid']) ? esc_attr($instance['pageid']) : '';
    $pagetitle      = isset($instance['pagetitle']) ? esc_attr($instance['pagetitle']) : '';
    $opt_childpage  = isset($instance['opt_childpage']) ? esc_attr($instance['opt_childpage']) : '';
    $pageexcerpt    = isset($instance['pageexcerpt']) ? esc_attr($instance['pageexcerpt']) : 20;
    
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
  ?>  
	 <p><small>Please select the page.</small></p>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>
  <p>
		<input class="checkbox" type="checkbox" <?php if ($opt_childpage == "on") echo "checked";?> id="<?php echo $this->get_field_id('opt_childpage'); ?>" name="<?php echo $this->get_field_name('opt_childpage'); ?>" />
		<label for="<?php echo $this->get_field_id('opt_childpage'); ?>"><small>Incude sub pages?</small></label><br />
    </p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $pageid         = isset($instance['pageid']) ? esc_attr($instance['pageid']) : '';
    $pagetitle      = isset($instance['pagetitle']) ? esc_attr($instance['pagetitle']) : '';
    $opt_childpage  = isset($instance['opt_childpage']) ? esc_attr($instance['opt_childpage']) : '';
    $pageexcerpt    = isset($instance['pageexcerpt']) ? esc_attr($instance['pageexcerpt']) : 20;
    
    $pagetitle = get_the_title($pageid); 
    echo $before_widget;
    echo $before_title.$pagetitle.$after_title;
    
    if ($opt_childpage == "on") {

      $aboutpagelist = new WP_Query('post_type=page&post_parent='.$pageid);
    	while ($aboutpagelist->have_posts()) : $aboutpagelist->the_post();      
      $thumb   = get_post_thumbnail_id();  
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $image   = aq_resize( $img_url, 223, 129, true ); //resize & crop the image
      ?>
        <?php if ($img_url) { ?>
        <img src="<?php echo $img_url;?>" alt="<?php the_title(); ?>" class="imgleft" />
        <?php } ?>
          <a href="<?php the_permalink();?>"><strong><?php the_title();?></strong></a><br />
				  <?php the_excerpt();?> 
      <?php
      endwhile;
    } else {      
    $aboutpage = new WP_Query('post_type=page&page_id='.$pageid);
    while ($aboutpage->have_posts()) : $aboutpage->the_post(); ?>       
      <p><?php the_excerpt();?></p>
    <?php
    endwhile;
    }
    
    echo $after_widget;
    wp_reset_query();
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("PageBox_Widget");'));

/* Latest News Widget */

class LatestNews_Widget extends WP_Widget {
  
  function LatestNews_Widget() {
    $widgets_opt = array('description'=>'Vulcan Latest News Theme Widget');
    parent::WP_Widget(false,$name= "Vulcan -  Latest News",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $catid = isset($instance['catid']) ? esc_attr($instance['catid']) : '';
    $newstitle = isset($instance['newstitle']) ? esc_attr($instance['newstitle']) : '';
    $numnews = isset($instance['numnews']) ? esc_attr($instance['numnews']) : '3';
    
    $categories_list = get_categories('hide_empty=0');
    
    $categories = array();
    foreach ($categories_list as $catlist) {
    	$categories[$catlist->cat_ID] = $catlist->cat_name;
    }

  ?>
    <p><label for="newstitle">Title:
  		<input id="<?php echo $this->get_field_id('newstitle'); ?>" name="<?php echo $this->get_field_name('newstitle'); ?>" type="text" class="widefat" value="<?php echo $newstitle;?>" /></label></p>  
	 <p><small>Please select category for <b>News</b>.</small></p>
		<select  name="<?php echo $this->get_field_name('catid'); ?>">  id="<?php echo $this->get_field_id('catid'); ?>" >
			<?php foreach ($categories as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $catid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>	
    <p><label for="numnews">Number to display:
  		<input id="<?php echo $this->get_field_id('numnews'); ?>" name="<?php echo $this->get_field_name('numnews'); ?>" type="text" class="widefat" value="<?php echo $numnews;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $catid = isset($instance['catid']) ? esc_attr($instance['catid']) : '';
    $newstitle = isset($instance['newstitle']) ? esc_attr($instance['newstitle']) : '';
    $numnews = isset($instance['numnews']) ? esc_attr($instance['numnews']) : '';
    
    if ($newstitle =="") $newstitle = "Latest News";
    if ($numnews == "") $numnews = 3;
    
    echo $before_widget;
    $title = $before_title.$newstitle.$after_title;
    indonez_latestnews($catid,$numnews,$title);    
    wp_reset_query();    
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("LatestNews_Widget");'));

/* Testimonial Widget */

class Testimonial_Widget extends WP_Widget {
  function Testimonial_Widget() {
    $widgets_opt = array('description'=>'Vulcan Testimonial Theme Widget');
    parent::WP_Widget(false,$name= "Vulcan - Testimonial",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $testititle = esc_attr($instance['testititle']);
    $numtesti = esc_attr($instance['numtesti']);
    
  ?>
    <p><label for="testititle">Title:
  		<input id="<?php echo $this->get_field_id('testititle'); ?>" name="<?php echo $this->get_field_name('testititle'); ?>" type="text" class="widefat" value="<?php echo $testititle;?>" /></label></p>	
    <p><label for="numtesti">Number to display:
  		<input id="<?php echo $this->get_field_id('numtesti'); ?>" name="<?php echo $this->get_field_name('numtesti'); ?>" type="text" class="widefat" value="<?php echo $numtesti;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $catid = apply_filters('catid',$instance['catid']);
    $testititle = apply_filters('testititle',$instance['testititle']);
    $numtesti = apply_filters('numtesti',$instance['numtesti']);    
    
    if ($numtesti == "") $numtesti = 1;
    if ($testititle == "") $testititle = __("Testimonials",'vulcan');
    echo $before_widget;
    $title = $before_title.$testititle.$after_title;
    indonez_testimonials($numtesti,$title);  
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Testimonial_Widget");'));

/* Team Widget */

class Staff_Widget extends WP_Widget {
  function Staff_Widget () {
    $widgets_opt = array('description'=>'Vulcan theme widget for displaying Staff of your company ');
    parent::WP_Widget(false,$name= "Vulcan - Staff",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $teamititle = esc_attr($instance['teamtitle']);
    $team_num = esc_attr($instance['team_num']);
    

  ?>
    <p><label for="teamtitle">Title:
  		<input id="<?php echo $this->get_field_id('teamtitle'); ?>" name="<?php echo $this->get_field_name('teamtitle'); ?>" type="text" class="widefat" value="<?php echo $teamtitle;?>" /></label></p>  
	 	<p><label for="team_num">Number to display:
  		<input id="<?php echo $this->get_field_id('team_num'); ?>" name="<?php echo $this->get_field_name('team_num'); ?>" type="text" class="widefat" value="<?php echo $team_num;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $team_num = apply_filters('team_num',$instance['team_num']);
    $teamtitle = apply_filters('teamtitle',$instance['teamtitle']);
    if ($teamtitle =="") $teamtitle = "Our Team";
    echo $before_widget;
    ?>
    <?php
    echo $before_title.$teamtitle.$after_title;
    query_posts(array( 'post_type' => 'staff', 'posts_per_page' => $team_num,"orderby" => 'date','order'=> 'DESC'));
 
    while ( have_posts() ) : the_post();   
    $thumb   = get_post_thumbnail_id();
    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    $image   = aq_resize( $img_url, 60, 60, true ); //resize & crop the image
    
    ?>
      <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) { ?>
        <img src="<?php echo $image;?>" alt="" class="imgleft border" />
      <?php } ?>
      <p><strong><a href="<?php the_permalink();?>"><?php the_title();?></a></strong><br /><?php echo excerpt(12);?></p>    
   <?php
   endwhile;
   ?>
   <?php
   wp_reset_query();    
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Staff_Widget");'));

/* Post to Homepage Box or Sidebar Box Widget */

class PostBox_Widget extends WP_Widget {
  function PostBox_Widget() {
    $widgets_opt = array('description'=>'Display Posts as small box in sidebar');
    parent::WP_Widget(false,$name= "Vulcan - Post to Box",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $postid = esc_attr($instance['postid']);
    $opt_thumbnail = esc_attr($instance['opt_thumbnail']);
    $postexcerpt = esc_attr($instance['postexcerpt']);
    
		$centitaposts = get_posts('numberposts=-1')
		?>  
	<p><label>Please select post display
			<select  name="<?php echo $this->get_field_name('postid'); ?>">  id="<?php echo $this->get_field_id('postid'); ?>" >
				<?php foreach ($centitaposts as $post) { ?>
			<option value="<?php echo $post->ID;?>" <?php if ( $postid  ==  $post->ID) { echo ' selected="selected" '; }?>><?php echo  the_title(); ?></option>
			<?php } ?>
			</select>
	</label></p>
  <p>
		<input class="checkbox" type="checkbox" <?php if ($opt_thumbnail == "on") echo "checked";?> id="<?php echo $this->get_field_id('opt_thumbnail'); ?>" name="<?php echo $this->get_field_name('opt_thumbnail'); ?>" />
		<label for="<?php echo $this->get_field_id('opt_thumbnail'); ?>"><small>display thumbnail?</small></label><br />
    </p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $postid = apply_filters('postid',$instance['postid']);
    $opt_thumbnail = apply_filters('opt_thumbnail',$instance['opt_thumbnail']);
    $postexcerpt = apply_filters('postexcerpt',$instance['postexcerpt']);
    if ($postexcerpt =="") $postexcerpt = 20;
    
    echo $before_widget;
    $postlist = new WP_Query('p='.$postid);
    
    while ($postlist->have_posts()) : $postlist->the_post();
    $thumb   = get_post_thumbnail_id();
    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    $image   = aq_resize( $img_url, 260, 100, true ); //resize & crop the image
    ?>
      <h3><?php the_title();?></h3>
        <?php if ($opt_thumbnail == "on") { ?>
        <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) { ?>      
        <div class="blog-box">
        <img src="<?php echo $image;?>" alt="" />
        </div>
        <?php } 
        } ?>           
      <p><?php the_excerpt();?><a href="<?php the_permalink();?>" class="readmore"><?php echo __('Read more','vulcan');?></a></p> 
    <?php      
    endwhile;
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("PostBox_Widget");'));

/* Client Widget */
class Client_Widget extends WP_Widget {
  function Client_Widget() {
    $widgets_opt = array('description'=>'Vulcan Client List Widget');
    parent::WP_Widget(false,$name= "Vulcan - Client List ",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $clienttitle = esc_attr($instance['clienttitle']);
    $numclient = esc_attr($instance['numclient']);
    
  ?>
    <p><label for="clienttitle">Title:
  		<input id="<?php echo $this->get_field_id('clienttitle'); ?>" name="<?php echo $this->get_field_name('clienttitle'); ?>" type="text" class="widefat" value="<?php echo $clienttitle;?>" /></label></p>    
	  <p><label for="numclient">Number to display:
  		<input id="<?php echo $this->get_field_id('numclient'); ?>" name="<?php echo $this->get_field_name('numclient'); ?>" type="text" class="widefat" value="<?php echo $numclient;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $clienttitle = apply_filters('clienttitle',$instance['clienttitle']);
    $numclient = apply_filters('numclient',$instance['numclient']);    
    
    if ($numclient == "") $numclient = 4;    
    if ($clienttitle == "") $clienttitle =__('Our Clients','vulcan');
            
    echo $before_widget;
    $title = $before_title.$clienttitle.$after_title;    
        
    indonez_clientslist($numclient,$title,"date",false);
    
    echo $after_widget;
            
   wp_reset_query();    
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Client_Widget");'));

/* Client Widget */
class Portfolio_Widget extends WP_Widget {
  function Portfolio_Widget() {
    $widgets_opt = array('description'=>'Vulcan Portfolio List Widget');
    parent::WP_Widget(false,$name= "Vulcan - Portfolio Widget",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $portfoliotitle = esc_attr($instance['portfoliotitle']);
    $numportfolio = esc_attr($instance['numportfolio']);
    
  ?>
    <p><label for="portfoliotitle">Title:
  		<input id="<?php echo $this->get_field_id('portfoliotitle'); ?>" name="<?php echo $this->get_field_name('portfoliotitle'); ?>" type="text" class="widefat" value="<?php echo $portfoliotitle;?>" /></label></p>    
    <p><label for="numportfolio">Number to display:
  		<input id="<?php echo $this->get_field_id('numportfolio'); ?>" name="<?php echo $this->get_field_name('numportfolio'); ?>" type="text" class="widefat" value="<?php echo $numportfolio;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $portfoliotitle = apply_filters('portfoliotitle',$instance['portfoliotitle']);
    $numportfolio = apply_filters('numportfolio',$instance['numportfolio']);    
    
    if ($numportfolio == "") $numportfolio = 4;
    if ($portfoliotitle == "") $portfoliotitle = "Latest Portfolio";
     
    echo $before_widget;
    $title = $before_title.$portfoliotitle.$after_title;
    
    if (is_home()) {
      $place = true;
    } else {
      $place = false;
    }
    indonez_latest_portfolio($numportfolio,$title,$place);
    
    echo $after_widget;
    
   wp_reset_query();    
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Portfolio_Widget");'));

/* Banner Advertisement Widget */
class AdsBanner_Widget extends WP_Widget {
  function AdsBanner_Widget () {
    $widgets_opt = array('description'=>'260x120 pixel Banner Advertisement Widget');
    parent::WP_Widget(false,$name= "Vulcan - Banner Advertisement",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $bannertitle = esc_attr($instance['bannertitle']);
    $banner_image1 = esc_attr($instance['banner_image1']);
    $banner_url1 = esc_attr($instance['banner_url1']);
    $banner_image2 = esc_attr($instance['banner_image2']);
    $banner_url2 = esc_attr($instance['banner_url2']);
    $banner_image3 = esc_attr($instance['banner_image3']);
    $banner_url3 = esc_attr($instance['banner_url3']);
    $banner_image4 = esc_attr($instance['banner_image4']);
    $banner_url4 = esc_attr($instance['banner_url4']);            
  ?>
    <p><label for="bannertitle">Title:
  		<input id="<?php echo $this->get_field_id('bannertitle'); ?>" name="<?php echo $this->get_field_name('bannertitle'); ?>" type="text" class="widefat" value="<?php echo $bannertitle;?>" /></label></p>    
    <p><label for="banner_image1">Banner Image #1  Source:
  		<input id="<?php echo $this->get_field_id('banner_image1'); ?>" name="<?php echo $this->get_field_name('banner_image1'); ?>" type="text" class="widefat" value="<?php echo $banner_image1;?>" /></label></p>
    <p><label for="banner_url1">Banner Url #1  Source:
  		<input id="<?php echo $this->get_field_id('banner_url1'); ?>" name="<?php echo $this->get_field_name('banner_url1'); ?>" type="text" class="widefat" value="<?php echo $banner_url1;?>" /></label></p>
    <p><label for="banner_image2">Banner Image #2  Source:
  		<input id="<?php echo $this->get_field_id('banner_image2'); ?>" name="<?php echo $this->get_field_name('banner_image2'); ?>" type="text" class="widefat" value="<?php echo $banner_image2;?>" /></label></p>
    <p><label for="banner_url2">Banner Url #2  Source:
  		<input id="<?php echo $this->get_field_id('banner_url2'); ?>" name="<?php echo $this->get_field_name('banner_url2'); ?>" type="text" class="widefat" value="<?php echo $banner_url2;?>" /></label></p>
    <p><label for="banner_image3">Banner Image #3  Source:
  		<input id="<?php echo $this->get_field_id('banner_image3'); ?>" name="<?php echo $this->get_field_name('banner_image3'); ?>" type="text" class="widefat" value="<?php echo $banner_image3;?>" /></label></p>
    <p><label for="banner_url3">Banner Url #3  Source:
  		<input id="<?php echo $this->get_field_id('banner_url3'); ?>" name="<?php echo $this->get_field_name('banner_url3'); ?>" type="text" class="widefat" value="<?php echo $banner_url3;?>" /></label></p>    
    <p><label for="banner_image4">Banner Image #4  Source:
  		<input id="<?php echo $this->get_field_id('banner_image4'); ?>" name="<?php echo $this->get_field_name('banner_image4'); ?>" type="text" class="widefat" value="<?php echo $banner_image4;?>" /></label></p>
    <p><label for="banner_url3">Banner Url #4  Source:
  		<input id="<?php echo $this->get_field_id('banner_url4'); ?>" name="<?php echo $this->get_field_name('banner_url4'); ?>" type="text" class="widefat" value="<?php echo $banner_url4;?>" /></label></p>            		
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $clenttitle = apply_filters('clenttitle',$instance['clenttitle']);
    
    $bannertitle = apply_filters('bannertitle',$instance['bannertitle']);
    $banner_image1 = apply_filters('banner_image1',$instance['banner_image1']);
    $banner_url1 = apply_filters('banner_url1',$instance['banner_url1']);
    $banner_image2 = apply_filters('banner_image2',$instance['banner_image2']);
    $banner_url2 = apply_filters('banner_url2',$instance['banner_url2']);
    $banner_image3 = apply_filters('banner_image3',$instance['banner_image3']);
    $banner_url3 = apply_filters('banner_url3',$instance['banner_url3']);
    $banner_image4 = apply_filters('banner_image4',$instance['banner_image4']);
    $banner_url4 = apply_filters('banner_url4',$instance['banner_url4']);  
    
    if ($bannertitle == "") $bannertitle = "Sponsor";
     
    echo $before_widget;
    echo $before_title.$bannertitle.$after_title;  
    ?>
    <ul class="ads-list">
      <li><a href="<?php echo $banner_url1;?>"><img src="<?php echo $banner_image1;?>" alt="" /></a></li>
      <li><a href="<?php echo $banner_url2;?>"><img src="<?php echo $banner_image2;?>" alt="" /></a></li>                    
      <li><a href="<?php echo $banner_url3;?>"><img src="<?php echo $banner_image3;?>" alt="" /></a></li>                                
      <li><a href="<?php echo $banner_url4;?>"><img src="<?php echo $banner_image4;?>" alt="" /></a></li>    
		</ul>
		<div class="clr"></div>
   <?php
   echo $after_widget;
   wp_reset_query();    
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("AdsBanner_Widget");'));

/* Twitter Widget */
class Twitter_Widget extends WP_Widget {
  function Twitter_Widget() {
    $widgets_opt = array('description'=>'display your latest twitter feed');
    parent::WP_Widget(false,$name= "Vulcan - Twitter Update",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $twittertitle = esc_attr($instance['twittertitle']);
    $twitternum = esc_attr($instance['twitternum']);

  ?>
    <p><label for="twittertitle">Title:
  		<input id="<?php echo $this->get_field_id('twittertitle'); ?>" name="<?php echo $this->get_field_name('twittertitle'); ?>" type="text" class="widefat" value="<?php echo $twittertitle;?>" /></label></p>
    <p><label for="twitternum">Number to dispay:
  		<input id="<?php echo $this->get_field_id('twitternum'); ?>" name="<?php echo $this->get_field_name('twitternum'); ?>" type="text" class="widefat" value="<?php echo $twitternum;?>" /></label></p>                            
	  <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    echo $before_widget;
    
    $twittertitle = apply_filters('twittertitle',$instance['twittertitle']);
    $twitternum = apply_filters('twitternum',$instance['twitternum']);
    
    if ($twittertitle =="") $twittertitle = "Twitter Update!";
    if ($twitternum =="") $twitternum = 4;
    
    $tweet_title = $before_title.$twittertitle.$after_title;
    $twitter_id = get_option('vulcan_twitter_id');
    $user_consumer_key = get_option('vulcan_user_consumer_key');
    $user_consumer_secret = get_option('vulcan_user_consumer_secret');
    $user_access_token = get_option('vulcan_user_access_token');
    $user_access_token_secret = get_option('vulcan_user_access_token_secret');
    
    echo indonez_get_twitter_timeline($tweet_title,$twitter_id, $twitternum, $user_consumer_key, $user_consumer_secret, $user_access_token, $user_access_token_secret);
    
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Twitter_Widget");'));

?>