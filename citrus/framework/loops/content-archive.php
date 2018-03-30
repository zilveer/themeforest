<!-- #post-<?php the_ID()?> starts -->
<?php 
$post_meta = get_post_meta(get_the_id() ,'_dt_post_settings',TRUE);
$post_meta = is_array( $post_meta ) ? $post_meta  : array(); 

$format = get_post_format(  get_the_id() );
$format_icons = array( 'status' => 'fa-comment', 'quote' => 'fa-quote-left', 'gallery' => 'fa-camera', 'image' => 'fa-image', 'video' => 'fa-film', 'audio' => 'fa-music', 'link' => 'fa-link', 'aside' => 'fa-align-left', 'chat' => 'fa-comments' );
	
if(isset($format_icons[$format])) $format_icon = $format_icons[$format]; else $format_icon = 'fa-pencil';	


$page_layout = dttheme_option('specialty','post-archives-layout');
$page_layout = !empty($page_layout) ? $page_layout : "content-full-width";

$post_layout = dttheme_option('specialty','post-archives-post-layout'); 
$post_layout = !empty($post_layout) ? $post_layout : "one-column";

switch($post_layout):
	case 'one-column':
		$post_thumbnail = 'blog-one-column';
	break;

	case 'one-half-column';
		$post_thumbnail = 'blog-two-column';
	break;

	case 'one-third-column':
		$post_thumbnail = 'blog-three-column';
	break;
endswitch;

if($page_layout == 'with-left-sidebar' || $page_layout == 'with-right-sidebar') $post_thumbnail .= '-single-sidebar';
elseif($page_layout == 'both-sidebar') $post_thumbnail .= '-both-sidebar';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>

	<?php 
	$post_meta = get_post_meta(get_the_id() ,'_dt_post_settings',TRUE);
    $post_meta = is_array( $post_meta ) ? $post_meta  : array(); 
	$pholder = dttheme_option('general', 'disable-placeholder-images');
	?>
    <?php
    if($format == 'quote') {
    ?>		
        <div class="black-box">  
            <div class="entry-body">
                <?php if( array_key_exists('quote', $post_meta) ) { ?>
                    <p><a href="<?php the_permalink();?>"><?php echo $post_meta['quote']; ?></a></p>
                    <?php if( array_key_exists('quoteby', $post_meta) ) { ?>
                        <span>- <?php echo $post_meta['quoteby']; ?></span>
                    <?php } ?>
				<?php } else { ?>
                    <p><a href="<?php the_permalink();?>"><?php echo get_the_excerpt(); ?></a></p>
                <?php } ?>
            </div>
            <div class="entry-details">
                <?php if(is_sticky()): ?>
                    <div class="featured-post"> <span class="fa fa-trophy"> </span> <span class="text"> <?php _e('Featured','dt_themes');?> </span></div>
                <?php endif;?>
                <div class="entry-metadata">
                     <h6 class="date">
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-calendar"></i>
                         </span> 
                         <?php echo get_the_date('d M Y');?>
                     </h6>
                     <h6 class="author"> 
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-user"></i>
                         </span> 
                         <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php _e('View all posts by ', 'dt_themes').get_the_author();?>"><?php echo get_the_author();?></a>
                     </h6>
                     <h6 class="">
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-comments"></i>
                        </span>
                        <?php comments_popup_link( '0', '1', '%', '', '0');?>
                     </h6>
                     <h6 class="category"> 
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-sitemap"></i>
                         </span> 
                         <?php the_category(', '); ?>
                     </h6>
                     <h6 class="tags"> 
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-tags"></i>
                         </span> 
                         <?php the_tags('', ', ', '');?>
                     </h6>
                </div>
            </div>
         </div>
    
    <?php	
    } else {
    ?>
            <div class="entry-thumb">
                <?php if( $format === "image" || empty($format) ): ?>
                        <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>">
                        <?php if( has_post_thumbnail() ):
								$attachment_id = get_post_thumbnail_id(get_the_id());
								$img_attributes = wp_get_attachment_image_src($attachment_id, $post_thumbnail);
								echo "<img src='".$img_attributes[0]."' width='".$img_attributes[1]."' height='".$img_attributes[2]."' />";
                              elseif($pholder != 'on'):?>
                                <img src="http://placehold.it/1160x800&amp;text=<?php the_title(); ?>" alt="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" />
                        <?php endif;?>
                        </a>
                <?php elseif( $format === "gallery" && array_key_exists("items", $post_meta)):
                            echo "<ul class='entry-gallery-post-slider'>";
                            foreach ( $post_meta['items'] as $item ) { 
								$attachment_id = dt_get_attachment_id_from_url($item);
								$img_attributes = wp_get_attachment_image_src($attachment_id, $post_thumbnail);
								echo "<li><img src='".$img_attributes[0]."' width='".$img_attributes[1]."' height='".$img_attributes[2]."' /></li>";
							}
                            echo "</ul>";
                      elseif( $format === "video" && ( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ) ):
                            if( array_key_exists('oembed-url', $post_meta) ):
                                echo "<div class='dt-video-wrap'>".wp_oembed_get($post_meta['oembed-url']).'</div>';
                            elseif( array_key_exists('self-hosted-url', $post_meta) ):
                                echo "<div class='dt-video-wrap'>".wp_video_shortcode( array('src' => $post_meta['self-hosted-url']) ).'</div>';
                            endif;
                      elseif( $format === "audio" && (array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta)) ):
                            if( array_key_exists('oembed-url', $post_meta) ):
                                echo wp_oembed_get($post_meta['oembed-url']);
                            elseif( array_key_exists('self-hosted-url', $post_meta) ):
                                echo wp_audio_shortcode( array('src' => $post_meta['self-hosted-url']) );
                            endif;
                      else: ?>
                        <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>"><?php
                            if( has_post_thumbnail() ):
								$attachment_id = get_post_thumbnail_id(get_the_id());
								$img_attributes = wp_get_attachment_image_src($attachment_id, $post_thumbnail);
								echo "<img src='".$img_attributes[0]."' width='".$img_attributes[1]."' height='".$img_attributes[2]."' />";
                            elseif($pholder != 'on'):?>
                                <img src="http://placehold.it/1160x800&amp;text=<?php the_title(); ?>" alt="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" />
                        <?php endif;?></a>
                <?php endif; ?>
            </div>
                    
            <div class="entry-details">
                <div class="entry-title">
                    <span class="hexagon">
                        <span class="corner1"></span>
                        <span class="corner2"></span>
                        <i class="fa <?php echo $format_icon; ?>"></i>
                    </span>
                    <h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a> </h4>
                </div>
                <div class="entry-body">
                    <?php echo '<p>'.get_the_excerpt().'</p>'; ?>
                </div>
                <?php if(is_sticky()): ?>
                    <div class="featured-post"> <span class="fa fa-trophy"> </span> <span class="text"> <?php _e('Featured','dt_themes');?> </span></div>
                <?php endif;?>
                <div class="entry-metadata">
                     <h6 class="date">
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-calendar"></i>
                         </span> 
                         <?php echo get_the_date('d M Y');?>
                     </h6>
                     <h6 class="author"> 
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-user"></i>
                         </span> 
                         <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php _e('View all posts by ', 'dt_themes').get_the_author();?>"><?php echo get_the_author();?></a>
                     </h6>
                     <h6 class="">
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-comments"></i>
                        </span>
                        <?php comments_popup_link( '0', '1', '%', '', '0');?>
                     </h6>
                     <h6 class="category"> 
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-sitemap"></i>
                         </span> 
                         <?php the_category(', '); ?>
                     </h6>
                     <h6 class="tags"> 
                         <span class="hexagon2">
                            <span class="corner1"></span>
                            <span class="corner2"></span>
                            <i class="fa fa-tags"></i>
                         </span> 
                         <?php the_tags('', ', ', '');?>
                     </h6>
                </div>
             </div>                  
                   
        <?php
        }
        ?>

</article><!-- #post-<?php the_ID()?> Ends -->