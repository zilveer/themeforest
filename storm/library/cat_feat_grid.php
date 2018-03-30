<?php
    global $bk_option;
    global $bk_flex_el;
    $feat_tag = '';
    if (isset($bk_option)):
        $rtl = $bk_option['bk-rtl-sw'];
        $videothumb_opt = $bk_option['bk-video-thumb'];
        if ($bk_option['feat-tag'] != '') $feat_tag = $bk_option['feat-tag'];
    endif;
	$entries_display = 5;
    $cat_id = $wp_query->get_queried_object_id();        
        
        if ($feat_tag != '') {
            $args = array(
				'tag' => $feat_tag,
                'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $entries_display,
                );   
        } else {
            $args = array(
				'post__in'  => get_option( 'sticky_posts' ),
                'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $entries_display,
                );
        }         
        
        $grid_slider_uid = uniqid('masonry-grid-slider-'); 
        $bk_flex_el['grid'][$grid_slider_uid] = null;
 
       wp_localize_script( 'customjs', 'bk_flex_el', $bk_flex_el );
    ?>
    <?php 
    $posts_array = get_posts( $args );
    $number_posts_ret = count($posts_array);
    if ($number_posts_ret < 5){
        return;
    }
    $slide_num = $number_posts_ret - 4;

?>
        <div class="module-grid">
    		<div class="grid-widget-posts <?php if ($layout == 'left') {echo 'left-slider';} else {echo 'center-slider';} ?>" >
    			 <div class="js-masonry grid-container">
    				<?php
    
                        for ($i=0; $i<$number_posts_ret;$i++){
                            switch($i){
                                case $number_posts_ret - 4:
                                case $number_posts_ret - 1:
                                case $number_posts_ret - 2:
                                case $number_posts_ret - 3:
                                    
                                        $pos = $i;
                                    echo ('<div class="small-grid item invisible">');
                                        echo ("<div class='item-wrap'>");
                                            echo ("<div class='thumb'><a href='". get_permalink($posts_array[$pos]->ID)."'>");
                                            echo (bk_get_thumbnail($posts_array[$pos]->ID, 'bk270_210'));
                                            echo("</a>");
                                            echo (bk_get_post_info($posts_array[$pos]->ID)); 
                                            echo bk_review_score($posts_array[$pos]->ID);
                                            echo ("</div>");
                                        echo ('</div>');
                                    echo ('</div>');
                                    break;
                                default:
                                    $pos = $i;
                                    if ($i == 0) {
                                        echo ('<div class="big-grid item">');
                                        echo ('<div id='.$grid_slider_uid.' class="flexslider masonry-grid-slider" >');   
                                        echo ('<ul class="slides">');
                                        }
                                            echo ('<li>');
                                                echo ("<div class='thumb'><a href='". get_permalink($posts_array[$pos]->ID)."'>");
                                                echo (bk_get_thumbnail($posts_array[$pos]->ID, 'bk530_416'));
                                                echo("</a>");
                                                echo (bk_get_post_info($posts_array[$pos]->ID));
                                                echo bk_review_score($posts_array[$pos]->ID);
                                                echo ("</div>");
                                            echo ('</li>');
                                    if ($i == $number_posts_ret - 5) {
                                            echo('</ul>');
                                        echo('</div>');      
                                    echo '</div>';
                                    }
                                    break;
                            }
                            
                        }
                     
    ?>
    				
    			</div>
    		</div>
        </div>