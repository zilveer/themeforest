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
        
        $uid = uniqid('main-slider-');
    ?>


    <?php $query = new WP_Query( $args ); ?>
    <?php if($query->have_posts()):?>
        <div class="module-main-slider <?php if ($query->post_count == 1) {echo 'show-title';}?>">
			<div class="main-slider">
                <div id="<?php echo $uid;?>" class="flexslider main-slider-frame" >
    				<ul class="slides">
    					
    					<?php while($query->have_posts()): $query->the_post(); ?>	
                            <?php 
                                $post_id = get_the_ID();
                                $thumb_id = get_post_thumbnail_id();
                                $thumb_url = wp_get_attachment_image_src($thumb_id, 'bk1050_600', true);
                            ?>					
                                <li>
                                    <div class="thumb">									
                                        <?php echo (bk_get_thumbnail($post_id, 'bk1050_600'));?>						
        								<div class="post-info overlay">
                                            <div class="post-info-overlay">
                                                <h2 class="post-cat post-cat-main-slider">                                                 
                                                <?php
                                                    $category = get_the_category( $post_id );
                                                    $cat_link = get_category_link( get_cat_ID($category[0]->cat_name));
                                                    echo '<a class="main-color-hover" href="'; echo $cat_link; echo '">';
                                                    echo $category[0]->cat_name;
                                                    echo '</a>';
                                                ?>                                           
                                                </h2>
                                                <div class="post-info-line"></div>								
            									<h2 class="post-title post-title-main-slider">
            										<a href="<?php the_permalink() ?>">
            											<?php
                                                            $title = the_title(FALSE);
                                                            $short_title = the_excerpt_limit($title, 10);
            												echo $short_title; 
            											?>
            										</a>
            									</h2>
                                            </div>
                                        </div>
                                    </div>
    								
    							</li>																			
    					<?php endwhile; ?>
    				</ul>
    			</div>
            </div>
        </div>	
    <?php endif; ?>   					
	<?php
    $bk_flex_el['category_slider'][$uid] = null;

    wp_localize_script( 'customjs', 'bk_flex_el', $bk_flex_el );
    ?>   