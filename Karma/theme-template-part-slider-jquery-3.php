<div class="jquery3-slider-wrap flexslider">
        <ul class="slides">
        <?php remove_filter('pre_get_posts','wploop_exclude');
        
//@since 4.0.1 mod by denzel, comment out the following original codes
    //$tt_karma_slider_category       = get_post_meta($post->ID, 'tt_karma_slider_category',true);
    //$tt_karma_slider_category_id    = $tt_karma_slider_category[0];
      
//@since 4.0.1 mod by denzel to use category id from slider category id text input added in custom-metaboxes.php
//at line 278, as a fail safe in case slider category dropdown does not save the correct category id.
 
//@since 4.8 - WPML fix. Added (int)
$tt_karma_slider_category = get_post_meta($post->ID, 'slider_cat_id',true);

if($tt_karma_slider_category!=''){
$tt_karma_slider_category_id = (int)$tt_karma_slider_category;
}else{
//if user does not enter a slider category id, we use back the category dropdown
$tt_karma_slider_category = get_post_meta($post->ID, 'tt_karma_slider_category',true);
$tt_karma_slider_category_id = (int)$tt_karma_slider_category[0];
}
        
        $query_string = array(
            'post_type' => 'karma-slider',
            'posts_per_page' => 100,
            'tax_query' => array(
                array(
                    'taxonomy' => 'karma-slider-category',
                    //'field'  => 'id',
                    'field'    => 'term_id',
                    'terms'    => $tt_karma_slider_category_id
                )
            )
        );
        
        @query_posts($query_string);
        if (have_posts()) : while (have_posts()) : the_post();
        
        //retrieve slider metabox values
        $slider_image_layout       = get_post_meta($post->ID, 'slider_image_layout',true);
        $slider_image              = get_post_meta($post->ID, 'slider_image',true);
        $slider_image_linking      = get_post_meta($post->ID, 'slider_image_linking',true);
        $slider_image_alt_text     = get_post_meta($post->ID, 'slider_image_alt_text',true);
        $slider_video              = get_post_meta($post->ID, 'slider_video',true); //uses oembed field-type in custom-metaboxes.php
		$slider_blank_canvas       = get_post_meta($post->ID, 'slider_blank_canvas',true);
        
        //define for backward compatible
        if ('' == $slider_video):         'null' == $slider_video; endif;
        if ('' == $slider_image_layout):  'null' == $slider_image_layout; endif;
        
        //note: $slider_image_layout added as custom class to slider <li> below. If No image size is selected then "video" is the class.
        ?>
        
        <li class="jqslider karma-slider<?php echo '-'.$slider_image_layout; ?>">

        <?php
		//normal image layout (436 x 270) 
        if ('normal-image' == $slider_image_layout):
        $image_width  = 436;
        $image_height = 270;
        $image = truethemes_crop_image($thumb='',$slider_image,$image_width,$image_height);
        ?>
        
        <div class="slider-content-main">
            <?php 
            the_title( '<h2 class="slider-post-title">', '</h2>' );
            the_content();
            ?>
        </div><!-- END slider-content-main -->
        
        <div class="slider-content-sub">
            <?php if ('' == $slider_image_linking): ?>
            <img src="<?php echo $image; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php echo $slider_image_alt_text; ?>" />
            <?php else: echo '<a href="'.$slider_image_linking.'">'; ?>
            <img src="<?php echo $image; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php echo $slider_image_alt_text; ?>" /></a>
            <?php endif; ?>
        </div><!-- END slider-content-sub -->
        
        
        
        
        <?php //full-width image layout (960 x 350)
        elseif ('full-width-image' == $slider_image_layout):
        $image_width  = 960;
        $image_height = 350;
        $image = truethemes_crop_image($thumb='',$slider_image,$image_width,$image_height);
        ?>
        
        <div class="slider-content-sub-full-width">
            <?php if ('' == $slider_image_linking): ?>
            <img src="<?php echo $image; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php echo $slider_image_alt_text; ?>" />
            <?php else: echo '<a href="'.$slider_image_linking.'">'; ?>
            <img src="<?php echo $image; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php echo $slider_image_alt_text; ?>" /></a>
            <?php endif; ?>
        </div><!-- END slider-content-sub-full-width -->
        
        
        
        <?php elseif 
		//'video' for $slider_image_layout just means nothing is selected from the image-size dropdown list
		(('on' == $slider_blank_canvas) && ('video' == $slider_image_layout)): ?>
        <div class="slider-content-sub-full-width tt-slider-blank-canvas">
            <?php the_content(); ?>
        </div><!-- END slider-content-sub-full-width -->
        
        
         
         
        <?php //featured video layout
        else :  ?>

        <div class="slider-content-main">
            <?php 
            the_title( '<h2 class="slider-post-title">', '</h2>' );
            the_content();
            ?>
        </div><!-- END slider-content-main -->
        
        <div class="slider-content-video">
            <?php
            //Video will auto resize according to aspect ratio, and will not stay width 436 and height 270.
            //Do not remove height of video as the video will be missing in Internet Explorer.
            $embed_video = apply_filters('the_content', "[embed width=\"436\" height=\"270\"]".$slider_video."[/embed]");
            $embed_video = str_replace("<embed","<embed wmode='transparent' ",$embed_video);    
            echo $embed_video;
            ?>
        </div><!-- END slider-content-video -->
        <?php endif; //end featured video layout ?>
        
        
        
        
        </li>
        <?php endwhile; endif;wp_reset_query(); ?>
        </ul>
</div><!-- END jquery3-slider-wrap -->