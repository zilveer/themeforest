<?php
/**** Services ****/
function mukam_services($atts, $content = null) {
   extract(shortcode_atts ( array(
    'style' => 'services-1', 
    'icon' => '',
    'header' => '',
    'link' => '',
    'animation' => 'no_animation',
    'delay' => ''
    ), 
   $atts));

   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

   $readmore =  __( 'READ MORE', 'mukam' );
   $learnmore = __( 'Learn more', 'mukam');
   if ( $style == "services-1") {
   $icon_size = ' icon-4x';
   $caret = $add_buton = '';	
   }
   if ( $style == "services-2" || $style == "services-5") {
   $icon_size = ' icon-2x';
   $caret = $add_buton = '';	
   }
   if ( $style == "services-3" ) {
   $caret = '<b class="caret"></b>';
   $icon_size = ' icon-2x';
   $add_buton = '<span class="buton b_inherit buton-2 buton-mini">'.$readmore.'</span>';
   }
   if ( $style == "services-4" ) {
   $caret = $add_buton = '';
   $icon_size = '';
   return '<div class="'.$animation.' services-4 animated"'.$mydelay.'><div class="holder"><i class="'.$icon.'"></i></div><div class="services-4-content"><h4>'.$header.'</h4><p>'.do_shortcode($content).'</p><a href="'.$link.'">-'.$learnmore.'</a></div></div>';
   }
   if ( $style != "services-4") {
   return '<a href="'.$link.'"><div class="'.$animation.' '.$style.' animated"'.$mydelay.'><div class="holder"><i class="'.$icon.' '.$icon_size.'"></i></div>'.$caret.'<h4>'.$header.'</h4><p>'.do_shortcode($content).'</p>'.$add_buton.'</div></a>';
   }

}
add_shortcode('mukam_service', 'mukam_services');
add_action( 'init', 'mukam_service_integrateWithVC' );
function mukam_service_integrateWithVC() {
vc_map( array(
   "name" => __("Services", 'mukam'),
   "base" => "mukam_service",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Services Style", 'mukam'),
        "param_name" => "style",
        "value" => array(__('Four Column Big', "js_composer") => "services-1", __('Four Column Small', "js_composer") => "services-2", __('Four Column Small with Background', "js_composer") => "services-5",  __('Three Column', "js_composer") => "services-3",  __('Two Column', "js_composer") => "services-4"),
        "description" => __("Choose your services style", 'mukam')
    ),

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Services Icon", 'mukam'),
        "param_name" => "icon",
        "value" => __("mukam-sandtime", 'mukam'),
        "description" => __("Add icon to your title. Write icon name e.g. icon-moon, mukam-imac, mukam-clock2, icon-beaker", "js_composer")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "header",
        "value" => __("Title", 'mukam'),
        "description" => __("Title of Services", 'mukam')
    ),
    array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Box Content", 'mukam'),
        "param_name" => "content",
        "value" => __("This is your Content", 'mukam'),
        "description" => __("Write Content of Services", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link", 'mukam'),
        "param_name" => "link",
        "value" => __("http://", 'mukam'),
        "description" => __("Add link to your service box", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    )
   )
) );
}
/********************************/
/* Home Page Recent Post Widget */
/********************************/
function mukam_homepost($atts, $content = null) {
   extract(shortcode_atts ( array(
    	'header' => '',
    	'animation' => 'no_animation',
    	'post_count' => '3',
      'delay' => '',
      'r' => ''
    ), 
   $atts));

   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }
   		if ( $post_count == "") {
    		$post_count = 3;
    	}
        global $wp_query;
        $r = new WP_Query( array( 'posts_per_page' => $post_count, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) );
        if ($r->have_posts()) :
            ?>
        <?php ob_start(); ?>
        <div class="blog-widget">
            <h3 class="<?php echo $animation ?> animated"<?php echo $mydelay;?>><?php echo $header ?></h3>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <article class="<?php echo $animation ?> latest-post animated">
                <div class="post-date">
                  <p class="post-day"><?php the_time('j'); ?></p>
                  <p class="post-month"><?php the_time('M'); ?></p>
                </div>
                <div class="post-content">
                  <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute() ?>"><?php echo the_title(); ?></a></h3>
                  <i class="mukam-comments pull-left"></i><p class="comments"><?php comments_number( __('0', 'mukam'), __('1', 'mukam'), __('%', 'mukam') ); echo __(' Comments', 'mukam');?></p>
                  <p class="post-intro"><?php echo wp_trim_words( get_the_content(), 34, ' ' ) ?><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute() ?>"><?php echo __('Read more', 'mukam'); ?></a></p>
                </div>
            </article>
        <?php endwhile; ?>
        <div class="clearfix"></div>
		</div>
    <?php endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('latepost', 'mukam_homepost');

add_action( 'init', 'mukam_homepost_integrateWithVC' );
function mukam_homepost_integrateWithVC() {
vc_map( array(
   "name" => __("Homepage Recent Posts", 'mukam'),
   "base" => "latepost",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "header",
        "value" => __("Title", 'mukam'),
        "description" => __("Title of HomePage Recent Posts Widget", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Post Number", 'mukam'),
        "param_name" => "post_count",
        "value" => __("3", 'mukam'),
        "description" => __("Number of Post that you want to show", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    )
   )
) );
}
/********************************/
/*     Single Testimonial       */
/********************************/
function mukam_single_testimonial($atts, $content = null) {
   extract(shortcode_atts ( array(
    	'header' => '',
    	'animation' => 'no_animation',
    	'post_id' => '',
      'delay' => '',
      'r' => ''
    ), 
   $atts));

   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

        global $wp_query;
        $r = new WP_Query( array( 'p' => $post_id, 'post_type' => 'testimonial') );
        if ($r->have_posts()) :
            ?>
        <?php ob_start(); ?>
        <div class="<?php echo $animation ?> happyclients animated"<?php echo $mydelay;?>>
            <h3><?php echo $header ?></h3>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <div class="testimonial">
                <p><?php echo get_the_content(); ?></p>
				<div class="clientphoto"> 
                <?php if (has_post_thumbnail()) {echo the_post_thumbnail();} ?>
                </div>
                <div class="byclient">
                <p class="byclient">
                  <?php echo get_post_meta( get_the_ID(), "_clientname", true); ?>,<br><span><?php echo get_post_meta( get_the_ID(), "_job", true); ?></span>
                </p>
                </div>
                <div class="clearfix"></div>
            </div>
        <?php endwhile; ?>
        <div class="clearfix"></div>
		</div>
    <?php endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('single_testi', 'mukam_single_testimonial');

add_action( 'init', 'mukam_single_testimonial_integrateWithVC' );
function mukam_single_testimonial_integrateWithVC() {
vc_map( array(
   "name" => __("Single Testimonial", 'mukam'),
   "base" => "single_testi",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "header",
        "value" => __("Title", 'mukam'),
        "description" => __("Title of Testimonial Widget", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Post ID", 'mukam'),
        "param_name" => "post_id",
        "value" => __("fill this space", 'mukam'),
        "description" => __("Don't you know your testimonial post id? Please look documentation.", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    )
   )
) );
}
/********************************/
/*    Testimonial Slider        */
/********************************/
function mukam_max_testimonial($atts, $content = null) {
   extract(shortcode_atts ( array(
      'header' => '',
      'animation' => 'no_animation',
      'background_style' => 'asset_style',
      'custom_image' => '', 
      'image_repeat' => 'no-repeat',
      'r' => ''
    ), 
   $atts));
        $img_id = preg_replace('/[^\d]/', '', $custom_image);
        $image_url = wp_get_attachment_image_src( $img_id, 'full');
        $image_url = $image_url[0]; 

        global $wp_query;
        $r = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'testimonial') );
        if ($r->have_posts()) :
            ?>
        <?php ob_start(); ?>

        <div class="<?php echo $animation ?> happyclients-2 animated" style="background-image: url('<?php echo $image_url; ?>'); background-repeat:'<?php echo $image_repeat; ?>';">
          <?php if ( $background_style == "asset_style") { ?>
          <div class="happyclients-2-inner"></div><?php }
          ?>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="happyclientslider">
                  <ul class="slides">
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <li>
                      <div class="clients-say">
                        <h3><?php echo $header ?></h3>
                        <p><?php echo get_the_content(); ?></p>
                        <div class="clientphoto"> 
                        <?php if (has_post_thumbnail()) {echo the_post_thumbnail('full');} ?>
                        </div>
                        <div class="byclient">
                        <p class="byclient">
                          <?php echo get_post_meta( get_the_ID(), "_clientname", true); ?>,<br><span><?php echo get_post_meta( get_the_ID(), "_job", true); ?></span>
                        </p>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </li>
                  <?php endwhile; ?>
                </ul>              
              </div>
            </div>
          </div>
      </div>
  </div>
    <?php endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('max_testi', 'mukam_max_testimonial');

add_action( 'init', 'mukam_max_testimonial_integrateWithVC' );
function mukam_max_testimonial_integrateWithVC() {
vc_map( array(
   "name" => __("Testimonial Slider", 'mukam'),
   "base" => "max_testi",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "header",
        "value" => __("Title", 'mukam'),
        "description" => __("Title of Testimonial Widget", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Background Style", 'mukam'),
        "param_name" => "background_style",
        "value" => array(__('Asset Style', "js_composer") => "asset_style", __('Background Style', "js_composer") => "background_image"),
        "description" => __("Choose your style.", 'mukam')
    ),
    array(
      "type" => "attach_image",
      "heading" => __("Image", "js_composer"),
      "param_name" => "custom_image",
      "value" => "",
      "description" => __("Select image from media library.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Background Repeat", "js_composer"),
      "param_name" => "image_repeat",
      "value" => array(__("No Repeat", "js_composer") => "no-repeat", __("Repeat X", "js_composer") => "repeat-x", __("Repeat Y", "js_composer") => "repeat-y", __("Repeat", "js_composer") => "repeat"),
      "description" => __("Choose repeat of your image", "js_composer")
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    )
   )
) );
}
function mukam_clientslider($atts, $content = null) {
   extract(shortcode_atts ( array(
    	'header' => '',
    	'comment' => '',
    	'link' => '',
    	'animation' => 'no_animation',
      'delay' => '',
      'r' => ''
    ), 
   $atts));

   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }
   		
        global $wp_query;
        $r = new WP_Query( array( 'posts_per_page' => -1, 'no_found_rows' => true, 'post_status' => 'publish', 'post_type' => 'client', 'ignore_sticky_posts' => true ) );
        if ($r->have_posts()) :
            ?>
        <?php ob_start(); ?>
        <div class="<?php echo $animation ?> ourclients animated"<?php echo $mydelay;?>>
            <h2><?php echo $header ?></h2>
            <div class="ourclients-text">
			<p><?php echo $comment; ?></p>
            </div>
            <div class="clearfix"></div>
            <div class="clientslider">
                <ul class="slides">
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
           			<li><?php $link_test=get_post_meta( get_the_ID(), "_link", true); if(!empty($link_test)) { ?><a href="<?php echo get_post_meta( get_the_ID(), "_link", true); ?>" target = "_blank"><?php } echo the_post_thumbnail(); $link_test=get_post_meta( get_the_ID(), "_link", true); if(!empty($link_test)) { ?></a><?php } ?></li>
        <?php endwhile; ?>
    			</ul>
			</div>
			<div class="clearfix"></div>
		</div>    
    <?php endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('mukamclient', 'mukam_clientslider');

add_action( 'init', 'mukam_clientslider_integrateWithVC' );
function mukam_clientslider_integrateWithVC() {
vc_map( array(
   "name" => __("Client Slider", 'mukam'),
   "base" => "mukamclient",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "header",
        "value" => __("Title", 'mukam'),
        "description" => __("Title of Client Slider Widget", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Content", 'mukam'),
        "param_name" => "comment",
        "value" => __("fill this space", 'mukam'),
        "description" => __("Content of Client Slider Widget", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    )
   )
) );
}
/**** Mukam Actionbox ****/
function mukam_actionbox($atts, $content = null) {
   extract(shortcode_atts ( array(
    'style' => 'style1',
    'header' => '',
    'buton_quantity' => '1',
    'buton_type' => 'b_asset',
    'buton_title' => '',
    'buton_title_2' => '',
    'link' => '',
    'link2' => '',
    'icon' => '',
    'animation' => 'no_animation',
    'delay'=> ''
    ), 
   $atts));

   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

   if ($buton_quantity == 2 && $buton_type == 'b_white') {
    $buton2 = '<span class="buton b_white buton-2 buton-small"><a href="'.$link2.'">'.$buton_title_2.'</a></span>';
   }
   else if ($buton_quantity == 2 && $buton_type == 'b_asset') {
    $buton2 = '<span class="buton b_black buton-2 buton-small"><a href="'.$link2.'">'.$buton_title_2.'</a></span>';
   }

   else {
    $buton2='';
   }

   if ($style == 'style1') {
   return '<div class="call-to-action"><h2 class="'.$animation.' animated"'.$mydelay.'>'.$header.'</h2><p class="'.$animation.' animated"'.$mydelay.'>'.do_shortcode($content).'</p><span class="buton '.$buton_type.' buton-2 buton-small"><a href="'.$link.'">'.$buton_title.'</a></span>'.$buton2.'</div>';
   }
   else {
      return '
      <div class="call-to-action-2">
      <a href="'.$link.'"><span class="buton b_white buton-2 buton-small pull-right"><i class="'.$icon.'"></i>'.$buton_title.'</span></a><h4 class="'.$animation.' animated"'.$mydelay.'>'.$header.'</h4>
      <p class="'.$animation.' animated"'.$mydelay.'>'.do_shortcode($content).'</p>
      </div>';

   }

}
add_shortcode('mukam_action', 'mukam_actionbox');

add_action( 'init', 'mukam_actionbox_integrateWithVC' );
function mukam_actionbox_integrateWithVC() {
vc_map( array(
   "name" => __("Mukam Actionbox", 'mukam'),
   "base" => "mukam_action",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Actionbox Style", 'mukam'),
        "param_name" => "style",
        "value" => array(__('Actionbox 1', "js_composer") => "style1",  __('Actionbox 2', "js_composer") => "style2"),
        "description" => __("Choose your actionbox style", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "header",
        "value" => __("Title", 'mukam'),
        "description" => __("Title of Actionbox", 'mukam')
    ),
    array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Box Content", 'mukam'),
        "param_name" => "content",
        "value" => __("This is your Content", 'mukam'),
        "description" => __("Write Content of Actionbox", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Icon", 'mukam'),
        "param_name" => "icon",
        "value" => __("mukam-sandtime", 'mukam'),
        "description" => __("Add icon to your button. Write icon name e.g. icon-moon, mukam-imac, mukam-clock2, icon-beaker", "js_composer"),
        "dependency" => Array('element' => "style", 'value' => 'style2')
    ),    
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Style", 'mukam'),
        "param_name" => "buton_type",
        "value" => array(__('Asset', "js_composer") => "b_asset",  __('White', "js_composer") => "b_white"),
        "description" => __("Choose your buton style", 'mukam'),
        "dependency" => Array('element' => "style", 'value' => 'style1')
    ),

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Buton Quantity", 'mukam'),
        "param_name" => "buton_quantity",
        "value" => array(__('1', "js_composer") => "1",  __('2', "js_composer") => "2"),
        "description" => __("Choose your quantity", "js_composer"),
        "dependency" => Array('element' => "style", 'value' => 'style1')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Title", 'mukam'),
        "param_name" => "buton_title",
        "value" => __("View More", 'mukam'),
        "description" => __("Add title to your button", 'mukam')
    ),
 
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link", 'mukam'),
        "param_name" => "link",
        "value" => __("http://", 'mukam'),
        "description" => __("Add link to your button", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Title 2", 'mukam'),
        "param_name" => "buton_title_2",
        "value" => __("View More", 'mukam'),
        "description" => __("Add title to your button", 'mukam'),
        "dependency" => Array('element' => "buton_quantity", 'value' => array('2'))
    ),
 
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Link 2", 'mukam'),
        "param_name" => "link2",
        "value" => __("http://", 'mukam'),
        "description" => __("Add link to your button", 'mukam'),
        "dependency" => Array('element' => "buton_quantity", 'value' => array('2'))
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    )
   )
) );
}
/**** Mukam Team ****/
function mukam_team($atts, $content = null) {
   extract(shortcode_atts ( array(
    'pname' => '',
    'position' => '',
    'photo' => '',
    'google_account' => '',
    'twitter_account' => '',
    'face_account' => '',
    'animation' => 'no_animation',
    'delay' => ''
    ), 
   $atts));

   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

  $img_id = preg_replace('/[^\d]/', '', $photo);
  $image_url = wp_get_attachment_image_src( $img_id, 'full');
  $image_url = $image_url[0]; 

   if ( !empty($google_account)) {
    $google_account = '<a href="'.$google_account.'"><div class="team-holder"><i class="mukam-google"></i></div></a>';
   }
   if ( !empty($twitter_account)) {
    $twitter_account = '<a href="'.$twitter_account.'"><div class="team-holder"><i class="mukam-tweet"></i></div></a>';
   }
   if ( !empty($face_account)) {
    $face_account = '<a href="'.$face_account.'"><div class="team-holder"><i class="mukam-face"></i></div></a>';
   }

   return '<div class="'.$animation.' mukam-team animated"'.$mydelay.'><img src="'.$image_url.'" alt="'.$pname.'"><div class="team-title"><div class="team-name"><p><span>'.$pname.'</span></p><p>'.$position.'</p></div><div class="team-social">'.$google_account.''.$twitter_account.''.$face_account.'</div></div><div class="clearfix"></div><div class="team-content"><p>'.do_shortcode($content).'</p></div></div>';   
}
add_shortcode('m_team', 'mukam_team');

add_action( 'init', 'mukam_team_integrateWithVC' );
function mukam_team_integrateWithVC() {
vc_map( array(
   "name" => __("Mukam Team", 'mukam'),
   "base" => "m_team",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Name", 'mukam'),
        "param_name" => "pname",
        "value" => __("fill this space", 'mukam'),
        "description" => __("Name", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Position", 'mukam'),
        "param_name" => "position",
        "value" => __("fill this space", 'mukam'),
        "description" => __("Write person position/job", 'mukam')
    ),    
    array(
      "type" => "attach_image",
      "heading" => __("Photo", "js_composer"),
      "param_name" => "photo",
      "value" => "",
      "description" => __("Select image from media library.", "js_composer")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Google", 'mukam'),
        "param_name" => "google_account",
        "value" => __("fill this space", 'mukam'),
        "description" => __("Google Account URL", 'mukam')
    ),
 
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Facebook", 'mukam'),
        "param_name" => "face_account",
        "value" => __("fill this space", 'mukam'),
        "description" => __("Facebook Account URL", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Twitter", 'mukam'),
        "param_name" => "twitter_account",
        "value" => __("fill this space", 'mukam'),
        "description" => __("Twitter Account URL", 'mukam')
    ),
    array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Box Content", 'mukam'),
        "param_name" => "content",
        "value" => __("This is your Content", 'mukam'),
        "description" => __("Something about me", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    )
   )
) );
}
/********************/
/* Four Tabs Slider */
/********************/
function mukam_fourtabs($atts, $content = null) {
   extract(shortcode_atts ( array(
    'intro' => '', 
    'images' => '',
    'title1' => '',
    'caption1' => '',
    'title2' => '',
    'caption2' => '',
    'title3' => '',
    'caption3' => '',
    'title4' => '',
    'caption4' => ''
    ), 
   $atts));

$i = 1;
$addstart = $tabcontent = $activeclass = $tabslider = $slidetitle = $slidecaption = $p_img_large = '';
$images = explode( ',', $images);
foreach ( $images as $attach_id ) {
  if ( $i == 1 ) { 
    $addstart = ' in active';
    $activeclass = ' class="active">';    
  }

  else { 
    $addstart = '';
    $activeclass = '>';
  }

    $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => 'full' ));
    $thumbnail = $post_thumbnail['thumbnail'];
    
    $tabcontent = $tabcontent.'<div class="tab-pane fade'.$addstart.'" id="banner-'.$i.'">'.$thumbnail.'</div>';
    if ( $i == 1) {
    $slidetitle[$i] = $title1;
    $slidecaption[$i] = $caption1;
    }
    if ( $i == 2) {
    $slidetitle[$i] = $title2;
    $slidecaption[$i] = $caption2;
    }
    if ( $i == 3) {
    $slidetitle[$i] = $title3;
    $slidecaption[$i] = $caption3;
    }
    if ( $i == 4) {
    $slidetitle[$i] = $title4;
    $slidecaption[$i] = $caption4;
    }
    $tabslider = $tabslider.'<li'.$activeclass.'<a href="#banner-'.$i.'" data-toggle="tab"><div class="slide-number pull-left">'.$i.'</div><div class="hidden-xs hidden-sm">'.$slidetitle[$i].'</div><span class="hidden-xs hidden-sm">'.$slidecaption[$i].'</span></a></li>';

  $i++;       
}

return '<div class="tabs-featured-slider"><h3>'.$intro.'</h3><div class="tab-content">'.$tabcontent.'</div><ul class="nav nav-tabs">'.$tabslider.'</ul><div class="clearfix"></div></div>';
}
add_shortcode('mukam_fourtabslide', 'mukam_fourtabs');

add_action( 'init', 'mukam_fourtabs_integrateWithVC' );
function mukam_fourtabs_integrateWithVC() {
vc_map( array(
   "name" => __("Mukam 4 Slide", 'mukam'),
   "base" => "mukam_fourtabslide",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Intro for your slider", 'mukam'),
        "param_name" => "intro",
        "value" => '',
        "description" => __("Just write something for your intro, this will look above slider", "js_composer")
    ),

    array(
      "type" => "attach_images",
      "heading" => __("Images", "js_composer"),
      "param_name" => "images",
      "value" => "",
      "description" => __("Select 4 images from media library.", "js_composer")
    ),

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title for first slide", 'mukam'),
        "param_name" => "title1",
        "value" => '',
        "description" => __("Write your title for 1 slide", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Caption for first slide", 'mukam'),
        "param_name" => "caption1",
        "value" => '',
        "description" => __("Write your caption for 1 slide, caption will look under your title", 'mukam')
    ),

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title for 2. slide", 'mukam'),
        "param_name" => "title2",
        "value" => '',
        "description" => __("Write your title for 2. slide", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Caption for 2. slide", 'mukam'),
        "param_name" => "caption2",
        "value" => '',
        "description" => __("Write your caption for 2. slide, caption will look under your title", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title for 3. slide", 'mukam'),
        "param_name" => "title3",
        "value" => '',
        "description" => __("Write your title for 3. slide", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Caption for 3. slide", 'mukam'),
        "param_name" => "caption3",
        "value" => '',
        "description" => __("Write your caption for 3. slide, caption will look under your title", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title for 4 slide", 'mukam'),
        "param_name" => "title4",
        "value" => '',
        "description" => __("Write your title for 4 slide", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Caption for 4. slide", 'mukam'),
        "param_name" => "caption4",
        "value" => '',
        "description" => __("Write your caption for 4. slide, caption will look under your title", 'mukam')
    )
   )
) );
}
/********************************/
/*    Latest Portfolio          */
/********************************/
function mukam_masonry_latest($atts, $content = null) {
   extract(shortcode_atts ( array(
      'type' => 'masonry',
      'header' => '',
      'r' => '',
      'item_count' => '6',
      'order' => 'DESC',
      'reverse' => ''
    ), 
   $atts));
        $ordery = $order;
        global $post;
        global $wp_query;
        $r = new WP_Query( array( 'posts_per_page' => $item_count, 'post_type' => 'portfolio', 'order' => $ordery) );
        if ($r->have_posts()) :
            ?>
        <?php ob_start();
        if ( $type != "thumbnail") { ?>
        <div class="latest-word-grid-container">
          <div class="col-sm-3 col-md-3">
            <div class="menu-widget">
            <h4 class="bounceInLeft-1 blind animated v bounceInLeft"><?php echo $header ?></h4>
            <ul class="bounceInLeft-1 blind animated v bounceInLeft">
              <a href="#latest-work-item"><li class="slug-latest-work-item active"><?php echo __('All', 'mukam');?></li></a>
              <?php
              $terms = get_terms("portfolio-category");
              $count = count($terms);
              if ( $count > 0 ){
                foreach ( $terms as $term) {
                echo '<a href="#'.$term->slug.'"><li class="slug-'.$term->slug.'">'.$term->name.'</li></a>';
                }
              }
              ?>
            </ul>
            </div>
          </div>
          <div class="col-sm-9 col-md-9">
            <div class="latest-work-grid">
              <div class="grid-sizer"></div>
                    <?php while ( $r->have_posts() ) : $r->the_post();
                    ?>

                    <div class="latest-work-item <?php $categories = wp_get_object_terms($post->ID, 'portfolio-category');
              foreach($categories as $category){
                echo $category->slug.' '; }?>">
                      <div class="widget-thumb">
                        <?php echo the_post_thumbnail(); ?>
                        <span class="overthumb"></span>
                          <div class="carousel-icon">
                            <a href="<?php print mukam_portfolio_thumbnail_url( $post->ID ) ?>" data-rel="prettyPhoto[latest-work]" class="prettyPhoto lightzoom">
                            <i class="mukam-search"></i>
                            </a>
                            <a href="<?php the_permalink() ?>" class="postlink">
                            <i class="mukam-link"></i>
                            </a>
                          </div>
                      </div>
                      </div> 
                  <?php endwhile; ?>
              </div>
            </div>
          </div>
 
    
<?php }
else {
    ?> <div class="fullcarousel<?php if($reverse == "yes") { echo '2'; } ?>">
        <ul class="slides">
            <?php while ( $r->have_posts() ) : $r->the_post();?>
            <li><a href="<?php the_permalink() ?>"><?php echo the_post_thumbnail(); ?></a></li>
            <?php endwhile; ?>              
        </ul>
       </div><?php
} endif;
       wp_reset_query(); 
       $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('masonry_portfolio', 'mukam_masonry_latest');

add_action( 'init', 'mukam_masonry_latest_integrateWithVC' );
function mukam_masonry_latest_integrateWithVC() {
vc_map( array(
   "name" => __("Latest Portfolio", 'mukam'),
   "base" => "masonry_portfolio",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(

    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Portfolio Style", 'mukam'),
        "param_name" => "type",
        "value" => array(__('Masonry', "js_composer") => "masonry", __('Thumbnail Slides', "js_composer") => "thumbnail" ),
        "description" => __("Choose your style.", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Portfolio Style", 'mukam'),
        "param_name" => "order",
        "value" => array(__('Descending ', "js_composer") => "DESC ", __('Ascending ', "js_composer") => "ASC" ),
        "description" => __("Choose your order.", 'mukam')
    ),
    array(
        "type" => 'checkbox',
        "heading" => __("Reverse Animation", "js_composer"),
        "param_name" => "reverse",
        "description" => __("Reverse Animation.", "js_composer"),
        "value" => Array(__("Yes, please", "js_composer") => 'yes'),
        "dependency" => Array('element' => "type", 'value' => 'thumbnail')
    ),    
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "header",
        "value" => __("Our Latest Works", 'mukam'),
        "description" => __("Title of Latest Portfolio Widget", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Items", 'mukam'),
        "param_name" => "item_count",
        "value" => __("6", 'mukam'),
        "description" => __("How many items do you want to show?", 'mukam')
    )  
   )
) );
}
/*******************/
/**** SUBSCRIBE ****/
/*******************/
function mukam_subscribes($atts, $content = null) {
   extract(shortcode_atts ( array(
    'header' => '',
    'note' => '',
    'animation' => 'no_animation',
    'delay' => '',
    'mailchimp' => ''
    ), 
   $atts));
   $mydelay = '';
   if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }
   $theme_options = get_option('option_tree');
   $mailchimp = get_option_tree('mailchimp',$theme_options);
   return '
   <div class="'.$animation.' subscribe animated"'.$mydelay.'>
    <div class="subscribe-inner">
        <h3>'.$header.'</h3>
        <p>'.$note.'</p>
        <div class="subscribe-widget">
        <form action="'.$mailchimp.'" method="post" id="subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <input type="email" name="EMAIL" placeholder="your email" class="required email-form" id="subscribe-email">
        <input type="submit" value="Go" name="subscribe" id="mc-embedded-subscribe" class="button">
        
        <div class="clearfix"></div>
        <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
        </div>
        </form>  
        <div class="clearfix"></div>
        </div>
    </div>
</div>';
}
add_shortcode('mukam_subscribe', 'mukam_subscribes');

add_action( 'init', 'mukam_subscribe_integrateWithVC' );
function mukam_subscribe_integrateWithVC() {
vc_map( array(
   "name" => __("Mukam Subscribe", 'mukam'),
   "base" => "mukam_subscribe",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Url", 'mukam'),
        "param_name" => "yourUrl",
        "value" => __("fill this space", 'mukam'),
        "description" => __("To learn how to find your mailchimp url, look documentation", "js_composer")
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "header",
        "value" => __("Subscribe to Our Newsletter", 'mukam'),
        "description" => __("Title of Subscribe", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "note",
        "value" => __("Sign up with your email to get fresh updates.", 'mukam'),
        "description" => __("Notes of Subscribe", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    )
   )
) );
}
/*********************************/
/*       Mestro Buttons          */
/*********************************/

function mukam_buttons($atts, $content = null) {
   extract(shortcode_atts ( array(
    'color' => '', 
    'url' => '#',
    'transition' => 'buton-1',
    'b_size' => 'buton-mini'
    ), 
   $atts));
   return '<span class="buton '.$color.' '.$transition.' '.$b_size.'"><a href="'.$url.'">'.do_shortcode($content).'</a></span>';
}
add_shortcode('mbuttons', 'mukam_buttons');

add_action( 'init', 'mukam_buttons_integrateWithVC' );
function mukam_buttons_integrateWithVC() {
vc_map( array(
   "name" => __("Mukam Buttons", 'mukam'),
   "base" => "mbuttons",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend_admin.css'),
   "params" => array(    

    array( 
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Color", 'mukam'),
        "param_name" => "color",
        "value" => array( __('Blue', "js_composer") => "b_blue", __('Red', "js_composer") => "b_red", __('Green', "js_composer") => "b_green-1", __('Orange', "js_composer") => "b_orange-1-dark", __('Light Orange', "js_composer") => "b_orange-1", __('Purple', "js_composer") => 'b_purple', __('Grey', "js_composer") => "b_grey", __('Dark Grey', "js_composer") => "b_darkgrey-1"),
        "description" => __("Choose your button color.", 'mukam')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Buton Size", 'mukam' ),
        "param_name" => "b_size",
        "value" => array( __('XS', "js_composer") => "buton-mini", __('Small', "js_composer") => "buton-small", __('Medium', "js_composer") => "buton-medium", __('Large', "js_composer") => "buton-large"),
    ),  
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button Transition", 'mukam'),
        "param_name" => "transition",
        "value" => array(__('Left to Right', "js_composer") => "buton-1", __('Top to Bottom', "js_composer") => "buton-2", __('Fade Effect', "js_composer") => "buton-3", __('Middle to Side', "js_composer") => "buton-4", __('Middle to Corners', "js_composer") => "buton-5", __('Middle to Top', "js_composer") => "buton-6", ),
        "description" => __("Choose your button effect.", 'mukam')
    ),
     array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Content", 'mukam'),
        "param_name" => "content",
        "value" => __("Awesome Button", 'mukam'),
        "description" => __("Text on buttons", 'mukam')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Button link", 'mukam'),
        "param_name" => "url",
        "value" => "http://themeforest.net",
        "description" => __("Link of your button.", 'mukam')
    )
    )
    ) );
}
/**********************************/
/* Contact Widget for Custom Page */
/**********************************/
function mukam_template_contacts($atts) {
   extract(shortcode_atts ( array(
    'title' => '',
    'telephone' => '',
    'email' => '',
    'web' => '',
    'time' => '',
    'address' => '',
    'social' => ''
    ), 
   $atts));

   if ( function_exists( 'get_option_tree') ) {
    $theme_options = get_option('option_tree');  
}

$contact_social = '';
if ( get_option_tree('social_facebook', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_facebook', $theme_options).'"><div class="socialbox"><i class="mukam-face"></i></div></a>';
}

if ( get_option_tree('social_twitter', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_twitter', $theme_options).'"><div class="socialbox"><i class="mukam-tweet"></i></div></a>';
}

if ( get_option_tree('social_google', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_google', $theme_options).'"><div class="socialbox"><i class="mukam-google"></i></div></a>';
}

if ( get_option_tree('social_dribbble', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_dribbble', $theme_options).'"><div class="socialbox"><i class="mukam-dribble"></i></div></a>';
}

if ( get_option_tree('social_youtube', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_youtube', $theme_options).'"><div class="socialbox"><i class="mukam-youtube"></i></div></a>';
}

if ( get_option_tree('social_vimeo', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_vimeo', $theme_options).'"><div class="socialbox"><i class="mukam-vine"></i></div></a>';
}

if ( get_option_tree('social_linkedin', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_linkedin', $theme_options).'"><div class="socialbox"><i class="icon-linkedin"></i></div></a>';
}

if ( get_option_tree('social_digg', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_digg', $theme_options).'"><div class="socialbox"><i class="mukam-digg"></i></div></a>';
}

if ( get_option_tree('social_skype', $theme_options) != '') {
  $contact_social .= '<a href="skype:'.get_option_tree('social_skype', $theme_options).'"><div class="socialbox"><i class="mukam-skype"></i></div></a>';
}

if ( get_option_tree('social_stumbleupon', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_stumbleupon', $theme_options).'"><div class="socialbox"><i class="mukam-stumbleupon"></i></div></a>';
}

if ( get_option_tree('social_pinterest', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_pinterest', $theme_options).'"><div class="socialbox"><i class="mukam-pinterest"></i></div></a>';
}

if ( get_option_tree('social_flickr', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_flickr', $theme_options).'"><div class="socialbox"><i class="mukam-flicker"></i></div></a>';
}

if ( get_option_tree('social_rss', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_rss', $theme_options).'"><div class="socialbox"><i class="mukam-rss"></i></div></a>';
}

if ( get_option_tree('social_yahoo', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_yahoo', $theme_options).'"><div class="socialbox"><i class="mukam-yahoo"></i></div></a>';
}
if ( get_option_tree('social_foursquare', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_foursquare', $theme_options).'"><div class="socialbox"><i class="icon-foursquare"></i></div></a>';
}

if ( get_option_tree('social_yelp', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_yelp', $theme_options).'"><div class="socialbox"><i class="icomoon-yelp"></i></div></a>';
}
   if( $social == 'yes') {
    $social = $contact_social;
   }

   else {
    $social = '';
   }

   if(!empty($telephone)){
   $tel ='<i class="mukam-telephone pull-left widget-icon"></i><p>'.$telephone.'</p>';
   }

   if(!empty($email)){
   $mail ='<i class="mukam-envelope pull-left widget-icon"></i><p>'.$email.'</p>';
   }

   if(!empty($web)){
   $site ='<i class="mukam-globe pull-left widget-icon"></i><p><a href="http://'.$web.'">'.$web.'</a></p>';
   }

   if(!empty($time)){
   $zone ='<i class="mukam-clock pull-left widget-icon"></i><p>'.$time.'</p>';
   }

   if(!empty($telephone)){
   $adress ='<i class="mukam-direction pull-left widget-icon"></i><p>'.$address.'</p>';
   } 

   return '<div class="contact-info"><h3>'.$title.'</h3><div class="contact-widget">'.$tel.$mail.$site.$zone.$adress.'</div><div class="social-widget">'.$social.'</div></div>';
}
add_shortcode('template_contact', 'mukam_template_contacts');

add_action( 'init', 'mukam_template_contacts_integrateWithVC' );
function mukam_template_contacts_integrateWithVC() {
vc_map( array(
   "name" => __("Contact Info", 'mukam'),
   "base" => "template_contact",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array(    

    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Title", 'mukam'),
        "param_name" => "title",
        "value" => __("fill this space", 'mukam')
    ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Phone", 'mukam'),
        "param_name" => "telephone",
        "value" => __("fill this space", 'mukam')
    ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("E-Mail", 'mukam'),
        "param_name" => "email",
        "value" => __("fill this space", 'mukam')
    ),    
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Url", 'mukam'),
        "param_name" => "web",
        "value" => __("fill this space", 'mukam'),
        "description" => __("Dont write http://, write your url starting with www.", 'mukam')

    ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Business Hours", 'mukam'),
        "param_name" => "time",
        "value" => __("fill this space", 'mukam')
    ),
        array(
        "type" => "textarea",
        "holder" => "div",
        "class" => "",
        "heading" => __("Your Address", 'mukam'),
        "param_name" => "address",
        "value" => __("fill this space", 'mukam')
    ),
        array(
        "type" => 'checkbox',
        "heading" => __("Add your social", "js_composer"),
        "param_name" => "social",
        "description" => __("Add your social to contact.", "js_composer"),
        "value" => Array(__("Yes, please", "js_composer") => 'yes')
    )    
    )
));
}
/****************************/
/*  TABLES CONTAINER&HEAD  */
/***************************/
function mukam_tables($atts, $content = null) {
    extract(shortcode_atts( array(
        'delay' => '',
        'animation' => 'no_animation'       
    ),
    $atts));

    $mydelay = '';
    if ( $delay != '') {
    $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
    }
    return '<div class="'.$animation.' mukam-table animated"'.$mydelay.'>'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'mukam_table', 'mukam_tables' );

add_action( 'init', 'mukam_tables_integrateWithVC' );
function mukam_tables_integrateWithVC() {
vc_map( array(
   "name" => __("Mukam Price Tables", 'BLICCA_THEME'),
   "base" => "mukam_table",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend_admin.css'),
   "params" => array(    

    array(
        "type" => "textarea_html",
        "holder" => "div",
        "class" => "",
        "heading" => __("Content", 'BLICCA_THEME'),
        "param_name" => "content",
        "value" => "",
        "description" => __("Click Row icon.", 'BLICCA_THEME')
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'BLICCA_THEME'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'BLICCA_THEME')
    ),
    array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    )
    )
   ));
}
/****************************/
/*       TABLES ROW         */
/***************************/
function mukam_rows($atts, $content = null) {
  extract(shortcode_atts( array(
        'color' => '',
        'title' => ''
    ),
    $atts ));
  return '<div class="mukam-line '.$color.'"><p>'.$title.'<p>'.do_shortcode($content).'</div>';
}
add_shortcode('mukam_row', 'mukam_rows');
/****************************/
/*     TABLES PRICE ROW     */
/****************************/
function mukam_price_rows($atts) {
  extract(shortcode_atts( array(
        'color' => '',
        'price' => '',
        'title' => '',
        'subtitle' => '',
        'currency' => ''
    ),
    $atts ));
  return '<div class="price-line '.$color.'"><p>'.$title.'<p><p class="period">'.$subtitle.'</p><div class="price"><span class="mcurrency">'.$currency.'</span><span class="money">'.$price.'</span></div></div>';
}
add_shortcode('mukam_price_row', 'mukam_price_rows');
/*****************************/
/* ADD BUTTON TO WP EDITOR  */
/***************************/
add_action( 'init', 'mukam_tiny' );
function mukam_tiny() {
    add_filter( "mce_external_plugins", "mukam_add_buttons" );
    add_filter( 'mce_buttons', 'mukam_register_buttons' );
}
function mukam_add_buttons( $plugin_array ) {
    $plugin_array['mukam_tiny'] = get_template_directory_uri() . '/js/wpeditor.js';
    return $plugin_array;
}
function mukam_register_buttons( $buttons ) {
    array_push( $buttons, 'mukam_price_row', 'mukam_row', 'mbuttons'); 
    return $buttons;
}
/*****************/
/*  Mini Social  */
/*****************/
function mukam_mini_social () {
$theme_options = get_option('option_tree');
$contact_social = '';

if ( get_option_tree('social_dribbble', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_dribbble', $theme_options).'" target="_blank"><div class="social-box"><i class="mukam-dribble"></i></div></a>';
}

if ( get_option_tree('social_google', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_google', $theme_options).'" target="_blank"><div class="social-box"><i class="mukam-google"></i></div></a>';
}

if ( get_option_tree('social_skype', $theme_options) != '') {
  $contact_social .= '<a href="skype:'.get_option_tree('social_skype', $theme_options).'" target="_blank"><div class="social-box"><i class="mukam-skype"></i></div></a>';
}

if ( get_option_tree('social_youtube', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_youtube', $theme_options).'" target="_blank"><div class="social-box"><i class="mukam-youtube"></i></div></a>';
}

if ( get_option_tree('social_twitter', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_twitter', $theme_options).'" target="_blank"><div class="social-box"><i class="mukam-tweet"></i></div></a>';
}

if ( get_option_tree('social_facebook', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_facebook', $theme_options).'" target="_blank"><div class="social-box"><i class="mukam-face"></i></div></a>';
}

if ( get_option_tree('social_foursquare', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_foursquare', $theme_options).'" target="_blank"><div class="social-box"><i class="icon-foursquare"></i></div></a>';
}

if ( get_option_tree('social_yelp', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_yelp', $theme_options).'" target="_blank"><div class="social-box"><i class="icomoon-yelp"></i></div></a>';
}

if ( get_option_tree('social_instagram', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_instagram', $theme_options).'" target="_blank"><div class="social-box"><i class="icon-instagram"></i></div></a>';
}

if ( get_option_tree('social_linkedin', $theme_options) != '') {
  $contact_social .= '<a href="'.get_option_tree('social_linkedin', $theme_options).'" target="_blank"><div class="social-box"><i class="icon-linkedin"></i></div></a>';
}

echo $contact_social;

}

/***********************/
/* Register Plugin CSS */
/***********************/

function mukam_plugin_style(){

   wp_enqueue_style( 'plugin_style', get_template_directory_uri().'/css/vc_recode.css' );

}
add_action('wp_footer', 'mukam_plugin_style');
function mukam_overwrite_shortcode() 
{ 
/* Start */
/* Row */
$setting_row = array (
"params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Row Style", "js_composer"),
      "param_name" => "row_style",
      "value" => array(__("None", "js_composer") => "nostyle", __("Asset Color", "js_composer") => "asset-bg", __("Custom Color", "js_composer") => "bg-color", __("Image", "js_composer") => "image", __("Parallax", "js_composer") => "parallax", __("Slider", "js_composer") => "slider", __("Video", "js_composer") => "video"),
      "description" => __("You can choose background color, image or parallax image for your row, choose slider if you want to add Home Page Layer Slider in your row", "js_composer")
    ),
  array(
      "type" => "attach_image",
      "heading" => __("Video Image", "js_composer"),
      "param_name" => "video_img",
      "value" => "",
      "description" => __("Select image for non-support video background", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('video'))
    ),
    array(
      "type" => "textfield",
      "heading" => __("Video MP4 URL", "js_composer"),
      "param_name" => "video_url",
      "description" => __("Add your video url, mp4 file type.", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('video'))
    ),
  array(
      "type" => "textfield",
      "heading" => __("Video .webm URL", "js_composer"),
      "param_name" => "video_url_webm",
      "description" => __("Add your video url, webm file type.", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('video'))
    ),
  array(
      "type" => "textfield",
      "heading" => __("Video .ogv URL", "js_composer"),
      "param_name" => "video_url_ogv",
      "description" => __("Add your video url, webm file type.", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('video'))
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Row Background Color", "js_composer"),
      "param_name" => "custombgcolor",
      "description" => __("Select custom background color for rows.", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('bg-color'))
    ),
    array(
      "type" => 'checkbox',
      "heading" => __("Remove Padding Your Container", "js_composer"),
      "param_name" => "removepadding",
      "description" => __("If selected, your container have not space top and bottom", "js_composer"),
      "value" => Array(__("Yes, please", "js_composer") => 'yes'),
      "dependency" => Array('element' => "row_style", 'value' => array('bg-color'))
    ),
    array(
      "type" => "attach_image",
      "heading" => __("Image", "js_composer"),
      "param_name" => "custom_image",
      "value" => "",
      "description" => __("Select image from media library.", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('image', 'parallax'))
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Background Repeat", "js_composer"),
      "param_name" => "image_repeat",
      "value" => array(__("No Repeat", "js_composer") => "no-repeat", __("Repeat X", "js_composer") => "repeat-x", __("Repeat Y", "js_composer") => "repeat-y", __("Repeat", "js_composer") => "repeat"),
      "description" => __("Choose repeat of your image", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('image'))
    ),
    array(
      "type" => "textfield",
      "heading" => __("Parallax Image Ratio", "js_composer"),
      "param_name" => "image_ratio",
      "description" => __("You need set your parallax effects ratio, please look documentation", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('parallax'))
    ),
    array(
      "type" => 'checkbox',
      "heading" => __("Add Padding to Container", "js_composer"),
      "param_name" => "addpadding",
      "description" => __("If selected, your content will have space top and bottom", "js_composer"),
      "value" => Array(__("Yes, please", "js_composer") => 'yes'),
      "dependency" => Array('element' => "row_style", 'value' => array('parallax'))
    ),
    array(
      "type" => "textfield",
      "heading" => __("Parallax Image Ratio", "js_composer"),
      "param_name" => "image_ratio",
      "description" => __("You need set your parallax effects ratio, please look documentation", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('parallax'))
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )

    )
  );
  vc_map_update('vc_row', $setting_row);

/* Row Inner */
$setting_row_inner = array (
"params" => array(
   array(
      "type" => "dropdown",
      "heading" => __("Row Style", "js_composer"),
      "param_name" => "row_style",
      "value" => array(__("None", "js_composer") => "nostyle", __("Background Image", "js_composer") => "image", __("Blog Style", "js_composer") => "blog-content"),
      "description" => __("You can choose background color, image or parallax image for your row, choose slider if you want to add Home Page Layer Slider in your row", "js_composer")
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Row Background Color", "js_composer"),
      "param_name" => "custombgcolor",
      "description" => __("Select custom background color for rows.", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('bg-color'))
    ),
    array(
      "type" => "attach_image",
      "heading" => __("Image", "js_composer"),
      "param_name" => "custom_image",
      "value" => "",
      "description" => __("Select image from media library.", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('image'))
    ),
    array(
      "type" => 'checkbox',
      "heading" => __("Background Size", "js_composer"),
      "param_name" => "b_size",
      "description" => __("If selected, your image has full-width", "js_composer"),
      "value" => Array(__("Yes, please", "js_composer") => 'yes'),
      "dependency" => Array('element' => "row_style", 'value' => array('image'))      
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Background Repeat", "js_composer"),
      "param_name" => "image_repeat",
      "value" => array(__("No Repeat", "js_composer") => "no-repeat", __("Repeat X", "js_composer") => "repeat-x", __("Repeat Y", "js_composer") => "repeat-y", __("Repeat", "js_composer") => "repeat"),
      "description" => __("Choose repeat of your image", "js_composer"),
      "dependency" => Array('element' => "row_style", 'value' => array('image'))
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  )
  );
  vc_map_update('vc_row_inner', $setting_row_inner);
/* Text Widget */
$setting_vc_column_text = array (
"params" => array(
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "heading" => __("Text", "js_composer"),
      "param_name" => "content",
      "value" => __("<p>I am text block. Click edit button to change this text.</p>", "js_composer")
    ),
    array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam')
    ),
    array (
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation Delay", 'mukam'),
        "param_name" => "delay",
        "description"=> __("If you write 1000, it means your animation will work after 1 second", 'mukam')
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  )
  );
  vc_map_update('vc_column_text', $setting_vc_column_text);



/* Tabs */
$setting_vc_tabs = array (
"params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "js_composer"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Tabs Style", "js_composer"),
      "param_name" => "tabs_style",
      "value" => array(__("Tabs Classic", "js_composer") => "tabs-classic", __("Tour Section", "mukam") => "tour-section", __("Tour Section 2", "js_composer") => "tour-section-2", __("Tabs Featured", "js_composer") => "tabs-featured"),
      "description" => __("Auto rotate tabs each X seconds.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  )
  );
  vc_map_update('vc_tabs', $setting_vc_tabs);


/* Teaser Grid*/
vc_add_param( 'vc_teaser_grid', array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => __("CSS Animation", 'mukam'),
        "param_name" => "animation",
        "value" => array(__('No Animation', "js_composer") => "no_animation", __('Tada', "js_composer") => "tadab-1 blind", __('Flip In X', "js_composer") => "flipInX-1 blind", __('Flip In Y', "js_composer") => "flipInY-1 blind", __('Fade In', "js_composer") => "fadeIn-1 blind", __('Fade In Up', "js_composer") => "fadeInUp-1 blind", __('Fade In Down', "js_composer") => "fadeInDown-1 blind", __('Fade In Left', "js_composer") => "fadeInLeft-1 blind", __('Fade In Right', "js_composer") => "fadeInRight-1 blind", __('Fade In Up Big', "js_composer") => "fadeInUpBig-1 blind", __('Fade In Down Big', "js_composer") => "fadeInDownBig-1 blind", __('Fade In Left Big', "js_composer") => "fadeInLeftBig-1 blind", __('Fade In Right Big', "js_composer") => "fadeInRightBig-1 blind", __('Bounce In', "js_composer") => "bounceIn-1 blind", __('Bounce In Down', "js_composer") => "bounceInDown-1 blind",  __('Bounce In Left', "js_composer") => "bounceInLeft-1 blind", __('Bounce In Right', "js_composer") => "bounceInRight-1 blind", __('Rotate In', "js_composer") => "rotateIn-1 blind", __('Rotate In Down Left', "js_composer") => "rotateInDownLeft-1 blind", __('Rotate In Down Right', "js_composer") => "rotateInDownRight-1 blind", __('Rotate In Up Left', "js_composer") => "rotateInUpLeft-1 blind", __('Rotate In Up Right', "js_composer") => "rotateInUpRight-1 blind", __('Light Speed In', "js_composer") => "lightSpeedIn-1 blind", __('Roll In', "js_composer") => "rollIn-1 blind", __('Special Effect 1', "js_composer") => "blogeffect4-1 blind", __('Special Effect 2', "js_composer") => "blogeffect5-1 blind", __('Special Effect 3', "js_composer") => "blogeffect6-1 blind"),
        "description" => __("Choose your animation.", 'mukam'),
        "dependency" => Array('element' => "grid_template", 'value' => array('grid', 'filtered_grid'))
    ) );
vc_add_param( 'vc_teaser_grid', array(
      "type" => "textfield",
      "heading" => __("Add delay your animation?", "js_composer"),
      "param_name" => "delay",
      "description" => __("If you write 1000, it means your animation will work after 1 second", "js_composer"),
      "value" => '',
        "dependency" => Array('element' => "grid_template", 'value' => array('grid', 'filtered_grid'))    
    ) );
vc_add_param( 'vc_teaser_grid', array(
      "type" => "textfield",
      "heading" => __("Add start delay your animation?", "js_composer"),
      "param_name" => "delaystart",
      "description" => __("This is usefull if you are using page load animation, if you dont use page load, leave this area blank.", "js_composer"),
      "value" => '',
      "dependency" => Array('element' => "grid_template", 'value' => array('grid', 'filtered_grid')) 
    ) );
/* Finish */
} 
add_action( 'wp_loaded', 'mukam_overwrite_shortcode' );