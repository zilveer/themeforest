<div id="slideshow">
<?php
  $slideshow_order = get_option('vulcan_slideshow_order') ? get_option('vulcan_slideshow_order') : "date"; 
  if (post_type_exists('slideshow')) {
    query_posts(array( 'post_type' => 'slideshow', 'showposts' => -1,'orderby' => $slideshow_order));
    ?>
    <ul class="slideshow">
      <?php 
        global $post;
        
        if (have_posts()) {
        while (have_posts() ) : the_post(); 
        $slideshow_image = get_post_meta($post->ID, '_slideshow_image', true );
        $slideshow_url = get_post_meta($post->ID, '_slideshow_url', true ) ? get_post_meta($post->ID, '_slideshow_url', true )  : get_permalink();
        $slideshow_readmore = get_post_meta($post->ID, '_slideshow_readmore', true ) ? get_post_meta($post->ID, '_slideshow_readmore', true ) : __("Read More",'vulcan');
        $slideshow_style = get_post_meta($post->ID, '_slideshow_style', true );
        $thumb   = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
        $image_full   = aq_resize( $img_url, 936, 280, true ); //resize & crop the image
        $image_half   = aq_resize( $img_url, 610, 328, true ); //resize & crop the image
      ?>
      <li>
        <?php if ($slideshow_style == "full image") { ?>
          <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
            <a href="<?php echo $slideshow_url;?>">
              <img src="<?php echo $image_full;?>" alt="<?php the_title(); ?>" />
            </a>
          <?php } ?>
        <?php } else if ($slideshow_style == "with right description") { ?>
        <span class="slide-img">
        <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
            <img src="<?php echo $image_half;?>" alt="<?php the_title(); ?>" />
        <?php } ?>
        </span>
        <span class="slide-text">
            <span class="heading1-slide"><?php the_title();?></span>
            <?php the_content();?>
            <span class="slide-more"><a href="<?php echo $slideshow_url;?>"><?php echo $slideshow_readmore;?></a></span>
        </span>   
        <?php } else if ($slideshow_style == "with left description") { ?>
        <span class="slide-text-left">
            <span class="heading1-slide"><?php the_title();?></span>
            <?php the_content();?>
            <span class="slide-more"><a href="<?php echo $slideshow_url;?>"><?php echo $slideshow_readmore;?></a></span>
        </span>        
        <span class="slide-img-right">
        <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
            <img src="<?php echo $image_half;?>" alt="<?php the_title(); ?>" />
        <?php } ?>
        </span>          
        <?php } else { ?> 
          <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
            <a href="<?php echo $slideshow_url;?>">
              <img src="<?php echo $image_full;?>" alt="<?php the_title(); ?>" />
            </a>
          <?php } ?>
          <span class="slide-text-bottom">
            <?php the_content();?>
          </span>
          </a>
        <?php } ?>
        </li> 
      <?php endwhile; wp_reset_query();?> 
    </ul>  
    <div id="pager"></div>
  <?php
    } 
  }
  ?>
</div>