<?php 
	/*
	 * This file is used to generate single post page.
	 */	
get_header(); ?>
<?php
		// Sidebar check and class
		$sidebar = get_post_meta($post->ID,'post-option-sidebar-template',true);
		global $default_post_sidebar;
		$bcontainer_class = '';
		$sidebar_class = '';
		if( empty( $sidebar ) ){ $sidebar = $default_post_sidebar; }
		  if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
            $sidebar_class = "sidebar-included " . $sidebar;
			$container_class = "span8";
        } else if ($sidebar == "both-sidebar") {
            $sidebar_class = "both-sidebar-included";
			 $bcontainer_class ="span9";
			 $container_class = "span8";
        } else {
		    $container_class = "span12";	
		}
	?>
    
<section id="content-holder" class="container-fluid container">
<?php $post_format =  get_post_format(); ?>
 <?php if ($post_format == "video") { 
 echo '<div class="video-detail">';
		$video_link = get_post_meta($post->ID,'post-option-inside-thumbnail-video', true);
		$video_type = get_post_meta($post->ID,'post-option-inside-video-types', true);
		echo '<div id="video">';
		$item_size = "1170x500";
		 $item_size_arr= explode('x',$item_size); $item_height=$item_size_arr[1]; $item_width=$item_size_arr[0];	
			echo '<div class="screen fluid-width-video-wrapper" style="height:'.$item_height.'px; width:'.$item_width.'px;">';
				 cp_video($post->ID, $item_size);
			echo '</div><!-- end .screen -->';
		echo '</div><!-- end #video-->'; 
echo '</div>';														
} ?>
  <div class="row-fluid <?php echo $sidebar_class; ?>">
    <?php
			$left_sidebar = get_post_meta( $post->ID , "post-option-choose-left-sidebar", true);
			$right_sidebar = get_post_meta( $post->ID , "post-option-choose-right-sidebar", true);
			global $default_post_left_sidebar, $default_post_right_sidebar;
			if( empty( $left_sidebar )){ $left_sidebar = $default_post_left_sidebar; } 
			if( empty( $right_sidebar )){ $right_sidebar = $default_post_right_sidebar; } 
			echo "<div class='".$bcontainer_class." cp-page-float-left'>";
			echo "<div class='".$container_class. " page-item'>";
			if ($post_format == "video") { ?>                  
             <header class="header-style">
                <h2 class="h-style"><?php _e('Video Detial','cp_front_end')?></h2>
                <?php comments_popup_link( __('<i class="fa fa-comment-o"></i> 0 Comment','cp_front_end'), __('<i class="fa fa-comment-o"></i> 1 Comment','cp_front_end'), __('<i class="fa fa-comment-o"></i> % Comments','cp_front_end'), '',__('Comments are off','cp_front_end') );?>
                <a><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></a>
               <?php  echo cp_like_post($post->ID); ?>
                
            </header>
   <?php } ?> 
      <?php 
    if ( have_posts() ){ while (have_posts()){ the_post(); ?>
          <?php if ($post_format !== "video") {  ?>                              
          <header class="header-style">
            <h2 class="h-style"><?php echo get_the_title(); ?></h2>
          </header>                                       
          <?php } ?>
            <article class="blog-post">
              <div class="widget-bg">
                <figure id="post-<?php the_ID(); ?>" <?php post_class('wrap-blog-post mbtm2'); ?>>
                  <?php if ($post_format !== "video") {  ?>
                     <div class="thumb2">
                     <?php // Inside Thumbnail
                        if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
                            $item_size = "770x440";
                        }else if( $sidebar == "both-sidebar" ){
                            $item_size = "560x200";
                        }else{
                            $item_size = "1170x350";
                        } 
                      $inside_thumbnail_type = get_post_meta($post->ID, 'post-option-inside-thumbnail-types', true);
                        switch($inside_thumbnail_type){
                            case "Image" : 
                                $thumbnail_id = get_post_meta($post->ID,'post-option-inside-thumbnial-image', true);
                                $thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
                                $thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
                                $alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
                                if( !empty($thumbnail) ){
                                    echo '<div class="blog-thumbnail-image">';
                                        echo '<a href="' . $thumbnail_full[0] . '" data-rel="prettyPhoto" title="' . get_the_title() . '" ><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>';
                                    echo '</div>';
                                }
                                break;
                            case "Video" : 
                                $video_link = get_post_meta($post->ID,'post-option-inside-thumbnail-video', true);
                                $video_type = get_post_meta($post->ID,'post-option-inside-video-types', true);
                                echo '<div id="video">';
                                    echo '<div class="screen fluid-width-video-wrapper">';
                                     cp_video($post->ID, get_option('dp_single_video_autoplay'));
                                    echo '</div><!-- end .screen -->';
                                echo '</div><!-- end #video-->';
                                echo '<div class="blog-thumbnail-video">';
                                echo '</div>';			
                                break;
                            case "Slider" : 
                                $slider_xml = get_post_meta( $post->ID, 'post-option-inside-thumbnail-xml', true); 
                                $slider_xml_dom = new DOMDocument();
                                $slider_xml_dom->loadXML($slider_xml);
                                echo '<div class="blog-thumbnail-slider">';
                                    echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
                                echo '</div>';					
                                break;
                        }
                   ?>
                  </div>
                  <?php } ?>
                  <div class="text">
                  <?php if ($post_format == "video") {  ?>
                      <h2><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></h2>
                   <?php } ?>
                    <div class="blog-content"> <?php echo the_content(); ?> </div>
                    <?php print_post_meta(); ?>
                  </div>
                </figure>
                <?php } ?>
              </div>
            </article>
    		     <article class="share-this">
                  <div class="widget-bg">
                   <?php if ($post_format == "video") {  ?>
                     <h2><?php _e('Share This Video','cp_front_end'); ?></h2>
                   <?php }else{ ?>
                     <h2><?php _e('Share This Post','cp_front_end'); ?></h2>
                   <?php } ?>
                    <ul>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog' ); ?>
	                  <li><a title="" data-toggle="tooltip" href="http://www.facebook.com/sharer.php?s=100
					  &p[url]=<?php echo urlencode( get_permalink() ); ?>
		 			  &p[images][0]=<?php echo urlencode( $image[0]); ?>
					  &p[title]=<?php echo urlencode( $post->post_title ); ?>
					  &p[summary]=<?php echo urlencode( $message ); ?>" data-original-title="Facebook"><img src="<?php echo CP_THEME_PATH_URL; ?>/images/fb.png"></a></li>
                      <li><a title="" data-toggle="tooltip" href="http://twitter.com/home?status=<?php echo str_replace(' ', '%20', get_the_title());?>%20-%20<?php echo $currentUrl;?>" data-original-title="Twitter"><img src="<?php echo CP_THEME_PATH_URL; ?>/images/tw.png"></a></li>
                      <li><a title="" data-toggle="tooltip" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" data-original-title="Pintrest"><img src="<?php echo CP_THEME_PATH_URL; ?>/images/vimeo.png"></a></li>
                      <li><a title="" data-toggle="tooltip" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" data-original-title="Google Plus"><img src="<?php echo CP_THEME_PATH_URL; ?>/images/g-plus2.png"></a></li>
                    </ul>
                  </div>
                </article>
               
			<?php  echo '<div class="comment-wrapper leave-frm">';
                        comments_template(); 
                   echo '</div>';
             ?>
   			 <?php } ?>
 		 </div>

		  <?php 	
            get_sidebar('left');	
                echo "</div>  <!--cp-page-float-left-end-->";
            get_sidebar('right');
          ?>
  </div>
</section>
<?php get_footer(); ?>
