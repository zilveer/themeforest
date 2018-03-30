<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Load complicated shortcodes
// **********************************************************************// 
et_load_shortcode('banner');
et_load_shortcode('brands');
et_load_shortcode('title');
et_load_shortcode('divider');
et_load_shortcode('categories');
et_load_shortcode('posts-grid');
et_load_shortcode('images-carousel');
et_load_shortcode('icon-box');
et_load_shortcode('tabs');
et_load_shortcode('contact_form');
et_load_shortcode('products');
et_load_shortcode('row');
et_load_shortcode('team-member');
et_load_shortcode('testimonials');
et_load_shortcode('twitter');
et_load_shortcode('follow');



// **********************************************************************// 
// ! Shortcodes
// **********************************************************************// 

add_shortcode('quick_view', 'etheme_quick_view_shortcodes');
function etheme_quick_view_shortcodes($atts, $content=null){
    extract(shortcode_atts(array( 
        'id' => '',
        'class' => ''
    ), $atts));
    
    
    return '<div class="show-quickly-btn '.$class.'" data-prodid="'.$id.'">'. do_shortcode($content) .'</div>';

}


// **********************************************************************// 
// ! Buttons
// **********************************************************************// 

add_shortcode('button', 'etheme_btn_shortcode');
function etheme_btn_shortcode($atts){
    $a = shortcode_atts( array(
       'title' => 'Button',
       'url' => '#',
       'icon' => '',
       'size' => '',
       'style' => '',
       'el_class' => '',
       'type' => ''
   ), $atts );
    $icon = $class = '';
    if($a['icon'] != '') {
        $icon = '<i class="fa fa-'.$a['icon'].'"></i>';
    }
    if($a['style'] != '') {
	    $class .= ' '.$a['style'];
    }
    if($a['type'] != '') {
	    $class .= ' '.$a['type'];
    }
    if($a['size'] != '') {
	    $class .= ' '.$a['size'];
    }
    if($a['size'] != '') {
	    $class .= ' '.$a['size'];
    }
    if($a['el_class'] != '') {
	    $class .= ' '.$a['el_class'];
    }
    return '<a class="btn'. $class .'" href="' . $a['url'] . '"><span>'. $icon . $a['title'] . '</span></a>';
}

// **********************************************************************// 
// ! Alert Boxes
// **********************************************************************// 

add_shortcode('alert', 'etheme_alert_shortcode');
function etheme_alert_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'type' => 'success',
        'title' => '',
        'close' => 1
    ), $atts);
    $icon = '';
    switch($a['type']) {
        case 'error':
            $class = 'error';
            $icon = 'times-circle';
        break;
        case 'success':
            $class = 'success';
            $icon = 'check-circle';

        break;
        case 'info':
            $class = 'info';
            $icon = 'info-circle';

        break;
        case 'warning':
            $class = 'warning';
            $icon = 'exclamation-circle';

        break;
        default:
            $class = 'success';
    }
    $closeBtn = '';
    $title = '';
    if($a['close'] == 1){
        $closeBtn = '<span class="close-parent">close</span>';
    }
    if($a['title'] != '') {
        $title = '<span class="h3">' . $a['title'] . '</span><br>';
    }
    
    return '<p class="' . $class . '">' . $title . do_shortcode($content) . $closeBtn . '</p>';
}

// **********************************************************************// 
// ! Animated counter
// **********************************************************************// 

add_shortcode('counter', 'etheme_counter_shortcode');
function etheme_counter_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'init_value' => 1,
        'final_value' => 100,
        'class' => ''
    ), $atts);

    return '<span id="animatedCounter" class="animated-counter '.$a['class'].'" data-value='.$a['final_value'].'>'.$a['init_value'].'</span>';
}



// **********************************************************************// 
// ! Call to action
// **********************************************************************// 

add_shortcode('callto', 'etheme_callto_shortcode');
function etheme_callto_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'btn' => '',
        'style' => '',
        'btn_position' => 'right',
        'link' => ''
    ), $atts);
    $btn = '';
    $class = '';
    $btnClass = '';
    $onclick = '';

    if($a['style'] == 'filled') {
        $btnClass = 'filled';
    } else if($a['style'] == 'dark') {
        $btnClass = 'white';
    }
    
    if($a['btn'] != '') {
        $btn = '<a href="'.$a['link'].'" class="btn '.$btnClass.'">' . $a['btn'] . '</a>';
    }
    
    if($a['style'] != '') {
        $class = 'style-'.$a['style'];
    }
    
    if($a['style'] == 'fullwidth') { 
        $onclick = 'window.location="'.$a['link'].'"';
    }
    
    $output = '';

    $output .= '<div class="cta-block '.$class.'" onclick=\''. $onclick.'\'>';
    if($a['style'] == 'fullwidth') { 
        $output .= '<div class="container">';
    }
        $output .= '<div class="table-row">';

            if($a['btn'] != '') {

                    if ($a['btn_position'] == 'left') {
                        $output .= '<div class="table-cell button-left">'.$btn.'</div>';
                    }
                    $output .= '<div class="table-cell">'. do_shortcode($content) .'</div>';

                    if ($a['btn_position'] == 'right') {
                        $output .= '<div class="table-cell button-right">'.$btn.'</div>';
                    }

            } else{
                $output .= '<div class="table-cell">'. do_shortcode($content) .'</div>';
            }
        $output .= '</div>';
    if($a['style'] == 'fullwidth') { 
        $output .= '</div>';
    }
    $output .= '</div>';
    
    return $output;
}


// **********************************************************************// 
// ! Dropcap
// **********************************************************************// 

add_shortcode('dropcap', 'etheme_dropcap_shortcode');
function etheme_dropcap_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'style' => ''
   ), $atts );
   
    return '<span class="dropcap ' . $a['style'] . '">' . $content . '</span>';
}

// **********************************************************************// 
// ! Blockquote
// **********************************************************************// 

add_shortcode('blockquote', 'etheme_blockquote_shortcode');
function etheme_blockquote_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'align' => 'left',
        'class' => ''
    ), $atts);
    switch($a['align']) {

        case 'right':
            $align = 'fl-r';
        break;
        case 'center':
            $align = 'fl-none';
        break;
        default:
            $align = 'fl-l';        
    }
    $content = wpautop(trim($content));
    return '<blockquote class="' . $align .' '. $a['class'] . '">' . $content . '</blockquote>';
}


// **********************************************************************// 
// ! Checklist
// **********************************************************************// 

add_shortcode('checklist', 'etheme_checklist_shortcode');
function etheme_checklist_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'style' => 'arrow'
    ), $atts);
    switch($a['style']) {
        case 'arrow':
            $class = 'arrow';
        break;
        case 'circle':
            $class = 'circle';
        break;
        case 'star':
            $class = 'star';
        break;
        case 'square':
            $class = 'square';
        break;
        case 'dash':
            $class = 'dash';
        break;
        default:
            $class = 'arrow';
    }
    return '<div class="list list-' . $class . '">' . do_shortcode($content) . '</div	>';
}


// **********************************************************************// 
// ! Toggles
// **********************************************************************// 

add_shortcode('toggle_block', 'etheme_toggle_block_shortcode');
function etheme_toggle_block_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => ''
    ), $atts);
    return '<div class="toggle-block '.$a['class'].'">' . do_shortcode($content) . '</div>';
}

add_shortcode('toggle', 'etheme_toggle_shortcode');

function etheme_toggle_shortcode($atts, $content = null) {
    global $tab_count;
    $a = shortcode_atts(array(
        'title' => 'Tab',
        'class' => '',
        'active' => 0
    ), $atts);
    
    $class = $a['class'];
    $style = '';

    $opener = '<div class="open-this">+</div>';
    
    if ($a['active'] == 1)  {
        $style = ' style="display: block;"';
        $class .= 'opened'; 
        $opener = '<div class="open-this">&ndash;</div>';
    }
    
    $tab_count++;
    
    return '<div class="toggle-element ' . $class . '"><a href="#" class="toggle-title">' . $opener . $a['title'] . '</a><div class="toggle-content" ' . $style . '>' . do_shortcode($content) . '</div></div>';
}

// **********************************************************************// 
// ! Tabs
// **********************************************************************// 

add_shortcode('tabs', 'etheme_tabs_shortcode');
function etheme_tabs_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => ''
    ), $atts);
    return '<div class="tabs '.$a['class'].'">' . do_shortcode($content) . '</div>';
}

add_shortcode('tab', 'etheme_tab_shortcode');

function etheme_tab_shortcode($atts, $content = null) {
    global $tab_count;
    $a = shortcode_atts(array(
        'title' => 'Tab',
        'class' => '',
        'active' => 0
    ), $atts);
    
    $class = $a['class'];
    $style = '';
    
    if ($a['active'] == 1)  {
        $style = ' style="display: block;"';
        $class .= 'opened'; 
    }
    
    $tab_count++;
    
    return '<a href="#tab_'.$tab_count.'" id="tab_'.$tab_count.'" class="tab-title ' . $class . '">' . $a['title'] . '</a><div id="content_tab_'.$tab_count.'" class="tab-content" ' . $style . '><div class="tab-content-inner">' . do_shortcode($content) . '</div></div>';
}



// **********************************************************************// 
// ! Countdown
// **********************************************************************// 

add_shortcode('countdown','etheme_countdown_shortcode');

function etheme_countdown_shortcode($atts) {
    $a = shortcode_atts(array(
        'class' => '',
        'date' => '31 December 2014 00:00',
        'height' => ''   
    ),$atts);
    
    return '<div class="et-timer" data-final="'.$a['date'].'">
                <div class="time-block">
                    <span class="days">00</span>
                    days
                </div>
                <div class="timer-devider">:</div>
                <div class="time-block">
                    <span class="hours">00</span>
                    hours
                </div>
                <div class="timer-devider">:</div>
                <div class="time-block">
                    <span class="minutes">00</span>
                    minutes
                </div>
                <div class="timer-devider">:</div>
                <div class="time-block">
                    <span class="seconds">00</span>
                    seconds
                </div>
                <div class="clear"></div>
            </div>';
}


// **********************************************************************// 
// ! QR Code
// **********************************************************************// 

add_shortcode('qrcode', 'etheme_qrcode_shortcode');
function etheme_qrcode_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'size' => '128',
        'self_link' => 0,
        'title' => 'QR Code',
        'lightbox' => 0,
        'class' => ''
    ), $atts);

    return generate_qr_code($content,$a['title'],$a['size'],$a['class'],$a['self_link'],$a['lightbox']);
}


// **********************************************************************// 
// ! Project links
// **********************************************************************// 

add_shortcode('project_links', 'etheme_project_links');
function etheme_project_links($atts, $content = null) {
    $next_post = get_next_post();
    $prev_post = get_previous_post();
    ?>
        <div class="project-navigation">
            <?php if(!empty($prev_post)) : ?>
                <div class="pull-left prev-project">
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="btn border-grey btn-xmedium project-nav"><?php _e('Previous', ET_DOMAIN); ?></a> 
                    <div class="hide-info">
                        <?php echo get_the_post_thumbnail( $prev_post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ); ?>
                        <span class="price"><?php echo get_the_title($prev_post->ID); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($next_post)) : ?>
                <div class="pull-right next-project">
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="btn border-grey btn-xmedium project-nav"><?php _e('Next', ET_DOMAIN); ?></a>
                    <div class="hide-info">
                    	<span class="price"><?php echo get_the_title($next_post->ID); ?></span>
                        <?php echo get_the_post_thumbnail( $next_post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php
}

// **********************************************************************// 
// ! Tooltip
// **********************************************************************// 

add_shortcode('tooltip', 'etheme_tooltip_shortcode');
function etheme_tooltip_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'position' => 'top',
       'text' => '',
       'class' => ''
   ), $atts );
   
    return '<div class="et-tooltip '.$a['class'].'" rel="tooltip" data-placement="'.$a['position'].'" data-original-title="'.$a['text'].'"><div><div>'.$content.'</div></div></div>';
}

// **********************************************************************// 
// ! Share This Product
// **********************************************************************// 

add_shortcode('share', 'etheme_share_shortcode');
function etheme_share_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'title'  => '',
		'text' => '',
		'tooltip' => 1,
        'twitter' => 1,
        'facebook' => 1,
        'pinterest' => 1,
        'google' => 1,
        'mail' => 1,
		'class' => ''
	), $atts));
	global $post;
	if(!isset($post->ID)) return;
    $html = '';
	$permalink = get_permalink($post->ID);
	$tooltip_class = '';
	if($tooltip) {
		$tooltip_class = 'title-toolip';
	}
	$image =  etheme_get_image( get_post_thumbnail_id($post->ID), 150,150,false);
	$post_title = rawurlencode(get_the_title($post->ID)); 
	if($title) $html .= '<span class="share-title">'.$title.'</span>';
    $html .= '
        <ul class="menu-social-icons '.$class.'">
    ';
    if($twitter == 1) {
        $html .= '
                <li>
                    <a href="https://twitter.com/share?url='.$permalink.'&text='.$post_title.'" class="'.$tooltip_class.'" title="'.__('Twitter', ET_DOMAIN).'" target="_blank">
                        <i class="ico-twitter"></i>
                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
                        </svg>
                    </a>
                </li>
        ';
    }
    if($facebook == 1) {
        $html .= '
                <li>
                    <a href="http://www.facebook.com/sharer.php?u='.$permalink.'&amp;images='.$image.'" class="'.$tooltip_class.'" title="'.__('Facebook', ET_DOMAIN).'" target="_blank">
                        <i class="ico-facebook"></i>
                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
                        </svg>
                    </a>
                </li>
        ';
    }

    if($pinterest == 1) {
        $html .= '
                <li>
                    <a href="http://pinterest.com/pin/create/button/?url='.$permalink.'&amp;media='.$image.'&amp;description='.$post_title.'" class="'.$tooltip_class.'" title="'.__('Pinterest', ET_DOMAIN).'" target="_blank">
                        <i class="ico-pinterest"></i>
                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
                        </svg>
                    </a>
                </li>
        ';
    }

    if($google == 1) {
        $html .= '
                <li>
                    <a href="http://plus.google.com/share?url='.$permalink.'&title='.$text.'" class="'.$tooltip_class.'" title="'.__('Google +', ET_DOMAIN).'" target="_blank">
                        <i class="ico-google-plus"></i>
                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
                        </svg>
                    </a>
                </li>
        ';
    }

    if($mail == 1) {
        $html .= '
                <li>
                    <a href="mailto:enteryour@addresshere.com?subject='.$post_title.'&amp;body=Check%20this%20out:%20'.$permalink.'" class="'.$tooltip_class.'" title="'.__('Mail to friend', ET_DOMAIN).'" target="_blank">
                        <i class="ico-envelope"></i>
                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
                        </svg>
                    </a>
                </li>
        ';
    }
    
    $html .= '
        </ul>
    ';
	return $html;
} 

// **********************************************************************// 
// ! Google Charts
// **********************************************************************// 

add_shortcode('googlechart', 'etheme_googlechart_shortcode');
function etheme_googlechart_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'title' => '',
        'labels' => '',
        'data' => '',
        'type' => 'pie2d',
        'data_colours' => ''
    ), $atts);
    
    switch($a['type']) {
        case 'pie':   
            $type = 'p3';
        break;
        case 'pie2d':   
            $type = 'p';
        break;
        case 'line':   
            $type = 'lc';
        break;
        case 'xyline':   
            $type = 'lxy';
        break;
        case 'scatter':   
            $type = 's';
        break;
    }
    
    $output = '';
    if ($a['title'] != '') $output = '<h2>'. $a['title'] .'</h2>';
    $output .= '<div class="googlechart">';
    $output .= '<img src="http://chart.apis.google.com/chart?cht='.$type.'&chd=t:'.$a['data'].'&chtt=&chl='.$a['labels'].'&chs=600x250&chf=bg,s,65432100&chco='.$a['data_colours'].'" />';
    $output .= '</div>';
    return $output;
}


// **********************************************************************// 
// ! Google Font
// **********************************************************************// 

add_shortcode('googlefont','etheme_googlefont_shortcode');
$registerd_fonts = array();

function etheme_googlefont_shortcode($atts, $content = null) {
	global $registerd_fonts;
    $a = shortcode_atts(array(
        'name' => 'Open Sans',
        'size' => '',
        'color' => '',
        'class' => ''
    ),$atts);
    $google_name = str_replace(" ", "+", $a['name']);
    if (!in_array($google_name, $registerd_fonts)) {
    	$registerd_fonts[] = $google_name;
	    ?>
	    <link rel='stylesheet'  href='http://fonts.googleapis.com/css?family=<?php echo $google_name; ?>' type='text/css' media='all' />
	    <?php
    }
    
    //wp_enqueue_style($google_name,"http://fonts.googleapis.com/css?family=".$google_name);
    return '<span class="google-font '.$a['class'].'" style="font-family:'.$a['name'].'; color:'.$a['color'].'; font-size:'.$a['size'].'px;">'.do_shortcode($content).'</span>';
}
// **********************************************************************// 
// ! Single post
// **********************************************************************// 

add_shortcode('single_post','etheme_featured_post_shortcode');

function etheme_featured_post_shortcode($atts) {
    $a = shortcode_atts(array(
        'title' => '',
        'id' => '',
        'class' => '',
        'more_posts' => 1
    ),$atts);
    $limit = 1;
    $width = 300;
    $height = 300;
    $lightbox = etheme_get_option('blog_lightbox');
    $blog_slider = etheme_get_option('blog_slider');
    $posts_url = get_permalink(get_option('page_for_posts'));
    $args = array(
        'p'                     => $a['id'],
        'post_type'             => 'post',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit
    );

    $the_query = new WP_Query( $args ); 
    ob_start();
    ?>

    <?php if ( $the_query->have_posts() ) : ?>

        <?php while ( $the_query->have_posts() ) : $the_query->the_post();  $postId = get_the_ID(); ?>

            <div class="featured-posts <?php echo $a['class']; ?>">
                <?php if ($a['title'] != ''): ?>
                    <h3 class="title a-left"><span><?php echo $a['title']; ?></span></h3>
                    <?php if ($a['more_posts']): ?>
                            <?php echo '<a href="'.$posts_url.'" class="show-all-posts hidden-tablet hidden-phone">'.__('View more posts', ET_DOMAIN).'</a>'; ?>
                    <?php endif ?>
                <?php endif ?>
                <div class="featured-post row">
                    <div class="col-md-6">
                        <?php 
                            $width = etheme_get_option('blog_page_image_width');
                            $height = etheme_get_option('blog_page_image_height');
                            $crop = etheme_get_option('blog_page_image_cropping');
                        ?>

                        <?php $images = etheme_get_images($width,$height,$crop); ?>

                        <?php if (count($images)>0 && has_post_thumbnail()): ?>
                            <div class="post-images nav-type-small<?php if (count($images)>1): ?> images-slider<?php endif; ?>">
                                <ul class="slides">
                                     <li><a href="<?php the_permalink(); ?>"><img src="<?php echo $images[0]; ?>"></a></li>
                                </ul>
                                <div class="blog-mask">
                                    <div class="mask-content">
                                        <?php if($lightbox): ?><a href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>" rel="lightbox"><i class="fa fa-resize-full"></i></a><?php endif; ?>
                                        <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-md-6">
                        <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="post-info">
                            <span class="posted-on">
                                <?php _e('Posted on', ET_DOMAIN) ?>
                                <?php the_time(get_option('date_format')); ?> 
                                <?php _e('at', ET_DOMAIN) ?> 
                                <?php the_time(get_option('time_format')); ?>
                            </span> 
                            <span class="posted-by"> <?php _e('by', ET_DOMAIN);?> <?php the_author_posts_link(); ?></span>
                        </div>
                        <div class="post-description">
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="button read-more"><?php _e('Read More', ET_DOMAIN) ?></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

    <?php else:  ?>

        <p><?php _e( 'Sorry, no posts matched your criteria.', ET_DOMAIN ); ?></p>

    <?php endif; ?>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}

// **********************************************************************// 
// ! Static Block Shortcode
// **********************************************************************// 

add_shortcode('block','etheme_block_shortcode');

function etheme_block_shortcode($atts) {
    $a = shortcode_atts(array(
        'class' => '',
        'id' => ''
    ),$atts);

    return et_get_block($a['id']);
}
?>
