<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 
    $counter = 1;
?>
    <?php if($title) { ?>
        <div class="panel_title">
            <div>
                <h4>
                    <?php if($link) { ?>
                        <a href="<?php echo esc_url($link);?>">
                    <?php } ?>
                        <?php echo esc_html__($title);?>
                    <?php if($link) { ?>
                        </a>
                    <?php } ?>
                </h4>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <?php 
                $DF_builder->set_double($my_query->post->ID);
                $image = get_post_thumb($my_query->post->ID,0,0);

                //categories
                $categories = get_the_category($my_query->post->ID);
                $catCount = count($categories);
                //select a random category id
                $id = rand(0,$catCount-1);
                if(isset($categories[$id]->term_id)) {
                    $titleColor = df_title_color($categories[$id]->term_id, "category", false); 
                } else {
                    $titleColor = df_get_option(THEME_NAME."_pageColorScheme");
                }
            ?>
                <div class="col<?php if($columnID == "column4") { ?> col_12_of_12<?php } elseif($columnID == "column6") { ?> col_6_of_12<?php } else { ?> col_4_of_12<?php } ?>">
                    <!-- Layout post 1 -->
                    <div class="layout_post_1">
                        <div class="item_thumb">
                        <?php if(df_option_compare("showTumbIcon","showTumbIcon", $my_query->post->ID)==true) { ?>
                            <div class="thumb_icon">
                                <a href="<?php the_permalink();?>" style="background-color: <?php echo esc_attr__($titleColor);?>"><?php df_image_icons($my_query->post->ID);?></a>
                            </div>
                        <?php } ?>
                            <div class="thumb_hover">
                                <a href="<?php the_permalink();?>">
                                    <?php echo df_image_html($my_query->post->ID,500,500);?>
                                </a>
                            </div>
                            <div class="thumb_meta">
                                <?php 
                                    if(count(get_the_category($my_query->post->ID))>=1 && df_option_compare("postCategory","postCategory", $my_query->post->ID)==true) {
                                ?>
                                    <a href="<?php echo esc_url(get_category_link($categories[$id]->term_id));?>">
                                        <span class="category" style="background-color: <?php echo esc_attr__($titleColor);?>">
                                            <?php echo esc_html__(get_cat_name($categories[$id]->term_id));?>
                                        </span>
                                    </a>
                                <?php } ?>
                                <?php if(df_option_compare("postComments","postComments", $my_query->post->ID)==true && comments_open()) { ?>
                                    <span class="comments">
                                        <a href="<?php the_permalink();?>#comment">
                                            <?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?>
                                        </a>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="item_content">
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                            <div class="item_meta clearfix">
                                <?php if(df_option_compare('postDate','postDate',$my_query->post->ID)==true) { ?>
                                    <span class="meta_date">
                                        <a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))); ?>">
                                            <?php the_time(get_option('date_format'));?>
                                        </a>
                                    </span>
                                <?php } ?>
                                <?php if(df_option_compare('showLikes','showLikes',$my_query->post->ID)==true) { ?>
                                    <span class="meta_likes">
                                        <a href="<?php the_permalink();?>"><?php echo intval(get_post_meta( $my_query->post->ID, "_".THEME_NAME."_total_votes", true ));?></a>
                                    </span>
                                <?php } ?>
                            </div>
                            <?php 
                                add_filter('excerpt_length', 'df_new_excerpt_length_20');
                                the_excerpt();
                                remove_filter('excerpt_length', 'df_new_excerpt_length_20');
                            ?>
                        </div>
                    </div><!-- End Layout post 1 -->
                </div>

                <?php 
                if($columnID=="column6") {
                    $a = 2;
                } else {
                    $a = 3;
                }
                if($counter%$a==0 && $counter!=$my_query->post_count) { ?>
                </div>
                <div class="row">
                <?php } ?>
        <?php $counter++; ?>
        <?php endwhile; endif; ?>
    </div>