<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>

 
  <!--BEGIN #content-wrap-->
  <div id="content-wrap" class="masonry-On"> 
    <!--BEGIN #content-->
    <section id="content">
    
    
    <div id="masonry-wrap">
        <?php		$args = array(
				'post_type' => 'theme_portfolio',
				'posts_per_page' => '-1',
				'orderby' => ''.of_get_option('portfolio_order').'',
				'paged' => $paged
				);
				$wp_query = new WP_Query($args);
				if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
	?>
       <article id="post-<?php the_ID(); ?>" <?php post_class(masonry_item); ?>>
       <?php 
			$video_url_portfolio = get_post_meta(get_the_ID(), 'theme_video_url_portfolio', true);
			$embeded_code_portfolio = get_post_meta(get_the_ID(), 'theme_video_m4v_portfolio', true);
			?>
<?php if($embeded_code_portfolio != '') { ?>	
							<?php theme_video_embed_portfolio(get_the_ID()); ?>
                            
                            
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
						<?php  } elseif($video_url_portfolio != '')  { ?>
                        <div class="post-thumb image-frame">
                        <?php theme_video_portfolio(get_the_ID()); ?>
                        </div>
                        <?php } ?>
      <?php if(has_post_thumbnail()) : //if has thumbnail ?>
      <div class="post-thumb image-frame">
      <?php $thumb_size = 'post-thumb'; 
		theme_lightbox(get_the_ID(), $thumb_size); ?>
	</div>
      <?php endif; //end of has post thumbnail ?>
      <h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<div class="entry-content">
  <?php wpe_excerpt('wpe_excerptlength_blog', 'wpe_excerptmore'); ?>
</div>
</article>
       <?php endwhile; endif; ?>
	</div>

      <div class="clear"></div>
           
      <!--END #content--> 
    </section>
    <!--END #content-wrap--> 
  </div>
  <div class="clear"></div>
<?php get_footer(); ?>