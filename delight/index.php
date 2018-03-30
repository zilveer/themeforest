<?php
/**
 * @package WordPress
 * @subpackage Delight
 */

get_header();

if( get_pix_option('pix_timthumb_cache') != '0' ) {
	$timthumb_cache = '_cache';
} else {
	$timthumb_cache = '';
}

?>


<?php
/*---------------------------------------------------------------------- if POSTS --------------------------------------------------------------------*/
if (get_pix_option('pix_frontpage_posttype')=='posts'){ ?>


<section>
<?php 
global $custom_options; 
global $custom_payoff; 
global $page, $paged;
$class = '';
$left = '';
$width = '';
$classside = '';
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

if (get_pix_option('pix_sliding_frontpage')== 'open') { 
	$class = 'open_toggle';
} elseif (get_pix_option('pix_sliding_frontpage')== 'default' && get_pix_option('pix_sliding_page')=='open') {
	$class = 'open_toggle';
} elseif (get_pix_option('pix_sliding_frontpage')== 'always') { 
	$class = 'open_toggle always_open';
} elseif (get_pix_option('pix_sliding_frontpage')== 'default' && get_pix_option('pix_sliding_page')=='always') {
	$class = 'open_toggle always_open';
}

if((get_pix_option('pix_sidebar_frontpage_layout')=='nosidebar' && get_pix_option('pix_front_page_layout') == 'right')||get_pix_option('pix_sidebar_frontpage_layout')== 'leftsidebar'){ 
	$left = 'margin-right';
	$classside = 'leftsidebar';
} elseif (get_pix_option('pix_sidebar_frontpage_layout')=='default'  && (get_pix_option('pix_general_sidebar')=='leftsidebar' || (get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template')=='right'))) {
	$left = 'margin-right';
}

if (get_pix_option('pix_sidebar_frontpage_layout')== 'leftsidebar'|| (get_pix_option('pix_sidebar_frontpage_layout')=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
?>
    <aside class="<?php echo $classside.' '.$class; ?>">
    	<div>
<?php dynamic_sidebar(get_pix_option('pix_sidebar_frontpage')); ?>
        </div>
    </aside>
<?php }
wp_reset_query();
?>

<?php

if( (get_pix_option('pix_sidebar_frontpage_layout')=='nosidebar' && get_pix_option('pix_front_page_layout') == 'wide') || get_pix_option('pix_sidebar_frontpage_layout')=='default'   && get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template') == 'wide'){ $width = 'seveneighty'; $size_th = 'wideCol43'; $sizes  = array('width'=>708,'height'=>399); $new_size= ' style="width:708px; height:399px;"'; } else { $size_th = 'narrowCol43'; $sizes  = array('width'=>427,'height'=>240); $new_size= ' style="width:427px; height:240px;"'; }
?>
	<article class="<?php echo $class.' '.$left.' '.$width; ?>">
    	<div><div>
		<?php 
		$my_query = null;
		if(is_array(get_pix_option('pix_frontpage_posttype_categories')) && !in_array('all',get_pix_option('pix_frontpage_posttype_categories'))){
				$cat_selected = implode(',',get_pix_option('pix_frontpage_posttype_categories'));
				$my_query = new WP_Query('cat='.$cat_selected.'&paged=' . $paged.'&posts_per_page='.get_pix_option('pix_frontpage_galleries_ppp'));
				$my2_query = new WP_Query('cat='.$cat_selected.'&posts_per_page=-1');
		} else {
			$my_query = new WP_Query('paged=' . $paged.'&posts_per_page='.get_pix_option('pix_frontpage_galleries_ppp'));
			$my2_query = new WP_Query('posts_per_page=-1');
		}
        ?>
<?php if ($my_query->have_posts()) : ?>
                <h2 class="entry-title"><?php echo stripslashes(get_pix_option( 'pix_front_page_title' )); ?></h2>
				<?php global $paged; if($paged==1) { echo do_shortcode(wpautop(stripslashes(get_pix_option( 'pix_front_page_content' )))); } ?>
            <?php while ( $my_query->have_posts() ) : $my_query->the_post();
    $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
    $meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
    
    if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
        $the_title = $meta_title['payoff'];
    } else {
        $the_title = get_the_title();
    }
	
             ?>
    
            <div id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>
                    <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php echo $the_title; ?></a></h3>
				<?php if(get_pix_option('pix_archive_show_postmetadata')=='show') { ?>
                    <div class="postmetadata">
                        <span>
                            <?php echo get_the_date(); ?>
                        </span>
                        <?php delight_posted_on(); ?>
                    </div><!-- .postmetadata -->
				<?php }// show postmetadata ?>
                
                <?php if(isset($meta_title['subtitle']) && $meta_title['subtitle']!=''){?><p class="subtitle"><?php echo $meta_title['subtitle']; ?></p><?php } ?>
                <?php if(has_post_thumbnail() && get_pix_option('pix_frontpage_featured_image') != 'true') {
					$image_id = get_post_thumbnail_id();  
					$image_url = wp_get_attachment_image_src($image_id,'full');  
					$image_url = $image_url[0]; 
                    ?><div class="imgHentry"><img src="<?php echo pix_switch_timthumb($post, $size_th, $sizes['width'], $sizes['height']); ?>" style="display:block" alt=""><div class="linkIcon"<?php echo $new_size; ?>>
				<?php if(get_pix_option('pix_frontpage_posts_image_link')=='') { ?>
                	<a href="<?php the_permalink(); ?>" class="goto-icon"<?php echo $new_size; ?>></a>
                <?php } else {
					
					if (get_pix_option('pix_frontpage_posts_image_link') == 'both'){
						if($size_th == 'wideCol43') {
							$imgwidth = 708*0.5;
							$imgheight = 399;
						} else {
							$imgwidth = 427*0.5;
							$imgheight = 240;
						}
					} else {
						if($size_th == 'wideCol43') {
							$imgwidth = 708;
							$imgheight = 399;
						} else {
							$imgwidth = 427;
							$imgheight = 240;
						}
					}
					
					if(get_pix_option('pix_frontpage_posts_image_link')=='enlarge' || get_pix_option('pix_frontpage_posts_image_link')=='both' ) { ?><a href="<?php echo $image_url; ?>" class="enlarge-icon" data-rel="portfolio" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                    <?php if(get_pix_option('pix_frontpage_posts_image_link')=='goto' || get_pix_option('pix_frontpage_posts_image_link')=='both') { ?><a href="<?php the_permalink(); ?>" class="goto-icon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                <?php } ?>
                    </div></div><!-- .imgHentry --><?php
				} ?>
				<?php if (get_pix_option('pix_frontpage_content_excerpt')=='excerpt') { custom_the_excerpt(get_pix_option('pix_frontpage_length_excerpt'), __('Read more','delight')); } else { the_content(__('Read more','delight')); } ?>
                <div class="clear"></div>
            </div>
		<?php endwhile; ?>
<?php if(function_exists('pix_pagenavi')) { pix_pagenavi($my2_query->post_count);} wp_reset_query(); ?>
        </div></div>
<?php endif; ?>
    </article>

<?php 

if (get_pix_option('pix_sidebar_frontpage_layout')== 'rightsidebar' || (get_pix_option('pix_sidebar_frontpage_layout')=='default' && get_pix_option('pix_general_sidebar')=='rightsidebar')) {?> 
    <aside class="<?php echo $classside.' '.$class; ?>">
    	<div>
<?php dynamic_sidebar(get_pix_option('pix_sidebar_frontpage')); ?>
        </div>
    </aside>
<?php }
wp_reset_query();
?>

</section>
<?php get_footer(); ?>


<?php }  /*---------------------------------------------------------------------- if PORTFOLIO --------------------------------------------------------------------*/
elseif (get_pix_option('pix_frontpage_posttype')=='portfolio'){ ?>


<?php
/**
 * @package WordPress
 * @subpackage Delight
 */

get_header();

global $custom_options; 
global $custom_payoff; 
global $custom_url; 
global $print_isotope;

$print_isotope=true;


if(is_array(get_pix_option('pix_frontpage_posttype_galleries')) && !in_array('all',get_pix_option('pix_frontpage_posttype_galleries'))){
	$cat_selected = implode(',',get_pix_option('pix_frontpage_posttype_galleries'));
} else {
	$cat_selected = '';
}

$size_th = 'narrowCol';
$size_page = 429;

function getInfScroll() {
	global $page, $paged, $print_infinite;
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} else if ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	$print_infinite = true;
	echo '<span id="page_nav_span"><a id="page_nav" class="button medium alignleft" href="'. esc_url(get_pagenum_link($paged+1)).'">'.__( 'More items', 'delight' ).'</a></span>';
}

function tooltip_info($the_action){
	switch (get_pix_option('pix_frontpage_galleries_tooltip')){
		case 'title':
			return  'data-title="'.get_the_title().'" ';
			break;
		case 'titleexcerpt':
			return 'data-title="'.get_the_title().'" data-excerpt="'.get_the_excerpt().'" ';
			break;
		case 'titleaction': 
			return 'data-title="'.get_the_title().'" data-action="'.$the_action.'" ';
			break;
		case 'titleexcerptaction': 
			return 'data-title="'.get_the_title().'" data-excerpt="'.get_the_excerpt().'" data-action="'.$the_action.'" ';
			break;
		case 'action': 
			return 'data-action="'.$the_action.'" ';
			break;
		case 'hide': 
			return 'data-hide="hide" ';
			break;
	}
}
?>


<section<?php if(get_pix_option('pix_frontpage_galleries_template')=='widepage'){ echo ' class="widepagePortfolio"'; } else { echo ' class="pagePortfolio"'; } ?>>
<?php 

if (get_pix_option('pix_frontpage_galleries_template')!='widepage' && (get_pix_option('pix_sidebar_frontpage_layout')== 'leftsidebar'|| (get_pix_option('pix_sidebar_frontpage_layout')=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar' ) ) ) { 


get_sidebar();
}
wp_reset_query();
?>

<?php
if (get_pix_option('pix_frontpage_galleries_filterable') == 'show' || get_pix_option('pix_frontpage_galleries_scrolling') == 'show' ) { 
	$class = 'open_toggle always_open';
} else {
	if (get_pix_option('pix_sliding_frontpage')== 'open') { 
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_sliding_frontpage')== 'default' && get_pix_option('pix_sliding_page')=='open') {
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_sliding_frontpage')== 'always') { 
		$class = 'open_toggle always_open';
	} elseif (get_pix_option('pix_sliding_frontpage')== 'default' && get_pix_option('pix_sliding_page')=='always') {
		$class = 'open_toggle always_open';
	} 
}

if((get_pix_option('pix_sidebar_frontpage_layout')=='nosidebar' && get_pix_option('pix_front_page_layout') == 'right')||get_pix_option('pix_sidebar_frontpage_layout')== 'leftsidebar'){ 
	$left = 'margin-right';
	$classside = 'leftsidebar';
} elseif (get_pix_option('pix_sidebar_frontpage_layout')=='default'  && (get_pix_option('pix_general_sidebar')=='leftsidebar' || (get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template')=='right'))) {
	$left = 'margin-right';
}

if( (get_pix_option('pix_sidebar_frontpage_layout')=='nosidebar' && get_pix_option('pix_front_page_layout') == 'wide') || get_pix_option('pix_sidebar_frontpage_layout')=='default'   && get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template') == 'wide'){ $width = 'seveneighty'; $size_th = 'wideCol'; $size_page = 710; }



if(get_pix_option('pix_frontpage_galleries_template')=='widepage') { $size_th = 'floatPort';

if(get_pix_option('pix_frontpage_galleries_filterable')=='show') {
	$code_array = array();
	$code_array2 = array();
	global $page, $paged;
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} else if ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	$args=array(
		'gallery'	=> $cat_selected,
		'post_type' => 'portfolio',
		'posts_per_page' => -1,
		'paged' => $paged
	);
	$my_query = null;
	$my_query = new WP_Query($args);
	$numposts = $my_query->post_count;
	while ( $my_query->have_posts() ) : $my_query->the_post();
		$terms_ar = get_the_terms( get_the_id(), 'image_tag' ); 
		if($terms_ar){
			foreach( $terms_ar as $term ) {
				if(!in_array($term->slug,$code_array)){
					$code_array[] = $term->slug;
				}
				if(!in_array($term->name,$code_array2)){
					$code_array2[] = $term->name;
				}
				unset($term);
			}
	}
	endwhile;
	if(count($code_array)!=0 && count($code_array2)!=0) {
		$code_array3 = pix_array_combine($code_array, $code_array2);
		echo '<span id="filtering-nav"><a href="#filter" data-filter="*" class="selected">'. __('All','delight') .'</a>';
	
		foreach( $code_array3 as $key => $value ) {
			echo '<a href="#filter" data-filter=".'.$key.'">'.$value.'</a>';
		}
		echo '</span>';
	} else {
		echo '<span>You must have at least one image tag (better two tags at least) to use the filter option</span>';
	}
	
	wp_reset_query();
}
?>
<div class="isoFilter">
<?php
    $args=array(
		'gallery'	=> $cat_selected,
		'post_type' => 'portfolio',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged
	);
    $args2=array(
		'gallery'	=> $cat_selected,
		'post_type' => 'portfolio',
		'posts_per_page' => -1,
		'paged' => $paged
	);
	$my_query = null;
	$my_query2 = null;
	$my_query = new WP_Query($args);
	$my_query2 = new WP_Query($args2);
	$numposts = $my_query2->post_count;

	$i=0; while ( $my_query->have_posts() ) : $my_query->the_post();
    $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
    $meta_destination = get_post_meta(get_the_ID(), $custom_destination->get_the_id(), TRUE);
    $meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
    $meta_url = get_post_meta(get_the_ID(), $custom_url->get_the_id(), TRUE);
    
    if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
        $the_title = $meta_title['payoff'];
    } else {
        $the_title = get_the_title();
    }
             ?>
	
            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?>>                
                <?php if(has_post_thumbnail()) { 
					$imgdata = wp_get_attachment_image_src( get_post_thumbnail_id(), $size_th );
					$imgwidth = $imgdata[1];
					$imgheight = $imgdata[2];
	
				?>
                	<div class="imgHentry" style="width:<?php echo $imgwidth+2; ?>px; height:<?php echo $imgheight+2; ?>px; margin-top:0">
                        <?php the_post_thumbnail($size_th); ?>

                        <?php
							$links = array(); 
							if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_colorbox')); }
							if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_gotopage')); }
							$result = count($links);
							if ($result!=0) {
								$imgwidth2 = $imgwidth/$result;
							}
							
							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								$image_url = $image_url[0]; 
								if($meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.urlencode(get_the_title());
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}
							
							if($meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
							} elseif($meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
							}
							
						?>
                        <div class="linkIcon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;"><?php $the_id = get_the_ID(); ?>
                            <?php if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if($meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if($meta_destination['featured_video']!=''){ echo tooltip_info(__('Play video','delight')); } else { echo tooltip_info(__('Enlarge picture','delight')); } ?> <?php if(get_pix_option('pix_frontpage_galleries_slideshow')=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                            <?php if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info(__('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                        </div>
                    </div><!-- .imgHentry -->
				<?php } ?>
                <div class="clear"></div>
            </div>
		<?php $i++; endwhile; wp_reset_query(); ?>
        
</div><!-- .isoFilter -->        
<?php 
	if(get_pix_option('pix_frontpage_galleries_scrolling')=='show') {
		getInfScroll();
	} else {
		if(function_exists('pix_pagenavi')) { pix_pagenavi(	$numposts );}
	}
?>
<?php } else { //if get_pix_option('pix_frontpage_galleries_template')!='widepage' ?>
	<article class="<?php echo $class.' '.$left.' '.$width; ?>">
    	<div><div>
             <h2 class="entry-title"><?php echo stripslashes(get_pix_option( 'pix_front_page_title' )); ?></h2>
				<?php echo do_shortcode(wpautop(stripslashes(get_pix_option( 'pix_front_page_content' )))); ?>
<?php if(get_pix_option('pix_frontpage_galleries_filterable')=='show') {
	$code_array = array();
	$code_array2 = array();
	global $page, $paged;
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} else if ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	$args=array(
		'gallery'	=> $cat_selected,
		'post_type' => 'portfolio',
		'posts_per_page' => -1,
		'paged' => $paged
	);
	$my_query = null;
	$my_query = new WP_Query($args);
	while ( $my_query->have_posts() ) : $my_query->the_post();
		$terms_ar = get_the_terms( get_the_id(), 'image_tag' ); 
		if($terms_ar){
			foreach( $terms_ar as $term ) {
				if(!in_array($term->slug,$code_array)){
					$code_array[] = $term->slug;
				}
				if(!in_array($term->name,$code_array2)){
					$code_array2[] = $term->name;
				}
				unset($term);
			}
	}
	endwhile; 
	if(count($code_array)!=0 && count($code_array2)!=0) {
		$code_array3 = pix_array_combine($code_array, $code_array2);
		echo '<span id="filtering-nav"><a href="#filter" data-filter="*" class="selected">'. __('All','delight') .'</a>';
	
		foreach( $code_array3 as $key => $value ) {
			echo '<a href="#filter" data-filter=".'.$key.'">'.$value.'</a>';
		}
		echo '</span>';
	} else {
		echo '<span>You must have at least one image tag (better two tags at least) to use the filter option</span>';
	}
	
	wp_reset_query();
} ?>

<?php 
if($size_page == 710) {
	switch (get_pix_option('pix_frontpage_galleries_template')) {
		case 'twocolumns':
			$isoWidth = 30;
			break;
		case 'threecolumns':
			$isoWidth = 7;
			break;
		case 'fourcolumns':
			$isoWidth = 6;
			break;
		case 'fivecolumns':
			$isoWidth = 0;
			break;
	}
} else {
	switch (get_pix_option('pix_frontpage_galleries_template')) {
		case 'twocolumns':
			$isoWidth = 19;
			break;
		case 'threecolumns':
			$isoWidth = 6;
			break;
		case 'fourcolumns':
			$isoWidth = 7;
			break;
		case 'fivecolumns':
			$isoWidth = 1;
			break;
	}
}
?>

    	<div class="isoFilter" style="width:<?php echo ($size_page+$isoWidth); ?>px; margin-left:-<?php echo $isoWidth; ?>px">
<?php
    $args=array(
		'gallery'	=> $cat_selected,
		'post_type' => 'portfolio',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged
	);
    $args2=array(
		'gallery'	=> $cat_selected,
		'post_type' => 'portfolio',
		'posts_per_page' => -1,
		'paged' => $paged
	);
	$my_query = null;
	$my_query2 = null;
	$my_query = new WP_Query($args);
	$my_query2 = new WP_Query($args2);
	$numposts = $my_query2->post_count;

	$i=0; while ( $my_query->have_posts() ) : $my_query->the_post();
    $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
    $meta_destination = get_post_meta(get_the_ID(), $custom_destination->get_the_id(), TRUE);
    $meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
    $meta_url = get_post_meta(get_the_ID(), $custom_url->get_the_id(), TRUE);
	
	
    
    if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
        $the_title = $meta_title['payoff'];
    } else {
        $the_title = get_the_title();
    }
             ?>
    
<?php if(get_pix_option('pix_frontpage_galleries_template')=='onecolumn') { ?>

            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?>>                
                <?php if(has_post_thumbnail()) { 
					$imgdata = wp_get_attachment_image_src( get_post_thumbnail_id(), $size_th );
					$imgwidth = $imgdata[1];
					$imgheight = $imgdata[2];
				?>
                	<div class="imgHentry" style="width:<?php echo $imgwidth+2; ?>px; height:<?php echo $imgheight+2; ?>px;">
                        <?php the_post_thumbnail($size_th); ?>
                        <?php
							$links = array(); 
							if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_colorbox')); }
							if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_gotopage')); }
							$result = count($links);
							if ($result!=0) {
								$imgwidth2 = $imgwidth/$result;
							}
							
							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								$image_url = $image_url[0]; 
								if($meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}
							
							if($meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
							} elseif($meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
							}
						?>
                        <div class="linkIcon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;"><?php $the_id = get_the_ID(); ?>
                            <?php if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if($meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if($meta_destination['featured_video']!=''){ echo tooltip_info(__('Play video','delight')); } else { echo tooltip_info(__('Enlarge picture','delight')); } ?> <?php if(get_pix_option('pix_frontpage_galleries_slideshow')=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                            <?php if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info(__('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>

                        </div>
                    </div><!-- .imgHentry -->
				<?php } ?>
                <div class="clear"></div>
            </div>


<?php } elseif(get_pix_option('pix_frontpage_galleries_template')=='twocolumns') { ?>

            <?php 
				$attachment_id = get_post_thumbnail_id($post->ID);
				$thumb_src = wp_get_attachment_image_src( $attachment_id, $size_th );
				if($size_page == 710) {
					$lessmargin = 30;
					$marginleft = 30;
					$imgwidth = 338;
					$imgheight = 191;
					$size_th = 'th338191';
				} else {
					$lessmargin = 19;
					$marginleft = 19;
					$imgwidth = 203;
					$imgheight = 115;
					$size_th = 'th203115';
				}

				$links = array(); 
				if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_colorbox')); }
				if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_gotopage')); }
				$result = count($links);
				if ($result!=0) {
					$imgwidth2 = $imgwidth/$result;
				}

							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								$image_url = $image_url[0]; 
								if($meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}

							if($meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
							} elseif($meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
							}
			?>
            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?> style="width: <?php echo ($imgwidth+2); ?>px; margin-left:<?php echo $marginleft; ?>px">                
                <div class="imgHentry" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px; margin-top:<?php echo ($marginleft); ?>px">
                
                <?php if(has_post_thumbnail()) { ?>

					<img src="<?php echo  pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
                    <div class="linkIcon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;"><?php $the_id = get_the_ID(); ?>
                        <?php if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if($meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if($meta_destination['featured_video']!=''){ echo tooltip_info(__('Play video','delight')); } else { echo tooltip_info(__('Enlarge picture','delight')); } ?> <?php if(get_pix_option('pix_frontpage_galleries_slideshow')=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
						<?php if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info(__('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                    </div>
				<?php } ?>
                </div><!-- .imgHentry -->
            </div>
            
            <?php if(($i+1)%2==0) { echo '<div class="clear"></div>'; } ?>


<?php } elseif(get_pix_option('pix_frontpage_galleries_template')=='threecolumns') { ?>

            <?php 
				$attachment_id = get_post_thumbnail_id($post->ID);
				$thumb_src = wp_get_attachment_image_src( $attachment_id, $size_th );
				if($size_page == 710) {
					$lessmargin = 14;
					$marginleft = 7;
					$imgwidth = 230;
					$imgheight = 130;
					$sizeth = 'th230130';
				} else {
					$lessmargin = 12;
					$marginleft = 6;
					$imgwidth = 137;
					$imgheight = 78;
					$sizeth = 'th13778';
				}

				$links = array(); 
				if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_colorbox')); }
				if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_gotopage')); }
				$result = count($links);
				if ($result!=0) {
					$imgwidth2 = $imgwidth/$result;
				}

							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								$image_url = $image_url[0]; 
								if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}

							if(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && isset($meta_url['featured_target']) && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
							} elseif(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && isset($meta_url['featured_target']) && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
							}
			?>
            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?> style="width: <?php echo ($imgwidth+2); ?>px; margin-left:<?php echo $marginleft; ?>px">                
                <div class="imgHentry" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px; margin-top:<?php echo ($marginleft); ?>px">
                
                <?php if(has_post_thumbnail()) { ?>
					<img src="<?php echo  pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
                    <div class="linkIcon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;"><?php $the_id = get_the_ID(); ?>
                        <?php if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if($meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if($meta_destination['featured_video']!=''){ echo tooltip_info(__('Play video','delight')); } else { echo tooltip_info(__('Enlarge picture','delight')); } ?> <?php if(get_pix_option('pix_frontpage_galleries_slideshow')=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
						<?php if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info(__('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                    </div>
				<?php } ?>
                </div><!-- .imgHentry -->
            </div>
            
            <?php if(($i+1)%3==0) { echo '<div class="clear"></div>'; } ?>


<?php } elseif(get_pix_option('pix_frontpage_galleries_template')=='fourcolumns') { ?>

            <?php 
				$attachment_id = get_post_thumbnail_id($post->ID);
				$thumb_src = wp_get_attachment_image_src( $attachment_id, $size_th );
				if($size_page == 710) {
					$lessmargin = 18;
					$marginleft = 6;
					$imgwidth = 171;
					$imgheight = 98;
					$size_th = 'th17198';
				} else {
					$lessmargin = 21;
					$marginleft = 7;
					$imgwidth = 100;
					$imgheight = 57;
					$size_th = 'th10057';
				}

				$links = array(); 
				if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_colorbox')); }
				if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_gotopage')); }
				$result = count($links);
				if ($result!=0) {
					$imgwidth2 = $imgwidth/$result;
				}

							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								$image_url = $image_url[0]; 
								if($meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}

							if($meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
							} elseif($meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
							}
			?>
            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?> style="width: <?php echo ($imgwidth+2); ?>px; margin-left:<?php echo $marginleft; ?>px">                
                <div class="imgHentry" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px; margin-top:<?php echo ($marginleft); ?>px">
                
                <?php if(has_post_thumbnail()) { ?>
					<img src="<?php echo  pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
                    <div class="linkIcon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;"><?php $the_id = get_the_ID(); ?>
                        <?php if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if($meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if($meta_destination['featured_video']!=''){ echo tooltip_info(__('Play video','delight')); } else { echo tooltip_info(__('Enlarge picture','delight')); } ?> <?php if(get_pix_option('pix_frontpage_galleries_slideshow')=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
						<?php if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info(__('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                    </div>
				<?php } ?>
                </div><!-- .imgHentry -->
            </div>
            
            <?php if(($i+1)%4==0) { echo '<div class="clear"></div>'; } ?>


<?php } elseif(get_pix_option('pix_frontpage_galleries_template')=='fivecolumns') { ?>

            <?php 
				$attachment_id = get_post_thumbnail_id($post->ID);
				$thumb_src = wp_get_attachment_image_src( $attachment_id, $size_th );
				if($size_page == 710) {
					$lessmargin = 0;
					$marginleft = 0;
					$imgwidth = 142;
					$imgheight = 80;
					$size_th = 'th14280';
				} else {
					$lessmargin = 4;
					$marginleft = 1;
					$imgwidth = 85;
					$imgheight = 48;
					$size_th = 'th8548';
				}

				$links = array(); 
				if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_colorbox')); }
				if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { array_push($links, get_pix_option('pix_frontpage_galleries_gotopage')); }
				$result = count($links);
				if ($result!=0) {
					$imgwidth2 = $imgwidth/$result;
				}

							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								$image_url = $image_url[0]; 
								if($meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}

							if($meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
							} elseif($meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
							}
			?>
            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?> style="width: <?php echo ($imgwidth); ?>px; margin-left:<?php echo $marginleft; ?>px">                
                <div class="imgHentry" style="width:<?php echo ($imgwidth); ?>px; height:<?php echo ($imgheight); ?>px; margin-top:<?php echo ($marginleft); ?>px">
                
                <?php if(has_post_thumbnail()) { ?>
					<img style="border:0!important" src="<?php echo  pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
                    <div class="linkIcon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;"><?php $the_id = get_the_ID(); ?>
                        <?php if(get_pix_option('pix_frontpage_galleries_colorbox')=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if($meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if($meta_destination['featured_video']!=''){ echo tooltip_info(__('Play video','delight')); } else { echo tooltip_info(__('Enlarge picture','delight')); } ?> <?php if(get_pix_option('pix_frontpage_galleries_slideshow')=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
						<?php if(get_pix_option('pix_frontpage_galleries_gotopage')=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info(__('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                    </div>
				<?php } ?>
                </div><!-- .imgHentry -->
            </div>
            

<?php } ?>
		<?php $i++; endwhile; ?>
        </div><!-- .isoFilter -->
<?php 
	if(get_pix_option('pix_frontpage_galleries_scrolling')=='show') {
		getInfScroll();
	} else {
		if(function_exists('pix_pagenavi')) { pix_pagenavi(	$numposts );}
	}
?>
        </div></div>
    </article>

<?php }//if get_pix_option('pix_frontpage_galleries_template')=='widepage'

if (get_pix_option('pix_frontpage_galleries_template')!='widepage' && (get_pix_option('pix_sidebar_frontpage_layout')== 'rightsidebar' || (get_pix_option('pix_sidebar_frontpage_layout')=='default' && get_pix_option('pix_general_sidebar')=='rightsidebar' ) ) ) {  ?>
    <aside class="<?php echo $classside.' '.$class; ?>">
    	<div>
<?php dynamic_sidebar(get_pix_option('pix_sidebar_frontpage')); ?>
        </div>
    </aside>
<?php }
wp_reset_query();
?>

</section>
<?php get_footer(); ?>
<?php } else { ?>
<section>
</section>
<?php get_footer(); ?>
<?php } ?>