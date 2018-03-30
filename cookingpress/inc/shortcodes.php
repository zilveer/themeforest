<?php
/**
 * Custom shortcodes for astrum theme
 *
 *
 * @package astrum
 * @since astrum 1.0
 */

/**
* Clear shortcode
* Usage: [clear]
*/
if (!function_exists('pp_clear')) {
    function pp_clear() {
       return '<div class="clear"></div>';
   }
   add_shortcode( 'clear', 'pp_clear' );
}

/**
* Dropcap shortcode
* Usage: [dropcap color="gray"] [/dropcap]// margin-down margin-both
*/
if (!function_exists('pp_dropcap')) {
    function pp_dropcap($atts, $content = null) {
        extract(shortcode_atts(array(
            'color'=>''), $atts));
        return '<span class="dropcap '.$color.'">'.$content.'</span>';
    }
    add_shortcode('dropcap', 'pp_dropcap');
}

function pp_accordion( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Tab'
        ), $atts));
    return '<h3><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span>'.$title.'</h3><div><p>'.do_shortcode( $content ).'</p></div>';
}
add_shortcode( 'accordion', 'pp_accordion' );

function pp_accordion_wrap( $atts, $content ) {
    extract(shortcode_atts(array(), $atts));
    return '<div class="accordion">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'accordionwrap', 'pp_accordion_wrap' );

function pp_button($atts, $content = null) {
    extract(shortcode_atts(array(
        "url" => '',
        "type" => 'btn-default',  //btn-primary,  btn-success, btn-info, btn-warning, btn-danger, btn-link
        "customcolor" => '',
        "iconcolor" => 'white',
        "icon" => '',
        "size" => '', //btn-lg , btn-sm,  btn-xs
        "target" => '',
        "customclass" => '', // .btn-block.
        ), $atts));
    $output = '<a class="btn '.$size.' '.$type.' '.$customclass.'" href="'.$url.'" ';
    if(!empty($target)) { $output .= 'target="'.$target.'"'; }
    if(!empty($customcolor)) { $output .= 'style="background-color:'.$customcolor.'"'; }
    $output .= '>';
    if(!empty($icon)) { $output .= '<i class="icon '.$icon.'  '.$iconcolor.'"></i> '; }
    $output .= $content.'</a>';

    return $output;
}
add_shortcode('button', 'pp_button');

function etdc_tab_group( $atts, $content ) {
    $GLOBALS['pptab_count'] = 0;
    do_shortcode( $content );
    $count = 0;
    if( is_array( $GLOBALS['tabs'] ) ) {
        foreach( $GLOBALS['tabs'] as $tab ) {
            $count++;
            $tabs[] = '<li><a href="#tab'.$count.'">'.$tab['title'].'</a></li>';
            $panes[] = '<div class="tab-content" id="tab'.$count.'">'.$tab['content'].'</div>';
        }
        $return = "\n".'<ul class="tabs-nav">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tabs-container">'.implode( "\n", $panes ).'</div>'."\n";
    }
    return $return;
}

/**
* Usage: [tab title="" ] [/tab]
*/
function etdc_tab( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Tab %d',
        ), $atts));

    $x = $GLOBALS['pptab_count'];
    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['pptab_count'] ), 'content' =>  do_shortcode( $content ) );
    $GLOBALS['pptab_count']++;
}
add_shortcode( 'tabgroup', 'etdc_tab_group' );

add_shortcode( 'tab', 'etdc_tab' );


/**
* Line shortcode
* Usage: [line]
*/
function pp_line() {
    return '<div class="line" style="margin-top: 25px; margin-bottom: 40px;"></div>';
}
add_shortcode( 'line', 'pp_line' );




/**
* Icon shortcode
* Usage: [icon icon="icon-exclamation"]
*/
function pp_icon($atts) {
    extract(shortcode_atts(array(
        'icon'=>''), $atts));
    return '<i class="'.$icon.'"></i>';
}
add_shortcode('icon', 'pp_icon');


/**
* Highlight shortcode
* Usage: [highlight style="gray"] [/highlight] // color, gray, light
*/
function pp_highlight($atts, $content = null) {
    extract(shortcode_atts(array(
        'style' => 'gray'
        ), $atts));
    return '<span class="highlight '.$style.'">'.$content.'</span>';
}
add_shortcode('highlight', 'pp_highlight');



/**
* Columns shortcode
* Usage: [column width="eight" place="" custom_class=""] [/column]
*/
function pp_column( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "lg" => false,
      "md" => false,
      "sm" => false,
      "xs" => false,
      "offset_lg" => false,
      "offset_md" => false,
      "offset_sm" => false,
      "offset_xs" => false,
      "pull_lg" => false,
      "pull_md" => false,
      "pull_sm" => false,
      "pull_xs" => false,
      "push_lg" => false,
      "push_md" => false,
      "push_sm" => false,
      "push_xs" => false,
      ), $atts));
    $return  =  '<div class="';
    $return .= ($lg) ? 'col-lg-' . $lg . ' ' : '';
    $return .= ($md) ? 'col-md-' . $md . ' ' : '';
    $return .= ($sm) ? 'col-sm-' . $sm . ' ' : '';
    $return .= ($xs) ? 'col-xs-' . $xs . ' ' : '';
    $return .= ($offset_lg) ? 'col-lg-offset-' . $offset_lg . ' ' : '';
    $return .= ($offset_md) ? 'col-md-offset-' . $offset_md . ' ' : '';
    $return .= ($offset_sm) ? 'col-sm-offset-' . $offset_sm . ' ' : '';
    $return .= ($offset_xs) ? 'col-xs-offset-' . $offset_xs . ' ' : '';
    $return .= ($pull_lg) ? 'col-lg-pull-' . $pull_lg . ' ' : '';
    $return .= ($pull_md) ? 'col-md-pull-' . $pull_md . ' ' : '';
    $return .= ($pull_sm) ? 'col-sm-pull-' . $pull_sm . ' ' : '';
    $return .= ($pull_xs) ? 'col-xs-pull-' . $pull_xs . ' ' : '';
    $return .= ($push_lg) ? 'col-lg-push-' . $push_lg . ' ' : '';
    $return .= ($push_md) ? 'col-md-push-' . $push_md . ' ' : '';
    $return .= ($push_sm) ? 'col-sm-push-' . $push_sm . ' ' : '';
    $return .= ($push_xs) ? 'col-xs-push-' . $push_xs . ' ' : '';
    $return .= '">' . do_shortcode( $content ) . '</div>';

    return $return;
}


add_shortcode('column', 'pp_column');

function pp_row( $atts, $content = null ) {

    return '<div class="row">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('row', 'pp_row');

/**
* Notice shortcode
* Usage: [noticebox title="Notice" icon="" link=""] [/noticebox]
*/
function pp_noticebox( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Notice',
        'icon' => '',
        'link' => ''
        ), $atts));
    $output = '';
    if($link) {
        $output .= '<a href="'.$link.'">';
    }

    $output .= '<div class="notice-box"><h3>'.$title.'</h3>';
    if($icon) {
        $output .= '<i class="icon '.$icon.'"></i>';
    }
    $output .= '<p>'.do_shortcode( $content ).'</p></div>';
    if($link) {
        $output .= '</a>';
    }
    return $output;
}

add_shortcode( 'noticebox', 'pp_noticebox' );



/**
* Skillbars shortcode
* Usage: [skillbars] [/skillbars]
*/

function pp_skillbars( $atts, $content ) {
    extract(shortcode_atts(array(), $atts));
    return '<div id="skillzz">'.do_shortcode( $content ).'</div>';
}

add_shortcode( 'skillbars', 'pp_skillbars' );


/**
* Usage: [skillbar title="Web Design 80%" value="80"]
*/
function pp_skillbar( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Web Design',
        'value' => '80',
        'icon' => ''
        ), $atts));
    return '<div class="skill-bar"><span class="skill-title"> '.$title.' </span><div class="skill-bar-value" style="width: '.$value.'%;"></div></div>';
}

add_shortcode( 'skillbar', 'pp_skillbar' );



/**
* Box shortcodes
* Usage: [box type=""] [/box]
*/

function pp_box($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => ''
        ), $atts));
    return '<div class="notification closeable '.$type.'"><p>'.do_shortcode( $content ).'</p><a class="close" href="#"></a></div>';
}

add_shortcode('box', 'pp_box');



/**
* Toggle shortcodes
* Usage: [toggle title="" open="no"] [/toggle]
*/

function pp_toggle( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => '',
        'open' => 'no'
        ), $atts));
    if($open != 'no') { $opclass = "opened"; } else { $opclass = ''; }
    return ' <div class="toggle-wrap"><span class="trigger '.$opclass.'"><a href="#"><i class="toggle-icon"></i> '.$title.'</a></span><div class="toggle-container"><p>'.do_shortcode( $content ).'</p></div></div>';
}

add_shortcode( 'toggle', 'pp_toggle' );


/**
* List style shortcode
* Usage: [list type="check"] [/list] // check, arrow, checkbg, arrowbg
*/
function pp_liststyle($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => 'check'
        ), $atts));

    switch ($type) {
        case 'check':
        $list = 'list-1';
        break;
        case 'arrow':
        $list = 'list-2';
        break;
        case 'checkbg':
        $list = 'list-3';
        break;
        case 'arrowbg':
        $list = 'list-4';
        break;
        default:
        $list = 'list-1';
        break;
    }
    return '<div class="'.$list.'">'.$content.'</div>';
}

add_shortcode('list', 'pp_liststyle');


$pp_puregallery_count = 1;
function pp_puregallery($atts, $content = null) {
    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order',
        'include'    => '',
        'exclude'    => ''
        ), $atts));
    global $post;

    static $instance = 0;
    $instance++;
    global $pp_puregallery_count;
    $ids = get_post_meta($post->ID, 'pp_gallery_slider', TRUE);
    if(empty($ids)) {
        if ( !empty($include) ) {
//$include = preg_replace( '/[^0-9,]+/', '', $include );
            $args = array(

                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'post_mime_type' => 'image',
                'post__in' => explode( ",", $include),
                'posts_per_page' => '-1',
                'orderby' => 'post__in'
                );
        } elseif ( !empty($exclude) ) {
//$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
            $args = array(
                'post_parent' => $post->ID,
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'post_mime_type' => 'image',
                'post__not_in' => explode( ",", $exclude),
                'posts_per_page' => '-1',
                'orderby' => 'post__in'
                );
        } else {
            $args =  array(
                'post_parent' => $post->ID,
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_mime_type' => 'image',
                'order' => $order,
                'orderby' => $orderby
                );
        }
} else {
    $args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'post_mime_type' => 'image',
      'post__in' => explode( ",", $ids),
      'posts_per_page' => '-1',
      'orderby' => 'post__in'
      );
}

$output = '';
$images_array = get_posts( $args );

if ( $images_array ) {
    //royalslider:
    $output .= '<div id="cp_post_gallery-'.$pp_puregallery_count.'" class="royalSlider rsDefault rsCPgallery">';
      foreach( $images_array as $images ) : setup_postdata($images);
        $attachment = wp_get_attachment_image_src($images->ID, 'full');
        $thumb = wp_get_attachment_image_src($images->ID, 'portfolio-wide');
        $content = $images->post_excerpt;

   $output .= '<a class="rsImg bugaga" data-rsw="'.$attachment[1].'" data-rsh="'.$attachment[2].'"
   data-rsBigImg="'.$attachment[0].'" href="'.$attachment[0].'">'.$content.'<img width="96" height="72" class="rsTmb"  src="'.$thumb[0].'" /></a>';

    endforeach;
    $output .= '</div>';
    //flexslider:
    /*$output .= '<section class="flexslider shortcode post-img">
    <div class="media">
    <ul class="slides mediaholder">';
    foreach( $images_array as $images ) : setup_postdata($images);

    $attachment = wp_get_attachment_image_src($images->ID, 'full');
    $thumb = wp_get_attachment_image_src($images->ID, 'portfolio-wide');
    $content = $images->post_excerpt;

    $output .= '<li>';
    $output .= '<a href="'.$attachment[0].'" class="mfp-gallery" title="'.$images->post_title.'" >';
    if(isset($content) && !empty($content)) {    $output .= '<div class="flex-content"><p>'.$content.'</p></div>'; }
    $output .= '<img src="'.$thumb[0].'" alt="'.$images->post_title.'" />

    </a>
    </li>';
    endforeach;
    $output .= '</ul>
    </div>
    </section>';
*/
}
 $pp_puregallery_count++;
return $output;
}

add_shortcode('puregallery', 'pp_puregallery');





?>