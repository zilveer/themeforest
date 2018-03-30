<?php
/**
 * SHORTCODES
 */
function pp_separator($atts) {
    extract(shortcode_atts(array(), $atts));
    return '<div style="margin:15px 0px;"></div>';
}
add_shortcode('separator', 'pp_separator');


function pureslideshow($atts,$content = null) {
    extract(shortcode_atts(array(), $atts));
    $images =  explode(";", $content);
    $output = '<div class="basic-slider royalSlider rsDefault">';
        foreach($images as $img){
            if(!empty($img)) $output .= '<img src="'.$img.'"/>';
        }
    $output .= '</div>';
    return $output;
}
add_shortcode('pureslideshow', 'pureslideshow');



// new shortcodes
function pp_column($atts, $content = null) {
    extract( shortcode_atts( array(
        'width' => '1/2',
        'place' => 'alpha',
        'custom_class' => ''
        ), $atts ) );

    switch ( $width ) {
        case "full" :
        $w = "columns sixteen";
        break;

        case "1/2" :
        $w = "columns eight";
        break;

        case "half" :
        $w = "columns eight";
        break;

        case "1/3" :
        $w = "column one-third";
        break;

        case "one-third" :
        $w = "column one-third";
        break;

        case "2/3" :
        $w = "column two-thirds";
        break;

        case "1/4" :
        $w = "four columns";
        break;

        case "3/4" :
        $w = "twelve columns";
        break;

        case "one" : $w = "one columns"; break;
        case "two" : $w = "two columns"; break;
        case "three" : $w = "three columns"; break;
        case "four" : $w = "four columns"; break;
        case "five" : $w = "five columns"; break;
        case "six" : $w = "six columns"; break;
        case "seven" : $w = "seven columns"; break;
        case "eight" : $w = "eight columns"; break;
        case "nine" : $w = "nine columns"; break;
        case "ten" : $w = "ten columns"; break;
        case "eleven" : $w = "eleven columns"; break;
        case "twelve" : $w = "twelve columns"; break;
        case "thirteen" : $w = "thirteen columns"; break;
        case "fourteen" : $w = "fourteen columns"; break;
        case "fifteen" : $w = "fifteen columns"; break;
        case "sixteen" : $w = "sixteen columns"; break;


        default :
        $w = 'columns sixteen';
    }
    switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = 'alpha';
    }

    $column = '<div class="'.$w.' '.$custom_class.' ';
    $column .= $p.'">'.do_shortcode( $content ).'</div>';
    if($place=='last') $column .= '<br class="clear" />';
    return $column;
}
add_shortcode('column', 'pp_column');

/**
* Icon shortcode
* Usage: [icon icon="icon-exclamation"]
*/
function pp_icon($atts) {
    extract(shortcode_atts(array(
        'icon'=>''), $atts));
    return '<i class="fa fa-'.$icon.'"></i>';
}
add_shortcode('icon', 'pp_icon');

/**
* Tooltip shortcode
* Usage: [tooltip title="" url=""] [/tooltip] // color, gray, light
*/
function pp_tooltip($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'url' => '#',
        'side' => 'top'
        ), $atts));
    return '<a href="'.$url.'" class="tooltip '.$side.'" title="'.esc_attr($title).'">'.$content.'</a>';
}

add_shortcode('tooltip', 'pp_tooltip');


function pp_button($atts, $content = null) {
    extract(shortcode_atts(array(
        "url" => '#',
        "color" => 'color',  //gray color dark
        "customcolor" => '',
        "iconcolor" => 'white',
        "icon" => '',
        "size" => '',
        "target" => '',
        "custom_class" => '',
        "from_vs" => 'no',
        ), $atts));
    if($from_vs == 'yes') {
        $link = vc_build_link( $url );
        $a_href = $link['url'];
        $a_title = $link['title'];
        $a_target = $link['target'];
        $output = '<a class="button '.$color.' '.$size.' '.$custom_class.'" href="'.$a_href.'" title="'.esc_attr( $a_title ).'" target="'.$a_target.'"';
        if(!empty($customcolor)) { $output .= 'style="background-color:'.$customcolor.'"'; }
        $output .= '>';
        if(!empty($icon)) { $output .= '<i class="fa fa-'.$icon.'  '.$iconcolor.'"></i> '; }
        $output .= $a_title.'</a>';
    } else {
        $output = '<a class="button '.$color.' '.$custom_class.'" href="'.$url.'" ';
        if(!empty($target)) { $output .= 'target="'.$target.'"'; }
        if(!empty($customcolor)) { $output .= 'style="background-color:'.$customcolor.'"'; }
        $output .= '>';
        if(!empty($icon)) { $output .= '<i class="fa fa-'.$icon.'  '.$iconcolor.'"></i> '; }
        $output .= $content.'</a>';
    }
    return $output;
}
add_shortcode('button', 'pp_button');


function etdc_tab_group( $atts, $content ) {
    $GLOBALS['tab_count'] = 0;
    do_shortcode( $content );
    $count = 0;
    if( is_array( $GLOBALS['tabs'] ) ) {
        foreach( $GLOBALS['tabs'] as $tab ) {
            $count++;
            if($tab['icon']) { $tabs[] = '<li><a href="#tab'.$count.'"><i class="fa fa-'.$tab['icon'].'"></i> '.$tab['title'].'</a></li>'; }
            else { $tabs[] = '<li><a href="#tab'.$count.'">'.$tab['title'].'</a></li>'; }
            $panes[] = '<div class="tab-content" id="tab'.$count.'">'.$tab['content'].'</div>';
        }
        $GLOBALS['tab_count'] = 0;
        unset($GLOBALS['tabs']);
        $return = "\n".'<ul class="tabs-nav">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tabs-container">'.implode( "\n", $panes ).'</div>'."\n";
    }
    return $return;
}


function etdc_tab( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Tab %d',
        'icon' => ''
        ), $atts));

    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'icon' => $icon, 'content' =>  do_shortcode( $content ) );
    $GLOBALS['tab_count']++;
}
add_shortcode( 'tabgroup', 'etdc_tab_group' );
add_shortcode( 'tab', 'etdc_tab' );




function pp_accordion( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Tab'
        ), $atts));
    return '<h5 class="acc-trigger"><a href="#">'.$title.'</a></h5><div class="acc-container"><div class="content">'.do_shortcode( $content ).'</div></div>';
}

add_shortcode( 'accordion', 'pp_accordion' );


function pp_box($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => ''
        ), $atts));
    return '<div class="notification closeable '.$type.'"><p>'.do_shortcode( $content ).'</p><a href="#" class="close"></a></div>';
}
add_shortcode('box', 'pp_box');


/*function breadcrumbs() {
    return dimox_breadcrumbs();
}
add_shortcode('breadcrumbs', 'breadcrumbs');
*/
function recent_pf($atts) {
   extract(shortcode_atts(
    array(
        'limit'=>'4',
        'columns' => '4',
        'fullpage' => 'no',
        'orderby'=> 'date',
        'order'=> 'DESC',
        'filters' => '',
        'exclude_posts' => '',
        'lightbox' => 'no',
        'from_vs' => 'no',
        'limit_words' => 11,
        'read_more' => 'no'

        ),
    $atts));

   $output = '';
   $counter = 0;
    if($filters){
        $filterstemparray = explode(',', $filters);
        if (count($filterstemparray)>1) {
            $filtersarray = $filterstemparray;
        } else {
            $filtersarray = $filterstemparray[0];
        }
    };

$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => $limit,
    'orderby' => $orderby,
    'order' => $order,
    );
if(!empty($exclude_posts)) {
    $exl = explode(",", $exclude_posts);
    $args['post__not_in'] = $exl;
}

if(!empty($filters) && $filters!='null') {
    $filters = explode(",", $filters);
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'filters',
            'field' => 'slug',
            'terms' => $filters
            )
        );
}
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ):
    while( $wp_query->have_posts() ) : $wp_query->the_post();
global $post;

$counter++;
if ($counter == 1) {
    $class = 'alpha';
} else if( $counter % $columns == 0) {
    $class = 'omega';
} else if ( $counter % $columns == 1 ) {
    $class = 'alpha';
} else if ($counter == $limit) {
    $class = 'omega';
} else {
    $class = '';
}

$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($wp_query->post->ID), 'large');
$excerpt = get_the_excerpt();
$short_excerpt = string_limit_words($excerpt,$limit_words);
if($from_vs=="yes") { $fullpage="yes"; }
if($fullpage == "yes") {
    $output .='<div class="four columns '.$class.'">';
} else {
    $output .='<div class="four columns">';
}

$id = $wp_query->post->ID;

$type = get_post_meta($id, 'incr_pf_type', true);
$videothumbtype = ot_get_option('portfolio_videothumb');

if($type == 'video' && $videothumbtype == 'video') {
    global $wp_embed;
    $videolink = get_post_meta($id, 'incr_pfvideo_link', true);
    $post_embed = $wp_embed->run_shortcode('[embed  width="280" height="187"]'.$videolink.'[/embed]') ;
    $output .= '<div class="picture recent_video">'.$post_embed.'</div>';
} else {
    if ( has_post_thumbnail()) {
        if($lightbox == 'yes') {
            $thumbbig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
            $title = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true); 
            if ( empty($title) ) {
                     $title = trim(strip_tags( get_post(get_post_thumbnail_id())->post_excerpt )); // If not, Use the Caption
                 }
            if ( empty($title) ) {
                     $title = trim(strip_tags( get_post(get_post_thumbnail_id())->post_title  )); // Finally, use the title
                 }
            $output .='<div class="picture"><a rel="image" title="'.$title.'" href="'. $thumbbig[0] .'">'.get_the_post_thumbnail($post->ID,'portfolio-thumb').'<div class="image-overlay-zoom"></div></a></div>';
        } else {
            $output .='<div class="picture"><a href="'. get_permalink().'">'.get_the_post_thumbnail($post->ID,'portfolio-thumb').'<div class="image-overlay-link"></div></a></div>';
        }

    }
}
$output .=' <div class="item-description"><h5><a href="'. get_permalink().'">'.get_the_title().'</a></h5>';

$output .='<p>'.$short_excerpt.'</p>';
    if($read_more == 'yes') {
        $output .='<a class="button medium color post-entry" href="'. get_permalink().'">'.__('Continue Reading', 'centum').'</a>';
    }
$output .='</div></div>';
    endwhile;  // close the Loop
    endif;
    wp_reset_query();

    return $output;
}
add_shortcode('recent_pf', 'recent_pf');


function purelist($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => ''
        ), $atts));
    return '<div class="'.$type.'">'.$content.'</div>';
}
add_shortcode('list', 'purelist');



function pp_notice( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Notice'
        ), $atts));
    return '<div class="large-notice"><h2>'.$title.'</h2>'.do_shortcode( $content ).'</div>';
}

add_shortcode( 'notice', 'pp_notice' );

function pp_clients( $atts, $content ) {
    extract(shortcode_atts(array(), $atts));
    return '<div class="client-list">'.do_shortcode( $content ).'</div>';
}

add_shortcode( 'clients', 'pp_clients' );


function pp_headline( $atts, $content ) {
    extract(shortcode_atts(array(
        'margin' => 'no-margin',
        'htype' => 'h3'
        ), $atts));
    return '<div class="headline '.$margin.'"><'.$htype.'>'.do_shortcode( $content ).'</'.$htype.'></div>';
}

add_shortcode( 'headline', 'pp_headline' );



function pp_feature( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => '',
        'icon' => '',
        'color' => 'gray',
        'style' => 'circle', //old
        'url' => '',
        'target' => '',
        'custom_icon' => '',
        ), $atts));

if($style=='circle') {
    $output = '<div class="featured-box  homepage">';
    if(!empty($custom_icon)){
       $output .= '<img class="custom-icon" src="'.$custom_icon.'"/>';
    } else {
        if($color != 'gray') {
            $output .= '<div class="circle"><i class="fa fa-'.$icon. '" style="color:' .$color.'"></i><span></span></div>';
        } else {
            $output .= '<div class="circle"><i class="fa fa-'.$icon. '"></i><span></span></div>';
        }
    }
    $output .= '<div class="featured-desc">';
    if(isset($url) && !empty($url)) { $output .= '<h3><a target="'.$target.'" href="'.esc_url($url).'">'.$title.'</a></h3>'; } else { $output .= '<h3>'.$title.'</h3>'; }
    $output .= '<p>'.do_shortcode( $content ).'</p></div></div>';

} else {
    $output = '<div class="icon-box">';
    if(!empty($custom_icon)){
       $output .= '<img class="custom-icon" src="'.$custom_icon.'"/>';
    } else {
        if($color != 'gray') {
            $output .= '<i class="fa fa-'.$icon. '" style="color:' .$color.'"></i>';
        } else {
            $output .= '<i class="fa fa-'.$icon. '"></i>';
        }
    }
    $output .= '<div class="icon-box-content">';
    if(isset($url) && !empty($url)) { $output .= '<h3><a target="'.$target.'" href="'.esc_url($url).'">'.$title.'</a></h3>'; } else { $output .= '<h3>'.$title.'</h3>'; }
    $output .= '<p>'.do_shortcode( $content ).'</p></div></div>';
}
    return $output;

}

add_shortcode( 'feature', 'pp_feature' );





function recent_blog($atts) {
   extract(
    shortcode_atts(
        array(
            'limit'=>'4',
            'columns' => '4',
            'orderby'=> 'date',
            'order'=> 'DESC',
            'categories' => '',
            'tags' => '',
            'fullpage' => 'no',
            'exclude_posts' => '',
            'ignore_sticky_posts' => 1,
            'limit_words' => 13,
            'from_vs' => 'no',
            'read_more' => 'no'
            ),
        $atts));

   $output = '';
   $counter = 0;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'orderby' => $orderby,
        'order' => $order,
        );
    if(!empty($exclude_posts)) {
        $exl = explode(",", $exclude_posts);
        $args['post__not_in'] = $exl;
    }

    if(!empty($categories) && $categories!='null') {
        //$categories = explode(",", $categories);
        $args['category_name'] = $categories;
    }
    if(!empty($tags) && $tags!='null') {
        $tags = explode(",", $tags);
        $args['tag__in'] = $tags;
    }
    $i = 0;
    $wp_query = new WP_Query( $args );
   if ( $wp_query->have_posts() ):

        $output = '';
        while( $wp_query->have_posts() ) : $wp_query->the_post();
            $counter++;

            switch ($counter) {
                case '1':
                $class = 'alpha';
                break;
                case $limit:
                $class = 'omega';
                break;
                default:
                $class = ' ';
                break;
            }
            global $post;

            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
            $excerpt = get_the_excerpt();
            $short_excerpt = string_limit_words($excerpt,$limit_words);
            if($from_vs == "yes") { 
                switch ($columns) {
                    case '2':
                        $output .= '<div class="vc_col-sm-6 wpb_column">';
                        break;
                    case '3':
                        $output .= '<div class="vc_col-sm-4 wpb_column">';
                        break;
                    case '4':
                        $output .= '<div class="vc_col-sm-3 wpb_column">';
                        break;
                    default:
                        # code...
                        break;
            }
            } else {
                if($fullpage == "yes") {
                    $output .='<div class="four columns portfolio-item '.$class.'">';
                } else {
                    $output .='<div class="four columns portfolio-item">';
                }
            }

            if ((get_post_format(  $wp_query->post->ID ) == 'video' )) {
                global $wp_embed;
                $videolink = get_post_meta( $wp_query->post->ID, 'incr_video_link', true);
                $post_embed = $wp_embed->run_shortcode('[embed  width="220" height="147"]'.$videolink.'[/embed]') ;
                $output .='<div class="picture recent_video">'.$post_embed.'</div>';
            } else {
                if ( has_post_thumbnail()) {
                    $output .='<div class="picture"><a href="'. get_permalink().'">'.get_the_post_thumbnail($post->ID,'portfolio-thumb').'<div class="image-overlay-link"></div></a></div>';
                }
            }
        $output .=' <div class="item-description"><h5><a href="'. get_permalink().'">'.get_the_title().'</a></h5><p>'.$short_excerpt.'</p>';
if($read_more == 'yes') {
        $output .='<a class="button medium color post-entry" href="'. get_permalink().'">'.__('Continue Reading', 'centum').'</a>';
    }

        $output .=' </div></div>';
        endwhile;  // close the Loop
    endif;
    wp_reset_query();
    $output .= '<br class="clear" />';
    return $output;
}
add_shortcode('recent_blog', 'recent_blog');




function mag_testimonials($atts,$content ) {
 extract(shortcode_atts(array( 
    'title'=>"Testimonials",
    'delay' => '5000'
    ), $atts));
 $output = '<div class="headline no-margin"><h3>'.$title.'</h3></div> <div class="testimonials-carousel" data-autorotate="'.$delay.'"><ul class="carousel">'.do_shortcode( $content ).'</ul></div>';
 return $output;
}
add_shortcode('testimonials', 'mag_testimonials');

function pp_testimonial($atts, $content ) {
 extract(shortcode_atts(array( 'author'=>"", 'job' =>''), $atts));

 $output = '<li class="testimonial"><div class="testimonials">'.$content.'</div><div class="testimonials-bg"></div><div class="testimonials-author">'.$author;
 if($job) $output .= ', <span>'.$job.'</span>';
 $output .= '</div></li>';
 return $output;
}
add_shortcode('testimonial', 'pp_testimonial');


function pp_team($atts, $content ) {
 extract(shortcode_atts(array(
    'photo'=>"",
    'link' => "",
    'name'=>"",
    'job' =>'',
    'twitter' =>'',
    'facebook' =>'',
    'digg' =>'',
    'vimeo' =>'',
    'linkedin' =>'',
    'youtube' =>'',
    'from_vs' =>'no',
    ), $atts));
 $output = '';
    if($photo) {
        if($from_vs=="yes"){
              $photo = wp_get_attachment_url( $photo );
        }
       
        if($link) {
            $output .= '<a href="'.$link.'"><img src="'.$photo.'" alt=""/></a>';
        } else {
            $output .= '<img src="'.$photo.'" alt=""/>';
        }
    }
    if($link) {
        $output .= '<div class="team-name"><h5>'.$name.'</h5><span>'.$job.'</span></div>';
    } else {
        $output .= '<div class="team-name"><h5>'.$name.'</h5><span>'.$job.'</span></div>';
    }
$output .= '<div class="team-about"><p>'.do_shortcode( $content ).'</p></div>';
if($twitter || $facebook || $digg || $vimeo || $youtube || $skype || $linkedin ) $output .= '<ul class="social-icons about">';
if($twitter) $output .= ' <li><a class="twitter" href="'.$twitter.'"><i class="icon-twitter"></i></a></li>';
if($facebook) $output .= ' <li><a class="facebook" href="'.$facebook.'"><i class="icon-facebook"></i></a></li>';
if($linkedin) $output .= ' <li><a class="linkedin" href="'.$linkedin.'"><i class="icon-linkedin"></i></a></li>';
if($vimeo) $output .= ' <li><a class="vimeo" href="'.$vimeo.'"><i class="icon-vimeo"></i></a></li>';
if($youtube) $output .= ' <li><a class="youtube" href="'.$youtube.'"><i class="icon-youtube"></i></a></li>';
if($twitter || $facebook || $digg || $vimeo || $youtube || $skype ) $output .= '</ul>';
return $output;
}
add_shortcode('team', 'pp_team');




function pp_pricing_table($atts, $content) {
    extract(shortcode_atts(array(
        "color" => '1',
        "header" => '',
        "price" => '30',
        "per" => 'per month',
        ), $atts));


    $output = '<div class="pricing-table">';
    $output .= '<div class="color-'.$color.'">';

    $output .= '<h3>'.$header.'</h3>';
    $output .= '<h4><span class="price">'.$price.'</span>';
    if($per) $output .= '<span class="time">'.$per.'</span>';
    $output .= '</h4>';
    $output .= do_shortcode( $content );
    $output .= '</div>​</div>​';
    return $output;
}
add_shortcode('pricing_table', 'pp_pricing_table');

function pp_pricing_wrapper($atts, $content) {
    extract(shortcode_atts(array(
        "number" => '4',

        ), $atts));

    switch ($number) {
        case '2':
        $tables = 'two';
        break;
        case '3':
        $tables = 'three';
        break;
        case '4':
        $tables = 'four';
        break;
        case '5':
        $tables = 'five';
        break;

        default:
        $tables = 'four';
        break;
    }
    $output = '<div class="'.$tables.'-tables">';


    $output .= do_shortcode( $content );
    $output .= '</div>​';
    return $output;
}
add_shortcode('pricing_wrapper', 'pp_pricing_wrapper');


function pp_pricing_check($atts) {
    extract(shortcode_atts(array(
        "check" => 'yes',
        ), $atts));
    $output .= '<span class="pricing_check '.$check.'"></span>​';
    return $output;
}
add_shortcode('pricing_check', 'pp_pricing_check');



function fn_googleMaps($atts, $content = null) {
 extract(shortcode_atts(array(
  "width" => '100%',
  "height" => '250px',
  "address" => 'New York, United States'
  ), $atts));
 $output ='
 <div id="googlemaps" class="google-map google-map-full" style="height:'.$height.'; width:'.$width.'"></div>
 <script src="//maps.google.com/maps/api/js?sensor=true"></script>
 <script src="'.get_template_directory_uri().'/js/jquery.gmap.min.js"></script>
 <script type="text/javascript">
 jQuery("#googlemaps").gMap({
    maptype: "ROADMAP",
    scrollwheel: false,
    zoom: 13,
    markers: [
    {
        address: \''.$address.'\',
        html: "",
        popup: false,
    }
    ],
});
</script>';
return $output;
}
add_shortcode("googlemap", "fn_googleMaps");


//toggle shortcode
function pp_toggle( $atts, $content = null ) {
   extract( shortcode_atts(
       array(
           'title' => 'Click To Open',
           'icon' => ''
           ),
       $atts ) );
   if(!empty($icon)){
        $icon_output = '<i class="fa fa-'.$icon.'"></i>';
   } else {
        $icon_output = '';
   }
   return '<h5 class="toggle-trigger"><a href="#">'.$icon_output. ' '. $title .'</a></h5><div class="toggle-container"><div class="content">' . do_shortcode($content) . '</div></div>';
}
add_shortcode('toggle', 'pp_toggle');

/* new shortcodes */


/**
* Testimonials shortcode
* Usage: [testimonials_wide]
* Shows selected jobs in carousel
*/
add_shortcode('testimonials_wide','workscout_full_testimonials');
function workscout_full_testimonials($atts) { 
    extract(shortcode_atts(array(
        'per_page'                  =>'4',
        'orderby'                   => 'date',
        'order'                     => 'DESC',
        'exclude_posts'             => '',
        'include_posts'             => '',
        'background'                => '',
        'from_vs'                   => '',
        ), $atts));

    $randID = rand(1, 99);

    $args = array(
        'post_type' => array('testimonial'),
        'showposts' => $per_page,
        'orderby' => $orderby,
        'order' => $order,
    );
    if(!empty($exclude_posts)) {
        $exl = explode(",", $exclude_posts);
        $args['post__not_in'] = $exl;
    }
    if(!empty($include_posts)) {
        $inc = explode(",", $include_posts);
        $args['post__in'] = $inc;
    }
    $wp_query = new WP_Query( $args );
   
    if($from_vs === 'yes') {
        $bg_url = wp_get_attachment_url( $background );
    } else {
        $bg_url = $background;
    }
    if($from_vs === 'yes') {
        $output = '</div> <!-- eof wpb_wrapper -->
                </div> <!-- eof column_container -->
            </div> <!-- eof vc_row-fluid -->
        </div> <!-- eof columns -->
    </div> <!-- eof container -->';
    } else {
         $output = '</div>
        </div>';
    }
   
    $output .= '<!-- Testimonials -->
    <div id="testimonials"  style="background-image: url('.$bg_url.');">
        <!-- Slider -->
        <div class="container">
            <div class="sixteen columns">
                <div class="testimonials-slider">
                      <ul class="slides">';
                if ( $wp_query->have_posts() ):
                        while( $wp_query->have_posts() ) : $wp_query->the_post(); 
                        $id = $wp_query->post->ID;
                        $author = get_post_meta($id, 'pp_author', true);
                        $link = get_post_meta($id, 'pp_link', true);
                        $position = get_post_meta($id, 'pp_position', true);
                        
                        $output .= '<li>
                          <p>'.get_the_content().'
                          <span>'.get_the_title($id);
                             if(!empty($position)){
                                $output .= ', '.$position;
                                } 
                          $output .= '</span></p>
                        </li>';

                        endwhile;  // close the Loop
                endif;
                $output .='
                      </ul>
                </div>
            </div>
        </div>
    </div>';
    if($from_vs === 'yes') {
    $output .= '
    <div class="container">
        <div class="sixteen columns">
             <div class="vc_row wpb_row vc_row-fluid">
                <div class="vc_col-sm-12 wpb_column column_container">
                    <div class="wpb_wrapper">';
    } else {
        $output .= ' <div class="container">
            <div class="sixteen columns">';
    }
    
    return $output;
}



/**
* Actionbox shortcode
* Usage: [actionbox]
* Shows actionbox
*/
add_shortcode('actionbox','workscout_actionbox');
function workscout_actionbox($atts, $content ) { 
    extract(shortcode_atts(array(
        'wide'                      => 'true',
        'title'                   => 'Start Building Your Own Job Board Now ',
        'url'                     => '#',
        'buttontext'             => '',
        'from_vs'                   => '',
        ), $atts));
    $output = '';

    if($wide=='true') {
        if($from_vs === 'yes') {
            $output = '</div> <!-- eof wpb_wrapper -->
                    </div> <!-- eof column_container -->
                </div> <!-- eof vc_row-fluid -->
            </div> <!-- eof columns -->
        </div> <!-- eof container -->';
        } else {
             $output = '</div>
            </div>';
        }
        $output .='         
        <!-- Infobox -->
        <div class="infobox">
            <div class="container">
                <div class="sixteen columns">
                '.$title;
                   if(!empty($buttontext)) { $output .=' <a href="'.$url.'">'.$buttontext.'</a>'; }
                $output .='
                </div>
            </div>
        </div>';
        if($from_vs === 'yes') {
        $output .= '
        <div class="container">
            <div class="sixteen columns">
                 <div class="vc_row wpb_row vc_row-fluid">
                    <div class="vc_col-sm-12 wpb_column column_container">
                        <div class="wpb_wrapper">';
        } else {
            $output .= ' <div class="container">
                <div class="sixteen columns">';
        }
       
    } else {
        $output .='
            <div class="infobox">
                '.$title;
                if(!empty($buttontext)) { $output .='<a href="'.$url.'">'.$buttontext.'</a>'; }
        $output .='</div>';
    }

 return $output;
}


add_shortcode('counter', 'workscout_counter');
function workscout_counter( $atts, $content ) {
   extract(shortcode_atts(array(
            'title' => 'Resumes Posted',
            'number' => '768',
            'icon' => '',
            'from_vs' => '',
            'width' => 'one-third',

    ), $atts));
    $output = '';
    if($from_vs === 'yes') {
        $output .= '<div class="columns '.$width.'">';
    }
    $output .= '<div class="counter-box">';
    if(!empty($icon)) { $output .= '<i class="fa fa-'.$icon.'"></i>';}

    $output .= '<span class="counter">'.$number.'</span>';
    $output .= ' <p>'.$title.'</p>
            </div>';
    if($from_vs === 'yes') {
        $output .= '</div>';
    }
    return $output;
}

add_shortcode('counters', 'workscout_counters');
function workscout_counters( $atts, $content ) {
    extract(shortcode_atts(array('from_vs' => 'yes'), $atts));
    if($from_vs === 'yes') {
        $output = '</div> <!-- eof wpb_wrapper -->
                    </div> <!-- eof column_container -->
                </div> <!-- eof vc_row-fluid -->
            </div> <!-- eof columns -->
        </div> <!-- eof container -->';
        } else {
        $output = '</div>
        </div>';
    }


    $output .= '<!-- Counters -->
    <div id="counters">
        <div class="container">
        '.do_shortcode( $content ).'
        </div>
    </div>';

    if($from_vs === 'yes') {
    $output .= '
        <div class="container">
            <div class="sixteen columns">
                <div class="vc_row wpb_row vc_row-fluid">
                    <div class="vc_col-sm-12 wpb_column column_container">
                        <div class="wpb_wrapper">';
    } else {
        $output .= ' <div class="container">
            <div class="sixteen columns">';
    }
    return $output;
}


/**
 * Recent Products shortcode
 *
 * @access public
 * @param array $atts
 * @return string
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    function centum_woocommerce_recent_products( $atts, $content ) {
        extract(shortcode_atts(array(
            'orderby'=> 'date',
            'order'=> 'DESC',
            'per_page'  => '12',
            'columns'  => '4',
            'category'  => '',
            'ids' => '',
            ), $atts));

    global $woocommerce, $product;

    $randID = rand(1, 99); // Get unique ID for carousel

    $args = array(
        'suppress_filters' => false,
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'orderby'               => $orderby,
        'order'                 => $order,
        'posts_per_page'        => $per_page,
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array('catalog', 'visible'),
                'compare' => 'IN'
                )
            )
        );

    if(!empty($category)) {
        $categories = explode(',', $category);
        $args['tax_query'] = array(
            array(
                'taxonomy'      => 'product_cat',
                'terms'         => $categories,
                'field'         => 'slug',
                )
            );
    }
    if ( isset( $atts['ids'] ) ) {
            $ids = explode( ',', $atts['ids'] );
            $ids = array_map( 'trim', $ids );
            $args['post__in'] = $ids;
        }

    $output = '';
    $counter = 0;
    $products = get_posts( $args );
    if ( $products ) :
        foreach( $products as $productshop ) : setup_postdata($productshop);
        $counter++;
        if ($counter == 1) {
            $class = 'alpha';
        } else if( $counter % $columns == 0) {
            $class = 'omega';
        } else if ( $counter % $columns == 1 ) {
            $class = 'alpha';
        } else if ($counter == $per_page) {
            $class = 'omega';
        } else {
            $class = '';
        }
            $product = get_product( $productshop->ID );
            $output .= '
            <div class="four columns '.$class.'">
                <div class="shop-item">
                    <figure>';
            if ( has_post_thumbnail($productshop->ID)) {
                $output .=  '<a href="'.get_permalink($productshop->ID).'" >';
                $output .= get_the_post_thumbnail($productshop->ID,'shop_catalog');
                $alt    = esc_attr( get_the_title( $productshop->ID ) );
           
                $output .= '</a>';
            }
            $output .= ' <figcaption class="item-description">';
            $output .= '
                <a href="'.get_permalink($productshop->ID).'" ><h5>'.get_the_title($productshop->ID).'</h5></a>
                            <span>'.$product->get_price_html().'</span>';
                            if($product->product_type == 'simple') {
                    // echo esc_url($product->add_to_cart_url());
                    $output .= sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product-button button color product_type_%s">%s</a>',
                    esc_url( $product->add_to_cart_url() ),
                    esc_attr( $product->id ),
                    esc_attr( $product->get_sku() ),
                    esc_attr( isset( $quantity ) ? $quantity : 1 ),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    esc_attr( $product->product_type ),
                    esc_html( $product->add_to_cart_text() )
                    );
                    //$output .= '<a href="'.esc_url($product->add_to_cart_url()).'" class="add_to_cart_button product-button"><i class="fa fa-shopping-cart"></i>'.$product->single_add_to_cart_text().'</a>';
                } else {
                    $output .= '<a href="'.get_permalink($productshop->ID).'" class="button color">'.$product->add_to_cart_text().'</a>';
                }
            $output .= ' </figcaption></figure>';
            $output .= '
                </div>
            </div>';
        endforeach; // end of the loop.
    endif;

    return $output; wp_reset_postdata(); $products = '';
    }
add_shortcode('centum_recent_products', 'centum_woocommerce_recent_products');
}

?>