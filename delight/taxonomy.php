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


global $custom_options; 
global $custom_payoff; 
global $print_isotope;
global $current_user;

$class = '';
$left = '';
$width = '';
$classside = '';
$isoWidth = 0;
$featured_cb = '';

$print_isotope=true; 
	
	get_currentuserinfo();

$size_th = 'narrowCol';
$size_page = 429;

$the_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$the_term = $the_term->term_id;
$the_post_type = get_post_type();
$taxonomy = get_query_var( 'taxonomy' );
$pix_array_term = get_pix_option('pix_array_term_'.$the_term); 

function getInfScroll() {
	global $paged, $print_infinite; if($paged==0) $paged=1; $print_infinite = true;
	echo '<span id="page_nav_span"><a id="page_nav" class="button medium alignleft" href="'. esc_url(get_pagenum_link($paged+1)).'">'.__( 'More items', 'delight' ).'</a></span>';
}

function tooltip_info($the_term, $the_action){
	if(has_post_thumbnail()) { 
		$image_id = get_post_thumbnail_id();  
		$image_url = wp_get_attachment_image_src($image_id,'full');  
		$description = get_pix_content($image_url[0]); 
	}
	if ( $description!='' ) {
		$data_description = 'data-description="'.$description.'" ';
	} else {
		$data_description = '';
	}
	switch (get_pix_option('pix_array_term_tooltip_'.$the_term)){
		case 'title':
			return  'data-title="'.get_the_title().'" '.$data_description;
			break;
		case 'titleexcerpt':
			return 'data-title="'.get_the_title().'" data-excerpt="'.get_the_excerpt().'" '.$data_description;
			break;
		case 'titleaction': 
			return 'data-title="'.get_the_title().'" data-action="'.$the_action.'" '.$data_description;
			break;
		case 'titleexcerptaction': 
			return 'data-title="'.get_the_title().'" data-excerpt="'.get_the_excerpt().'" data-action="'.$the_action.'" '.$data_description;
			break;
		case 'action': 
			return 'data-action="'.$the_action.'" '.$data_description;
			break;
		case 'hide': 
			return 'data-hide="hide" '.$data_description;
			break;
	}
}
?>

<section<?php if(isset($pix_array_term[4]) && $pix_array_term[4]=='widepage'){ echo ' class="widepagePortfolio"'; } else { echo ' class="pagePortfolio"'; } ?>>
<?php 

if (isset($pix_array_term[4]) && $pix_array_term[4]!='widepage' && ($pix_array_term[1]== 'leftsidebar'|| ($pix_array_term[1]=='default' && get_pix_option('pix_general_sidebar')=='leftsidebar' ) ) ) { 


get_sidebar();
}
wp_reset_query();
?>

<?php
if ( (isset($pix_array_term[5]) &&$pix_array_term[5]== 'show') || (isset($pix_array_term[6]) && $pix_array_term[6]== 'show') ) { 
	$class = 'open_toggle always_open';
} else {
	if (isset($pix_array_term[0]) && $pix_array_term[0]== 'open') { 
		$class = 'open_toggle';
	} elseif (isset($pix_array_term[0]) && $pix_array_term[0]== 'default' && get_pix_option('pix_sliding_page')=='open') {
		$class = 'open_toggle';
	} elseif (isset($pix_array_term[0]) && $pix_array_term[0]== 'always') { 
		$class = 'open_toggle always_open';
	} elseif (isset($pix_array_term[0]) && $pix_array_term[0]== 'default' && get_pix_option('pix_sliding_page')=='always') {
		$class = 'open_toggle always_open';
	} 
}

if(($pix_array_term[1]=='nosidebar' && $pix_array_term[2] == 'right')||$pix_array_term[1]== 'leftsidebar'){ 
	$left = 'margin-right';
} elseif ($pix_array_term[1]=='default'  && (get_pix_option('pix_general_sidebar')=='leftsidebar' || (get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template')=='right'))) {
	$left = 'margin-right';
}

if($pix_array_term[1]=='nosidebar' && $pix_array_term[2] == 'wide'){ $width = 'seveneighty'; $size_th = 'wideCol'; $size_page = 710; }



if($pix_array_term[4]=='widepage') { $size_th = 'floatPort';

if($pix_array_term[5]=='show') {
	$code_array = array();
	$code_array2 = array();
	query_posts( 'posts_per_page=-1&post_type='.$the_post_type ); while ( have_posts() ) : the_post();
		$terms_ar = get_the_terms( $post->ID, 'image_tag' ); 
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
            <?php $i=0; while ( have_posts() ) : the_post();
    $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
    $meta_destination = get_post_meta(get_the_ID(), $custom_destination->get_the_id(), TRUE);
    $meta_url = get_post_meta(get_the_ID(), $custom_url->get_the_id(), TRUE);
    $meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
    
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
							if($pix_array_term[7]=='show') { array_push($links, $pix_array_term[7]); }
							if($pix_array_term[8]=='show') { array_push($links, $pix_array_term[8]); }
							$result = count($links);
							if ($result!=0) {
								$imgwidth2 = $imgwidth/$result;
							}
							
							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								if ($image_url) {
									$image_url = $image_url[0]; 
								}
								if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.urlencode(get_the_title());
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}
							
							if( isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
								$featured_cb = '';
							} elseif( isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
								$featured_cb = '';
							}
						?>
                        <div class="linkIcon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;"><?php $the_id = get_the_ID(); ?>
                            <?php if(isset($pix_array_term[7]) && $pix_array_term[7]=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ echo tooltip_info($the_term, __('Play video','delight')); } else { echo tooltip_info($the_term, __('Enlarge picture','delight')); } ?> <?php if(isset($pix_array_term[9]) && $pix_array_term[9]=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                            <?php if(isset($pix_array_term[8]) && $pix_array_term[8]=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info($the_term, __('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                        </div>
                    </div><!-- .imgHentry -->
				<?php } ?>
                <div class="clear"></div>
            </div>
		<?php $i++; endwhile; ?>
        
</div><!-- .isoFilter -->        
<?php 
	if($pix_array_term[6]=='show') {
		getInfScroll();
	} else {
		if(function_exists('pix_pagenavi')) { pix_pagenavi();}
	}
?>
<?php } else { //if $pix_array_term[4]!='widepage' ?>
	<article class="<?php echo $class.' '.$left.' '.$width; ?>">
    	<div><div>
<?php  if (have_posts()) : ?>
            <h1 class="entry-title"><?php single_cat_title(); ?></h1>
            <div id="breadcrumb">
                <?php pix_breadcrumbs(); ?>
            </div><!-- #breadcrumb -->
<?php if($paged==0){ echo term_description(); }?>
<?php if(isset($pix_array_term[5]) && $pix_array_term[5]=='show') {
	$code_array = array();
	$code_array2 = array();
	query_posts( 'posts_per_page=-1&post_type='.$the_post_type ); while ( have_posts() ) : the_post();
		$terms_ar = get_the_terms( $post->ID, 'image_tag' ); 
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
	switch ($pix_array_term[4]) {
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
	switch ($pix_array_term[4]) {
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
            <?php $i=0; while ( have_posts() ) : the_post();
    $meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
    $meta_destination = get_post_meta(get_the_ID(), $custom_destination->get_the_id(), TRUE);
    $meta_url = get_post_meta(get_the_ID(), $custom_url->get_the_id(), TRUE);
    $meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
	
    
    if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
        $the_title = $meta_title['payoff'];
    } else {
        $the_title = get_the_title();
    }
             ?>
    
<?php if($pix_array_term[4]=='onecolumn') { ?>

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
							if($pix_array_term[7]=='show') { array_push($links, $pix_array_term[7]); }
							if($pix_array_term[8]=='show') { array_push($links, $pix_array_term[8]); }
							$result = count($links);
							if ($result!=0) {
								$imgwidth2 = $imgwidth/$result;
							}
							
							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								if ( $image_url ) {
									$image_url = $image_url[0]; 
								}
								if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}
							
							if( isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
								$featured_cb = '';
							} elseif( isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
								$featured_cb = '';
							}
						?>
                        <div class="linkIcon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;"><?php $the_id = get_the_ID(); ?>
                            <?php if(isset($pix_array_term[7]) && $pix_array_term[7]=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ echo tooltip_info($the_term, __('Play video','delight')); } else { echo tooltip_info($the_term, __('Enlarge picture','delight')); } ?> <?php if(isset($pix_array_term[9]) && $pix_array_term[9]=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                            <?php if(isset($pix_array_term[8]) && $pix_array_term[8]=='show') { ?><a <?php echo $featured_href ; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info($the_term, __('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                        </div>
                    </div><!-- .imgHentry -->
				<?php } ?>
                <div class="clear"></div>
            </div>


<?php } elseif($pix_array_term[4]=='twocolumns') { ?>

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
				if($pix_array_term[7]=='show') { array_push($links, $pix_array_term[7]); }
				if($pix_array_term[8]=='show') { array_push($links, $pix_array_term[8]); }
				$result = count($links);
				if ($result!=0) {
					$imgwidth2 = $imgwidth/$result;
				}

							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								if ( $image_url) {
									$image_url = $image_url[0]; 
								}
								if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}

							if(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
							} elseif(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
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
                    <div class="linkIcon" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px;">
                            <?php if($pix_array_term[7]=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ echo tooltip_info($the_term, __('Play video','delight')); } else { echo tooltip_info($the_term, __('Enlarge picture','delight')); } ?> <?php if($pix_array_term[9]=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                        <?php if($pix_array_term[8]=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info($the_term, __('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo (2+$imgheight); ?>px;">&nbsp;</a><?php } ?>
                    </div>
				<?php } ?>
                </div><!-- .imgHentry -->
            </div>
            
            <?php if(($i+1)%2==0) { echo '<div class="clear"></div>'; } ?>


<?php } elseif($pix_array_term[4]=='threecolumns') { ?>

            <?php 
				$attachment_id = get_post_thumbnail_id($post->ID);
				$thumb_src = wp_get_attachment_image_src( $attachment_id, $size_th );
				if($size_page == 710) {
					$lessmargin = 14;
					$marginleft = 7;
					$imgwidth = 230;
					$imgheight = 130;
					$size_th = 'th230130';
				} else {
					$lessmargin = 12;
					$marginleft = 6;
					$imgwidth = 137;
					$imgheight = 78;
					$size_th = 'th13778';
				}

				$links = array(); 
				if($pix_array_term[7]=='show') { array_push($links, $pix_array_term[7]); }
				if($pix_array_term[8]=='show') { array_push($links, $pix_array_term[8]); }
				$result = count($links);
				if ($result!=0) {
					$imgwidth2 = $imgwidth/$result;
				}

							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								if ( $image_url) {
									$image_url = $image_url[0]; 
								}
								if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}

							if(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
								$featured_cb = '';
							} elseif(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
								$featured_cb = '';
							}
			?>
            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?> style="width: <?php echo ($imgwidth+2); ?>px; margin-left:<?php echo $marginleft; ?>px">                
                <div class="imgHentry" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px; margin-top:<?php echo ($marginleft); ?>px">
                
                <?php if(has_post_thumbnail()) { ?>
					<img src="<?php echo  pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
                    <div class="linkIcon" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px;">
<?php if($pix_array_term[7]=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ echo tooltip_info($the_term, __('Play video','delight')); } else { echo tooltip_info($the_term, __('Enlarge picture','delight')); } ?> <?php if($pix_array_term[9]=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                        <?php if($pix_array_term[8]=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info($the_term, __('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo (2+$imgheight); ?>px;">&nbsp;</a><?php } ?>
                    </div>
				<?php } ?>
                </div><!-- .imgHentry -->
            </div>
            
            <?php if(($i+1)%3==0) { echo '<div class="clear"></div>'; } ?>


<?php } elseif($pix_array_term[4]=='fourcolumns') { ?>

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
				if($pix_array_term[7]=='show') { array_push($links, $pix_array_term[7]); }
				if($pix_array_term[8]=='show') { array_push($links, $pix_array_term[8]); }
				$result = count($links);
				if ($result!=0) {
					$imgwidth2 = $imgwidth/$result;
				}

							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								if ( $image_url) {
									$image_url = $image_url[0]; 
								}
								if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}

							if(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
								$featured_cb = '';
							} elseif(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
								$featured_cb = '';
							}
			?>
            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?> style="width: <?php echo ($imgwidth+2); ?>px; margin-left:<?php echo $marginleft; ?>px">                
                <div class="imgHentry" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px; margin-top:<?php echo ($marginleft); ?>px">
                
                <?php if(has_post_thumbnail()) { ?>
					<img src="<?php echo  pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
                    <div class="linkIcon" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px; display:none">
                            <?php if(isset($pix_array_term[7]) && $pix_array_term[7]=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ echo tooltip_info($the_term, __('Play video','delight')); } else { echo tooltip_info($the_term, __('Enlarge picture','delight')); } ?> <?php if(isset($pix_array_term[9]) && $pix_array_term[9]=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                        <?php if(isset($pix_array_term[8]) && $pix_array_term[8]=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info($the_term, __('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo (2+$imgheight); ?>px;">&nbsp;</a><?php } ?>
                    </div>
				<?php } ?>
                </div><!-- .imgHentry -->
            </div>
            
            <?php if(($i+1)%4==0) { echo '<div class="clear"></div>'; } ?>


<?php } elseif(isset($pix_array_term[4]) && $pix_array_term[4]=='fivecolumns') { ?>

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
				if(isset($pix_array_term[7]) && $pix_array_term[7]=='show') { array_push($links, $pix_array_term[7]); }
				if(isset($pix_array_term[8]) && $pix_array_term[8]=='show') { array_push($links, $pix_array_term[8]); }
				$result = count($links);
				if ($result!=0) {
					$imgwidth2 = $imgwidth/$result;
				}

							if(has_post_thumbnail()) {
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'full');  
								if ( $image_url) {
									$image_url = $image_url[0]; 
								}
								if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
									if(strpos($meta_destination['featured_video'],'wp-content')==true){
										$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.get_the_title();
									} else {
										$image_url = $meta_destination['featured_video'];
									}
								}
							}

							if(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']!='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' target="'.$meta_url['featured_target'].'" ';
								$featured_cb = '';
							} elseif(isset($meta_url['featured_url']) && $meta_url['featured_url']!='' && $meta_url['featured_target']=='colorbox' ){
								$featured_href = 'href='.$meta_url['featured_url'].' ';
								$featured_cb = ' iframe';
							} else {
								$featured_href = 'href='.get_permalink().' target="_self" ';
								$featured_cb = '';
							}
			?>
            <div id="post-<?php the_ID(); ?>" <?php $postid = $post->ID; $postClass = 'all '; $terms_ar = get_the_terms( $postid, 'image_tag' ); if($terms_ar){foreach ($terms_ar as $term) { $postClass .= $term->slug.' '; }} post_class( $postClass );  ?> style="width: <?php echo ($imgwidth); ?>px; margin-left:<?php echo $marginleft; ?>px">                
                <div class="imgHentry" style="width:<?php echo ($imgwidth); ?>px; height:<?php echo ($imgheight); ?>px; margin-top:<?php echo ($marginleft); ?>px">
                
                <?php if(has_post_thumbnail()) { ?>
					<img style="border:0!important" src="<?php echo  pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
                    <div class="linkIcon" style="width:<?php echo ($imgwidth); ?>px; height:<?php echo ($imgheight); ?>px; display:none">
                            <?php if(isset($pix_array_term[7]) && $pix_array_term[7]=='show') { ?><a href="<?php echo $image_url; ?>" class="<?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ echo tooltip_info($the_term, __('Play video','delight')); } else { echo tooltip_info($the_term, __('Enlarge picture','delight')); } ?> <?php if(isset($pix_array_term[9]) && $pix_array_term[9]=='show') { ?> data-rel="portfolio"<?php } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a><?php } ?>
                        <?php if(isset($pix_array_term[8]) && $pix_array_term[8]=='show') { ?><a <?php echo $featured_href; ?> class="goto-icon <?php echo $featured_cb; ?>" <?php echo tooltip_info($the_term, __('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo (2+$imgheight); ?>px;">&nbsp;</a><?php } ?>
                    </div>
				<?php } ?>
                </div><!-- .imgHentry -->
            </div>
            

<?php } ?>
		<?php $i++; endwhile; ?>
        </div><!-- .isoFilter -->
<?php 
	if(isset($pix_array_term[6]) && $pix_array_term[6]=='show') {
		getInfScroll();
	} else {
		if(function_exists('pix_pagenavi')) { pix_pagenavi();}
	}
?>
        </div></div>
<?php endif; ?>
    </article>

<?php }//if $pix_array_term[4]=='widepage'

if ($pix_array_term[4]!='widepage' && ((isset($pix_array_term[1]) && $pix_array_term[1]== 'rightsidebar') || (isset($pix_array_term[1]) && $pix_array_term[1]=='default' && get_pix_option('pix_general_sidebar')=='rightsidebar' ) ) ) { 
get_sidebar();
}
wp_reset_query();
?>

</section>
<?php get_footer(); ?>
