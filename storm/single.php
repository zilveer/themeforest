<?php get_header();?>
<?php 
    if (isset($bk_option)):
        $share_box = $bk_option['bk-sharebox-sw'];
        $fb_share = $bk_option['bk-fb-sw'];
        $tw_share = $bk_option['bk-tw-sw'];
        $gp_share = $bk_option['bk-gp-sw'];
        $pi_share = $bk_option['bk-pi-sw'];
        $tbl_share = $bk_option['bk-tbl-sw'];
        $li_share = $bk_option['bk-li-sw'];
        $su_share = $bk_option['bk-su-sw'];
        $vk_share = $bk_option['bk-vk-sw'];
        $authorbox_sw = $bk_option['bk-authorbox-sw'];
        $postnav_sw = $bk_option['bk-postnav-sw'];
        $related_sw = $bk_option['bk-related-sw'];
        $rtl = $bk_option['bk-rtl-sw'];
        $title_pos = $bk_option['bk-single-title'];
        $single_feat = $bk_option['bk-single-feat'];
        $single_img = $bk_option['bk-single-featimg'];
    endif;
?>
    <?php if ($single_feat) {?>
    <div class="fullwidth-section">
    <?php $args = array('title' => '', 'category' => 'feat', 'style' => 'thumb', 'entries_display' => 6, 'speed' => 4000, 'autoplay' => 'off');
    the_widget( 'bk_carousel',$args ); 
    ?> 
    </div>
    <?php } ?>
    
<?php if (have_posts()) : while (have_posts()) : the_post();
        setPostViews($post->ID);
        $bk_url = get_post_meta($post->ID, 'bk_media_embed_code_post', true);
        $fullwidth = get_post_meta($post->ID, 'bk_post_fullwidth_checkbox', true);
        if ($fullwidth) { $bk_related_num = 4;} else { $bk_related_num = 3;};
        $bk_review_checkbox = get_post_meta($post->ID,'bk_review_checkbox',true);
        $bk_parse_url = parse_url($bk_url); ?>
        
        <div class="content <?php if ($fullwidth) {echo 'full-width';} else echo 'has-sidebar'; ?>" <?php if ( $bk_review_checkbox != '1' ) { echo 'itemscope itemtype="http://schema.org/BlogPosting"'; } else { echo 'itemscope itemtype="http://schema.org/Review"'; } ?>>
        
        <?php if ($title_pos == 'above') {
        $categories = get_the_category();
            if ($categories): ?>
            <div class="cat-list">
                <?php
				foreach ($categories as $category):
					echo '<a class="cat-btn" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s", 'bkninja'), $category->name)) .'">'. $category->cat_name.'</a>';
				endforeach; ?>
            </div>
			<?php endif;
        
        
            if (get_the_title()): ?>
        	<h1 class="post-title post-title-single" <?php if ( $bk_review_checkbox == '1' ) { echo 'itemprop="itemReviewed"'; } else { echo 'itemprop="headline"'; }?>><?php the_title(); ?></h1>
        <?php else: ?>
        	<h1 class="post-title post-title-single"><?php _e('Untitled','bkninja'); ?></h1>
        <?php endif; ?>
        
        <div class="post-meta post-meta-single">
        	
            <div class="post-meta post-meta-primary">                   
                    
                <?php $author_display_name = get_the_author_meta( 'display_name' );
                        $bk_author_id = $post->post_author;
                printf('<div class="author" itemprop="author" >%s</div>', '<a rel="author" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="'.sprintf(__('Posts by %s','bkninja'), $author_display_name).'">'.$author_display_name.'</a>') ?>
                                                         
                <time class="article-time" datetime="<?php the_time('c'); ?>">
                     <?php $time_s = __('\a\t','bkninja'); printf(__('| %s', 'bkninja'),get_the_time(__('j F, Y '.$time_s.' H:i', 'bkninja'))); ?>
                </time>					   
			</div>
            
            <div class="post-meta post-meta-secondary">
                <div class="views">
					<i class="fa fa-eye"></i>									
					<?php echo getPostViews(get_the_ID()); ?>
				</div>
   								
				<?php if ( comments_open() ) : ?>
					<div class="comments">
						<i class="fa fa-comment"></i>
						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
					</div>		
			    <?php endif; ?>
                
            </div>
        </div>
        <br/>
        <?php } ?>
        <?php if ($single_img) {?>
        <div class="article-thumb">
<?php
/**
* Post Format Image
*---------------------------------------------------
*/
            if(function_exists('has_post_format') && has_post_format('image')) {
                bk_image_display($post->ID, 'full');     
            }
/**
* Post Format Youtube and Vimeo
*---------------------------------------------------
*/
            else if(function_exists('has_post_format') && ( get_post_format( $post->ID ) == 'video') && (($bk_parse_url['host'] == 'www.youtube.com')||($bk_parse_url['host'] == 'youtube.com'))){
                $yt_id = parse_youtube($bk_url);
                echo("<div class='bk-oEmbed-video'>");                                    
                    echo ('<iframe width="1050" height="591" src="http://www.youtube.com/embed/'.$yt_id.'?feature=oembed" allowFullScreen="true"></iframe>');
                echo '</div>';
            }  		
            else if(function_exists('has_post_format') && ( get_post_format( $post->ID ) == 'video') && (($bk_parse_url['host'] == 'www.vimeo.com')||($bk_parse_url['host'] == 'vimeo.com'))){
                    $bk_vimeo_id = parse_vimeo($bk_url);
                    echo '<div class="bk-oEmbed-video">';
                        echo ('<iframe src="//player.vimeo.com/video/'.$bk_vimeo_id.'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" title="The Quiet City: Winter in Paris" ></iframe>');
                    echo '</div>';
            }

/**
* Post Format Others Video, Audio
*---------------------------------------------------
*/            
            else if(function_exists('has_post_format') && (has_post_format('video') || has_post_format('audio'))) {
                bk_oembed_code_display($post->ID,$bk_url);
            }
/**
* Post Format Gallery
*---------------------------------------------------
    */            
            else if( function_exists('has_post_format') && has_post_format( 'gallery') ) {
                bk_gallery_display($post->ID);
            }else{
                echo get_the_post_thumbnail($post->ID, 'full');
            }?>
        </div> <!-- article-thumb -->
        <?php } ?>
        
        <?php
        if ($title_pos == 'below') {
        $categories = get_the_category();
            if ($categories): ?>
            <div class="cat-list">
                <?php
				foreach ($categories as $category):
					echo '<a class="cat-btn" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s", 'bkninja'), $category->name)) .'">'. $category->cat_name.'</a>';
				endforeach; ?>
            </div>
			<?php endif;
        
        
            if (get_the_title()): ?>
        	<h1 class="post-title post-title-single" <?php if ( $bk_review_checkbox == '1' ) { echo 'itemprop="itemReviewed"'; } else { echo 'itemprop="headline"'; }?>><?php the_title(); ?></h1>
        <?php else: ?>
        	<h1 class="post-title post-title-single"><?php _e('Untitled','bkninja'); ?></h1>
        <?php endif; ?>
        
        <div class="post-meta post-meta-single">
        	
            <div class="post-meta post-meta-primary">                   
                    
                <?php $author_display_name = get_the_author_meta( 'display_name' );
                        $bk_author_id = $post->post_author;
                printf('<div class="author" itemprop="author" >%s</div>', '<a rel="author" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="'.sprintf(__('Posts by %s','bkninja'), $author_display_name).'">'.$author_display_name.'</a>') ?>
                                                         
                <time class="article-time" datetime="<?php the_time('c'); ?>">
                     <?php printf(__('| %s', 'bkninja'),get_the_time(__('j F, Y \a\t H:i', 'bkninja'))); ?>
                </time>					   
			</div>
            
            <div class="post-meta post-meta-secondary">
                <div class="views">
					<i class="fa fa-eye"></i>									
					<?php echo getPostViews(get_the_ID()); ?>
				</div>
   								
				<?php if ( comments_open() ) : ?>
					<div class="comments">
						<i class="fa fa-comment"></i>
						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
					</div>		
			    <?php endif; ?>
                
            </div>
        </div>
        <?php } ?>
        
    <article <?php post_class('post-article'); ?> >
        
        <section class="article-content" <?php if ( $bk_review_checkbox == '1' ) { echo 'itemprop="reviewBody"'; } else { echo 'itemprop="articleBody"'; } ?>>
        <?php the_content(); ?>
        </section>
        
        <?php
            if ($bk_review_checkbox) {
                global $multipage, $numpages, $page;
                if( $page == $numpages ) { 
                    echo (bk_post_review_boxes($post)); 
                }
            }
        ?>
        
        
    </article>
    
    <?php wp_link_pages( array(
    							'before' => '<div class="post-page-links">',
    							'pagelink' => '<span>%</span>',
    							'after' => '</div>',
    						)
    					 ); 
    ?>
    
    <?php 
			$tags = get_the_tags();
            if ($tags): ?>
            <div class="tag-list">
                <span><?php _e('Tags', 'bkninja') ?></span>
                <?php
					foreach ($tags as $tag):
						echo '<a class="tag-btn" href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s",'bkninja'), $tag->name)) .'">'. $tag->name.'</a>';
					endforeach;
                ?>
            </div>
	<?php endif; ?>
    
    <?php if ($share_box) bk_share_box($fb_share,$tw_share,$gp_share,$pi_share,$tbl_share,$li_share,$su_share,$vk_share);?>

<?php if ($authorbox_sw) echo bk_author_details($bk_author_id); ?>

<?php
    if ($postnav_sw):
    	$next_post = get_next_post();
    	$prev_post = get_previous_post();
    	if (!empty($prev_post) || !empty($next_post)): ?>
    	
    	<nav class="post-nav clear-fix">
    		<?php if (!empty($prev_post)): ?>
            <div class="post-nav-link  post-nav-link-prev">
    				<a href="<?php echo get_permalink($prev_post->ID); ?>">
    					<i class="fa fa-chevron-<?php if ($rtl) echo 'right'; else echo 'left';?>"></i>
                        <div class="post-nav-link-label">
    						<?php _e("Previous Post", 'bkninja'); ?>
    					</div>
    					<div class="post-nav-link-title">
    						<h3>
                            <?php previous_post_link( '%link','%title' ); ?>
                            </h3>
    					</div>
    				</a>
            </div> 
    		<?php endif; ?>
    		<?php if (!empty($next_post)): ?>
            <div class="post-nav-link  post-nav-link-next">
    				<a href="<?php echo get_permalink($next_post->ID); ?>">
    					<i class="fa fa-chevron-<?php if ($rtl) echo 'left'; else echo 'right';?>"></i>
                        <div class="post-nav-link-label">
    						<?php _e("Next Post", 'bkninja'); ?>
    					</div>
    					<div class="post-nav-link-title">
    						<h3>
                            <?php next_post_link( '%link','%title' ); ?>
                            </h3>
    					</div>
    				</a>
            </div>
    		<?php endif; ?>
        </nav>
    	
        <?php endif;
    endif; ?>

<?php if ($related_sw) echo (bk_related_posts($bk_related_num));?>

<?php comments_template(); ?>

    </div> <!-- main-content -->

<?php endwhile; endif; ?>    
    
    <?php if (!$fullwidth) get_sidebar(); ?>        

<?php get_footer();?>