<?php get_header(); ?>
<?php $postid = get_the_ID(); ?>
  <!--BEGIN #content-wrap-->
  <div id="content-wrap" class="sidebar-Right"> 
    
    <!--BEGIN #content-->
    <section id="content">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
       		<?php 
			$video_url_portfolio = get_post_meta(get_the_ID(), 'theme_video_url_portfolio', true);
			$embeded_code_portfolio = get_post_meta(get_the_ID(), 'theme_video_m4v_portfolio', true);
			?>
          <?php if($video_url_portfolio != '' || $embeded_code_portfolio != '') { ?>
          
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
						<?php  } else   { ?>
                        <div class="post-thumb image-frame">
                        <?php theme_video_portfolio(get_the_ID()); ?>
                        </div>
                        <?php } ?>

          <?php  } else   { ?>
          <?php if (has_post_thumbnail()) {?>
          <div class="post-thumb image-frame"><?php the_post_thumbnail('post');?></div>
          <?php } ?>
          <?php } ?>
        <h2 class="entry-title">
          <?php the_title(); ?>
        </h2>
                
        <!--BEGIN .entry-content-->
        <div class="entry-content">
          <?php the_content(); ?>
        <!--END .entry-content--> 
        </div>
        
        <div class="clear"></div>
      </article>
      <!-- #post-## -->
    <?php if(comments_open()) {comments_template( '', true ); }?>
    <?php endwhile; /* end loop */ ?>
    <!--END #content-->
    </section>
  <aside id="sidebar">
	<div class="entry-meta">
    <ul>
    <?php $terms = get_the_terms( get_the_ID(), 'portfolio_category' ); ?>
    <li<?php if(!comments_open()) { ?><?php if(!has_tag()) { ?><?php if ($terms == '') { ?> class="last"<?php }?><?php }?><?php }?>><time class="date" datetime="<?php the_time('Y-m-d')?>"><span class="icon date"></span><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format') ); ?></a></time></li>
     <?php if(comments_open()) { ?> 
    <li<?php if(!has_tag()) { ?><?php if ($terms == '') { ?> class="last"<?php  } ?><?php  } ?>><div class="comment"><span class="icon comment"></span><a href="<?php comments_link(); ?>"><?php comments_number( __( 'No Comments', 'framework' ), __( '1 Comment', 'framework' ), __( '% Comments', 'framework' ) ); ?></a></div></li><?php }?>
    
    <?php 
	if ($terms != '') {
	?>
    <li<?php if(!has_tag()) { ?> class="last"<?php  } ?>><div class="category"><span class="icon"></span><?php foreach ($terms as $term) :  ?>
                            <?php echo $term->name; ?>
                            <?php endforeach; ?></div>
    </li>
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