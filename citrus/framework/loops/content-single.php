<?php $tpl_default_settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
	  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();

	$hide_date_meta = isset( $tpl_default_settings['disable-date-info'] ) ? " hidden " : "";
	$hide_comment_meta = isset( $tpl_default_settings['disable-comment-info'] ) ? " hidden " : " comments ";
	
	$hide_author_meta = isset( $tpl_default_settings['disable-author-info'] ) ? " hidden " : "";
	$hide_category_meta = isset( $tpl_default_settings['disable-category-info'] ) ? " hidden " : "";
	$hide_tag_meta = isset( $tpl_default_settings['disable-tag-info'] ) ? " hidden " : "tags";

	$format = get_post_format(  $post->ID );
	$format_icons = array( 'status' => 'fa-comment', 'quote' => 'fa-quote-left', 'gallery' => 'fa-camera', 'image' => 'fa-image', 'video' => 'fa-film', 'audio' => 'fa-music', 'link' => 'fa-link', 'aside' => 'fa-align-left', 'chat' => 'fa-comments' );
	if(isset($format_icons[$format])) $format_icon = $format_icons[$format]; else $format_icon = 'fa-pencil';
	
	$pholder = dttheme_option('general', 'disable-placeholder-images');
	?>

<!--#post-<?php the_ID()?> starts -->
<article id="post-<?php the_ID();?>" <?php post_class(array('blog-entry'));?>>

    <div class="entry-thumb">
        <?php if( ($format === "image" || empty($format)) && !array_key_exists("disable-featured-image", $tpl_default_settings) ): ?>
                <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>">
                    <?php if( has_post_thumbnail() ):
                            the_post_thumbnail("full");
                          elseif($pholder != "on"):?>
                            <img src="http://placehold.it/1160x800&amp;text=<?php the_title();?>" alt="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" />
                    <?php endif;?>
                </a>
        <?php elseif( $format === "gallery" && array_key_exists("items", $tpl_default_settings)):
                    echo "<ul class='entry-gallery-post-slider'>";
                    foreach ( $tpl_default_settings['items'] as $item ) { echo "<li><img src='{$item}' alt='' /></li>";	}
                    echo "</ul>";
              elseif( $format === "video" && ( array_key_exists('oembed-url', $tpl_default_settings) || array_key_exists('self-hosted-url', $tpl_default_settings) ) ):
                    if( array_key_exists('oembed-url', $tpl_default_settings) ):
                        echo "<div class='dt-video-wrap'>".wp_oembed_get($tpl_default_settings['oembed-url']).'</div>';
                    elseif( array_key_exists('self-hosted-url', $tpl_default_settings) ):
                        echo "<div class='dt-video-wrap'>".wp_video_shortcode( array('src' => $tpl_default_settings['self-hosted-url']) ).'</div>';
                    endif;
              elseif( $format === "audio" && (array_key_exists('oembed-url', $tpl_default_settings) || array_key_exists('self-hosted-url', $tpl_default_settings)) ):
                    if( array_key_exists('oembed-url', $tpl_default_settings) ):
                        echo wp_oembed_get($tpl_default_settings['oembed-url']);
                    elseif( array_key_exists('self-hosted-url', $tpl_default_settings) ):
                        echo wp_audio_shortcode( array('src' => $tpl_default_settings['self-hosted-url']) );
                    endif;
              elseif(!array_key_exists("disable-featured-image", $tpl_default_settings)): ?>
                    <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>"><?php
                        if( has_post_thumbnail() ):
                            the_post_thumbnail("full");
                        elseif($pholder != "on"):?>
                            <img src="http://placehold.it/1160x800&amp;text=<?php the_title();?>" alt="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" />
                        <?php endif;?>
                    </a>
        <?php endif; ?>
    </div>
	
	<div class="entry-details">
    
        <div class="entry-title">
            <span class="hexagon">
                <span class="corner1"></span>
                <span class="corner2"></span>
                <i class="fa <?php echo $format_icon; ?>"></i>
            </span>
            <h4> <a href="<?php the_permalink();?>"><?php the_title();?></a> </h4>
        </div>
   
		<?php if(is_sticky()): ?>
            <div class="featured-post"> <span class="fa fa-trophy"> </span> <span class="text"> <?php _e('Featured','dt_themes');?> </span></div>
        <?php endif;?>
        
        <div class="entry-body">
			<?php 
            the_content();
            wp_link_pages( array('before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 'next_or_number'=>'number',	'pagelink' => '%', 'echo' => 1 ) );
            
			echo '<div class="dt-sc-clear"></div>';
            echo '<div class="social-bookmark">';
				show_fblike('post');
				show_googleplus('post');
				show_twitter('post');
				show_stumbleupon('post');
				show_linkedin('post');
				show_delicious('post');
				show_pintrest('post');
				show_digg('post');
            echo '</div>';
            
            echo '<div class="social-share">';
				dttheme_social_bookmarks('sb-post');
            echo '</div>';
            
            edit_post_link( __( ' Edit ','dt_themes' ) );
            ?>
            <div class="dt-sc-margin10"></div>
        </div>

        <div class="entry-metadata">
             <h6 class="date <?php echo $hide_date_meta;?>">
                 <span class="hexagon2">
                    <span class="corner1"></span>
                    <span class="corner2"></span>
                    <i class="fa fa-calendar"></i>
                 </span> 
                 <?php echo get_the_date('d M Y');?>
             </h6>
             <h6 class="author <?php echo $hide_author_meta;?>"> 
                 <span class="hexagon2">
                    <span class="corner1"></span>
                    <span class="corner2"></span>
                    <i class="fa fa-user"></i>
                 </span> 
                 <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php _e('View all posts by ', 'dt_themes').get_the_author();?>"><?php echo get_the_author();?></a>
             </h6>
             <h6 class="<?php echo $hide_comment_meta;?>">
                 <span class="hexagon2">
                    <span class="corner1"></span>
                    <span class="corner2"></span>
                    <i class="fa fa-comments"></i>
                </span>
                <?php comments_popup_link( '0', '1', '%', '', '0');?>
             </h6>
             <h6 class="category <?php echo $hide_category_meta;?>"> 
                 <span class="hexagon2">
                    <span class="corner1"></span>
                    <span class="corner2"></span>
                    <i class="fa fa-sitemap"></i>
                 </span> 
                 <?php the_category(', '); ?>
             </h6>
             <h6 class="tags <?php echo $hide_tag_meta;?>"> 
                 <span class="hexagon2">
                    <span class="corner1"></span>
                    <span class="corner2"></span>
                    <i class="fa fa-tags"></i>
                 </span> 
                 <?php the_tags('', ', ', '');?>
             </h6>
        </div>

	</div><!-- .entry-details -->
    
</article><!-- #post-<?php the_ID()?> Ends -->

<div class="post-author-details">
    <h4><?php echo __('ABOUT AUTHOR', 'dt_themes'); ?></h4>
    <div class="entry-author-image">
        <span class="hexagon2">
            <span class="corner1"></span>
            <span class="corner2"></span>
    </span>
    <div class="hexagon-image">
        <div class="hexagon-in1">
        <div class="hexagon-in2" style="background:url(<?php echo get_avatar_url(get_the_author_meta( 'ID' ), 100); ?>) repeat scroll 50%;"></div></div>
    </div>
    </div>
    <div class="author-desc">
        <div class="author-title">
            <h5><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo get_the_author();?></a></h5> / <span><?php $author_role = get_the_author_meta('roles'); echo $author_role[0]; ?></span>
        </div>
        <p><?php echo get_the_author_meta('description'); ?></p>
    </div>
    <!--author-desc ends-->
</div>

<?php $dttheme_options = get_option(IAMD_THEME_SETTINGS);
	$dttheme_general = $dttheme_options['general'];
	$globally_disable_post_comment =  array_key_exists('global-post-comment',$dttheme_general) ? true : false; 

	if( (!$globally_disable_post_comment) && (! isset($tpl_default_settings['disable-comment'])) ):?>
		<!-- **Comment Entries** -->   	
			<?php  comments_template('', true); ?>
        <!-- **Comment Entries - End** -->
<?php endif;?>