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


<section>
<?php 
$size_th = 'narrowCol';
global $custom_options; 
global $custom_payoff; 

$meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
$meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);

function tooltip_info($the_action){
	return 'data-title="'.get_the_title().'" data-excerpt="'.get_the_excerpt().'" data-action="'.$the_action.'" ';
}

if(isset($meta_title['payoff']) && $meta_title['payoff']!='') {
	$the_title = $meta_title['payoff'];
} else {
	$the_title = get_the_title();
}

if ( (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'left') ||((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && get_pix_option('pix_general_sidebar')=='leftsidebar')|| (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'right')||((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && get_pix_option('pix_general_sidebar')=='rightsidebar') || (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']=='nosidebar' && $meta_options['main_column']!='wide') || (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']=='default' && (get_pix_option('pix_general_template')!='wide' && get_pix_option('pix_general_sidebar')=='nosidebar')) ) { 
$content_width = 429; 
}
if ((isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'left')||((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && get_pix_option('pix_general_sidebar')=='leftsidebar')) {
get_sidebar();
}
wp_reset_query();
?>

<?php
if ($meta_options['sliding_page']== 'open') { 
	$class = 'open_toggle';
} elseif (($meta_options['sliding_page']== 'default' || $meta_options['sliding_page']== '') && get_pix_option('pix_sliding_page')=='open') {
	$class = 'open_toggle';
} elseif ($meta_options['sliding_page']== 'always') { 
	$class = 'open_toggle always_open';
} elseif (($meta_options['sliding_page']== 'default' || $meta_options['sliding_page']== '') && get_pix_option('pix_sliding_page')=='always') {
	$class = 'open_toggle always_open';
}

if((isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']=='nosidebar' && $meta_options['main_column'] == 'right')|| (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'left')){ 
	$left = 'margin-right';
} elseif ((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && (get_pix_option('pix_general_sidebar')=='leftsidebar' || (get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template')=='right'))) {
	$left = 'margin-right';
}

if(( isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']=='nosidebar' && $meta_options['main_column'] == 'wide')||( (!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default'||$meta_options['sidebar_position']=='')  && get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template') == 'wide')){ $width = 'seveneighty'; }
?>
	<article class="<?php echo $class.' '.$left.' '.$width; ?>">
    	<div><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <h1 class="entry-title"><?php echo $the_title; ?></h1>
        <div id="breadcrumb">
            <?php pix_breadcrumbs(); ?>
        </div><!-- #breadcrumb -->
                        
		<?php if(isset($meta_title['subtitle']) && $meta_title['subtitle']!=''){?><p class="subtitle"><?php echo $meta_title['subtitle']; ?></p><?php } ?>
		<?php the_content(); ?>
        <?php edit_post_link( __( 'Edit','delight' ), '<span class="edit-link">', '</span>' ); ?>
            

<?php
if(get_pix_option('pix_show_custom_related_items')=='show'){
	$orig_post = $post;
	global $post; global $post_type;
	$tags = get_the_terms( $post->ID, 'relationship' ); 
	if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	
	
	
	
	$args=array(
	'post_type' => $post_type,
	'post__not_in' => array($post->ID),
	'posts_per_page' => -1,
	'orderby' => 'rand',
	'caller_get_posts'=> 1
	);
	
	if($content_width == 710) {
		$isoWidth = 7;
	} else {
		$isoWidth = 6;
	}
	
	$i = 0;
	
	
	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) {
	echo '<div id="related_posts" style="width:'. ($content_width+$isoWidth) .'px; margin-left:-'. $isoWidth .'px"><h3>'.__('Related items','delight').'</h3>';
	while( $my_query->have_posts() ) {
	$my_query->the_post();
	
	$inner_tags = get_the_terms( $post->ID, 'relationship' ); 
	if ($inner_tags) {
		$inner_tag_ids = array();
		foreach($inner_tags as $inner_individual_tag) $inner_tag_ids[] = $inner_individual_tag->term_id;
		
		
		$result = array_intersect($tag_ids, $inner_tag_ids);
		
		if(count($result)!=0 && $i<3) { 
		
		$i++;
	

	?>
	
	
	
	
				<?php 
					$meta_destination = get_post_meta(get_the_ID(), $custom_destination->get_the_id(), TRUE);
	
					$attachment_id = get_post_thumbnail_id($post->ID);
					$thumb_src = wp_get_attachment_image_src( $attachment_id, $size_th );
					if($content_width == 710) {
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
	
					$imgwidth2 = $imgwidth/2;
	
								if(has_post_thumbnail()) {
									$image_id = get_post_thumbnail_id();  
									$image_url = wp_get_attachment_image_src($image_id,'full');  
									$image_url = $image_url[0]; 
									if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
										if(strpos($meta_destination['featured_video'],'wp-content')==true){
											$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.urlencode(get_the_title());
										} else {
											$image_url = $meta_destination['featured_video'];
										}
									}
								}
				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class( );  ?> style="width: <?php echo ($imgwidth+2); ?>px; margin-left:<?php echo $marginleft; ?>px">                
					<div class="imgHentry" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px; margin-top:<?php echo ($marginleft); ?>px">
					
					<?php if(has_post_thumbnail()) { ?>
						<img src="<?php echo pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
						<div class="linkIcon" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px;">
	<a href="<?php echo $image_url; ?>" class="<?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ ?>play-icon<?php } else { ?>enlarge-icon<?php } ?>" <?php if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){ echo tooltip_info(__('Play video','delight')); } else { echo tooltip_info(__('Enlarge picture','delight')); } ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a>
								<a href="<?php the_permalink(); ?>" class="goto-icon" <?php echo tooltip_info(__('Go to the attachment page','delight')); ?> style="width:<?php echo $imgwidth2; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a>                   </div>
					<?php } ?>
					</div><!-- .imgHentry -->
				</div>
	
	
	<?php
		}
	}
	}
	echo '</div><!-- #related items --><div class="clear"></div>';
	}
	}
	$post = $orig_post;
	wp_reset_query();
} //end related posts code ?>

<?php if(get_pix_option('pix_portfolio_show_share_section')=='show') { ?>
<div class="pix_share">
<h3><?php _e('Share','delight'); ?></h3>
<?php if(get_pix_option('pix_post_share_type')=='counter') { ?>
    <div id="fb-root" class="alignleft"></div><script src="http://connect.facebook.net/<?php $lang = WPLANG; if(!empty($lang)) { echo $lang; } else { echo 'en_US'; } ?>/all.js#appId=167999456606546&amp;xfbml=1"></script><fb:like href="" send="true" layout="button_count" width="150" show_faces="true" font="" class="alignleft" style="width:160px!important"></fb:like>
    <div class="alignleft" style="width:75px; overflow:hidden" id="gplus_icon_sharing">
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
        <div class="g-plusone" data-size="medium" data-count="true"></div>
    </div>
	<div class="alignleft" id="twitter_icon_sharing">
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
        <a href="http://twitter.com/share" class="twitter-share-button">Tweet</a>
    </div>
    <?php if (has_post_thumbnail()) {
        $postTh = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	?>
    <div class="alignleft" id="pinterest_icon_sharing">
        <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $postTh[0]; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal" target="_blank"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" style="border:0"></a>
    </div>
    
    <div class="clear"></div>
    <?php } ?>
<?php } else { ?>
	<?php $turl = getTinyUrl(get_permalink()); ?><a id="twitter_icon_sharing" href="http://twitter.com/share?text=<?php echo urlencode(get_the_title());?>&amp;url=<?php echo $turl; ?>" target="_blank" title="<?php _e('Twitter','delight'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter-icon.png" width="21" height="21" alt="<?php _e('Twitter','delight'); ?>"></a>
    
    <a id="facebook_icon_sharing" href="http://www.facebook.com/share.php?u=<?php echo $turl; ?>&amp;t=<?php echo urlencode(get_the_title());?>" target="_blank" title="<?php _e('Facebook','delight'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook-icon.png" width="21" height="21" alt="<?php _e('Facebook','delight'); ?>"></a>
    
    <a id="delicious_icon_sharing" href="http://delicious.com/post?url=<?php echo $turl; ?>&amp;title=<?php echo urlencode(get_the_title());?>&amp;notes=<?php echo urlencode(get_the_excerpt()); ?>" title="<?php _e('Del.icio.us','delight'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/delicious-icon.png" width="21" height="21" alt="<?php _e('Del.icio.us','delight'); ?>"></a>
    
    <a id="digg_icon_sharing" href="http://digg.com/submit?phase=2&amp;url=<?php echo $turl; ?>&amp;title=<?php echo urlencode(get_the_title());?>&amp;bodytext=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank" title="<?php _e('Digg','delight'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/digg-icon.png" width="21" height="21" alt="<?php _e('Digg','delight'); ?>"></a>
    
    <a id="linkedin_icon_sharing" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $turl; ?>&amp;title=<?php echo urlencode(get_the_title());?>&amp;source=<?php echo urlencode(get_bloginfo('name')); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank" title="<?php _e('LinkedIn','delight'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin-icon.png" width="21" height="21" alt="<?php _e('LinkedIn','delight'); ?>"></a>
    
    <a id="stumble_icon_sharing" href="http://www.stumbleupon.com/submit?url=<?php echo get_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title());?>" target="_blank" title="<?php _e('StumbleUpon','delight'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/stumbleupon-icon.png" width="21" height="21" alt="<?php _e('StumbleUpon','delight'); ?>"></a>
<?php } ?>
</div><!-- .pix_share -->
<?php } //show share section ?>

<?php 
$image_id = get_post_thumbnail_id();  
$image_url = wp_get_attachment_image_src($image_id,'full');  
$image_url = $image_url[0]; ?>
<?php if(get_pix_option('pix_portfolio_credits_section')=='show' && get_pix_content($image_url)!='<!-- pix_credits_hide -->'){ ?>
<h3><?php _e('Credits','delight'); ?></h3>
<p><?php 
echo get_pix_content($image_url); ?></p>
<?php } ?>

		<?php comments_template( '', true ); ?>

<?php endwhile; ?>
        </div></div>
    </article>

<?php 

if (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'right'||((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && get_pix_option('pix_general_sidebar')=='rightsidebar')) {
$content_width = 429; 
get_sidebar();
}
wp_reset_query();
?>
<div class="clear"></div>
</section>
<?php get_footer(); ?>
