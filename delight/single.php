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
global $custom_options; 
global $custom_payoff; 

$size_th = '';
$left = '';
$width = '';
$meta_destination = '';

$meta_options = get_post_meta(get_the_ID(), $custom_options->get_the_id(), TRUE);
$meta_options = isset($meta_options) ? $meta_options : '';

$meta_title = get_post_meta(get_the_ID(), $custom_payoff->get_the_id(), TRUE);
$meta_title = isset($meta_title) ? $meta_title : '';

if(isset($meta_title['payoff']) && isset($meta_title['payoff'])!='') {
	$the_title = $meta_title['payoff'];
} else {
	$the_title = get_the_title();
}

if ((isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'left') ||((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && get_pix_option('pix_general_sidebar')=='leftsidebar')|| (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'right')||((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && get_pix_option('pix_general_sidebar')=='rightsidebar') || (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']=='nosidebar' && $meta_options['main_column']!='wide') || (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']=='default' && (get_pix_option('pix_general_template')!='wide' && get_pix_option('pix_general_sidebar')=='nosidebar')) ) { 
$content_width = 429; 
}
if ((isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'left')||((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && get_pix_option('pix_general_sidebar')=='leftsidebar')) { 
get_sidebar();
}
wp_reset_query();
?>

<?php
if ( isset($meta_options['sliding_page']) ) {
	if ($meta_options['sliding_page']== 'open') { 
		$class = 'open_toggle';
	} elseif (($meta_options['sliding_page']== 'default' || $meta_options['sliding_page']== '') && get_pix_option('pix_sliding_page')=='open') {
		$class = 'open_toggle';
	} elseif ($meta_options['sliding_page']== 'always') { 
		$class = 'open_toggle always_open';
	} elseif (($meta_options['sliding_page']== 'default' || $meta_options['sliding_page']== '') && get_pix_option('pix_sliding_page')=='always') {
		$class = 'open_toggle always_open';
	}
} else {
	if (get_pix_option('pix_sliding_page') == 'open') { 
		$class = 'open_toggle';
	} elseif (get_pix_option('pix_sliding_page') == 'always') { 
		$class = 'open_toggle always_open';
	}
}

if((isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']=='nosidebar' && $meta_options['main_column'] == 'right')||(isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'left')){ 
	$left = 'margin-right';
} elseif ((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && (get_pix_option('pix_general_sidebar')=='leftsidebar' || (get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template')=='right'))) {
	$left = 'margin-right';
}

if(( (isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']=='nosidebar') && $meta_options['main_column'] == 'wide')||( (!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default'||$meta_options['sidebar_position']=='')  && get_pix_option('pix_general_sidebar')=='nosidebar' && get_pix_option('pix_general_template') == 'wide')){ $width = 'seveneighty'; }
?>
	<article class="<?php echo $class.' '.$left.' '.$width; ?>">
    	<div><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <h1 class="entry-title"><?php echo $the_title; ?></h1>
	<?php if(get_pix_option('pix_show_postmetadata')=='show') { ?>
        <div class="postmetadata">
        	<span class="date update">
				<?php echo get_the_date(); ?>
            </span>
            <?php delight_posted_on(); ?>
        </div><!-- .postmetadata -->
    <?php }// show postmetadata ?>
        <div id="breadcrumb">
            <?php pix_breadcrumbs(); ?>
        </div><!-- #breadcrumb -->
        
		<?php if(isset($meta_title['subtitle']) && $meta_title['subtitle']!=''){?><p class="subtitle"><?php echo $meta_title['subtitle']; ?></p><?php } ?>
		<?php the_content(); ?>
        <div class="posttags_list">
        	<span>
				<?php the_tags( __('Tags: ','delight'), ' ', ''); ?>
            </span>
        </div><!-- .posttags_list -->
        <?php edit_post_link( __( 'Edit','delight' ), '<p class="edit-link">', '</p>' ); ?>
            
<?php if(get_pix_option('pix_prev_next_posts') == 'show') { ?>
<table style="width:100%">
	<tr>
    	<td>
        	<h6><?php previous_post_link(); ?></h6>
        </td>
        <td width="20">&nbsp;
        	
        </td>
        <td style="text-align:right">
            <h6><?php next_post_link(); ?></h6>
        </td>
    </tr>
</table>
<hr>
<?php } ?>
<?php 
if(get_pix_option('pix_show_related_items') == 'show') {
$orig_post = $post;
global $post; global $post_type;
$tags = wp_get_post_tags( $post->ID ); 
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

$args=array(
	'post_type' => $post_type,
	'tag__in' => $tag_ids,
	'post__not_in' => array($post->ID),
	'posts_per_page'=> 3,
	'orderby' => 'rand',
	'ignore_sticky_posts'=>1
);

if($content_width == 710) {
	$isoWidth = 7;
} else {
	$isoWidth = 6;
}

$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
echo '<div id="related_posts" style="width:'. ($content_width+$isoWidth) .'px; margin-left:-'. $isoWidth .'px"><h3>'.__('Related items','delight').'</h3>';
while( $my_query->have_posts() ) {
$my_query->the_post();

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
?>

<div style="clear:both; display:block; overflow:auto">                
	<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
    <?php if (get_pix_option('pix_what_related_items')=='thumbnail') {
	
	
								if(has_post_thumbnail()) {
									$image_id = get_post_thumbnail_id();  
									$image_url = wp_get_attachment_image_src($image_id,'full');  
									if ( $image_url ) {
										$image_url = $image_url[0]; 
									}
									if(isset($meta_destination['featured_video']) && $meta_destination['featured_video']!=''){
										if(strpos($meta_destination['featured_video'],'wp-content')==true){
											$image_url = get_template_directory_uri().'/scripts/flowplayer.php?movie='.$meta_destination['featured_video'].'&amp;title='.htmlentities(get_the_title());
										} else {
											$image_url = $meta_destination['featured_video'];
										}
									}
								}
	
	?>
					<?php if(has_post_thumbnail()) { ?>
					<div class="imgHentry" style="width:<?php echo ($imgwidth+2); ?>px; height:<?php echo ($imgheight+2); ?>px; margin:0px 10px 10px 0; float:left">
					
						<img src="<?php echo pix_switch_timthumb($post, $size_th, $imgwidth, $imgheight); ?>" alt="">
						<div class="linkIcon" style="width:<?php echo ($imgwidth); ?>px; height:<?php echo ($imgheight); ?>px;">
							<a href="<?php the_permalink(); ?>" class="goto-icon" style="width:<?php echo $imgwidth; ?>px; height:<?php echo $imgheight; ?>px;">&nbsp;</a>                   </div>
					</div><!-- .imgHentry -->
					<?php } ?>
	<?php }//end if want to show thumbnail ?>		
    <?php custom_the_excerpt(get_pix_option('pix_length_related_items'), __('Read more','delight')); ?>
</div>


<?php 
}
echo '</div><!-- #related_posts -->
<div class="clear"></div>';
}
}
$post = $orig_post;
wp_reset_query();
} //end of releated items code ?>

<?php if(get_pix_option('pix_post_show_share_section')=='show') { ?>
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

		<?php comments_template( '', true ); ?>


<?php endwhile; ?>
        </div></div>
    </article>

<?php 

if ((isset($meta_options['sidebar_position']) && $meta_options['sidebar_position']== 'right')||((!isset($meta_options['sidebar_position']) || $meta_options['sidebar_position']=='default' || $meta_options['sidebar_position']=='') && get_pix_option('pix_general_sidebar')=='rightsidebar')) { 
$content_width = 429; 
get_sidebar();
}
wp_reset_query();
?>

</section>
<?php get_footer(); ?>
