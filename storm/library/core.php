<?php
/**
* ************* Display post views *****************
*---------------------------------------------------
*/
if ( ! function_exists( 'getPostViews' ) ) {  
    function getPostViews($postID){
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
       }
       return $count;
    }
}
if ( ! function_exists( 'setPostViews' ) ) {  
    function setPostViews($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
}
/**
 * ************* Review Score *****************
 *---------------------------------------------------
 */
/*if ( ! function_exists( 'bk_review_score' ) ) {
    function bk_review_score ($post_id) {
        $ret = '';
        $bk_final_score = get_post_meta($post_id, 'bk_final_score', true);
        if ( $bk_final_score > 5) { $fill = 'fill';} else { $fill = '';};
        if ( $bk_final_score > 5) { $left_half = 'left-half';} else { $left_half = '';};
        $rotate_angle = $bk_final_score*36;                                       
        $score_circle = '<div class="score-clip '.$left_half.'"><div class="pie-spinner" style="transform:rotatez('.$rotate_angle.'deg);-webkit-transform:rotatez('.$rotate_angle.'deg)"></div></div><div class="score-clip"><div class="pie-filler '.$fill.'"></div></div>';
        if (isset($bk_final_score) && ($bk_final_score != null)){
            $ret .= '<div class="reviewscore">'.$score_circle.'<span>'.$bk_final_score.'</span></div>';
        }
        return $ret;
    }
}*/
if ( ! function_exists( 'bk_review_score' ) ) {
    function bk_review_score ($post_id) {
        $ret = '';
        $bk_review_en = get_post_meta($post_id, 'bk_review_checkbox', true);
        if ($bk_review_en) {
            $bk_final_score = get_post_meta($post_id, 'bk_final_score', true);
            $arc_percent = $bk_final_score * 10;
            if (isset($bk_final_score) && ($bk_final_score != null)){
                $ret = '<div class="rating-wrap"><canvas class="rating-canvas" data-rating="'.$arc_percent.'"></canvas><span>'.$bk_final_score.'</span></div>';
            }
        }
        return $ret;
    }
}
/**
* ************* Display post review box ********
*---------------------------------------------------
*/
if ( ! function_exists( 'bk_post_review_boxes' ) ) {  
     function bk_post_review_boxes($post){
        global $bk_option;
            if (isset($bk_option)){
                $primary_color = $bk_option['bk-primary-color'];
            }
        $bk_post_id = $post->ID;
        $bk_custom_fields = get_post_custom();
        $bk_review_checkbox = get_post_meta($bk_post_id, 'bk_review_checkbox', true );

        if ( $bk_review_checkbox == '1' ) {
             $bk_review_checkbox = 'on'; 
        } else {
             $bk_review_checkbox = 'off';
        }
        if ($bk_review_checkbox == 'on') {
            $bk_summary = get_post_meta($bk_post_id, 'bk_summary', true );                
            $bk_final_score = get_post_meta($bk_post_id, 'bk_final_score', true );
            
            $bk_rating_1_title = $bk_rating_2_title = $bk_rating_3_title = $bk_rating_4_title = $bk_rating_5_title = $bk_rating_6_title = null;        
            
            if ( isset ( $bk_custom_fields['bk_ct1'][0] ) ) { $bk_rating_1_title = $bk_custom_fields['bk_ct1'][0]; }
            if ( isset ( $bk_custom_fields['bk_cs1'][0] ) ) { $bk_rating_1_score = $bk_custom_fields['bk_cs1'][0]; }
            if ( isset ( $bk_custom_fields['bk_ct2'][0] ) ) { $bk_rating_2_title = $bk_custom_fields['bk_ct2'][0]; }
            if ( isset ( $bk_custom_fields['bk_cs2'][0] ) ) { $bk_rating_2_score = $bk_custom_fields['bk_cs2'][0]; }
            if ( isset ( $bk_custom_fields['bk_ct3'][0] ) ) { $bk_rating_3_title = $bk_custom_fields['bk_ct3'][0]; }
            if ( isset ( $bk_custom_fields['bk_cs3'][0] ) ) { $bk_rating_3_score = $bk_custom_fields['bk_cs3'][0]; }
            if ( isset ( $bk_custom_fields['bk_ct4'][0] ) ) { $bk_rating_4_title = $bk_custom_fields['bk_ct4'][0]; }
            if ( isset ( $bk_custom_fields['bk_cs4'][0] ) ) { $bk_rating_4_score = $bk_custom_fields['bk_cs4'][0]; }
            if ( isset ( $bk_custom_fields['bk_ct5'][0] ) ) { $bk_rating_5_title = $bk_custom_fields['bk_ct5'][0]; }
            if ( isset ( $bk_custom_fields['bk_cs5'][0] ) ) { $bk_rating_5_score = $bk_custom_fields['bk_cs5'][0]; }
            if ( isset ( $bk_custom_fields['bk_ct6'][0] ) ) { $bk_rating_6_title = $bk_custom_fields['bk_ct6'][0]; }
            if ( isset ( $bk_custom_fields['bk_cs6'][0] ) ) { $bk_rating_6_score = $bk_custom_fields['bk_cs6'][0]; }
            
            $bk_review_final_score = floatval($bk_final_score);
            
            $bk_ratings = array();  
            
            $bk_best_rating = '10';
            for( $i = 1; $i < 7; $i++ ) {
                 if ( isset(${"bk_rating_".$i."_score"}) ) { $bk_ratings[] =  ${"bk_rating_".$i."_score"};}
            }
            $bk_review_ret = '<div class="bk-review-box clear-fix">'; 
            
            if (($bk_rating_1_title != null) || ($bk_rating_2_title != null) || ($bk_rating_3_title != null) || ($bk_rating_4_title != null)
             || ($bk_rating_5_title != null) || ($bk_rating_2_title != null)) {
                
                $bk_review_ret .= '<div class="bk-detail-rating clear-fix">';
                for( $j = 1; $j < 7; $j++ ) {
                    
                     $k = ($j - 1);
                
                     if ((isset(${"bk_rating_".$j."_title"})) && (isset(${"bk_rating_".$j."_score"})) ) {                       
                            $bk_review_ret .= '<span class="bk-criteria">'. ${"bk_rating_".$j."_title"}.'</span><span class="bk-criteria-score">'. $bk_ratings[$k].'</span>';                                     
                            $bk_review_ret .= '<div class="bk-bar"><span class="bk-overlay"><span class="bk-zero-trigger" style="width:'. ( ${"bk_rating_".$j."_score"}*10).'%"></span></span></div>';
                     }
                }
                $bk_review_ret .= '</div>';
            }
            if ( $bk_summary != NULL ) { $bk_review_ret .= '<div class="bk-summary"><div id="bk-conclusion">'.$bk_summary.'</div></div>'; }

            $arc_percent = $bk_final_score*10;                                       
            $score_circle = '<canvas class="rating-canvas" data-rating="'.$arc_percent.'"></canvas>';
                        
            $bk_review_ret .= '<div class="bk-score-box" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">'.$score_circle.'<meta itemprop="worstRating" content="1"><meta itemprop="bestRating" content="'. $bk_best_rating .'"><span class="score" itemprop="ratingValue">'.$bk_review_final_score.'</span></div></div><!-- /bk-review-box -->';
            
            return $bk_review_ret;
        }
    }
}


if ( ! function_exists('bk_image_display')){
    function bk_image_display($bk_post_id, $size){
        $attachment_id = get_post_meta($bk_post_id, 'bk_image_upload', true );
        
        $thumb_url = wp_get_attachment_image_src($attachment_id, $size, true);
        
        echo("<div class='bk-image'>");
            echo "<img src='{$thumb_url[0]}' alt='Image' />";
        echo("</div>");
    }
}
/**
* ************* Display oembed code ********
*-------------------------------------------
*/
if ( ! function_exists('bk_oembed_code_display')){
    function bk_oembed_code_display($bk_post_id,$bk_url){
        
        global $content_width;
        $content_width = 1050;
        $bk_media = get_post_meta($bk_post_id, 'bk_media_embed_code_post', true );
        if (!empty($bk_media)){
            if(has_post_format('video')){   
                $embed_code = wp_oembed_get( $bk_media );
                if ($embed_code != '') {
                    echo("<div class='bk-oEmbed-video'>");
                        $embed_code = wp_oembed_get( $bk_media );
                        echo($embed_code);
                    echo ("</div>");
                } else {
                    echo do_shortcode('[video src="'.$bk_url.'"]');
                }
            }
            else if(has_post_format('audio')){
                echo("<div class='bk-oEmbed-audio'>");
                    $embed_code = wp_oembed_get( $bk_media );
                    echo($embed_code);
                echo ("</div>");
            }
        }
    }
}
/**
* ************* Display Gallery post format ********
*---------------------------------------------------
*/
if ( ! function_exists('bk_gallery_display')){
    function bk_gallery_display($bk_post_id){
        
	   $gallery_images = rwmb_meta( 'bk_gallery_content', $args = array('type' => 'image'), $bk_post_id );
       ?>     

	<!-- FlexSlider -->				
		<div id="bk-gallery-slider" class="flexslider">
            <ul class="slides">
                <?php 
                	foreach ( $gallery_images as $image ){
                        $thumb_url = wp_get_attachment_image_src($image['ID'], true);
                ?>
                    <li>
                        <?php echo "<a href='{$image['full_url']}' title='{$image['title']}' rel='thickbox'><img src='{$thumb_url[0]}' alt='{$image['alt']}' /></a>"; ?>
                    </li>
                <?php } ?>       								    
            </ul>
		</div>
		<div id="bk-carousel-gallery-thumb" class="flexslider">
            <ul class="slides">
                <?php 
                	foreach ( $gallery_images as $image ){
                        $thumb_url = wp_get_attachment_image_src($image['ID'], 'bk239_130', true);
                ?>
                    <li>
                        <?php echo "<a href='{$image['full_url']}' title='{$image['title']}' rel='thickbox'><img src='{$thumb_url[0]}' alt='{$image['alt']}' /></a>"; ?>
                    </li>
                <?php } ?>       								    
            </ul>
		</div>
<?php
    }
}
?>
<?php

/**
* ************* BK Get masonry content*****************
*---------------------------------------------------
*/ 
if ( ! function_exists('bk_get_masonry_content')){ 
    function bk_get_masonry_content($display){
        $post_id = get_the_ID();
        $bk_url = get_post_meta($post_id, 'bk_media_embed_code_post', true);
        $bk_parse_url = parse_url($bk_url);
        if ($bk_url == '') {
            $display = 'thumb';
        }      
        ?>
        <div class="item">
            <article class="article article-masonry one-col clear-fix">    
<?php   						
/**
* Post Format Image: Display Thumbnail
*---------------------------------------------------
*/
?>
     			<div class="thumb-wrap post-thumb-wrap-masonry">
                    <?php 
    					$category = get_the_category(); 
                        if (array_key_exists(0,$category)){
        					if($category[0]){?>  										
        						<div class="post-cat post-cat-bg">
        							<?php echo '<a  href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
        						</div>					
        			<?php
        					}
                        }
    				?>
            <?php
    
                        if(function_exists('has_post_format') && has_post_format('image')) { // new image post format ?>
                        <div class="thumb post-thumb-masonry">
                            <a href="<?php the_permalink() ?>">
            					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <?php bk_image_display($post_id,'full'); ?>
            					</div>
                            </a>
                        </div>
<?php
/**
* Post Format Video, Audio, Gallery, Default: Display Thumbnail
*---------------------------------------------------
*/ 
                        } else if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.youtube.com')||($bk_parse_url['host'] == 'youtube.com'))){
                                $yt_id = parse_youtube($bk_url);
                                echo '<div class="video-thumb">';
                                    echo("<div class='bk-oEmbed-video'>");                                    
                                        echo ('<iframe width="1050" height="591" src="http://www.youtube.com/embed/'.$yt_id.'?feature=oembed" allowFullScreen="true"></iframe>');
                                    echo '</div>';
                                echo '</div>';
                                    		
                        }else if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.vimeo.com')||($bk_parse_url['host'] == 'vimeo.com'))){
                                $bk_vimeo_id = parse_vimeo($bk_url);
                                echo '<div class="video-thumb"> <div class="bk-oEmbed-video">';
                                    
                                    echo ('<iframe src="//player.vimeo.com/video/'.$bk_vimeo_id.'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" title="The Quiet City: Winter in Paris" ></iframe>');
                                echo '</div></div>';
                        ?>
    			<?php } else {	?>
                        <?php
                                echo '<div class="thumb post-thumb-masonry">';
                                echo '<a href="'.get_permalink().'">';
                                echo (bk_get_thumbnail($post_id, 'bk330_220'));
                                echo '</a>';
                                echo bk_review_score($post_id);
                                echo '</div>';
                            }
                        ?>  
                        
                    
                    
    			</div>
<?php
/**
* Post Detail
*---------------------------------------------------
*/ 
?> 
        
            <div class="post-details hide">
        			<h3 class="post-title post-title-masonry">
                        <a href="<?php the_permalink() ?>">
                            <?php $title = get_the_title(); echo the_excerpt_limit($title, 10); ?></a>
                    </h3>
                    
                    <div class="post-meta post-meta-primary clear-fix">                   
                    
                        <div class="post-author">
                                <?php the_author_posts_link();?>                            
                        </div>	
                                                                 
                        <div class="date">
            				<?php echo get_the_date(); ?>
            			</div>						   
        			</div>
                    
					<?php
                        if(function_exists('has_post_format') && (! has_post_format('image'))) { ?>						
                    		<div class="entry-excerpt">
                    			<?php 
                                    $string = get_the_excerpt();
                                    echo the_excerpt_limit($string, 35); 
                                ?>
                    		</div>
                    <?php }?>
                    
                    <div class="post-meta post-meta-secondary clear-fix">
                        <div class="views">
        					<i class="fa fa-eye"></i>									
        					<?php echo getPostViews($post_id); ?>
        				</div>
           								
        				<?php if ( comments_open() ) : ?>
        					<div class="comments">
        						<i class="fa fa-comment"></i>
        						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
        					</div>		
    				    <?php endif; ?>
                        
                        <div class="read-more">
                            <a href="<?php the_permalink() ?>"><?php _e('Read more','bkninja') ?></a>
                        </div>
                        
                    </div>
                    
                </div>

        </article>
    	</div>
<?php
    }
 }
?>
<?php
/**
* ************* BK Get Classic Blog content*****************
*---------------------------------------------------
*/ 
if ( ! function_exists('bk_get_classic_blog_content')){ 
    function bk_get_classic_blog_content($size, $display){
        $post_id = get_the_ID();
        $bk_url = get_post_meta($post_id, 'bk_media_embed_code_post', true);
        $bk_parse_url = parse_url($bk_url);
        if ($bk_url == '') {
            $display = 'thumb';
        } 
        ?>
        <div class="item clear-fix">    
        <article>    
<?php   						
/**
* Post Format Image: Display Thumbnail
*---------------------------------------------------
*/
?>
 			<div class="post-thumb-wrap post-thumb-wrap-classic-blog <?php if ($size == 'small') echo 'one-col'; else echo 'two-col';?>">
                <?php 
    					$category = get_the_category(); 
                        if (array_key_exists(0,$category)){
        					if($category[0]){?>  										
        						<div class="post-cat post-cat-bg">
        							<?php echo '<a  href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
        						</div>					
        			<?php
        					}
                        }
    				?>
                <?php

                    if(function_exists('has_post_format') && has_post_format('image')) { // new image post format ?>
                        <div class="thumb post-thumb-classic-blog">
                            <a href="<?php the_permalink() ?>">
            					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <?php bk_image_display($post_id,'full'); ?>
            					</div>
                            </a>
                        </div>
<?php
/**
* Post Format Video, Audio, Gallery, Default: Display Thumbnail
*---------------------------------------------------
*/ 
                        } else if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.youtube.com')||($bk_parse_url['host'] == 'youtube.com'))){  
                                $yt_id = parse_youtube($bk_url);
                                echo '<div class="video-thumb">';
                                    echo("<div class='bk-oEmbed-video'>");                                    
                                        echo ('<iframe width="1050" height="591" src="http://www.youtube.com/embed/'.$yt_id.'?feature=oembed" allowFullScreen="true"></iframe>');
                                    echo '</div>';
                                echo '</div>';
                                    		
                        }else if(($display == 'video')&&( get_post_format( $post_id ) == 'video') && (($bk_parse_url['host'] == 'www.vimeo.com')||($bk_parse_url['host'] == 'vimeo.com'))){
                                $bk_vimeo_id = parse_vimeo($bk_url);
                                echo '<div class="video-thumb"> <div class="bk-oEmbed-video">';
                                    echo ('<iframe src="//player.vimeo.com/video/'.$bk_vimeo_id.'?api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff"></iframe>');
                                echo '</div></div>';
                        ?>
    			<?php } else {	?>
                    <?php
                        echo '<div class="thumb post-thumb-classic-blog">';
                        echo '<a href="'.get_permalink().'">';
                        if(has_post_thumbnail()){
                            if ($size == 'small') echo the_post_thumbnail('bk330_220' ); else echo the_post_thumbnail('bk690_395');
                            echo '</a>';
                            echo bk_review_score($post_id);
                        }
                        else if(has_post_format('video')) { 
                            echo ('<div class="icon-thumb"><i class="fa fa-play-circle-o"></i></div>');
                            echo '</a>';
                        }                            
                        else if(has_post_format('gallery')) {
                            echo ('<div class="icon-thumb"><i class="fa fa-camera"></i></div>');
                            echo '</a>';                            
                        }                            
                        else if(has_post_format('audio')) {
                            echo ('<div class="icon-thumb"><i class="fa fa-music"></i></div>');
                            echo '</a>';                            
                        }                            
                        else {
                            echo ('<div class="icon-thumb"><i class="fa fa-pencil-square-o"></i></div>');
                            echo '</a>'; 
                        } 
                        echo '</div>';                          
                    }
                    ?>  
		</div>
<?php
/**
* Post Detail
*---------------------------------------------------
*/ 
?> 
                <div class="post-details last <?php if ($size == 'small') echo 'one-col'; else echo 'two-col';?>">
        			<h3 class="post-title post-title-classic-blog">
                        <a href="<?php the_permalink() ?>">
                            <?php $title = get_the_title();
							     echo the_excerpt_limit($title, 10); 
                            ?>
                        </a>
                    </h3>
                    
                    <div class="post-meta post-meta-primary clear-fix">                   
                    
                        <div class="post-author">
                                <?php the_author_posts_link();?>                            
                        </div>	
                                                                 
                        <div class="date">
            				<?php echo get_the_date(); ?>
            			</div>						   
        			</div>
                    
					<?php
                        if(function_exists('has_post_format') && (! has_post_format('image'))) { ?>						
                    		<div class="entry-excerpt">
                    			<?php 
                                    $string = get_the_excerpt();
                                    if (is_archive() && ($size == 'big')) {
                                        echo the_excerpt_limit($string, 70);
                                    } else {
                                        echo the_excerpt_limit($string, 35);
                                    }  
                                ?>
                    		</div>
                    <?php }?>
                    
                    <div class="post-meta post-meta-secondary clear-fix">
                        <div class="views">
        					<i class="fa fa-eye"></i>									
        					<?php echo getPostViews($post_id); ?>
        				</div>
           								
        				<?php if ( comments_open() ) : ?>
        					<div class="comments">
        						<i class="fa fa-comment"></i>
        						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
        					</div>		
    				    <?php endif; ?>
                        
                        <div class="read-more">
                            <a href="<?php the_permalink() ?>"><?php _e('Read more','bkninja') ?></a>
                        </div>
                        
                    </div>
                    
                </div>
        </article>
    	</div>
<?php
    }
 }
?>
<?php
/**
* ************* BK Get card content*****************
*---------------------------------------------------
*/ 
if ( ! function_exists('bk_get_card_content')){ 
    function bk_get_card_content(){ 
            $post_id = get_the_ID();?>
            <article>		
                <a href="<?php echo get_permalink( $post_id );?>">				
                <div class="thumb">									
                    <?php echo (bk_get_thumbnail($post_id, 'bk262_400'));?>								
                </div>
                </a>
                <?php echo (bk_get_post_info($post_id));
                   echo bk_review_score($post_id); 
                ?>
                <a href="<?php echo get_permalink( $post_id );?>">
                <div class="overlay-card">
                    
                    <div class="entry-excerpt entry-excerpt-card">
                            <?php $string = get_the_excerpt();
                                    echo the_excerpt_limit($string,35); ?>
                    </div>                                
                </div>
                </a>
            </article>                            																
<?php    }
}
/**
* ************* BK Get grid content*****************
*---------------------------------------------------
*/ 
if ( ! function_exists('bk_get_grid_content')){ 
    function bk_get_grid_content(){ ?>	
            						
				<div class="one-col main-post">
					<?php
                    $post_id = get_the_ID();
                    $review = '';
                    $bk_review_score = get_post_meta($post_id, 'bk_final_score', true);
                    if ($bk_review_score != null) { $review = 'has-review'; };?>

						<div class="thumb-wrap">
							<div class="thumb">
								<a href="<?php the_permalink() ?>">
                                    <?php echo (bk_get_thumbnail($post_id, 'bk330_220'));?>
                                </a>
                                <?php 
                                    echo bk_review_score($post_id);
                                ?>
							</div>		                                        
                            <?php 
        					$category = get_the_category(); 
                            if (array_key_exists(0,$category)){
            					if($category[0]){?>  										
            						<div class="post-cat post-cat-bg">
            							<?php echo '<a  href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
            						</div>					
            			     <?php
            					}
                            }
        				    ?>
                             
                            <div class="post-details <?php echo $review;?>">
								<h3 class="post-title post-title-main-post">
									<a href="<?php the_permalink() ?>">
										<?php 
											$title = get_the_title();
											echo the_excerpt_limit($title, 10);
										?>
									</a>
								</h3> 								
							</div>			
						</div>									
				</div>					
                          																
<?php    }
}
/**
* ************* Display post info ******************
*---------------------------------------------------
*/
if ( ! function_exists('bk_get_post_info')){
    function bk_get_post_info($bk_postid){?>
        <div class="post-info">
            <div class="post-cat">                                                 
            <?php
                $category = get_the_category( $bk_postid );
                if (array_key_exists(0,$category)){
        			if($category[0]){
                        echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
                    }
                }
            ?>                                           
            </div>		
            <div class="post-info-line"></div>						
			<h2 class="post-title">
				<a href="<?php echo get_permalink( $bk_postid );?>">
					<?php 
						
						$title = get_the_title($bk_postid);
						$short_title = the_excerpt_limit($title, 8);
						echo $short_title; 
					?>
				</a>
			</h2>
        </div>
    <?php }
}
?>
<?php
/**
* ************* Display post thumbnail *************
*---------------------------------------------------
*/
if ( ! function_exists('bk_get_thumbnail')){ 
    function bk_get_thumbnail($bk_postid, $size){
        if(has_post_thumbnail($bk_postid))	
            return get_the_post_thumbnail( $bk_postid, $size );
        else if(has_post_format('video'))
            return ('<div class="icon-thumb"><i class="fa fa-play-circle-o"></i></div>');
        else if(has_post_format('gallery'))
            return ('<div class="icon-thumb"><i class="fa fa-camera"></i></div>');
        else if(has_post_format('audio'))
            return ('<div class="icon-thumb"><i class="fa fa-music"></i></div>');
        else if(has_post_format('image'))
            return ('<div class="icon-thumb"><i class="fa fa-camera"></i></div>');
        else
            return ('<div class="icon-thumb"><i class="fa fa-pencil-square-o"></i></div>');
                
    }
}
/**
* ************* Custom excerpt *****************
*-----------------------------------------------
*/
if ( ! function_exists('string_limit_words')){
    function string_limit_words($string, $word_limit)
    {
      $words = explode(' ', $string, ($word_limit + 1));
      if(count($words) > $word_limit)
      array_pop($words);
      return implode(' ', $words);
    }
}

if ( ! function_exists('the_excerpt_limit')){
    function the_excerpt_limit($string, $word_limit){
        $strout = string_limit_words($string,$word_limit);
        if (strlen($strout) < strlen($string))
            $strout .=" ...";
        return $strout;
    }
}

if ( ! function_exists('bk_excerpt')){
    function bk_excerpt($limit) {
          $excerpt = explode(' ', get_the_excerpt(), $limit);
          if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
          } else {
            $excerpt = implode(" ",$excerpt);
          } 
          $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
          return $excerpt;
    }
}

if ( ! function_exists('bk_content')){
    function bk_content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }
}
/**
* ************* Author Page.*****************
*---------------------------------------------------
*/ 
if ( ! function_exists( 'bk_contact_data' ) ) {  
    function bk_contact_data($contactmethods) {
    
        unset($contactmethods['aim']);
        unset($contactmethods['yim']);
        unset($contactmethods['jabber']);
        $contactmethods['publicemail'] = 'Public Email';
        $contactmethods['twitter'] = 'Twitter Username';
        $contactmethods['facebook'] = 'Facebook URL';
        $contactmethods['youtube'] = 'Youtube Username';
        $contactmethods['googleplus'] = 'Google+ (Entire URL)';
         
        return $contactmethods;
    }
}
add_filter('user_contactmethods', 'bk_contact_data');

/**
* ************* Author box *****************
*---------------------------------------------------
*/
if ( ! function_exists( 'bk_author_details' ) ) {  
    function bk_author_details($bk_author_id, $bk_desc = true) {
        
        $bk_author_email = get_the_author_meta('publicemail', $bk_author_id);
        $bk_author_name = get_the_author_meta('display_name', $bk_author_id);
        $bk_author_tw = get_the_author_meta('twitter', $bk_author_id);
        $bk_author_go = get_the_author_meta('googleplus', $bk_author_id);
        $bk_author_fb = get_the_author_meta('facebook', $bk_author_id);
        $bk_author_yo = get_the_author_meta('youtube', $bk_author_id);
        $bk_author_www = get_the_author_meta('url', $bk_author_id);
        $bk_author_desc = get_the_author_meta('description', $bk_author_id);
        $bk_author_posts = count_user_posts( $bk_author_id ); 
    
        $bk_author_output = NULL;
        $bk_author_output .= '<div class="bk-author-box clear-fix"><div class="bk-author-avatar"><a href="'.get_author_posts_url($bk_author_id).'">'. get_avatar($bk_author_id, '100').'</a></div><span><h3><a href="'.get_author_posts_url($bk_author_id).'">'.$bk_author_name.'</a></h3>';
                            
                            
        if (($bk_author_email != NULL) || ($bk_author_www != NULL) || ($bk_author_tw != NULL) || ($bk_author_go != NULL) || ($bk_author_fb != NULL) ||($bk_author_yo != NULL)) {$bk_author_output .= '<div class="bk-author-page-contact">';}
        if ($bk_author_email != NULL) { $bk_author_output .= '<a href="mailto:'. $bk_author_email.'"><i class="fa fa-envelope " title="'.__('Email', 'bkninja').'"></i></a>'; } 
        if ($bk_author_www != NULL) { $bk_author_output .= ' <a href="'. $bk_author_www .'" target="_blank"><i class="fa fa-globe " title="'.__('Website', 'bkninja').'"></i></a> '; } 
        if ($bk_author_tw != NULL) { $bk_author_output .= ' <a href="//www.twitter.com/'. $bk_author_tw.'" target="_blank" ><i class="fa fa-twitter " title="Twitter"></i></a>'; } 
        if ($bk_author_go != NULL) { $bk_author_output .= ' <a href="'. $bk_author_go .'" rel="publisher" target="_blank"><i title="Google+" class="fa fa-google-plus " ></i></a>'; }
        if ($bk_author_fb != NULL) { $bk_author_output .= ' <a href="'.$bk_author_fb. '" target="_blank" ><i class="fa fa-facebook " title="Facebook"></i></a>'; }
        if ($bk_author_yo != NULL) { $bk_author_output .= ' <a href="http://www.youtube.com/user/'.$bk_author_yo. '" target="_blank" ><i class="fa fa-youtube " title="Youtube"></i></a>'; }
        if (($bk_author_email != NULL) || ($bk_author_www != NULL) || ($bk_author_go != NULL) || ($bk_author_tw != NULL) || ($bk_author_fb != NULL) ||($bk_author_yo != NULL)) {$bk_author_output .= '</div>';}
        $bk_author_output .= '</span>';                            
        if (($bk_author_desc != NULL) && ($bk_desc == true)) { $bk_author_output .= '<p class="bk-author-bio">'. $bk_author_desc .'</p>'; }
        $bk_author_output .= '</div>';
             
        return $bk_author_output;
    }
}

if ( ! function_exists( 'display_archive_grid_style') ) {
    function display_archive_grid_style($col) {
        if (have_posts()): ?>
        <div class="bk-grid-content clear-fix col<?php echo $col; ?>">
    			<?php 
                    while (have_posts()): the_post();
                    echo(bk_get_grid_content());
                    endwhile; 
                ?>                    
        </div>	<!-- End bk-grid-content -->
        <?php
            if (function_exists("bk_paginate"))
            {
                bk_paginate();
            }
        ?> 
    	<?php endif; ?>	
        <?php
    }
}

if ( ! function_exists( 'display_archive_card_style') ) {
    function display_archive_card_style(){
?>
        <?php if (have_posts()): ?>
        <div class="bk-card-content clear-fix" >
    			<?php while (have_posts()): the_post(); ?>  	
                    <?php echo(bk_get_card_content());?>
    			<?php endwhile; ?>                    
        </div>	<!-- End bk-card-content -->
        <?php
            if (function_exists("bk_paginate"))
            {
                bk_paginate();
            }
        ?> 
    	<?php endif; ?>	
        <?php
    }
}

if ( ! function_exists( 'display_archive_classic_small_style') ) {
    function display_archive_classic_small_style($display){
?>
        <?php if (have_posts()): ?>
        <div class="bk-classic-blog-content bk-classic-small" >
    			<?php while (have_posts()): the_post(); ?>  	
                    <?php echo(bk_get_classic_blog_content('small', $display));?>
    			<?php endwhile; ?>                    
        </div>	<!-- End bk-archive-classic-content -->
        <?php
            if (function_exists("bk_paginate"))
            {
                bk_paginate();
            }
        ?> 
    	<?php endif; ?>	
        <?php
    }
}
if ( ! function_exists( 'display_archive_classic_big_style') ) {
    function display_archive_classic_big_style($display){
?>
        <?php if (have_posts()): ?>
        <div class="bk-classic-blog-content bk-classic-big" >
    			<?php while (have_posts()): the_post(); ?>  	
                    <?php echo(bk_get_classic_blog_content('big',$display));?>
    			<?php endwhile; ?>                    
        </div>	<!-- End bk-author-classic-content -->
        <?php
            if (function_exists("bk_paginate"))
            {
                bk_paginate();
            }
        ?> 
    	<?php endif; ?>	
        <?php
    }
}
if ( ! function_exists( 'display_archive_masonry_style') ) {
    function display_archive_masonry_style($display){ ?>
    		<?php if (have_posts()): ?>          
                <div class="bk-masonry-content js-masonry" >

        			<?php while (have_posts()): the_post(); ?>  	
                        <?php echo(bk_get_masonry_content($display));?>
        			<?php endwhile; ?>
               </div>	<!-- End bk-masonry-content --> 
               <?php
                    if (function_exists("bk_paginate")) {
                        bk_paginate();
                    }
               ?>     
    		<?php endif; ?>	                    
           
        <?php
    }
}

/**
 * ************* Pagination *****************
 *---------------------------------------------------
 */ 
if ( ! function_exists( 'bk_paginate') ) {
    function bk_paginate(){  
        global $wp_query, $wp_rewrite; 
        if ( $wp_query->max_num_pages > 1 ) : ?>
        <div id="pagination" class="clear-fix">
        	<?php
        		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
                $big = 999999999; // need an unlikely integer
        		$pagination = array(
        			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
        			'total' => $wp_query->max_num_pages,
        			'current' => $current,
        			'prev_text' => __( '&laquo;', 'bkninja' ),
        			'next_text' => __( '&raquo;', 'bkninja' ),
        			'type' => 'plain'
        		);
        
        		echo paginate_links( $pagination );

        	?>
        </div>
<?php
    endif;
    }
}

if ( ! function_exists( 'set_video_as_featured_image') ) {
    function set_video_as_featured_image($post_id) {
        $format = get_post_format( $post_id );
        if($format == 'video'){
            if(!has_post_thumbnail($post_id)) { 
                
                $oembed= new WP_oEmbed;
                $url = get_post_meta($post_id, 'bk_media_embed_code_post', true );
                $url_parse = parse_url($url);
                $host = $url_parse['host'];
                if($host == 'www.dailymotion.com' || $host == 'dailymotion.com'){
                    $video_id = parse_dailymotion($url);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://api.dailymotion.com/video/".$video_id."?fields=id,title,thumbnail_url,tags,duration,embed_url");
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
                    $results = curl_exec($ch);
                    curl_close($ch);
                    $results = json_decode($results);
                    if (!$results || $results->error->code) {
                        return;
                    } else {
                        $thumb = $results->thumbnail_url;
                    }
                }else{
                    $provider = $oembed->discover($url);
                    $video = $oembed->fetch($provider, $url, array('width' => 300, 'height' => 175));
                    $thumb = $video->thumbnail_url;
                }
                if($thumb) {
                    media_sideload_image($thumb, $post_id, 'thumbnail image.');
                
                    // find the most recent attachment for the given post
                    $attachments = get_posts(
                        array(
                            'post_type' => 'attachment',
                            'numberposts' => 1,
                            'order' => 'DESC',
                            'post_parent' => $post_id
                        )
                    );
                    $attachment = $attachments[0];    
                    // and set it as the post thumbnail
                    set_post_thumbnail( $post_id, $attachment->ID );
                }else{
                    return;
                }
            } // end if
        }
    }
}

add_action('save_post', 'set_video_as_featured_image', 100);

/**
 * ************* Comments  *****************
 *---------------------------------------------------
 */ 
if ( ! function_exists( 'bk_comments') ) {
    function bk_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment-article  media">
                <header class="comment-author clear-fix">
                    <div class="comment-avatar">
                        <!-- custom gravatar call -->
                        <?php $bgauthemail = get_comment_author_email(); echo get_avatar( $comment, 60 );?>
                    </div>
                        <?php printf('<span class="comment-author-name">%s</span>', get_comment_author_link()) ?>
    					          <span class="comment-time" datetime="<?php comment_time('c'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment-timestamp"><?php comment_time(__('j F, Y \a\t H:i', 'bkninja')); ?> </a></span>
                        <span class="comment-links">
                            <?php
                                edit_comment_link(__('Edit', 'bkninja'),'  ','');
                                comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
                            ?>
                        </span>
                    </header><!-- .comment-meta -->
                
                <div class="comment-text">
                    				
    				<?php if ($comment->comment_approved == '0') : ?>
    				<div class="alert info">
    					<p><?php _e('Your comment is awaiting moderation.', 'bkninja') ?></p>
    				</div>
    				<?php endif; ?>
    				<section class="comment-content">
    					<?php comment_text() ?>
    				</section>
                </div>
			</article>
		<!-- </li> is added by WordPress automatically -->
		<?php
    }
}
    
/**
 * ************* Related Post *****************
 *---------------------------------------------------
 */     

if ( ! function_exists( 'bk_related_posts' ) ) {        
    function bk_related_posts($bk_number_related) {
        global $post;
        $bk_post_id = $post->ID;
        if (is_attachment() && ($post->post_parent)) { $bk_post_id = $post->post_parent; };
        $i = 1;
        $bk_related_posts = array();
        $bk_relate_tags = array();
        $bk_relate_categories = array();
        $excludeid = array();
        $bk_number_related_remain = 0;
        array_push($excludeid, $bk_post_id);

            $bk_tags = wp_get_post_tags($bk_post_id);   
            $tag_length = sizeof($bk_tags);                               
            $bk_tag_check = $bk_all_cats = NULL;
 
 // Get tag post
            if ($tag_length > 0){
                foreach ( $bk_tags as $bk_tag ) { $bk_tag_check .= $bk_tag->slug . ','; }             
                    $bk_related_args = array(   'numberposts' => $bk_number_related, 
                                                'tag' => $bk_tag_check, 
                                                'post__not_in' => $excludeid,
                                                'post_status' => 'publish',
                                                'orderby' => 'rand'  );
                $bk_relate_tags_posts = get_posts( $bk_related_args );
                $bk_number_related_remain = $bk_number_related - sizeof($bk_relate_tags_posts);
                if(sizeof($bk_relate_tags_posts) > 0){
                    foreach ( $bk_relate_tags_posts as $bk_relate_tags_post ) {
                        array_push($excludeid, $bk_relate_tags_post->ID);
                        array_push($bk_related_posts, $bk_relate_tags_post);
                    }
                }
            }
 // Get categories post
            $bk_categories = get_the_category($bk_post_id);  
            $category_length = sizeof($bk_categories);       
            if ($category_length > 0){       
                foreach ( $bk_categories as $bk_category ) { $bk_all_cats .= $bk_category->term_id  . ','; }
                    $bk_related_args = array(  'numberposts' => $bk_number_related_remain, 
                                            'category' => $bk_all_cats, 
                                            'post__not_in' => $excludeid, 
                                            'post_status' => 'publish', 
                                            'orderby' => 'rand'  );
                $bk_relate_categories = get_posts( $bk_related_args );
    
                if(sizeof($bk_relate_categories) > 0){
                    foreach ( $bk_relate_categories as $bk_relate_category ) {
                        array_push($bk_related_posts, $bk_relate_category);
                    }
                }
            }
            if ( $bk_related_posts != NULL ) {
                
                echo '<div id="bk-related-posts" class="clear-fix">
                        <h3 class="block-title">'.__('Related Posts', 'bkninja').'</h3><ul>';
                foreach ( $bk_related_posts as $key => $post ) { //setup global post
                    if($key > ($bk_number_related - 1))
                        break;                                   
                    setup_postdata($post);  
?> 
                    <li class="main-post">
							
								<div class="thumb-wrap">
                                    <?php 
                					$category = get_the_category(); 
                                    if (array_key_exists(0,$category)){
                    					if($category[0]){?>  										
                    						<div class="post-cat post-cat-bg">
                    							<?php echo '<a  href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
                    						</div>					
                    			     <?php
                    					}
                                    }
                				    ?>
									<div class="thumb">
										<a href="<?php the_permalink() ?>">
                                            <?php echo (bk_get_thumbnail(get_the_ID(), 'bk330_220'));?>
                                        </a>
									</div>
									
									<div class="overlay">									
										<a class="post-link" href="<?php the_permalink() ?>"><i class="icon-link"></i></a>	
									</div>
								
								
								</div>
						
							
							<div class="post-info">
								<h3 class="post-title post-title-main-post">
									<a href="<?php the_permalink() ?>">
										<?php
                                            $title = get_the_title();
                                            $short_title = the_excerpt_limit($title, 10);
											echo $short_title; 
										?>
									</a>
								</h3>
								<div class="post-meta post-meta-primary clear-fix">                   
                
                                    <span class="post-author">
                                            <?php the_author_posts_link();?>                           
                                    </span>	
                             					   
                    			</div>
                                
                                <div class="post-meta post-meta-secondary clear-fix">
                                    <span class="views">
                    					<i class="fa fa-eye"></i>									
                    					<?php echo getPostViews(get_the_ID()); ?>
                    				</span>
                       								
                    				<?php if ( comments_open() ) : ?>
                    					<span class="comments">
                    						<i class="fa fa-comment"></i>
                    						<?php comments_popup_link( __('0', 'bkninja'), __('1', 'bkninja'), __('%', 'bkninja')); ?>
                    					</span>		
                				    <?php endif; ?>
                                    
                                </div>
                                
							</div>							
						</li>
<?php 
                  } 
               echo '</ul></div>';
            wp_reset_postdata();    
            }    
    }
}

/**
 * ************* Get youtube ID  *****************
 *---------------------------------------------------
 */ 
if ( ! function_exists( 'parse_youtube' ) ) {
    function parse_youtube($link) {
     
        $regexstr = '~
            # Match Youtube link and embed code
            (?:                             # Group to match embed codes
                (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
                |(?:                        # Group to match if older embed
                    (?:<object .*>)?      # Match opening Object tag
                    (?:<param .*</param>)*  # Match all param tags
                    (?:<embed [^>]*src=")?  # Match embed tag to the first quote of src
                )?                          # End older embed code group
            )?                              # End embed code groups
            (?:                             # Group youtube url
                https?:\/\/                 # Either http or https
                (?:[\w]+\.)*                # Optional subdomains
                (?:                         # Group host alternatives.
                youtu\.be/                  # Either youtu.be,
                | youtube\.com              # or youtube.com
                | youtube-nocookie\.com     # or youtube-nocookie.com
                )                           # End Host Group
                (?:\S*[^\w\-\s])?           # Extra stuff up to VIDEO_ID
                ([\w\-]{11})                # $1: VIDEO_ID is numeric
                [^\s]*                      # Not a space
            )                               # End group
            "?                              # Match end quote if part of src
            (?:[^>]*>)?                       # Match any extra stuff up to close brace
            (?:                             # Group to match last embed code
                </iframe>                 # Match the end of the iframe
                |</embed></object>          # or Match the end of the older embed
            )?                              # End Group of last bit of embed code
            ~ix';
    
        preg_match($regexstr, $link, $matches);
    
        return $matches[1];
    
    }
}
/**
 * ************* Get vimeo ID *****************
 *---------------------------------------------------
 */  
if ( ! function_exists( 'parse_vimeo' ) ) {
    function parse_vimeo($link) {
     
        $regexstr = '~
            # Match Vimeo link and embed code
            (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
            (?:                         # Group vimeo url
                https?:\/\/             # Either http or https
                (?:[\w]+\.)*            # Optional subdomains
                vimeo\.com              # Match vimeo.com
                (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
                \/                      # Slash before Id
                ([0-9]+)                # $1: VIDEO_ID is numeric
                [^\s]*                  # Not a space
            )                           # End group
            "?                          # Match end quote if part of src
            (?:[^>]*></iframe>)?        # Match the end of the iframe
            (?:<p>.*</p>)?              # Match any title information stuff
            ~ix';
    
        preg_match($regexstr, $link, $matches);
    
        return $matches[1];
    }
}

if ( ! function_exists( 'parse_dailymotion' ) ) {
    function parse_dailymotion($link) {
        preg_match('#<object[^>]+>.+?http://www.dailymotion.com/swf/video/([A-Za-z0-9]+).+?</object>#s', $link, $matches);
    
            // Dailymotion url
            if(!isset($matches[1])) {
                preg_match('#http://www.dailymotion.com/video/([A-Za-z0-9]+)#s', $link, $matches);
            }
    
            // Dailymotion iframe
            if(!isset($matches[1])) {
                preg_match('#http://www.dailymotion.com/embed/video/([A-Za-z0-9]+)#s', $link, $matches);
            }
        return $matches[1];
    }
}
/**
 * ************* Social Share Box *****************
 *---------------------------------------------------
 */  

if ( ! function_exists( 'bk_share_box' ) ) {        
    function bk_share_box($fb,$tw,$gp,$pi,$tbl,$li,$su,$vk) {?>
    	<?php
    		/* get permalink */
    		$titleget = get_the_title();
    	?>
        <div class="bk-share-box clear-fix">
            <h3 class="block-title"><?php _e('Share this post','bkninja'); ?></h3>
            <ul>
                <?php if ($fb): ?>
                    <li><a class="bk_facebook_share" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink());?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink());?>"><i class="fa fa-facebook " title="Facebook"></i></a></li>
                <?php endif; ?>
                <?php if ($tw): ?>
                    <li><a class="bk_twitter_share" onClick="window.open('http://twitter.com/share?url=<?php echo urlencode(get_permalink());?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo urlencode(get_permalink());?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>"><i class="fa fa-twitter " title="Twitter"></i></a></li>
                <?php endif; ?>
                <?php if ($gp): ?>
                    <li><a class="bk_google_share" onClick="window.open('https://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>"><i class="fa fa-google-plus " title="Google Plus"></i></a></li>
                <?php endif; ?>
                <?php if ($pi): ?>
                    <li><a class="bk_pinterest_share" href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'><i class="fa fa-pinterest " title="Pinterest"></i></a></li>
                <?php endif; ?>
                <?php if ($tbl): 
                    $str = urlencode(get_permalink());
                    $str = preg_replace('#^https?://#', '', $str);
                ?>
                    <li><a class="bk_tumblr_share" onClick="window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink());?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>','Tumblr','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.tumblr.com/share/link?url=<?php echo $str; ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>"><i class="fa fa-tumblr " title="Tumblr"></i></a></li>
                <?php endif; ?>
                <?php if ($li): ?>
                    <li><a class="bk_linkedin_share" onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink());?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink());?>"><i class="fa fa-linkedin " title="Linkedin"></i></a></li>
                <?php endif; ?>
                <?php if ($su): ?>
                    <li><a class="bk_stumbleupon_share" onClick="window.open('http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink());?>','Stumbleupon','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink());?>"><i class="fa fa-stumbleupon" title="Stumbleupon"></i></a></li>
                <?php endif; ?>
                <?php if ($vk): ?>
                    <li><a class="bk_vk_share" onClick="window.open('http://vkontakte.ru/share.php?url=<?php echo urlencode(get_permalink());?>','VK','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://vkontakte.ru/share.php?url=<?php echo urlencode(get_permalink());?>"><i class="fa fa-vk " title="VK"></i></a></li>
                <?php endif; ?>                        
            </ul>
        </div>
     <?php   
    }
}
//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		echo '<meta property="og:image" content=""/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'bk600_315' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

// Gets instagram data
function fetchData($url){
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
     $result = curl_exec($ch);
     curl_close($ch); 
     return $result;
}
