<?php

// Buttons

add_shortcode('button', 'button_func');
function button_func($atts, $content = null){

	extract(shortcode_atts(array(
		'btntext' 	=> '',
		'btnlink' 	=> '',
		'color'		  => '',
		'type'		  => '',
    'size'      => '',
		'radius'		=> '',
	), $atts));
	ob_start(); ?>
	<?php 
    $type1 = '';
    $size2 = '';
    $rad = '';
    if($type == 'info'){
      $type1 = ' btn-info';
    }elseif($type == 'success'){
      $type1 = ' btn-success';
    }elseif($type == 'warning'){
      $type1 = ' btn-warning';
    }elseif($type == 'danger'){
      $type1 = ' btn-danger';
    }elseif($type == 'primary'){
      $type1 = ' btn-primary';
    }else{
      $type1 = ' btn-default';
    }

    if($size == 'small'){
      $size2 = ' btn-sm';
    }elseif($size == 'large'){
      $size2 = ' btn-lg';
    }
    if($radius == 'true'){
      $rad = ' no-radius';
    }
  ?>
  <a href="<?php echo esc_url($btnlink); ?>" class="btn<?php echo esc_attr($size2.$type1.$rad); ?>"><?php echo esc_attr($btntext); ?></a>
  
  <?php return ob_get_clean();
}

// Search Course Form
add_shortcode('searchform', 'searchform_func');
function searchform_func($atts, $content = null){
  extract(shortcode_atts(array(
    'place' => 'Search course...'
  ), $atts));
  
  ob_start(); ?>

  <form method="get" id="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
    <div class="input-group">
      <input type="text" placeholder="<?php echo esc_attr($place); ?>" name="s" class="form-control style_2" />
      <span class="input-group-btn">
        <button class="btn" type="submit"><i class="icon-search"></i></button>
      </span>
    </div>
    <input type="hidden" name="post_type" value="course" />
  </form>     

  <?php

    return ob_get_clean();
}

// Latest Courses
add_shortcode('latestcourse', 'latestcourse_func');
function latestcourse_func($atts, $content = null){
  extract(shortcode_atts(array(
    'number'  =>  '4',
    'col'     =>  '4',
    'link'    =>  '',
    'slink'   =>  '#',
    'btn'     =>  'View all courses',
  ), $atts));
  if($col == 1){
    $col1 = 12;
  }elseif($col == 4){
    $col1 = 3;
  }elseif ($col == 2) {
    $col1 = 6;
  }else{
    $col1 = 4;
  }
  ob_start(); ?>
  
    <div class="row">

        <?php 

        $recent = new WP_Query( array(

          'post_type' => 'course', 

          'posts_per_page' => $number,

          'meta_query' => array(
                  array(
                          'key' => '_cmb_sd_course',
                          'value' => date('Y-m-d'),
                          'compare' => '<=',
                  ),
          ),

        ) );

        while ($recent->have_posts()) :$recent-> the_post();

        $s_date = get_post_meta(get_the_ID(),'_cmb_sd_course', true);

        if($s_date){
          $date1 = new DateTime($s_date);
        }else{
          $date1 = new DateTime(get_the_date('Y-m-d', get_the_ID()));        
        }
        
        $date2 = new DateTime(date('Y-m-d'));

        $diff = date_diff($date1,$date2);
        
        $terms = get_the_terms( $post->ID, 'course-category' );

        ?>
        <div class="col-md-<?php echo esc_attr($col1); ?>">
          <div class="col-item">
            <div class="photo">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""></a>
                <div class="cat_row">
                  <?php if($terms) { ?>   
                    <?php foreach ( $terms as $term ) { ?>
                      <a href="<?php echo esc_url(get_term_link($term, 'course-category')); ?>"><?php echo esc_html($term->name); ?></a> 
                  <?php } } ?>
                  <span class="pull-right"><i class=" icon-clock"></i><?php echo esc_html($diff->days) . esc_html__(' Days', 'learn'); ?></span>
                </div>
            </div>
            <div class="info">
                <div class="row">
                    <div class="course_info col-md-12 col-sm-12">
                        <h4 class="black-color"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php the_excerpt(); ?></p>
                        <div class="rating">
                          <?php learn_get_rating_course(); ?>
                        </div>
                        <div class="price pull-right"><?php echo sensei_simple_course_price(get_the_ID()); ?></div>
                    </div>
                </div>
                <div class="separator clearfix">
                    <p class="btn-add woocommerce">
                      
                    </p>
                    <?php if($slink) { ?><p class="btn-add"> <a href="<?php echo esc_url($slink); ?>"><i class="icon-export-4"></i><?php esc_html_e(' Subscribe','learn'); ?></a></p><?php } ?>
                    <p class="btn-details"><a href="<?php the_permalink(); ?>"><i class=" icon-list"></i><?php esc_html_e(' Details','learn'); ?></a></p>
                </div>
            </div>
          </div>
        </div>

        <?php endwhile; ?>

      </div>
      <?php if($link) { ?>
      <div class="row">
        <div class="col-md-12">
             <a href="<?php echo esc_url($link); ?>" class="button_medium_outline pull-right"><?php echo htmlspecialchars_decode($btn); ?></a>
          </div>
      </div>
      <?php } ?>

    <?php

    return ob_get_clean();
}

// Next Courses
add_shortcode('nextcourse', 'nextcourse_func');
function nextcourse_func($atts, $content = null){
  extract(shortcode_atts(array(
    'number'  =>  '4',
    'col'     =>  '4',
    'link'    =>  '',
    'btn'     =>  'View all courses',
  ), $atts));
  if($col == 1){
    $col1 = 12;
  }elseif($col == 4){
    $col1 = 3;
  }elseif ($col == 2) {
    $col1 = 6;
  }else{
    $col1 = 4;
  }
  ob_start(); ?>
  
    <div class="row">

        <?php 

        $next = new WP_Query( array(

          'post_type' => 'course', 

          'posts_per_page' => $number,

          'meta_query' => array(
                  array(
                          'key' => '_cmb_sd_course',
                          'value' => date('Y-m-d'),
                          'compare' => '>',
                  ),
          ),

        ) );

        while ($next->have_posts()) :$next-> the_post();

        $s_date = get_post_meta(get_the_ID(),'_cmb_sd_course', true);

        if($s_date){
          $date1 = new DateTime($s_date);
        }else{
          $date1 = new DateTime(get_the_date('Y-m-d', get_the_ID()));          
        }
        
        $date2 = new DateTime(date('Y-m-d'));
        
        $terms = get_the_terms( $post->ID, 'course-category' );

        ?>

        <div class="col-md-<?php echo esc_attr($col1); ?>">
          <div class="media next-course">
             <div class="circ-wrapper pull-left"><h3><?php echo date("d", strtotime($s_date)); ?><br><?php echo date("M", strtotime($s_date)); ?></h3></div>
              <div class="media-body">
              <h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
               <?php the_excerpt(); ?>
               <ul class="data-lessons">
                 <li class="po-markup">
                  <?php if($terms) { ?>   
                    <?php foreach ( $terms as $term ) { ?>
                      <i class="fa fa-folder-open-o"></i> <?php echo esc_html($term->name); ?>
                  <?php } } ?>                
                  </li>
                  <li class="po-markup">
                    <i class="fa fa-clock-o"></i> <?php echo learn_lesson_length(); esc_html_e(' minutes', 'learn'); ?>              
                  </li>                  
              </ul>
             </div>
          </div>
        </div>  
        <?php endwhile; ?>

      </div>
      <?php if($link) { ?>
      <div class="row">
        <div class="col-md-12">
             <a href="<?php echo esc_url($link); ?>" class="button_medium_outline pull-right"><?php echo htmlspecialchars_decode($btn); ?></a>
          </div>
      </div>
      <?php } ?>

    <?php

    return ob_get_clean();
}

// Pricing Table

add_shortcode('pricingtable', 'pricingtable_func');
function pricingtable_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'    => '',
    'price'    => '',
    'per'      => '',
    'btn'      => '',
    'link'     => '',
    'fea'      => '',
    'type'     => '',
  ), $atts));

  if($fea){
    $fea1 = ' plan-tall';
    $fea2 = ' green';
  }else{
    $fea2 = ' black';
  }

  ob_start(); ?>

  <?php if(!$type) { ?>
  <div class="plan<?php echo esc_attr($fea1); ?>">
      <?php if($fea){ ?>
      <span class="ribbon_2"></span>
      <?php } ?>
      <h2 class="plan-title"><?php echo htmlspecialchars_decode($title); ?></h2>
      <p class="plan-price"><?php echo htmlspecialchars_decode($price); ?><span><?php echo htmlspecialchars_decode($per); ?></span></p>
      <div class="plan-features">
        <?php echo htmlspecialchars_decode($content); ?>
      </div>
      <p class="text-center"><a href="<?php echo esc_url($link); ?>" class="button_medium"><?php echo htmlspecialchars_decode($btn); ?></a></p>
  </div>
  <?php }else{ ?>
  <div class="pricing-table<?php echo esc_attr($fea2); ?>">
      <?php if($fea){ ?>
      <span class="ribbon_2"></span>
      <?php } ?>
      <div class="pricing-table-header">
          <span class="heading"><?php echo htmlspecialchars_decode($title); ?></span>
          <span class="price-value"><span><?php echo htmlspecialchars_decode($price); ?></span><span class="mo"><?php echo htmlspecialchars_decode($per); ?></span></span>
      </div>
      <div class="pricing-table-space "></div>
      <div class="pricing-table-features">
          <?php echo htmlspecialchars_decode($content); ?>
      </div>
      
      <div class="pricing-table-sign-up">
          <a href="<?php echo esc_url($link); ?>" class="button_fullwidth"><?php echo htmlspecialchars_decode($btn); ?></a>
      </div>

  </div>
  <?php } ?>

  <?php
    return ob_get_clean();
}


// Services
add_shortcode('services', 'services_func');
function services_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'   =>  '',
    'icon'    =>  '',
    'type'    =>  '',
  ), $atts));
  
  ob_start(); ?>

  <div class="feature <?php if($type) echo 'light'; ?>">
      <i class="<?php echo esc_attr($icon); ?>"></i>
      <h3><?php echo htmlspecialchars_decode($title); ?></h3>
      <p><?php echo htmlspecialchars_decode($content); ?></p>
  </div>     

  <?php

    return ob_get_clean();
}

// Features Box
add_shortcode('featurebox', 'featurebox_func');
function featurebox_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'   =>  '',
    'icon'    =>  '',
    'type'    =>  '',
    'btn'     =>  '',
    'link'    =>  '',
  ), $atts));

  ob_start(); ?>

  <div class="about-us-links">
    <?php if($icon) { ?><i class="<?php echo esc_attr($icon); ?>"></i><?php } ?>
    <h3><?php echo htmlspecialchars_decode($title); ?></h3>
    <p><?php echo htmlspecialchars_decode($content); ?></p>
    <?php if($link) { ?><div class="cta-button"><p><span><a href="<?php echo esc_url($link); ?>"><?php echo htmlspecialchars_decode($btn); ?></a></span></p></div><?php } ?>
  </div>    

  <?php

    return ob_get_clean();
}


// Testimonial Silder

add_shortcode('testslide','testslide_func');

function testslide_func($atts, $content = null){

	extract(shortcode_atts(array(

		'skin'	=>		'',

	), $atts));

	ob_start(); ?>

  <div class="carousel slide quote-carousel" data-ride="carousel" id="quote-carousel">
    <!-- Bottom Carousel Indicators -->
    <ol class="carousel-indicators">
      <?php

        $args = array(

          'post_type'      => 'testimonial',
          'posts_per_page' => -1

        );

        $testimonial = new WP_Query($args);
        $i = 0;
        if($testimonial->have_posts()) : while($testimonial->have_posts()) : $testimonial->the_post();
        
      ?>
      <li data-target="#quote-carousel" data-slide-to="<?php echo esc_attr($i); ?>" class="<?php if($i==0) echo 'active'; ?>"></li>
      <?php $i++; endwhile; endif; ?>
    </ol>
    <!-- Carousel Slides / Quotes -->
    <div class="carousel-inner <?php if($skin) echo 'light'; ?>">
      <?php

        $args = array(

          'post_type' => 'testimonial',

          'posts_per_page' => $number,

        );

        $testimonial = new WP_Query($args);
        $i = 0;
        if($testimonial->have_posts()) : while($testimonial->have_posts()) : $testimonial->the_post();
        
      ?>
      <div class="item <?php if($i==0) echo 'active'; ?>">
        <blockquote>
          <div class="row">
            <div class="col-sm-3 text-center">
              <img class="img-circle" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" />
            </div>
            <div class="col-sm-9">
              <?php the_content(); ?>
              <small><?php the_title(); ?></small>
            </div>
          </div>
        </blockquote>
      </div>
      <?php $i++; endwhile; endif; ?>
    </div>
  </div>  

	<?php

    return ob_get_clean();

}


// FAQs

add_shortcode('otfaqs', 'otfaqs_func');
function otfaqs_func($atts, $content = null){
  extract(shortcode_atts(array(
    'question'     =>  '',
  ), $atts));
  ob_start(); ?>

  <div class="faq-subheader">
    <div class="question"><?php echo htmlspecialchars_decode($question); ?></div>
    <p><?php echo htmlspecialchars_decode($content); ?></p>
  </div>
  
  <?php

  return ob_get_clean();
}

// Our Team
add_shortcode('ourteam', 'ourteam_func');
function ourteam_func($atts, $content = null){
  extract(shortcode_atts(array(
    'name'    =>  '',
    'photo'   =>  '',
    'job'     =>  '',
    'phone'   =>  '',
    'soc1'    =>  '',
    'soc2'    =>  '',
    'soc3'    =>  '',
    'soc4'    =>  '',
    'btn'    =>  '',
    'type'   =>  '',
  ), $atts));
  $img = wp_get_attachment_image_src($photo,'full');
  $img = $img[0];
  $url1 = vc_build_link( $soc1 );
  $url2 = vc_build_link( $soc2 );
  $url3 = vc_build_link( $soc3 );
  $url4 = vc_build_link( $soc4 );
  $btn2 = vc_build_link( $btn );
  ob_start(); ?>

  <?php if(!$type) { ?>
  <div class="thumbnail">
    <div class="project-item-image-container">
      <img src="<?php echo esc_url($img); ?>" alt="">
    </div>
    <div class="caption">
      <div class="transit-to-top">
        <h4 class="p-title"><?php echo htmlspecialchars_decode($name); ?> <small><?php echo htmlspecialchars_decode($job); ?></small></h4>
        <div class="widget_nav_menu">
          <ul class="social_team">
            <?php if($url1['url']) { echo '<li><a href="' . esc_attr( $url1['url'] ) . '" title="' . esc_attr( $url1['title'] ) . '" target="' . ( strlen( $url1['target'] ) > 0 ? esc_attr( $url1['target'] ) : '_self' ) . '"><i class="icon-'. esc_attr( $url1['title'] ) .'"></i></a></li>'; } ?>
            <?php if($url2['url']) { echo '<li><a href="' . esc_attr( $url2['url'] ) . '" title="' . esc_attr( $url2['title'] ) . '" target="' . ( strlen( $url2['target'] ) > 0 ? esc_attr( $url2['target'] ) : '_self' ) . '"><i class="icon-'. esc_attr( $url2['title'] ) .'"></i></a></li>'; } ?>
            <?php if($url3['url']) { echo '<li><a href="' . esc_attr( $url3['url'] ) . '" title="' . esc_attr( $url3['title'] ) . '" target="' . ( strlen( $url3['target'] ) > 0 ? esc_attr( $url3['target'] ) : '_self' ) . '"><i class="icon-'. esc_attr( $url3['title'] ) .'"></i></a></li>'; } ?>
            <?php if($url4['url']) { echo '<li><a href="' . esc_attr( $url4['url'] ) . '" title="' . esc_attr( $url4['title'] ) . '" target="' . ( strlen( $url4['target'] ) > 0 ? esc_attr( $url4['target'] ) : '_self' ) . '"><i class="icon-'. esc_attr( $url4['title'] ) .'"></i></a></li>'; } ?>
          </ul>
          <div class="phone-info">
            <i class=" icon-phone"></i> <?php echo htmlspecialchars_decode($phone); ?>
          </div><!-- End phone info -->
        </div><!-- End widget_nav_menu -->
      </div><!-- transition top -->
    </div><!-- caption -->
  </div>
  <?php }else{ ?>
  <div class=" box_style_3">
    <p><img src="<?php echo esc_url($img); ?>" alt="" class="img-circle styled"></p>
    <h4 class="p-title"><?php echo htmlspecialchars_decode($name); ?> <small><?php echo htmlspecialchars_decode($job); ?></small></h4>
    <p><?php echo htmlspecialchars_decode($content); ?></p>   
    <ul class="social_team">
        <?php if($url1['url']) { echo '<li><a href="' . esc_attr( $url1['url'] ) . '" title="' . esc_attr( $url1['title'] ) . '" target="' . ( strlen( $url1['target'] ) > 0 ? esc_attr( $url1['target'] ) : '_self' ) . '"><i class="icon-'. esc_attr( $url1['title'] ) .'"></i></a></li>'; } ?>
        <?php if($url2['url']) { echo '<li><a href="' . esc_attr( $url2['url'] ) . '" title="' . esc_attr( $url2['title'] ) . '" target="' . ( strlen( $url2['target'] ) > 0 ? esc_attr( $url2['target'] ) : '_self' ) . '"><i class="icon-'. esc_attr( $url2['title'] ) .'"></i></a></li>'; } ?>
        <?php if($url3['url']) { echo '<li><a href="' . esc_attr( $url3['url'] ) . '" title="' . esc_attr( $url3['title'] ) . '" target="' . ( strlen( $url3['target'] ) > 0 ? esc_attr( $url3['target'] ) : '_self' ) . '"><i class="icon-'. esc_attr( $url3['title'] ) .'"></i></a></li>'; } ?>
        <?php if($url4['url']) { echo '<li><a href="' . esc_attr( $url4['url'] ) . '" title="' . esc_attr( $url4['title'] ) . '" target="' . ( strlen( $url4['target'] ) > 0 ? esc_attr( $url4['target'] ) : '_self' ) . '"><i class="icon-'. esc_attr( $url4['title'] ) .'"></i></a></li>'; } ?>
    </ul>
    <hr>
    <?php if($btn2['title']) { echo '<a class="button_medium_outline" href="' . esc_attr( $btn2['url'] ) . '" title="' . esc_attr( $btn2['title'] ) . '" target="' . ( strlen( $btn2['target'] ) > 0 ? esc_attr( $btn2['target'] ) : '_self' ) . '">'. esc_attr( $btn2['title'] ) .'</a>'; } ?>                  
  </div>
  <?php } ?>

  <?php

    return ob_get_clean();
}

// Logos Client
add_shortcode('logos', 'logos_func');
function logos_func($atts, $content = null){
	extract(shortcode_atts(array(
    'gallery'   =>  '',
    'number'    =>  '6',
    'speed'     =>  '5000',
		'type'		  => 	'',
	), $atts));
	ob_start(); ?>

	<div class="logos">
    	<?php 
  		$img_ids = explode(",",$gallery);
  		foreach( $img_ids AS $img_id ){
  		$meta = wp_prepare_attachment_for_js($img_id);
  		$caption = $meta['caption'];
  		$title = $meta['title'];	
  		$description = $meta['description'];	
  		$image_src = wp_get_attachment_image_src($img_id,''); ?>
        <?php if(!empty($caption)){ ?> 
        	<div class="item"><a target="_blank" href="<?php echo esc_attr($caption); ?>">
	            <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($title); ?>">
	        </a></div>
        <?php }else{ ?>         	
	        <div class="item"><img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($title); ?>"></div>
        <?php } ?>
      <?php } ?>
  </div>

  <script type="text/javascript">
  (function($) {
  "use strict";
    $(".logos").owlCarousel({

        autoPlay: <?php echo esc_js($speed); ?>,
        items: <?php echo esc_js($number); ?>,
        itemsDesktop: [1199, <?php echo esc_js($number); ?>-1],
        itemsDesktopSmall: [979, <?php echo esc_js($number); ?>-2],
        pagination: false

    });
  })(jQuery);
  </script>     

	<?php

    return ob_get_clean();
}


// Photo & Video Gallery 
add_shortcode('pavgallery', 'pavgallery_func');
function pavgallery_func($atts, $content = null){
  extract(shortcode_atts(array(
    'image'     =>  '',
    'video'     =>  '',
    'type'      =>  '',
  ), $atts));

  $img = wp_get_attachment_image_src($image,'full');
  $img = $img[0];

  if($type){
    $class = 'fancybox-media';
    $icon  = 'icon-video';
    $link  = $video;
  }else{
    $class = 'fancybox';
    $icon  = 'icon-picture-4';
    $link  = $img;
  }

  ob_start(); ?>

  <div class="picture">
    <a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>" rel="gallery1">
      <span class="photo_icon"><i class="<?php echo esc_attr($icon); ?>"></i></span>
      <img src="<?php echo esc_url($img); ?>" alt="" class="img-responsive">
    </a>
  </div>

  <?php

    return ob_get_clean();
}


// Get Directions
add_shortcode('getdirect', 'getdirect_func');
function getdirect_func($atts, $content = null){
  extract(shortcode_atts(array(
    'btn'     =>  'GET DIRECTIONS',
    'address' =>  'New York, NY 11430',
  ), $atts));

  ob_start(); ?>

  <form action="http://maps.google.com/maps" method="get" target="_blank">
    <div class="input-group">
      <input type="text" name="saddr" placeholder="<?php esc_html_e('Enter your starting point','learn'); ?>" class="form-control style-2" />
      <input type="hidden" name="daddr" value="<?php echo esc_attr($address); ?>"/><!-- Write here your end point -->
      <span class="input-group-btn">
        <button class="btn" type="submit"><?php echo esc_html($btn); ?></button>
      </span>
    </div><!-- /input-group -->
  </form> 

  <?php

    return ob_get_clean();
}


// Google Map

add_shortcode('ggmap','ggmap_func');
function ggmap_func($atts, $content = null){
    extract( shortcode_atts( array(
      'idmap'    => 'map-canvas',
      'height'   => '',	
      'lat'      => '',
      'long'     => '',
      'zoom'     => '',
      'mapcolor' => '',
      'icon'     => '',
   ), $atts ) );
   
   $icon1 = wp_get_attachment_image_src($icon,'full');
   $icon1 = $icon1[0];
   if(!$zoom){
   	$zoom = 13;
   }
   		
    ob_start(); ?>
    	 
    <div id="<?php echo esc_attr( $idmap ); ?>" class="contacts-map" style="<?php if($height) echo 'height: '.$height.'px;'; ?>"></div>

    <script type="text/javascript">
	
	  (function($) {
    "use strict"
    $(document).ready(function(){
        
        var locations = [
      ['', <?php echo esc_attr( $lat );?>, <?php echo esc_attr( $long );?>, 2]
        ];
    
    var map = new google.maps.Map(document.getElementById('<?php echo esc_attr( $idmap ); ?>'), {
      zoom: <?php echo esc_attr( $zoom );?>,
      scrollwheel: false,
      navigationControl: true,
      mapTypeControl: false,
      scaleControl: false,
      draggable: true,
      styles: [ { "stylers": [ { "hue": "<?php echo esc_attr( $mapcolor );?>" }, { "gamma": 1 } ] } ],
      center: new google.maps.LatLng(<?php echo esc_attr( $lat );?>, <?php echo esc_attr( $long );?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  
    var infowindow = new google.maps.InfoWindow();
  
    var marker, i;
  
    for (i = 0; i < locations.length; i++) {  
    
      marker = new google.maps.Marker({ 
      position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
      map: map ,
      icon: '<?php echo esc_url( $icon1 );?>'
      });
      
    }
        
        });
    })(jQuery);     
    </script>
<?php

    return ob_get_clean();

}