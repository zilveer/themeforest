<?php get_header(); ?>

<!--BEGIN #content-wrap-->
<div id="content-wrap" class="sidebar-Right">

<!--BEGIN #content-->
  <section id="content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php $postid = get_the_ID(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
<?php if (has_post_format('audio')) { ?>

<?php theme_audio(get_the_ID()); ?>
                    
					<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>
		
                    <div class="jp-audio-container">
                        <div class="jp-audio">
                            <div class="jp-type-single">
                                <div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
                                    <ul class="jp-controls">
                                    	<li><div class="seperator-first"></div></li>
                                        <li><div class="seperator-second"></div></li>
                                        <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                        <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                        <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                                        <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                                    </ul>
                                    <div class="jp-progress-container">
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jp-volume-bar-container">
                                        <div class="jp-volume-bar">
                                            <div class="jp-volume-bar-value"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } elseif (has_post_format('quote')) { ?>
<?php 
$quote = get_post_meta($postid, 'theme_quote', true);
?>
<div class="entry-header">
<span class="icon"></span><p><?php echo $quote; ?></p>
</div>
<?php } elseif (has_post_format('link')) {?>
<?php 
$url_link = get_post_meta($postid, 'theme_link_url', true);
?>
<div class="entry-header">
<span class="icon"></span><p><a href="<?php echo $url_link; ?>"><?php the_title(); ?></a></p>
</div>
<?php } elseif (has_post_format('video')) { ?>

<?php 
			$video_url = get_post_meta(get_the_ID(), 'theme_video_url', true);
			$embeded_code = get_post_meta(get_the_ID(), 'theme_video_m4v', true);
			?>
<?php if($embeded_code != '') { ?>	
							<?php theme_video_embed(get_the_ID()); ?>
                            
                            <?php $videoheightSingle = get_post_meta(get_the_ID(), 'theme_video_height', TRUE); ?>
                            
                            <style type="text/css">
                                .single .jp-video-play,
                                .single div.jp-jplayer.jp-jplayer-video {
                                    height: <?php echo $heightSingle; ?>px;
                                }
                            </style>
                            
                            <div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer jp-jplayer-video"></div>
                            
                            <div class="jp-video-container">
                                <div class="jp-video">
                                    <div class="jp-type-single">
                                        <div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
                                            <ul class="jp-controls">
                                                <li><div class="seperator-first"></div></li>
                                                <li><div class="seperator-second"></div></li>
                                                <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                                <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                                <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                                                <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                                            </ul>
                                            <div class="jp-progress-container">
                                                <div class="jp-progress">
                                                    <div class="jp-seek-bar">
                                                        <div class="jp-play-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jp-volume-bar-container">
                                                <div class="jp-volume-bar">
                                                    <div class="jp-volume-bar-value"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						<?php  } else   { ?>
                        <div class="post-thumb image-frame">
                        <?php theme_video(get_the_ID()); ?>
                        </div>
                        <?php } ?>
    
<?php } elseif (has_post_format('gallery')) { ?>
<?php theme_gallery(get_the_ID()); ?>
<!--BEGIN .slider -->
					<div id="slider-<?php the_ID(); ?>" class="slider">
                    
                    <?php 
						$args = array(
							'orderby'		 => 'menu_order',
							'post_type'      => 'attachment',
							'post_parent'    => get_the_ID(),
							'post_mime_type' => 'image',
							'post_status'    => null,
							'numberposts'    => -1,
						);
						$attachments = get_posts($args);
					?>
                        
                        <?php if ($attachments) : ?>
                        
                        <div class="slides_container">
                        
                        <?php foreach ($attachments as $attachment) : ?>
                        	
                            <?php 
								$src = wp_get_attachment_image_src( $attachment->ID, 'post'); 
								if(is_singular())
									$src = wp_get_attachment_image_src( $attachment->ID, 'post'); 
							?>
                            
                        	<div>
                            <img 
                            height="<?php echo $src[2]; ?>"
                            width="<?php echo $src[1]; ?>"
                            alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" 
                            src="<?php echo $src[0]; ?>" 
                            />
                            </div>
                        
                        <?php endforeach; ?>
                        
                        </div>
                        <?php endif; ?>

                    <!--END .slider -->
					</div>
<?php } elseif (has_post_format('image')) { ?>
<?php if(has_post_thumbnail()) {  ?>
        <div class="post-thumb image-frame"><?php the_post_thumbnail('post');?></div>
<?php } ?>
<?php }  ?>
<?php if ( (!has_post_format('quote') && !has_post_format('link')) && !has_post_format('aside') && !has_post_format('status') ) { ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php }  ?>
        <div class="clear"></div>
        <?php if (has_post_format('status')) { ?>   
<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '50' ); /* This avatar is the user's gravatar (http://gravatar.com) based on their administrative email address */  } ?>
<?php } ?>
        <!--BEGIN .entry-content -->
        <div class="entry-content">
          <?php the_content(); ?>
        <!--END .entry-content -->
        </div>


<div class="clear"></div>
      </article>
          
    <!-- #post-## -->
    <?php comments_template( '', true ); ?>
    <?php endwhile; /* end loop */ ?>
    <!--END #content-->
   </section> 
   
  <aside id="sidebar">
	<div class="entry-meta">
    <ul>
    <li><time class="date" datetime="<?php the_time('Y-m-d')?>"><span class="icon date"></span><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format') ); ?></a></time></li>
    <li<?php if(!has_tag()) { ?><?php if( in_category( 'Uncategorized' )) { ?> class="last"<?php  } ?><?php  } ?>><div class="comment"><span class="icon comment"></span><a href="<?php comments_link(); ?>"><?php comments_number( __( 'No Comments', 'framework' ), __( '1 Comment', 'framework' ), __( '% Comments', 'framework' ) ); ?></a></div></li>
    <?php if( !in_category( 'Uncategorized' )) { ?>
    <li<?php if(!has_tag()) { ?> class="last"<?php  } ?>><div class="category"><span class="icon"></span><?php the_category(', '); ?></div></li>
    <?php  } ?> 
    <?php if(has_tag()) { ?> 
    <li class="last"><div class="tags"><span class="icon"></span><?php the_tags('', ', ', ' '); ?></div></li>
    <?php  } ?> 
    </ul>
<div class="clear"></div>
</div>
</aside>
    <!--END #content-wrap-->
  </div>

<div class="clear"></div>
<?php get_footer(); ?>